<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 20/08/18
 * Time: 10:37
 */

class partner_Metabox {
    private $screen = array(
        'page',
    );
    private $meta_fields = array(
        array(
            'label' => 'Nombre de post',
            'id' => 'nombre_de_post',
            'type' => 'select',
            'options' => array(
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
            ),
        ),
        array(
            'label' => 'Texte inférieur',
            'id' => 'texte_inferieur',
            'type' => 'text',
        ),
    );
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_fields' ) );
    }
    public function add_meta_boxes() {
        foreach ( $this->screen as $single_screen ) {
            global $post;
            if ('tpl-homepage.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
                add_meta_box(
                    'partner_metabox',
                    __('Module partenaire', 'textdomain'),
                    array($this, 'meta_box_callback'),
                    $single_screen,
                    'normal',
                    'default'
                );
            }
        }
    }
    public function meta_box_callback( $post ) {
        wp_nonce_field( 'partner_metabox_data', 'partner_metabox_nonce' );
        $this->field_generator( $post );
    }
    public function field_generator( $post ) {
        $output = '';
        foreach ( $this->meta_fields as $meta_field ) {
            $label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
            $meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
            if ( empty( $meta_value ) ) {
                $meta_value = $meta_field['default']; }
            switch ( $meta_field['type'] ) {
                case 'select':
                    $input = sprintf(
                        '<select id="%s" name="%s">',
                        $meta_field['id'],
                        $meta_field['id']
                    );
                    foreach ( $meta_field['options'] as $key => $value ) {
                        $meta_field_value = !is_numeric( $key ) ? $key : $value;
                        $input .= sprintf(
                            '<option %s value="%s">%s</option>',
                            $meta_value === $meta_field_value ? 'selected' : '',
                            $meta_field_value,
                            $value
                        );
                    }
                    $input .= '</select>';
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
        if ( ! isset( $_POST['partner_metabox_nonce'] ) )
            return $post_id;
        $nonce = $_POST['partner_metabox_nonce'];
        if ( !wp_verify_nonce( $nonce, 'partner_metabox_data' ) )
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
if (class_exists('partner_Metabox')) {
    new partner_Metabox;
};