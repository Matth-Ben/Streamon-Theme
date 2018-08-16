<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 16/08/18
 * Time: 10:28
 */

class form_contact_Metabox {

    private $screen = array(
        'page',
    );
    private $meta_fields = array(
        array(
            'label' => 'Title',
            'id' => 'title-contact-form',
            'type' => 'text',
        ),
        array(
            'label' => 'Shortcode Form',
            'id' => 'shortcode-contact-form',
            'type' => 'textarea',
        ),
        array(
            'label' => 'Title Maps',
            'id' => 'title-map-form',
            'type' => 'text',
        ),
        array(
            'label' => 'Code Postal & City',
            'id' => 'cp-city-form',
            'type' => 'text',
        ),
        array(
            'label' => 'Google Maps Link',
            'id' => 'google-maps-link-form',
            'type' => 'textarea',
        ),
        array(
            'label' => 'Address Mail',
            'id' => 'address-mail-form',
            'type' => 'text',
        ),
        array(
            'label' => 'Facebook',
            'id' => 'url-facebook-form',
            'type' => 'text',
        ),
        array(
            'label' => 'Twitter',
            'id' => 'url-twitter-form',
            'type' => 'text',
        ),
        array(
            'label' => 'Instagram',
            'id' => 'url-instagram-form',
            'type' => 'text',
        ),
        array(
            'label' => 'Youtube',
            'id' => 'url-youtube-form',
            'type' => 'text',
        ),
        array(
            'label' => 'Discord',
            'id' => 'url-discord-form',
            'type' => 'text',
        ),
        array(
            'label' => 'Twitch',
            'id' => 'url-twitch-form',
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
            if ('tpl-contact.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
                add_meta_box(
                    'metabox_contact_form',
                    __( 'Contact Form', 'textdomain' ),
                    array( $this, 'meta_box_callback' ),
                    $single_screen,
                    'normal',
                    'low'
                );
            }
        }
    }
    public function meta_box_callback( $post ) {
        wp_nonce_field( 'metabox_contact_form_data', 'metabox_contact_form_nonce' );
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
        if ( ! isset( $_POST['metabox_contact_form_nonce'] ) )
            return $post_id;
        $nonce = $_POST['metabox_contact_form_nonce'];
        if ( !wp_verify_nonce( $nonce, 'metabox_contact_form_data' ) )
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
if (class_exists('form_contact_Metabox')) {
    new form_contact_Metabox;
};