<?php

add_action('wp_print_styles', 'child_theme_style', 11);
function child_theme_style()
{
    wp_enqueue_style('hemingway-child-style', mix('/public/assets/css/app.css'));
}

/**
 * Load child theme javascript
 *
 * @return void
 */
add_action('wp_enqueue_scripts', 'child_theme_script', 11);
function child_theme_script()
{
    wp_enqueue_script('child-custom-script', mix('/public/assets/js/app.js'), array('jquery'), '1.0', true);
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

/**
 * Disable featured image for single post
 * 
 * @return string
 */
add_filter('post_thumbnail_html', 'wordpress_hide_feature_image', 10, 3);
function wordpress_hide_feature_image($html, $post_id, $post_image_id)
{
    return is_single() ? '' : $html;
}

/**
 * Change post excerpt ending. 
 * 
 * @return string
 */
function new_excerpt_more($more)
{
    // error_log(print_r($more), 1);
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Gets the path to a versioned Mix file in a theme.
 *
 * Use this function if you want to load theme dependencies. This function will cache the contents
 * of the manifest file for you. This also means that you can’t work with different mix locations.
 * For that, you’d need to use `mix_any()`.
 *
 * Inspired by <https://www.sitepoint.com/use-laravel-mix-non-laravel-projects/>.
 *
 * @since 1.0.0
 *
 * @param string $path The relative path to the file.
 * @param string $manifest_directory Optional. Custom path to manifest directory. Default 'build'.
 *
 * @return string The versioned file URL.
 */
function mix($path, $manifest_directory = 'public/assets')
{
    static $manifest;
    static $manifest_path;

    if (!$manifest_path) {
        $manifest_path = get_theme_file_path($manifest_directory . '/mix-manifest.json');
    }

    // Bailout if manifest couldn’t be found
    if (!file_exists($manifest_path)) {
        return get_theme_file_uri($path);
    }

    if (!$manifest) {
        // @codingStandardsIgnoreLine
        $manifest = json_decode(file_get_contents($manifest_path), true);
    }

    // Remove manifest directory from path
    $path = str_replace($manifest_directory, '', $path);
    // Make sure there’s a leading slash
    $path = '/' . ltrim($path, '/');

    // Bailout with default theme path if file could not be found in manifest
    if (!array_key_exists($path, $manifest)) {
        return get_theme_file_uri($path);
    }

    // Get file URL from manifest file
    $path = $manifest[$path];
    // Make sure there’s no leading slash
    $path = ltrim($path, '/');

    return get_stylesheet_directory_uri() . '/' . trailingslashit($manifest_directory) . $path;
}
