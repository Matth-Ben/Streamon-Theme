<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 15/06/18
 * Time: 10:28
 */?>

<?php get_header(); ?>

<div id="content" class="">
    <div>
        <h2>Search</h2>
        <form method="get" id="searchform" action="<?php bloginfo('home'); ?>/" class="form-inline my-2 my-lg-0">
            <div>
                <input class="form-control mr-sm-2" type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="searchsubmit" value="Chercher" >Chercher</button>
            </div>
        </form>
    </div>
    <hr style="color: #000;">
    <div class="row">
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
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
