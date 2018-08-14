<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 15/06/18
 * Time: 10:29
 */

require_once 'inc/functions/sidebar.php';
require_once 'inc/functions/menu.php';
require_once 'inc/functions/custom-post-type.php';

foreach (glob(get_stylesheet_directory() . "/inc/modules/*.php") as $function) {
    $function= basename($function);
    require get_template_directory() . '/inc/modules/' . $function;
}

foreach (glob(get_stylesheet_directory() . "/inc/modules/render/*.php") as $function) {
    $function= basename($function);
    require get_template_directory() . '/inc/modules/render/' . $function;
}


foreach (glob(get_stylesheet_directory() . "/inc/template/*.php") as $function) {
    $function= basename($function);
    require get_template_directory() . '/inc/template/' . $function;
}

foreach (glob(get_stylesheet_directory() . "/inc/plugins/*.php") as $function) {
    $function= basename($function);
    require get_template_directory() . '/inc/plugins/' . $function;
}

add_action('wp_footer', 'so_insert_js_footer');
function so_insert_js_footer() { ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
    <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="js/isotope-docs.min.js?6"></script>

<?php }