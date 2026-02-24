<?php
/**
 * Register Custom Post Types
 * @package law-firm-dpattorney
 */
function law_firm_dpattorney_register_cpts() {
  // CASE STUDIES
  register_post_type('case_studies', array(
    'labels' => array(
      'name' => __('Kasus', 'law-firm-dpattorney'),
      'singular_name' => __('Kasus', 'law-firm-dpattorney'),
      'add_new' => __('Tambah Kasus', 'law-firm-dpattorney'),
      'add_new_item' => __('Tambah Kasus', 'law-firm-dpattorney'),
      'edit_item' => __('Edit Kasus', 'law-firm-dpattorney'),
      'new_item' => __('Kasus Baru', 'law-firm-dpattorney'),
      'view_item' => __('Lihat Kasus', 'law-firm-dpattorney'),
      'search_items' => __('Cari Kasus', 'law-firm-dpattorney'),
      'not_found' => __('Tidak ditemukan', 'law-firm-dpattorney'),
      'not_found_in_trash' => __('Tidak ditemukan di sampah', 'law-firm-dpattorney'),
    ),
    'public' => true,
    'menu_icon' => 'dashicons-shield-alt',
    'menu_position' => 5,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
    'has_archive' => true,
    'rewrite' => array('slug' => 'kasus'),
    'show_in_rest' => true,
  ));

  // TEAM MEMBERS
  register_post_type('team_members', array(
    'labels' => array(
      'name' => __('Partner', 'law-firm-dpattorney'),
      'singular_name' => __('Partner', 'law-firm-dpattorney'),
      'add_new' => __('Tambah Partner', 'law-firm-dpattorney'),
      'add_new_item' => __('Tambah Partner', 'law-firm-dpattorney'),
      'edit_item' => __('Edit Partner', 'law-firm-dpattorney'),
      'new_item' => __('Partner Baru', 'law-firm-dpattorney'),
      'view_item' => __('Lihat Partner', 'law-firm-dpattorney'),
      'search_items' => __('Cari Partner', 'law-firm-dpattorney'),
      'not_found' => __('Tidak ditemukan', 'law-firm-dpattorney'),
      'not_found_in_trash' => __('Tidak ditemukan di sampah', 'law-firm-dpattorney'),
    ),
    'public' => true,
    'menu_icon' => 'dashicons-businessman',
    'menu_position' => 6,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive' => true,
    'rewrite' => array('slug' => 'partner'),
    'show_in_rest' => true,
  ));

  // PRACTICE AREAS
  register_post_type('practice_areas', array(
    'labels' => array(
      'name' => __('Area Praktik', 'law-firm-dpattorney'),
      'singular_name' => __('Area Praktik', 'law-firm-dpattorney'),
      'add_new' => __('Tambah Area Praktik', 'law-firm-dpattorney'),
      'add_new_item' => __('Tambah Area Praktik', 'law-firm-dpattorney'),
      'edit_item' => __('Edit Area Praktik', 'law-firm-dpattorney'),
      'new_item' => __('Area Praktik Baru', 'law-firm-dpattorney'),
      'view_item' => __('Lihat Area Praktik', 'law-firm-dpattorney'),
      'search_items' => __('Cari Area Praktik', 'law-firm-dpattorney'),
      'not_found' => __('Tidak ditemukan', 'law-firm-dpattorney'),
      'not_found_in_trash' => __('Tidak ditemukan di sampah', 'law-firm-dpattorney'),
    ),
    'public' => true,
    'menu_icon' => 'dashicons-awards',
    'menu_position' => 7,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive' => true,
    'rewrite' => array('slug' => 'area-praktik'),
    'show_in_rest' => true,
  ));
}
add_action('init', 'law_firm_dpattorney_register_cpts');

