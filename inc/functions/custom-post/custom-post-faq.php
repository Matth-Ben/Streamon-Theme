<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 28/06/18
 * Time: 16:54
 */

function wpm_custom_post_faq() {

    $labels = array(
        // Le nom au pluriel
        'name'                => _x( 'FAQs', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name'       => _x( 'FAQ', 'Post Type Singular Name'),
        // Le libellé affiché dans le menu
        'menu_name'           => __( 'FAQ' ),
        // Les différents libellés de l'administration
        'all_items'           => __( 'Toutes les FAQs'),
        'view_item'           => __( 'Voir les FAQs'),
        'add_new_item'        => __( 'Ajouter une nouvelle FAQ'),
        'add_new'             => __( 'Ajouter'),
        'edit_item'           => __( 'Editer la FAQ'),
        'update_item'         => __( 'Modifier la FAQ'),
        'search_items'        => __( 'Rechercher une FAQ'),
        'not_found'           => __( 'Non trouvée'),
        'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
    );

    $args = array(
        'label'               => __( 'FAQ'),
        'description'         => __( 'Tous sur FAQ'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'has_archive'         => true,
        'rewrite'			  => array( 'slug' => 'foire-aux-questions'),
        'menu_icon'           => 'dashicons-format-chat',
        'taxonomies'          => array( 'category' ),
    );

    register_post_type( 'foire-aux-questions', $args );

}

add_action( 'init', 'wpm_custom_post_faq' );