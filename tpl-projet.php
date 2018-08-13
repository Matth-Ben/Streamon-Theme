<?php
/**
 * Created by PhpStorm.
 * User: Matthias
 * Date: 28/06/2018
 * Time: 19:57
 */

/*
Template Name: Projet
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

    <div class="navbar-thumbnails">
        <div class="container">
            <div class="button-group filters-button-group text-center" id="filters">
                <button class="button is-checked active-tag btn-small" data-filter="*">Tout</button>
                <?php
                $terms = get_terms("type");
                $count = count($terms);
                if ( $count > 0 ) {
                    foreach ( $terms as $term ) {
                        $termname = ($term->slug);
                        echo ' <button class="button btn-small" data-filter=".'.$termname.'">'.$termname.'</button>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="container-large">
        <ul id="projet-list" class="thumbnails grid row" style="width: 100%">
            <?php
            $args = array(
                'post_type'   => 'projet'
            );
            $query = new WP_Query($args);
            if( $query -> have_posts() ) :
                while($query->have_posts()) : $query->the_post();
                    if (has_post_thumbnail()) : $image = get_the_post_thumbnail_url();
                    $terms = get_the_terms($post->ID,'type');
                    $term = array_shift($terms);?>
                    <li class="element-item col-4 <?php echo $term->slug ?>">
                        <div style="background-image: url('<?php echo $image; ?>')">
                            <div class="content-thumbnail">
                                <div class="content-thumbnail-date">
                                    Date projet
                                </div>
                                <div class="content-thumbnail-title">
                                    <a class="fancybox thumbnail" id="post-<?php echo $post->ID ?>" href="<?php echo the_permalink() ?>" title="<?php echo the_title() ?>">
                                        <h3><?php echo the_title(); ?></h3>
                                    </a>
                                </div>
                                <div class="content-thumbnail-button">
                                    <a class="btn btn-raised btn-secondary-so" href="<?php echo the_permalink() ?>"><?php echo __('En savoir plus', 'streamon') ?></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                    elseif($thumbnail = get_post_meta($post->ID, 'image', true)) : ?>
                        <li>
                            <a class="fancybox thumbnail" id="post-<?php echo $post->ID ?>" href="<?php echo the_permalink() ?>" title="<?php echo the_title() ?>">
                                <?php echo the_title(); ?>
                            </a>
                        </li>
                    <?php
                    endif;
                endwhile;
            endif;
            ?>
        </ul>
    </div>
</div>
<?php get_footer(); ?>
