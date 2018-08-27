<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 20/08/18
 * Time: 10:37
 */

function partner_render( $content ) {
    $number_partner = get_post_meta( get_the_ID(), 'nombre_de_post', true );
    $sub_text = get_post_meta( get_the_ID(), 'texte_inferieur', true );
    if ( ! is_single () && get_page_template_slug() == 'tpl-homepage.php' ) {
        $args = array(
            'posts_per_page'    => $number_partner,
            'post_type'         => 'partenaires',
        );
        $posts = get_posts($args);

        $html .= <<<EOF
            <div class="bloc-partner container-fullwidth">
            <div class="row">
EOF;

        $count = 12/$number_partner;

        foreach($posts as $post):
            $post_url = get_permalink($post->ID);
            $post_banner_img = get_the_post_thumbnail_url($post->ID);
            $post_logo_img = get_post_meta( $post->ID, 'logo_du_partenaire', true );
            $post_content = substr($post->post_content, 0, 100);
            $html .= <<<EOF
            <a href="$post_url" class="partner-content col-$count">
                <div class="partner-banner" style="background-image: url($post_banner_img);">
                    <div class="content-bloc-partner">
                        <img src="$post_logo_img" class="partner-logo">
                        <p class='partner-temoignage'>$post_content</p>
                    </div>
                </div>
            </a>
EOF;
        endforeach;

        $html .=<<<EOF
        <div class="partner-button row">
            <div class="partner-button-text-before col-2"></div>
            <a class="partner-button-text col-8" href="#">$sub_text</a>
            <div class="partner-button-text-after col-2"></div>
        </div>
        </div>
    </div>
EOF;
        $content .= $html;
    }
    return $content;
}
add_action('the_content', 'partner_render');