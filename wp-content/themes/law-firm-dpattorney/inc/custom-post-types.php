<?php
/**
 * Register Custom Post Types
 * @package law-firm-dpattorney
 */
// CASE STUDY CPT
add_action('init', function() {
  $labels = array(
    'name' => __('Kasus Terkemuka / Notable Cases', 'law-firm-dpattorney'),
    'singular_name' => __('Kasus / Case', 'law-firm-dpattorney'),
    'menu_name' => __('Kasus', 'law-firm-dpattorney'),
    'add_new' => __('Tambah Kasus', 'law-firm-dpattorney'),
    'add_new_item' => __('Tambah Kasus Baru', 'law-firm-dpattorney'),
    'edit_item' => __('Edit Kasus', 'law-firm-dpattorney'),
    'new_item' => __('Kasus Baru', 'law-firm-dpattorney'),
    'view_item' => __('Lihat Kasus', 'law-firm-dpattorney'),
    'search_items' => __('Cari Kasus', 'law-firm-dpattorney'),
    'not_found' => __('Tidak ditemukan', 'law-firm-dpattorney'),
    'not_found_in_trash' => __('Tidak ditemukan di sampah', 'law-firm-dpattorney'),
  );
  register_post_type('case_study', array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-shield-alt',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'rewrite' => array('slug' => 'kasus'),
    'show_in_rest' => true,
  ));
});

// CASE CATEGORY TAXONOMY
add_action('init', function() {
  $labels = array(
    'name' => __('Kategori Kasus', 'law-firm-dpattorney'),
    'singular_name' => __('Kategori', 'law-firm-dpattorney'),
    'search_items' => __('Cari Kategori', 'law-firm-dpattorney'),
    'all_items' => __('Semua Kategori', 'law-firm-dpattorney'),
    'edit_item' => __('Edit Kategori', 'law-firm-dpattorney'),
    'add_new_item' => __('Tambah Kategori', 'law-firm-dpattorney'),
    'menu_name' => __('Kategori Kasus', 'law-firm-dpattorney'),
  );
  register_taxonomy('case_category', 'case_study', array(
    'labels' => $labels,
    'hierarchical' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'kategori-kasus'),
  ));
  $terms = array(
    __('Korupsi / Corruption', 'law-firm-dpattorney'),
    __('Pembunuhan / Murder', 'law-firm-dpattorney'),
    __('Pencemaran Nama Baik / Defamation', 'law-firm-dpattorney'),
    __('Suap / Bribery', 'law-firm-dpattorney'),
    __('Fraud / Fraud', 'law-firm-dpattorney'),
    __('Cyber Crime / Cyber Crime', 'law-firm-dpattorney'),
    __('Lainnya / Other', 'law-firm-dpattorney'),
  );
  foreach ($terms as $term) {
    if (!term_exists($term, 'case_category')) {
      wp_insert_term($term, 'case_category');
    }
  }
});

// CASE STUDY META BOXES
add_action('add_meta_boxes', function() {
  add_meta_box('case_study_meta', __('Detail Kasus', 'law-firm-dpattorney'), 'case_study_meta_callback', 'case_study', 'normal', 'high');
});

