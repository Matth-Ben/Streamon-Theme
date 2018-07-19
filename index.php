<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 15/06/18
 * Time: 10:29
 */
get_header(); ?>

<div class="container">

    <div id="content" class="row">

        <div class="col row" >

            <?php if(have_posts()) : ?>

                <?php while(have_posts()) : the_post(); ?>

    <!--                --><?php //for () : ?>
    <!---->
    <!--                --><?php //endfor; ?>

                    <div class="post col" id="post-<?php the_ID(); ?>">

                        <h2>

                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>

                        </h2>

                        <div class="post_content">

                            <?php the_content(); ?>

                        </div>

                        <p class="postmetadata">

                            <?php the_time('j F Y') ?> par <?php the_author() ?> | Cat&eacute;gorie: <?php the_category(', ') ?> | <?php comments_popup_link('Pas de commentaires', '1 Commentaire', '% Commentaires'); ?> <?php edit_post_link('Editer', ' &#124; ', ''); ?>

                        </p>

                    </div>

                <?php endwhile; ?>

            <?php endif; ?>

        </div>

        <?php /*get_sidebar(); */?>

    </div>

</div>

<?php get_footer(); ?>
