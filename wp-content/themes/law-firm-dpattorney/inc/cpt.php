<?php
// Register Custom Post Types: case_studies, practice_areas, team_members
add_action('init', function() {
    // Case Studies
    register_post_type('case_study', [
        'labels' => [
            'name' => __('Case Studies', 'law-firm-dpattorney'),
            'singular_name' => __('Case Study', 'law-firm-dpattorney'),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'cases'],
        'menu_icon' => 'dashicons-portfolio',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest' => true,
    ]);
    // Practice Areas
    register_post_type('practice_area', [
        'labels' => [
            'name' => __('Practice Areas', 'law-firm-dpattorney'),
            'singular_name' => __('Practice Area', 'law-firm-dpattorney'),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'practice-areas'],
        'menu_icon' => 'dashicons-shield-alt',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest' => true,
    ]);
    // Team Members
    register_post_type('team_member', [
        'labels' => [
            'name' => __('Team Members', 'law-firm-dpattorney'),
            'singular_name' => __('Team Member', 'law-firm-dpattorney'),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'team'],
        'menu_icon' => 'dashicons-businessperson',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest' => true,
    ]);
    // Taxonomies for case categories, status, court level, year
    register_taxonomy('case_category', 'case_study', [
        'label' => __('Case Categories', 'law-firm-dpattorney'),
        'hierarchical' => true,
        'show_in_rest' => true,
    ]);
    register_taxonomy('case_status', 'case_study', [
        'label' => __('Case Status', 'law-firm-dpattorney'),
        'hierarchical' => false,
        'show_in_rest' => true,
    ]);
    register_taxonomy('court_level', 'case_study', [
        'label' => __('Court Level', 'law-firm-dpattorney'),
        'hierarchical' => false,
        'show_in_rest' => true,
    ]);
    register_taxonomy('practice_area_category', 'practice_area', [
        'label' => __('Practice Area Categories', 'law-firm-dpattorney'),
        'hierarchical' => true,
        'show_in_rest' => true,
    ]);
});
