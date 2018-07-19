<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 15/06/18
 * Time: 10:29
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
    <title><?php if ( is_404() ) : ?> &raquo; <?php _e('Not Found') ?><?php elseif ( is_home() ) : ?> &raquo; <?php bloginfo('description') ?><?php else : ?><?php wp_title() ?><?php endif ?></title>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /><?php wp_head(); ?>   <?php wp_get_archives('type=monthly&format=link'); ?> <?php //comments_popup_script(); <?php wp_head(); ?>

    <link rel="stylesheet" href="css/isotope-docs.css?6" media="screen">
</head>
<body>

<div id="page">
    <div id="header">
        <nav class="navbar navbar-expand-lg navbar-dark bn-grey">

            <?php if ( has_nav_menu('header-menu') ) : ?>

                <?php if ( has_nav_menu('header-sub-menu')) : ?>

                    <?php if ( function_exists( 'the_custom_logo' ) ) : ?>

                        <?php the_custom_logo(); ?>

                    <?php else : ?>

                        <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>

                    <?php endif; ?>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <?php

                    wp_nav_menu(array('theme_location' => 'header-menu', 'container_class' => 'collapse navbar-collapse justify-content-center', 'container_id' => 'navbarText', 'menu_class' => 'menu', 'menu_id' => '',
                        'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s navbar-nav nav nav-tabs">%3$s</ul>', 'item_spacing' => 'preserve',
                        'depth' => 0, 'walker' => ''));

                    wp_nav_menu(array('theme_location' => 'header-sub-menu'));

                    ?>

                <?php else : ?>

                    <div class="container">

                        <?php if ( function_exists( 'the_custom_logo' ) ) : ?>

                            <?php the_custom_logo(); ?>

                        <?php else : ?>

                            <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>

                        <?php endif; ?>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <?php

                        wp_nav_menu(array('theme_location' => 'header-menu', 'container_class' => 'collapse navbar-collapse justify-content-end ', 'container_id' => 'navbarText', 'menu_class' => 'menu', 'menu_id' => '',
                            'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s navbar-nav nav nav-tabs">%3$s</ul>', 'item_spacing' => 'preserve',
                            'depth' => 0, 'walker' => ''));

                        ?>

                    </div>

                <?php endif; ?>

            <?php else : ?>

                <?php menu_theme(); ?>

            <?php endif; ?>

        </nav>

    </div>