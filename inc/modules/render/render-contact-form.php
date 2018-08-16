<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 16/08/18
 * Time: 10:44
 */
function contact_form_render( $content ) {
    $title_form = get_post_meta( get_the_ID(), 'title-contact-form', true );
    $shortcode_form = do_shortcode(get_post_meta( get_the_ID(), 'shortcode-contact-form', true ));
    $title_map_form = get_post_meta( get_the_ID(), 'title-map-form', true );
    $cp_city_form = get_post_meta( get_the_ID(), 'cp-city-form', true );
    $maps_link_form = get_post_meta( get_the_ID(), 'google-maps-link-form', true );
    $address_mail_form = get_post_meta( get_the_ID(), 'address-mail-form', true );
    $url_facebook_form = get_post_meta( get_the_ID(), 'url-facebook-form', true );
    $url_twitter_form = get_post_meta( get_the_ID(), 'url-twitter-form', true );
    $url_instagram_form = get_post_meta( get_the_ID(), 'url-instagram-form', true );
    $url_youtube_form = get_post_meta( get_the_ID(), 'url-youtube-form', true );
    $url_discord_form = get_post_meta( get_the_ID(), 'url-discord-form', true );
    $url_twitch_form = get_post_meta( get_the_ID(), 'url-twitch-form', true );

    $icon_reseaux_sociaux = "";

    if ("" != $url_facebook_form) {
        $icon_reseaux_sociaux .= '<a href="' . $url_facebook_form .' " class="col"><i class="fab fa-facebook-f"></i></a>';
    }
    if ("" != $url_twitter_form) {
        $icon_reseaux_sociaux .= '<a href="' . $url_twitter_form .' " class="col"><i class="fab fa-twitter"></i></a>';
    }
    if ("" != $url_instagram_form) {
        $icon_reseaux_sociaux .= '<a href="' . $url_instagram_form .' " class="col"><i class="fab fa-instagram"></i></a>';
    }
    if ("" != $url_youtube_form) {
        $icon_reseaux_sociaux .= '<a href="' . $url_youtube_form .' " class="col"><i class="fab fa-youtube"></i></a>';
    }
    if ("" != $url_discord_form) {
        $icon_reseaux_sociaux .= '<a href="' . $url_discord_form .' " class="col"><i class="fab fa-discord"></i></a>';
    }
    if ("" != $url_twitch_form) {
        $icon_reseaux_sociaux .= '<a href="' . $url_twitch_form .' " class="col"><i class="fab fa-twitch"></i></a>';
    }

    if ( ! is_single () && get_page_template_slug() == 'tpl-contact.php' ) {

        $html .= <<<EOF
        <div class="module-contact-form">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="contact-form">            
                            <h2 class="contact-form-title">$title_form</h2>
                            <hr>
                            <div class='contact-form-shortcode'>$shortcode_form</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="contact-form-map row">
                            <div class="icon-map col-4">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <div class="content-top col-5">
                                <h2 class="contact-form-map-title">$title_map_form</h2>
                                <h4 class="contact-form-map-cp-city">$cp_city_form</h4>
                            </div>
                        </div>
                        <div class="contact-form-map-link">$maps_link_form</div>
                        <div class="contact-form-address">
                            <h4 class="contact-form-address-mail">$address_mail_form</h4>
                            <hr>
                            <div class="icon-form row">
                                $icon_reseaux_sociaux
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
EOF;
        $content .= $html;
    }
    return $content;
}
add_action('the_content', 'contact_form_render');