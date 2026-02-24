<?php
/**
 * Featured Cases Section
 * @package DPATTORNEY
 */
$cases = new WP_Query([
    'post_type' => 'case_study',
    'posts_per_page' => 3,
    'meta_query' => [
        [
            'key' => 'case_status',
            'value' => ['Won', 'Ongoing'],
            'compare' => 'IN',
        ],
    ],
]);
?>
<section class="featured-cases">
    <h2 class="uppercase-tracked"><?php _e('Kasus Terkemuka', 'law-firm-dpattorney'); ?></h2>
    <p><?php _e('Track record kami dalam menangani kasus kompleks', 'law-firm-dpattorney'); ?></p>
    <div class="featured-cases-list">
        <?php while ($cases->have_posts()): $cases->the_post(); ?>
            <div class="featured-case-card">
                <div class="featured-case-image">
                    <?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?>
                </div>
                <div class="featured-case-content">
                    <h3><?php the_title(); ?></h3>
                    <span class="case-status-<?php echo strtolower(get_post_meta(get_the_ID(), 'case_status', true)); ?>">
                        <?php echo esc_html(get_post_meta(get_the_ID(), 'case_status', true)); ?>
                    </span>
                    <span class="case-year"> <?php echo esc_html(get_post_meta(get_the_ID(), 'case_year', true)); ?> </span>
                    <div class="case-excerpt"> <?php the_excerpt(); ?> </div>
                    <a href="<?php the_permalink(); ?>" class="case-detail-link"><?php _e('Lihat Detail', 'law-firm-dpattorney'); ?></a>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <a href="<?php echo get_post_type_archive_link('case_study'); ?>" class="btn btn-primary">
        <?php _e('Lihat Semua Kasus', 'law-firm-dpattorney'); ?>
    </a>
</section>
