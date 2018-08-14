<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 14/08/18
 * Time: 17:18
 */
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