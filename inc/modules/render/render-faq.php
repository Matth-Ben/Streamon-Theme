<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 14/08/18
 * Time: 17:21
 */
function faq_render( $content ) {
    $title_bloc = get_post_meta( get_the_ID(), 'title-bloc-faq', true );
    $content_bloc = get_post_meta( get_the_ID(), 'content-bloc-faq', true );
    $title_button = get_post_meta( get_the_ID(), 'title-button-faq', true );
    $url_button = get_post_meta( get_the_ID(), 'url-button-faq', true );
    if ( ! is_single () && get_page_template_slug() == 'tpl-contact.php' ) {
        $args = array(
            'posts_per_page'    => 4,
            'post_type'         => 'foire-aux-questions',
        );
        $posts = get_posts($args);

        foreach($posts as $post):
            $post_url = get_permalink($post->ID);
            $post_img = get_the_post_thumbnail_url($post->ID);
            $faq_bloc = <<<EOF
            <div class="col-3">
                <a href="$post_url">
                    <div class="faq-post-content" style="background-image: url($post_img);">
                        <h2 class="faq-post-title">$post->post_title</h2>
                        <p class='faq-post-date'>$post->post_date</p>
                        <p class='faq-post-content'>$post->post_content</p>
                    </div>
                </a>
            </div>
EOF;
        endforeach;

        $html .= <<<EOF
        <div class="module-faq">
            <div class="container">
                <div class="faq">
                    <div class="faq-content">
                        <h2 class="post-title">$title_bloc</h2>
                        <hr>
                        <p class='post-comment-count'>$content_bloc</p>
                    </div>
                </div>    
                <div class="faq-bloc row">
                    $faq_bloc
                </div>
                <div class="faq-button">
                    <a href="$url_button">$title_button</a>
                </div>
            </div>
        </div>
EOF;
        $content .= $html;
    }
    return $content;
}
add_action('the_content', 'faq_render');