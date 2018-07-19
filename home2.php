<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 15/06/18
 * Time: 10:28
 */
get_header(); ?>

<?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>