function case_study_meta_callback($post) {
  $status = get_post_meta($post->ID, 'case_status', true);
  $court = get_post_meta($post->ID, 'court_level', true);
  $year = get_post_meta($post->ID, 'case_year', true);
  $client = get_post_meta($post->ID, 'client_name', true);
  $result = get_post_meta($post->ID, 'case_result', true);
  $media = get_post_meta($post->ID, 'media_coverage', true);
  $attorneys = get_post_meta($post->ID, 'related_attorneys', true);
  ?>
  <label><?php _e('Status Kasus', 'law-firm-dpattorney'); ?></label>
  <select name="case_status">
    <option value="Ongoing" <?php selected($status, 'Ongoing'); ?>><?php _e('Ongoing', 'law-firm-dpattorney'); ?></option>
    <option value="Won" <?php selected($status, 'Won'); ?>><?php _e('Won', 'law-firm-dpattorney'); ?></option>
    <option value="On Appeal" <?php selected($status, 'On Appeal'); ?>><?php _e('On Appeal', 'law-firm-dpattorney'); ?></option>
    <option value="Settled" <?php selected($status, 'Settled'); ?>><?php _e('Settled', 'law-firm-dpattorney'); ?></option>
  </select><br>
  <label><?php _e('Tingkat Pengadilan', 'law-firm-dpattorney'); ?></label>
  <select name="court_level">
    <option value="Praperadilan" <?php selected($court, 'Praperadilan'); ?>><?php _e('Praperadilan', 'law-firm-dpattorney'); ?></option>
    <option value="Pengadilan Negeri" <?php selected($court, 'Pengadilan Negeri'); ?>><?php _e('Pengadilan Negeri', 'law-firm-dpattorney'); ?></option>
    <option value="Pengadilan Tinggi" <?php selected($court, 'Pengadilan Tinggi'); ?>><?php _e('Pengadilan Tinggi', 'law-firm-dpattorney'); ?></option>
    <option value="Mahkamah Agung" <?php selected($court, 'Mahkamah Agung'); ?>><?php _e('Mahkamah Agung', 'law-firm-dpattorney'); ?></option>
    <option value="Peninjauan Kembali" <?php selected($court, 'Peninjauan Kembali'); ?>><?php _e('Peninjauan Kembali', 'law-firm-dpattorney'); ?></option>
  </select><br>
  <label><?php _e('Tahun Kasus', 'law-firm-dpattorney'); ?></label>
  <input type="number" name="case_year" value="<?php echo esc_attr($year); ?>" maxlength="4"><br>
  <label><?php _e('Nama Klien', 'law-firm-dpattorney'); ?></label>
  <input type="text" name="client_name" value="<?php echo esc_attr($client); ?>"><br>
  <label><?php _e('Hasil Kasus', 'law-firm-dpattorney'); ?></label>
  <textarea name="case_result"><?php echo esc_textarea($result); ?></textarea><br>
  <label><?php _e('Media Coverage', 'law-firm-dpattorney'); ?></label>
  <div id="media_coverage_repeater">
    <!-- Repeater UI for media coverage: url + title -->
  </div>
  <label><?php _e('Pengacara Terkait', 'law-firm-dpattorney'); ?></label>
  <div id="related_attorneys_selector">
    <!-- Relationship UI to Attorney CPT -->
  </div>
  <?php
}

add_action('save_post', function($post_id) {
  if (isset($_POST['case_status'])) {
    update_post_meta($post_id, 'case_status', sanitize_text_field($_POST['case_status']));
  }
  if (isset($_POST['court_level'])) {
    update_post_meta($post_id, 'court_level', sanitize_text_field($_POST['court_level']));
  }
  if (isset($_POST['case_year'])) {
    update_post_meta($post_id, 'case_year', intval($_POST['case_year']));
  }
  if (isset($_POST['client_name'])) {
    update_post_meta($post_id, 'client_name', sanitize_text_field($_POST['client_name']));
  }
  if (isset($_POST['case_result'])) {
    update_post_meta($post_id, 'case_result', sanitize_textarea_field($_POST['case_result']));
  }
  // Media coverage and related attorneys would require custom JS for repeater and relationship UI
});

  // ATTORNEY CPT
  register_post_type('attorney', array(
    'labels' => array(
      'name' => __('Attorney', 'law-firm-dpattorney'),
      'singular_name' => __('Attorney', 'law-firm-dpattorney'),
      'add_new' => __('Tambah Attorney', 'law-firm-dpattorney'),
      'add_new_item' => __('Tambah Attorney', 'law-firm-dpattorney'),
      'edit_item' => __('Edit Attorney', 'law-firm-dpattorney'),
      'new_item' => __('Attorney Baru', 'law-firm-dpattorney'),
      'view_item' => __('Lihat Attorney', 'law-firm-dpattorney'),
      'search_items' => __('Cari Attorney', 'law-firm-dpattorney'),
      'not_found' => __('Tidak ditemukan', 'law-firm-dpattorney'),
      'not_found_in_trash' => __('Tidak ditemukan di sampah', 'law-firm-dpattorney'),
    ),
    'public' => true,
    'menu_icon' => 'dashicons-businessman',
    'menu_position' => 6,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive' => true,
    'rewrite' => array('slug' => 'attorney'),
    'show_in_rest' => true,
  ));

// Default Dion Pongkor attorney on theme activation
add_action('after_switch_theme', function() {
    $title = __('Dion Pongkor', 'law-firm-dpattorney');
    if (!get_page_by_title($title, OBJECT, 'attorney')) {
        wp_insert_post([
            'post_title' => $title,
            'post_content' => __('Managing Partner. Spesialisasi: Corporate Criminal Law, Strategic Litigation, Pretrial Defense. Notable cases: Johnny G. Plate, Tommy Sumardi, Margriet Megawe.', 'law-firm-dpattorney'),
            'post_type' => 'attorney',
            'post_status' => 'publish',
        ]);
    }
});

