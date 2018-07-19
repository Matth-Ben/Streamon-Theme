<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 28/06/18
 * Time: 16:54
 */

function wpm_custom_post_project() {

    $labels = array(
        // Le nom au pluriel
        'name'                => _x( 'Projets', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name'       => _x( 'Projet', 'Post Type Singular Name'),
        // Le libellé affiché dans le menu
        'menu_name'           => __( 'Projets' ),
        // Les différents libellés de l'administration
        'all_items'           => __( 'Toutes les projets'),
        'view_item'           => __( 'Voir les projets'),
        'add_new_item'        => __( 'Ajouter un nouveau projet'),
        'add_new'             => __( 'Ajouter'),
        'edit_item'           => __( 'Editer le projet'),
        'update_item'         => __( 'Modifier le projet'),
        'search_items'        => __( 'Rechercher un projet'),
        'not_found'           => __( 'Non trouvée'),
        'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
    );

    $args = array(
        'label'               => __( 'Projets'),
        'description'         => __( 'Tous sur projet'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'has_archive'         => true,
        'rewrite'			  => array( 'slug' => 'projet'),
        'menu_icon'           => 'dashicons-welcome-write-blog',
        'taxonomies'          => array( 'type' ),
    );
    register_post_type( 'projet', $args );
}
add_action( 'init', 'wpm_custom_post_project' );

function ct_ntp_type() {
    $labels = array(
        'name' => _x( 'Types', 'Taxonomy General Name', 'ntp_framework' ),
        'singular_name' => _x( 'Type', 'Taxonomy Singular Name', 'ntp_framework' ),
        'menu_name' => __( 'Types', 'ntp_framework' ),
        'all_items' => __( 'Tous les types', 'ntp_framework' ),
        'parent_item' => __( 'Type parent', 'ntp_framework' ),
        'parent_item_colon' => __( 'Type parent :', 'ntp_framework' ),
        'new_item_name' => __( 'Nouveau type', 'ntp_framework' ),
        'add_new_item' => __( 'Ajouter un type', 'ntp_framework' ),
        'edit_item' => __( 'Editer un type', 'ntp_framework' ),
        'update_item' => __( 'Mettre à jour', 'ntp_framework' ),
        'separate_items_with_commas' => __( 'Séparer les types par des virgules', 'ntp_framework' ),
        'search_items' => __( 'Rechercher des types', 'ntp_framework' ),
        'add_or_remove_items' => __( 'Ajouter ou supprimer des types', 'ntp_framework' ),
        'choose_from_most_used' => __( 'Choisir parmi les types les plus utilisés', 'ntp_framework' ),
    );
    $rewrite = array(
        'slug' => 'type',
        'with_front' => true,
        'hierarchical' => true,
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'query_var' => 'type',
        'rewrite' => $rewrite,
    );
    register_taxonomy( 'type', 'projet', $args );
}
add_action( 'init', 'ct_ntp_type', 0 );