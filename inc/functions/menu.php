<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 18/06/18
 * Time: 13:02
 */
function register_my_menu() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Main Menu' ),
            'header-sub-menu' => __( 'User Menu' )
        ));
}
add_action( 'init', 'register_my_menu' );



/*******************Logo*********************/
add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
) );

function theme_prefix_setup() {
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-width' => true,
    ) );
}
add_action( 'after_setup_theme', 'theme_prefix_setup' );

function theme_prefix_the_custom_logo() {

    if ( function_exists( 'the_custom_logo' ) ) {
        the_custom_logo();
    }

}