<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 15/06/18
 * Time: 10:29
 */
?>

<?php get_header(); ?>

<div id="content" class="row">
    <?php if(have_posts()) : ?>
        <?php while(have_posts()) : the_post(); ?>
            <div class="post col" id="post-<?php the_ID(); ?>">
                <h2>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="post_content">
                    <?php the_excerpt(); ?>
                </div>

                <p class="postmetadata">
                    <?php the_time('j F Y') ?> par <?php the_author() ?> | Cat&eacute;gorie: <?php the_category(', ') ?> | <?php comments_popup_link('Pas de commentaires', '1 Commentaire', '% Commentaires'); ?> <?php edit_post_link('Editer', ' &#124; ', ''); ?>   </p>
            </div>
        <?php endwhile; ?>
        <div class="navigation"> <?php posts_nav_link(' - ','page suivante','page pr&eacute;c&eacute;dente'); ?> </div>
    <?php endif; ?>
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
