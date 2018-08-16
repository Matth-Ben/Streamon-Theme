<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 14/08/18
 * Time: 17:19
 */
function mra_display_product( $content ) {
    if ( ! is_single () && get_page_template_slug() == 'tpl-projet.php' ) {
        if ( get_post_meta( get_the_ID(), 'display-article', true ) == 'on' ) {
            $terms = get_terms("category");
            foreach ( $terms as $term ) {
                if ($term->slug == get_post_meta( get_the_ID(), 'category-title', true )) {
                    $id_cat = $term->term_id;
                }
            }
            $args = array(
                'posts_per_page'    => 1,
                'cat'               => $id_cat,
            );
            $posts = get_posts($args);
            foreach($posts as $post):
                $post_url = get_permalink($post->ID);
                $post_img = get_the_post_thumbnail_url($post->ID);
                $html = <<<EOF
            <div class="article-expo">
                <div class="article-content" style="background-image: url($post_img);">
                    <div class="content-expo">
                        <h2 class="post-title"><a href="$post_url">$post->post_title</a></h2>
                        <p class='post-date'>$post->post_date</p>
                        <p class='post-content'>$post->post_content</p>
                    </div>
                </div>
                <div class="bar-expo">
                    <div class="content-bar-expo">
                        <p class='post-comment-count'>$post->comment_count commentaires</p>
                    </div>
                </div>
            </div>
EOF;
            endforeach;
            $content .= $html;
        }
    }
    return $content;
}
add_action('the_content', 'mra_display_product');