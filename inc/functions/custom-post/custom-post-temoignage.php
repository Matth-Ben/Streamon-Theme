<?php

/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 28/06/18
 * Time: 17:10
 */

function wpm_custom_post_partenaires() {

    $labels = array(
        'name'                => _x( 'Partenaires', 'Post Type General Name'),
        'singular_name'       => _x( 'Partenaire', 'Post Type Singular Name'),
        'menu_name'           => __( 'Partenaires' ),
        'all_items'           => __( 'Toutes les Partenaires'),
        'view_item'           => __( 'Voir les Partenaires'),
        'add_new_item'        => __( 'Ajouter un nouveau Partenaire'),
        'add_new'             => __( 'Ajouter'),
        'edit_item'           => __( 'Editer le Partenaire'),
        'update_item'         => __( 'Modifier le Partenaire'),
        'search_items'        => __( 'Rechercher un Partenaire'),
        'not_found'           => __( 'Non trouvé'),
        'not_found_in_trash'  => __( 'Non trouvé dans la corbeille'),
    );

    $args = array(
        'label'               => __( 'Partenaires'),
        'description'         => __( 'Tous sur Partenaires'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
        'hierarchical'        => false,
        'public'              => true,
        'has_archive'         => true,
        'rewrite'			  => array( 'slug' => 'partenaire'),
        'menu_icon'           => 'dashicons-groups',
    );

    register_post_type( 'partenaires', $args );

}

add_action( 'init', 'wpm_custom_post_partenaires' );


class logo_partner_Metabox {
    private $screen = array(
        'partenaires',
    );
    private $meta_fields = array(
        array(
            'label' => 'Logo du partenaire',
            'id' => 'logo_du_partenaire',
            'type' => 'media',
        ),
    );
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'admin_footer', array( $this, 'media_fields' ) );
        add_action( 'save_post', array( $this, 'save_fields' ) );
    }
    public function add_meta_boxes() {
        foreach ( $this->screen as $single_screen ) {
            add_meta_box(
                'logopartner',
                __( 'Logo du partenaire', 'textdomain' ),
                array( $this, 'meta_box_callback' ),
                $single_screen,
                'normal',
                'default'
            );
        }
    }
    public function meta_box_callback( $post ) {
        wp_nonce_field( 'logopartner_data', 'logopartner_nonce' );
        $this->field_generator( $post );
    }
    public function media_fields() {
        ?><script>
            jQuery(document).ready(function($){
                if ( typeof wp.media !== 'undefined' ) {
                    var _custom_media = true,
                        _orig_send_attachment = wp.media.editor.send.attachment;
                    $('.logopartner-media').click(function(e) {
                        var send_attachment_bkp = wp.media.editor.send.attachment;
                        var button = $(this);
                        var id = button.attr('id').replace('_button', '');
                        _custom_media = true;
                        wp.media.editor.send.attachment = function(props, attachment){
                            if ( _custom_media ) {
                                $('input#'+id).val(attachment.url);
                            } else {
                                return _orig_send_attachment.apply( this, [props, attachment] );
                            };
                        }
                        wp.media.editor.open(button);
                        return false;
                    });
                    $('.add_media').on('click', function(){
                        _custom_media = false;
                    });
                }
            });
        </script><?php
    }
    public function field_generator( $post ) {
        $output = '';
        foreach ( $this->meta_fields as $meta_field ) {
            $label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
            $meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
            if ( empty( $meta_value ) ) {
                $meta_value = $meta_field['default']; }
            switch ( $meta_field['type'] ) {
                case 'media':
                    $input = sprintf(
                        '<input style="width: 80%%" id="%s" name="%s" type="text" value="%s"> <input style="width: 19%%" class="button logopartner-media" id="%s_button" name="%s_button" type="button" value="Upload" />',
                        $meta_field['id'],
                        $meta_field['id'],
                        $meta_value,
                        $meta_field['id'],
                        $meta_field['id']
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
        if ( ! isset( $_POST['logopartner_nonce'] ) )
            return $post_id;
        $nonce = $_POST['logopartner_nonce'];
        if ( !wp_verify_nonce( $nonce, 'logopartner_data' ) )
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
if (class_exists('logo_partner_Metabox')) {
    new logo_partner_Metabox;
};