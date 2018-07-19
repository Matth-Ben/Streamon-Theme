<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 28/06/18
 * Time: 17:10
 */
function wpm_custom_post_temoignage() {

    $labels = array(
        // Le nom au pluriel
        'name'                => _x( 'Témoignages', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name'       => _x( 'Témoignage', 'Post Type Singular Name'),
        // Le libellé affiché dans le menu
        'menu_name'           => __( 'Témoignages' ),
        // Les différents libellés de l'administration
        'all_items'           => __( 'Toutes les témoignages'),
        'view_item'           => __( 'Voir les témoignages'),
        'add_new_item'        => __( 'Ajouter un nouveau témoignage'),
        'add_new'             => __( 'Ajouter'),
        'edit_item'           => __( 'Editer le témoignage'),
        'update_item'         => __( 'Modifier le témoignage'),
        'search_items'        => __( 'Rechercher un témoignage'),
        'not_found'           => __( 'Non trouvée'),
        'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
    );

    $args = array(
        'label'               => __( 'Témoignages'),
        'description'         => __( 'Tous sur témoignages'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
        'hierarchical'        => false,
        'public'              => true,
        'has_archive'         => true,
        'rewrite'			  => array( 'slug' => 'temoignage'),
        'menu_icon'           => 'dashicons-format-quote',
    );

    register_post_type( 'temoignage', $args );

}

add_action( 'init', 'wpm_custom_post_temoignage' );