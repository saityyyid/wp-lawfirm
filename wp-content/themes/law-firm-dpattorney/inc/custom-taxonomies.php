<?php
/**
 * Register Custom Taxonomies
 * @package law-firm-dpattorney
 */
function law_firm_dpattorney_register_taxonomies() {
  // CASE CATEGORY
  register_taxonomy('case_category', 'case_studies', array(
    'labels' => array(
      'name' => __('Kategori Kasus', 'law-firm-dpattorney'),
      'singular_name' => __('Kategori Kasus', 'law-firm-dpattorney'),
    ),
    'hierarchical' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'kategori-kasus'),
  ));
  // TEAM ROLE
  register_taxonomy('team_role', 'team_members', array(
    'labels' => array(
      'name' => __('Peran Tim', 'law-firm-dpattorney'),
      'singular_name' => __('Peran Tim', 'law-firm-dpattorney'),
    ),
    'hierarchical' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'peran-tim'),
  ));
  // PRACTICE SPECIALTIES
  register_taxonomy('team_specialties', 'team_members', array(
    'labels' => array(
      'name' => __('Spesialisasi', 'law-firm-dpattorney'),
      'singular_name' => __('Spesialisasi', 'law-firm-dpattorney'),
    ),
    'hierarchical' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'spesialisasi'),
  ));
}
add_action('init', 'law_firm_dpattorney_register_taxonomies');
