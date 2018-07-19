<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 28/06/18
 * Time: 17:04
 */
add_theme_support( 'post-thumbnails' );

foreach (glob(get_stylesheet_directory() . "/inc/functions/custom-post/*.php") as $function) {
    $function= basename($function);
    require get_template_directory() . '/inc/functions/custom-post/' . $function;
}