<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 18/07/18
 * Time: 16:11
 */
function mra_display_product( $content ) {
    if ( ! is_single () ) {
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


function bloc_contact_render( $content ) {
    $title_bloc = get_post_meta( get_the_ID(), 'title-bloc', true );
    $content_bloc = get_post_meta( get_the_ID(), 'content-bloc', true );
    $title_button = get_post_meta( get_the_ID(), 'title-button', true );
    $url_button = get_post_meta( get_the_ID(), 'url-button', true );
    if ( ! is_single () ) {
        $html .= <<<EOF
        <div class="container">
            <div class="row bloc-contact">
                <div class="col">
                    <div class="content-expo">
                        <h2 class="post-title">$title_bloc</h2>
                    </div>
                    <div class="content-bar-expo">
                        <p class='post-comment-count'>$content_bloc</p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="contact-button">
                        <a href="$url_button">$title_button</a>
                    </div>
                </div>
            </div>
        </div>
        
EOF;
        $content .= $html;
    }
    return $content;
}
add_action('the_content', 'bloc_contact_render');