<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 14/08/18
 * Time: 16:46
 */

class faq_Metabox {

    private $screen = array(
        'page',
    );
    private $meta_fields = array(
        array(
            'label' => 'Titre',
            'id' => 'title-bloc-faq',
            'type' => 'text',
        ),
        array(
            'label' => 'Text',
            'id' => 'content-bloc-faq',
            'type' => 'textarea',
        ),
        array(
            'label' => 'Title button',
            'id' => 'title-button-faq',
            'type' => 'text',
        ),
        array(
            'label' => 'Url button',
            'id' => 'url-button-faq',
            'type' => 'url',
        ),
    );
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_fields' ) );
    }
    public function add_meta_boxes() {
        foreach ( $this->screen as $single_screen ) {
            global $post;
            if ('tpl-contact.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
                add_meta_box(
                    'metabox_faq',
                    __( 'FAQ Content', 'textdomain' ),
                    array( $this, 'meta_box_callback' ),
                    $single_screen,
                    'normal',
                    'low'
                );
            }
        }
    }
    public function meta_box_callback( $post ) {
        wp_nonce_field( 'metabox_faq_data', 'metabox_faq_nonce' );
        $this->field_generator( $post );
    }
    public function field_generator( $post ) {

//        var_dump(get_page_template()); exit;

        $output = '';
        foreach ( $this->meta_fields as $meta_field ) {
            $label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
            $meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
            if ( empty( $meta_value ) ) {
                $meta_value = $meta_field['default']; }
            switch ( $meta_field['type'] ) {
                case 'textarea':
                    $input = sprintf(
                        '<textarea style="width: 100%%" id="%s" name="%s" rows="5">%s</textarea>',
                        $meta_field['id'],
                        $meta_field['id'],
                        $meta_value
                    );
                    break;
                default:
                    $input = sprintf(
                        '<input %s id="%s" name="%s" type="%s" value="%s">',
                        $meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
                        $meta_field['id'],
                        $meta_field['id'],
                        $meta_field['type'],
                        $meta_value
                    );
            }
            $output .= $this->format_rows( $label, $input );
        }
        echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
    }
    public function format_rows( $label, $input ) {
        return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
    }
    public function save_fields( $post_id ) {
        if ( ! isset( $_POST['metabox_faq_nonce'] ) )
            return $post_id;
        $nonce = $_POST['metabox_faq_nonce'];
        if ( !wp_verify_nonce( $nonce, 'metabox_faq_data' ) )
            return $post_id;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return $post_id;
        foreach ( $this->meta_fields as $meta_field ) {
            if ( isset( $_POST[ $meta_field['id'] ] ) ) {
                switch ( $meta_field['type'] ) {
                    case 'email':
                        $_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
                        break;
                    case 'text':
                        $_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
                        break;
                }
                update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
            } else if ( $meta_field['type'] === 'checkbox' ) {
                update_post_meta( $post_id, $meta_field['id'], '0' );
            }
        }
    }
}
if (class_exists('faq_Metabox')) {
    new faq_Metabox;
};