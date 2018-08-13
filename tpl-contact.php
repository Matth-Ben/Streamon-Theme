<?php
/**
 * Created by PhpStorm.
 * User: matthias
 * Date: 01/08/2018
 * Time: 10:38
 */

/*
Template Name: Contact - FAQ
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
        <div class="title_question_head" >
            <p>Une question ? Une recommendation ?</p>
        </div>
    </div>

    <?php

    the_content();

    ?>

</div>

<?php get_footer(); ?>

