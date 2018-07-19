<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 15/06/18
 * Time: 17:07
 */ ?>

<?php if ( function_exists('register_sidebar') ) register_sidebar(); ?>

<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
            'name' => __('Footer Column 1', 'virtue'),
            'id' => 'footer_widget_1',
            'before_widget' => '<div class="col"><aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside></div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );
if ( function_exists('register_sidebar') )
    register_sidebar(array(
            'name' => __('Footer Column 2', 'virtue'),
            'id' => 'footer_widget_2',
            'before_widget' => '<div class="col"><aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside></div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );
if ( function_exists('register_sidebar') )
    register_sidebar(array(
            'name' => __('Footer Column 3', 'virtue'),
            'id' => 'footer_widget_3',
            'before_widget' => '<div class="col"><aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside></div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );
if ( function_exists('register_sidebar') )
    register_sidebar(array(
            'name' => __('Footer Column 4', 'virtue'),
            'id' => 'footer_widget_4',
            'before_widget' => '<div class="col"><aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside></div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );
?>
<?php //if ( function_exists('register_sidebar') ) register_sidebar(2); ?>