// Attorney meta fields
add_action('add_meta_boxes', function() {
    add_meta_box('attorney_meta', __('Detail Attorney', 'law-firm-dpattorney'), 'attorney_meta_callback', 'attorney', 'normal', 'high');
});
function attorney_meta_callback($post) {
    $bar = get_post_meta($post->ID, 'bar_admission', true);
    $edu = get_post_meta($post->ID, 'education', true);
    $langs = get_post_meta($post->ID, 'languages', true);
    $email = get_post_meta($post->ID, 'contact_email', true);
    $phone = get_post_meta($post->ID, 'contact_phone', true);
    ?>
    <label><?php _e('Bar Admission', 'law-firm-dpattorney'); ?></label>
    <input type="text" name="bar_admission" value="<?php echo esc_attr($bar); ?>"><br>
    <label><?php _e('Education', 'law-firm-dpattorney'); ?></label>
    <textarea name="education"><?php echo esc_textarea($edu); ?></textarea><br>
    <label><?php _e('Languages', 'law-firm-dpattorney'); ?></label>
    <input type="text" name="languages" value="<?php echo esc_attr($langs); ?>"><br>
    <label><?php _e('Contact Email', 'law-firm-dpattorney'); ?></label>
    <input type="email" name="contact_email" value="<?php echo esc_attr($email); ?>"><br>
    <label><?php _e('Contact Phone', 'law-firm-dpattorney'); ?></label>
    <input type="tel" name="contact_phone" value="<?php echo esc_attr($phone); ?>"><br>
    <label><?php _e('Notable Cases', 'law-firm-dpattorney'); ?></label>
    <div id="notable_cases_selector"></div>
    <label><?php _e('Media Mentions', 'law-firm-dpattorney'); ?></label>
    <div id="media_mentions_repeater"></div>
    <?php
}
add_action('save_post', function($post_id) {
    if (isset($_POST['bar_admission'])) {
        update_post_meta($post_id, 'bar_admission', sanitize_text_field($_POST['bar_admission']));
    }
    if (isset($_POST['education'])) {
        update_post_meta($post_id, 'education', sanitize_textarea_field($_POST['education']));
    }
    if (isset($_POST['languages'])) {
        update_post_meta($post_id, 'languages', sanitize_text_field($_POST['languages']));
    }
    if (isset($_POST['contact_email'])) {
        update_post_meta($post_id, 'contact_email', sanitize_email($_POST['contact_email']));
    }
    if (isset($_POST['contact_phone'])) {
        update_post_meta($post_id, 'contact_phone', sanitize_text_field($_POST['contact_phone']));
    }
    // Notable cases and media mentions would require custom JS for relationship and repeater UI
});

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
    'menu_icon' => 'dashicons-shield',
    'menu_position' => 7,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive' => true,
    'rewrite' => array('slug' => 'area-praktik'),
    'show_in_rest' => true,
  ));

// Default practice areas on theme activation
add_action('after_switch_theme', function() {
    $areas = [
        [
            'title' => __('Hukum Pidana Korporasi', 'law-firm-dpattorney'),
            'desc' => __('Pembelaan korporasi dalam perkara pidana berat dan fraud. Corporate criminal defense for major fraud and white-collar crime.', 'law-firm-dpattorney'),
        ],
        [
            'title' => __('Litigasi Strategis', 'law-firm-dpattorney'),
            'desc' => __('Strategi litigasi untuk kasus berdampak tinggi. Strategic litigation for high-impact cases.', 'law-firm-dpattorney'),
        ],
        [
            'title' => __('Pra-peradilan', 'law-firm-dpattorney'),
            'desc' => __('Pembelaan dan gugatan praperadilan. Pretrial defense and motions.', 'law-firm-dpattorney'),
        ],
        [
            'title' => __('Perlindungan Eksekutif', 'law-firm-dpattorney'),
            'desc' => __('Perlindungan hukum bagi eksekutif dan pejabat. Legal protection for executives and officials.', 'law-firm-dpattorney'),
        ],
        [
            'title' => __('Hukum Administrasi', 'law-firm-dpattorney'),
            'desc' => __('Sengketa administrasi dan perizinan. Administrative and licensing disputes.', 'law-firm-dpattorney'),
        ],
        [
            'title' => __('Hukum Keluarga', 'law-firm-dpattorney'),
            'desc' => __('Sengketa keluarga dan waris. Family and inheritance disputes.', 'law-firm-dpattorney'),
        ],
    ];
    foreach ($areas as $area) {
        if (!get_page_by_title($area['title'], OBJECT, 'practice_areas')) {
            wp_insert_post([
                'post_title' => $area['title'],
                'post_content' => $area['desc'],
                'post_type' => 'practice_areas',
                'post_status' => 'publish',
            ]);
        }
    }
});
add_action('init', 'law_firm_dpattorney_register_cpts');

// Register meta fields using Carbon Fields (or ACF fallback)
