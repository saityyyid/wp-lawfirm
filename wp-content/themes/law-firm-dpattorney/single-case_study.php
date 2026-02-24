<?php
/**
 * Single Case Study Template
 * @package DPATTORNEY
 */
get_header();
$case_status = get_post_meta(get_the_ID(), 'case_status', true);
$case_year = get_post_meta(get_the_ID(), 'case_year', true);
$court_level = get_post_meta(get_the_ID(), 'court_level', true);
$client_name = get_post_meta(get_the_ID(), 'client_name', true);
$case_result = get_post_meta(get_the_ID(), 'case_result', true);
$media_coverage = get_post_meta(get_the_ID(), 'media_coverage', true);
$related_attorneys = get_post_meta(get_the_ID(), 'related_attorneys', true);
$categories = get_the_terms(get_the_ID(), 'case_category');
?>
<section class="case-hero">
    <h1><?php the_title(); ?></h1>
    <span class="case-status-<?php echo strtolower($case_status); ?>"> <?php echo esc_html($case_status); ?> </span>
    <span class="case-year"> <?php echo esc_html($case_year); ?> </span>
    <span class="court-level"> <?php echo esc_html($court_level); ?> </span>
</section>
<aside class="case-meta-sidebar">
    <?php if ($client_name): ?>
        <div class="client-name">
            <strong><?php _e('Klien', 'law-firm-dpattorney'); ?>:</strong> <?php echo esc_html($client_name); ?>
        </div>
    <?php endif; ?>
    <div class="attorneys-involved">
        <strong><?php _e('Pengacara', 'law-firm-dpattorney'); ?>:</strong>
        <!-- List related attorneys -->
    </div>
    <div class="media-links">
        <strong><?php _e('Media Coverage', 'law-firm-dpattorney'); ?>:</strong>
        <!-- List media coverage links -->
    </div>
</aside>
<section class="case-content">
    <h2><?php _e('Tantangan', 'law-firm-dpattorney'); ?></h2>
    <div><?php the_content(); ?></div>
    <h2><?php _e('Strategi', 'law-firm-dpattorney'); ?></h2>
    <!-- Strategy content (custom field or block) -->
    <h2><?php _e('Hasil', 'law-firm-dpattorney'); ?></h2>
    <div><?php echo esc_html($case_result); ?></div>
</section>
<section class="related-cases">
    <h2><?php _e('Kasus Terkait', 'law-firm-dpattorney'); ?></h2>
    <!-- Query and display other cases in same category -->
</section>
<?php get_footer(); ?>
