<?php
// Theme setup: support, scripts, styles, menus, widgets
add_action('after_setup_theme', function() {
    load_theme_textdomain('law-firm-dpattorney', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('custom-logo', [
        'height' => 80,
        'width' => 320,
        'flex-height' => true,
        'flex-width' => true,
    ]);
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    register_nav_menus([
        'primary' => __('Primary Menu', 'law-firm-dpattorney'),
        'footer' => __('Footer Menu', 'law-firm-dpattorney'),
    ]);
});

// Enqueue styles and scripts
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('law-firm-dpattorney-googlefonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600&family=Crimson+Text:ital,wght@0,400;1,700&display=swap', [], null);
    wp_enqueue_style('law-firm-dpattorney-style', get_stylesheet_uri(), [], wp_get_theme()->get('Version'));
    // Critical CSS inline example
    wp_add_inline_style('law-firm-dpattorney-style', '.site-header, .site-footer { font-family: "Inter", sans-serif; } h1, h2, h3, h4 { font-family: "Playfair Display", serif; } blockquote, .case-citation { font-family: "Crimson Text", serif; }');
    // Minified assets and WebP support can be added here
});
