<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 15/06/18
 * Time: 10:28
 */
get_header(); ?>
<div class="container">
    <div id="content" class="row">
        <?php if(have_posts()) : ?>
            <?php while(have_posts()) : the_post(); ?>
                <div class="post col" id="post-<?php the_ID(); ?>">
                    <h2>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="post_content">
                        <?php the_content(); ?>
                    </div>

                </div>
            <?php endwhile; ?>
            <?php edit_post_link('Modifier cette page', '<p>', '</p>'); ?>
        <?php endif; ?>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>



