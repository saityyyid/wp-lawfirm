<?php
/**
 * Register Custom Gutenberg Blocks
 * @package law-firm-dpattorney
 */
// Register custom Gutenberg blocks
add_action('init', 'law_firm_dpattorney_register_blocks');
function law_firm_dpattorney_register_blocks() {
	// Hero Case Block
	register_block_type(__DIR__ . '/../blocks/hero-section/', [
		'render_callback' => 'law_firm_dpattorney_render_hero_case_block',
	]);
	// Case Grid Block
	register_block_type(__DIR__ . '/../blocks/case-grid/', [
		'render_callback' => 'law_firm_dpattorney_render_case_grid_block',
	]);
	// Team Grid Block
	register_block_type(__DIR__ . '/../blocks/team-grid/', [
		'render_callback' => 'law_firm_dpattorney_render_team_grid_block',
	]);
	// Practice Grid Block
	register_block_type(__DIR__ . '/../blocks/practice-grid/', [
		'render_callback' => 'law_firm_dpattorney_render_practice_grid_block',
	]);
	// Stat Counter Block
	register_block_type(__DIR__ . '/../blocks/stat-counter/', [
		'render_callback' => 'law_firm_dpattorney_render_stat_counter_block',
	]);
}

function law_firm_dpattorney_render_hero_case_block($attributes, $content) {
	// Render hero section with case data
	ob_start();
	echo '<section class="hero-case-block">';
	// ...output hero markup based on $attributes...
	echo '</section>';
	return ob_get_clean();
}
function law_firm_dpattorney_render_case_grid_block($attributes, $content) {
	ob_start();
	echo '<div class="case-grid-block">';
	// ...output case grid markup based on $attributes...
	echo '</div>';
	return ob_get_clean();
}
function law_firm_dpattorney_render_team_grid_block($attributes, $content) {
	ob_start();
	echo '<div class="team-grid-block">';
	// ...output team grid markup based on $attributes...
	echo '</div>';
	return ob_get_clean();
}
function law_firm_dpattorney_render_practice_grid_block($attributes, $content) {
	ob_start();
	echo '<div class="practice-grid-block">';
	// ...output practice grid markup based on $attributes...
	echo '</div>';
	return ob_get_clean();
}
function law_firm_dpattorney_render_stat_counter_block($attributes, $content) {
	ob_start();
	echo '<div class="stat-counter-block">';
	// ...output stat counter markup based on $attributes...
	echo '</div>';
	return ob_get_clean();
}
