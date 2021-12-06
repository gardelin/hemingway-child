<?php

add_action('wp_print_styles', 'child_theme_style', 11);
function child_theme_style()
{
    wp_enqueue_style('hemingway-child-style', get_stylesheet_directory_uri() . '/public/assets/css/style.css');
}

/**
 * Load child theme javascript
 *
 * @return void
 */
add_action('wp_enqueue_scripts', 'child_theme_script', 11);
function child_theme_script()
{
    wp_enqueue_script('child-custom-script', get_stylesheet_directory_uri() . '/public/assets/js/script.js', array('jquery'), '1.0', true);
}

/**
 * Load languages files
 *
 * @return void
 */
add_action('after_setup_theme', 'child_theme_slug_setup');
function child_theme_slug_setup()
{
    load_child_theme_textdomain('hemingway', get_stylesheet_directory() . '/languages');
}

/**
 * Register widgets
 *
 * @return void
 */
add_action('widgets_init', 'register_widgets');
function register_widgets()
{
    $shared_args = array(
        'before_title'     => '<h3 class="sponsors-title">',
        'after_title'      => '</h3>',
        'before_widget'    => '<div id="%1$s" class="sponsors-image %2$s"><div class="sponsor-content">',
        'after_widget'     => '</div></div>'
    );

    register_sidebar(array_merge($shared_args, array(
        'name'             => __('Sponsors', 'hemingway'),
        'id'               => 'sponsors',
        'description'      => __('Widgets in this area will be shown sponsors section', 'hemingway'),
    )));

    register_sidebar(array_merge($shared_args, array(
        'name'             => __('Patrons', 'hemingway'),
        'id'               => 'patrons',
        'description'      => __('Widgets in this area will be shown patrons section', 'hemingway'),
    )));
}

/**
 * Disable loading parent theme Lato and Railway fonts
 * 
 * @return bool
 */
function hemingway_get_google_fonts_url()
{
    return;
}

add_filter('excerpt_length', 'my_excerpt_length', 1);
function my_excerpt_length($length)
{
    return 30;
}
