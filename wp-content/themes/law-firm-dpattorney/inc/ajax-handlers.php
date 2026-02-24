<?php
/**
 * AJAX Handlers for Case Filtering
 * @package law-firm-dpattorney
 */
// AJAX handler for case filtering
add_action('wp_ajax_law_firm_dpattorney_filter_cases', 'law_firm_dpattorney_filter_cases');
add_action('wp_ajax_nopriv_law_firm_dpattorney_filter_cases', 'law_firm_dpattorney_filter_cases');
function law_firm_dpattorney_filter_cases() {
	check_ajax_referer('law_firm_dpattorney_filter_cases', 'nonce');
	$status = sanitize_text_field($_POST['status'] ?? '');
	$category = sanitize_text_field($_POST['category'] ?? '');
	$year = sanitize_text_field($_POST['year'] ?? '');
	$court = sanitize_text_field($_POST['court'] ?? '');
	$args = [
		'post_type' => 'case_studies',
		'posts_per_page' => 9,
		'post_status' => 'publish',
		'meta_query' => [],
		'tax_query' => [],
	];
	if ($status) $args['meta_query'][] = ['key'=>'case_status','value'=>$status];
	if ($year) $args['meta_query'][] = ['key'=>'case_year','value'=>$year];
	if ($category) $args['tax_query'][] = ['taxonomy'=>'case_category','field'=>'slug','terms'=>$category];
	if ($court) $args['meta_query'][] = ['key'=>'case_court_level','value'=>$court];
	$query = new WP_Query($args);
	ob_start();
	if ($query->have_posts()) {
		while ($query->have_posts()) { $query->the_post();
			get_template_part('template-parts/components/case-card');
		}
	} else {
		echo '<p>' . esc_html__('Tidak ada kasus ditemukan.', 'law-firm-dpattorney') . '</p>';
	}
	wp_reset_postdata();
	$html = ob_get_clean();
	wp_send_json_success(['html'=>$html]);
}
