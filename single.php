<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 15/06/18
 * Time: 10:28
 */
get_header(); ?>

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

                    <div>
                        <?php previous_post_link() ?> <?php next_post_link() ?>
                    </div>

                    <div>
                        <?php comments_popup_link('Pas de commentaires', '1 Commentaire', '% Commentaires'); ?> <?php edit_post_link('Editer', ' &#124; ', ''); ?>

                        <div class="comments-template"> <?php comments_template(); ?> </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php get_sidebar(); ?>
    </div>

<?php get_footer(); ?>