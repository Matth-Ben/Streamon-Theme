<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 17/08/18
 * Time: 11:53
 */

function wpm_custom_post_partenaire() {

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
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'has_archive'         => true,
        'rewrite'			  => array( 'slug' => 'partenaires'),
        'menu_icon'           => 'dashicons-groups',
        'taxonomies'          => array( 'type_partenaire' ),
    );

    register_post_type( 'partenaires', $args );

}

add_action( 'init', 'wpm_custom_post_partenaire' );