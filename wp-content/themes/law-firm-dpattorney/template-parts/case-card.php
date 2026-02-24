<?php
/**
 * Case Card Template Part
 * @package DPATTORNEY
 */
$case_status = get_post_meta(get_the_ID(), 'case_status', true);
$case_year = get_post_meta(get_the_ID(), 'case_year', true);
?>
<article class="case-card">
    <div class="case-image">
        <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('medium'); ?>
        <?php endif; ?>
    </div>
    <div class="case-info">
        <h3><?php the_title(); ?></h3>
        <span class="case-status-<?php echo strtolower($case_status); ?>"> <?php echo esc_html($case_status); ?> </span>
        <span class="case-year"> <?php echo esc_html($case_year); ?> </span>
        <div class="case-excerpt">
            <?php the_excerpt(); ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="case-detail-link">
            <?php _e('Lihat Detail', 'law-firm-dpattorney'); ?>
        </a>
    </div>
</article>