// Register meta fields using Carbon Fields (or ACF fallback)
add_action('carbon_fields_register_fields', 'law_firm_dpattorney_register_meta_fields');
function law_firm_dpattorney_register_meta_fields() {
  // CASE STUDIES META
  \Carbon_Fields\Field\Field::make('text', 'case_client', __('Nama Klien', 'law-firm-dpattorney')),
  \Carbon_Fields\Field\Field::make('select', 'case_status', __('Status Kasus', 'law-firm-dpattorney'))
    ->set_options(['Ongoing'=>'Ongoing','Won'=>'Won','Lost'=>'Lost','On Appeal'=>'On Appeal','Settled'=>'Settled']),
  \Carbon_Fields\Field\Field::make('text', 'case_year', __('Tahun', 'law-firm-dpattorney')),
  \Carbon_Fields\Field\Field::make('select', 'case_court_level', __('Tingkat Pengadilan', 'law-firm-dpattorney'))
    ->set_options(['Praperadilan'=>'Praperadilan','PN'=>'PN','PT'=>'PT','MA'=>'MA','PK'=>'PK']),
  \Carbon_Fields\Field\Field::make('text', 'case_court_name', __('Nama Pengadilan', 'law-firm-dpattorney')),
  \Carbon_Fields\Field\Field::make('textarea', 'case_summary', __('Ringkasan', 'law-firm-dpattorney')),
  \Carbon_Fields\Field\Field::make('rich_text', 'case_result', __('Hasil Akhir', 'law-firm-dpattorney')),
  \Carbon_Fields\Field\Field::make('rich_text', 'case_challenge', __('Tantangan Hukum', 'law-firm-dpattorney')),
  \Carbon_Fields\Field\Field::make('rich_text', 'case_strategy', __('Strategi', 'law-firm-dpattorney')),
  \Carbon_Fields\Field\Field::make('association', 'case_team', __('Tim Terkait', 'law-firm-dpattorney'))
    ->set_types([['type'=>'post','post_type'=>'team_members']]),
  \Carbon_Fields\Field\Field::make('association', 'case_practice_areas', __('Area Praktik', 'law-firm-dpattorney'))
    ->set_types([['type'=>'term','taxonomy'=>'practice_areas']]),
  \Carbon_Fields\Field\Field::make('complex', 'case_media_links', __('Media Links', 'law-firm-dpattorney'))
    ->add_fields([
      \Carbon_Fields\Field\Field::make('text', 'title', __('Judul', 'law-firm-dpattorney')),
      \Carbon_Fields\Field\Field::make('text', 'url', __('URL', 'law-firm-dpattorney')),
      \Carbon_Fields\Field\Field::make('text', 'source', __('Sumber', 'law-firm-dpattorney')),
    ]),
  \Carbon_Fields\Field\Field::make('checkbox', 'case_featured', __('Tampilkan di Homepage', 'law-firm-dpattorney')),
  \Carbon_Fields\Field\Field::make('text', 'case_order', __('Urutan', 'law-firm-dpattorney')),

  \Carbon_Fields\Container\Container::make('post_meta', __('Detail Kasus', 'law-firm-dpattorney'))
    ->where('post_type', '=', 'case_studies')
    ->add_fields([
      ...get_defined_vars()
    ]);

  // TEAM MEMBERS META
  \Carbon_Fields\Container\Container::make('post_meta', __('Detail Partner', 'law-firm-dpattorney'))
    ->where('post_type', '=', 'team_members')
    ->add_fields([
      \Carbon_Fields\Field\Field::make('text', 'team_position', __('Jabatan', 'law-firm-dpattorney')),
      \Carbon_Fields\Field\Field::make('text', 'team_email', __('Email', 'law-firm-dpattorney')),
      \Carbon_Fields\Field\Field::make('text', 'team_phone', __('Telepon', 'law-firm-dpattorney')),
      \Carbon_Fields\Field\Field::make('text', 'team_linkedin', __('LinkedIn', 'law-firm-dpattorney')),
      \Carbon_Fields\Field\Field::make('complex', 'team_education', __('Pendidikan', 'law-firm-dpattorney'))
        ->add_fields([
          \Carbon_Fields\Field\Field::make('text', 'degree', __('Gelar', 'law-firm-dpattorney')),
          \Carbon_Fields\Field\Field::make('text', 'institution', __('Institusi', 'law-firm-dpattorney')),
          \Carbon_Fields\Field\Field::make('text', 'year', __('Tahun', 'law-firm-dpattorney')),
        ]),
      \Carbon_Fields\Field\Field::make('complex', 'team_bar_admissions', __('Bar Admissions', 'law-firm-dpattorney'))
        ->add_fields([
          \Carbon_Fields\Field\Field::make('text', 'admission', __('Admission', 'law-firm-dpattorney')),
          \Carbon_Fields\Field\Field::make('text', 'year', __('Tahun', 'law-firm-dpattorney')),
        ]),
      \Carbon_Fields\Field\Field::make('text', 'team_languages', __('Bahasa', 'law-firm-dpattorney')),
      \Carbon_Fields\Field\Field::make('association', 'team_cases', __('Kasus Ditangani', 'law-firm-dpattorney'))
        ->set_types([['type'=>'post','post_type'=>'case_studies']]),
      \Carbon_Fields\Field\Field::make('text', 'team_order', __('Urutan', 'law-firm-dpattorney')),
      \Carbon_Fields\Field\Field::make('checkbox', 'team_featured', __('Tampilkan di Homepage', 'law-firm-dpattorney')),
    ]);

  // PRACTICE AREAS META
  \Carbon_Fields\Container\Container::make('post_meta', __('Detail Area Praktik', 'law-firm-dpattorney'))
    ->where('post_type', '=', 'practice_areas')
    ->add_fields([
      \Carbon_Fields\Field\Field::make('text', 'practice_icon', __('Ikon', 'law-firm-dpattorney')),
      \Carbon_Fields\Field\Field::make('textarea', 'practice_short_desc', __('Deskripsi Singkat', 'law-firm-dpattorney')),
      \Carbon_Fields\Field\Field::make('association', 'practice_cases', __('Kasus', 'law-firm-dpattorney'))
        ->set_types([['type'=>'post','post_type'=>'case_studies']]),
      \Carbon_Fields\Field\Field::make('association', 'practice_team', __('Tim', 'law-firm-dpattorney'))
        ->set_types([['type'=>'post','post_type'=>'team_members']]),
      \Carbon_Fields\Field\Field::make('complex', 'practice_faq', __('FAQ', 'law-firm-dpattorney'))
        ->add_fields([
          \Carbon_Fields\Field\Field::make('text', 'question', __('Pertanyaan', 'law-firm-dpattorney')),
          \Carbon_Fields\Field\Field::make('textarea', 'answer', __('Jawaban', 'law-firm-dpattorney')),
        ]),
      \Carbon_Fields\Field\Field::make('text', 'practice_order', __('Urutan', 'law-firm-dpattorney')),
    ]);
}
