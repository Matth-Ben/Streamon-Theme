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
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'has_archive'         => true,
        'rewrite'			  => array( 'slug' => 'foire-aux-questions'),
        'menu_icon'           => 'dashicons-format-chat',
        'taxonomies'          => array( 'type_faq' ),
    );

    register_post_type( 'foire-aux-questions', $args );

}

add_action( 'init', 'wpm_custom_post_faq' );

function cpt_faq_type() {
    $labels = array(
        'name' => _x( 'Types FAQ', 'Taxonomy General Name', 'ntp_framework' ),
        'singular_name' => _x( 'Type FAQ', 'Taxonomy Singular Name', 'ntp_framework' ),
        'menu_name' => __( 'Types FAQ', 'ntp_framework' ),
        'all_items' => __( 'Tous les types FAQ', 'ntp_framework' ),
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
        'slug' => 'type_faq',
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
        'query_var' => 'type_faq',
        'rewrite' => $rewrite,
    );
    register_taxonomy( 'type_faq', 'foire-aux-questions', $args );
}
add_action( 'init', 'cpt_faq_type', 0 );