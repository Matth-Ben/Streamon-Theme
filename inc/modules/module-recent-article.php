<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 12/07/18
 * Time: 11:00
 */

function mra_add_meta_box() {
    global $post;
    if ('tpl-projet.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
        add_meta_box(
            'metabox_last_article',
            'Category Article',
            'mra_display_meta_box',
            'page',
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'mra_add_meta_box' );

function mra_display_meta_box( $post ) {
    wp_nonce_field( plugin_basename(__FILE__), 'mra_nonce_field' );

    $terms = get_terms("category");

    $html = '<label id="display-article" for="display-article">';
    $html .= 'Display :';
    $html .= '</label>';

    if ( get_post_meta( get_the_ID(), 'display-article', true ) == 'on' ) {
        $html .= '<input class="form-check-input" type="radio" name="display-article" id="display-article-on" value="on" checked>';
        $html .= '<label class="form-check-label" for="display-article-on">On</label>';
        $html .= '<input class="form-check-input" type="radio" name="display-article" id="display-article-off" value="off">';
        $html .= '<label class="form-check-label" for="display-article-off">Off</label>';
    } else {
        $html .= '<input class="form-check-input" type="radio" name="display-article" id="display-article-on" value="on">';
        $html .= '<label class="form-check-label" for="display-article-on">On</label>';
        $html .= '<input class="form-check-input" type="radio" name="display-article" id="display-article-off" value="off" checked>';
        $html .= '<label class="form-check-label" for="display-article-off">Off</label>';
    }

    $html .= '</br>';
    $html .= '<label id="category-article" for="category-article">';
    $html .= 'Category Article';
    $html .= '</label>';
    $html .= '</br>';
    $html .= '<select type="select" id="category-title" name="category-title" value="' . get_post_meta( $post->ID, 'category-title', true ) . '">';
    foreach ( $terms as $term ) {
        if ( get_post_meta( get_the_ID(), 'category-title', true ) == $term->slug ) {
            $html.= '<option class="category-title" selected="selected" data-filter=".'.$term->slug.'">'.$term->slug.'</option>';
        } else {
            $html.= '<option class="category-title" data-filter=".'.$term->slug.'">'.$term->slug.'</option>';
        }
    }
    $html .= '</select>';
    echo $html;
}

function mra_save_meta_box_data( $post_id ) {
    if ( mra_user_can_save( $post_id, 'mra_nonce_field' ) ) {
        if ( isset( $_POST['category-title'] ) ) {
            $category_title = stripslashes( strip_tags( $_POST['category-title'] ) );
            update_post_meta( $post_id, 'category-title', $category_title );
        }

        if ( isset ($_POST['display-article']) ) {
            $category_display_on = stripslashes( strip_tags( $_POST['display-article'] ) );
            update_post_meta( $post_id, 'display-article', $category_display_on );
        }
    }
}
add_action( 'save_post', 'mra_save_meta_box_data' );

function mra_user_can_save( $post_id, $nonce ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST [ $nonce ], plugin_basename( __FILE__ ) ) );
    return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
}