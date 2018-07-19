<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 15/06/18
 * Time: 10:29
 */ ?>

</div> <!-- Close page -->

<footer class="page-footer font-small bn-grey pt-4 mt-4">
    <!-- Footer Links -->
    <div class="container text-center text-md-left">
        <!-- Grid row -->
        <div class="row">
            <!-- Grid column -->
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_widget_1'))  :?>
                <div class="col-md-6 mt-md-0 mt-3">
                    <!-- Content -->
                    <h5 class="text-uppercase">Footer Content</h5>
                    <p>Here you can use rows and columns here to organize your footer content.</p>
                </div>
                <!-- Grid column -->
                <hr class="clearfix w-100 d-md-none pb-3">
                <!-- Grid column -->
                <div class="col-md-6 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Link 1</a>
                        </li>
                        <li>
                            <a href="#!">Link 2</a>
                        </li>
                        <li>
                            <a href="#!">Link 3</a>
                        </li>
                        <li>
                            <a href="#!">Link 4</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_widget_2'))  :?><?php endif; ?>
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_widget_3'))  :?><?php endif; ?>
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_widget_4'))  :?><?php endif; ?>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3 bn-grey-dark">
        &#169; <?php print(date(Y)); ?> Copyright - <?php bloginfo('name'); ?>
        <br />Blog propulsé par <a href="http://wordpress.org/">WordPress</a> et con&ccedil;u par <a href="http://matthiasbenoit.fr">Benoit Matthias</a>
    </div>
    <!-- Copyright -->

</footer>

</body>
<?php wp_footer(); ?>
</html>
