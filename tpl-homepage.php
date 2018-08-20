<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 17/08/18
 * Time: 12:10
 */

/*
Template Name: Accueil
*/
?>

<?php get_header(); ?>

<div class="container-fullwidth">
    <div class="container">
        <div class="page-header">
            <h1 class="archive_title h2">
                <?php the_title(); ?>
            </h1>
            <hr class="title_highlight">
        </div>
    </div>

<?php

the_content();

?>

</div>

<?php get_footer(); ?>
