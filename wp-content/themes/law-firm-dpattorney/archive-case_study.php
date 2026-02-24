<?php
/**
 * Archive Case Study Template
 * @package DPATTORNEY
 */
get_header();
?>
<section class="case-filter-bar">
    <!-- Filter by status, category, year, court level -->
</section>
<section class="case-grid">
    <?php
    $args = array(
        'post_type' => 'case_study',
        'posts_per_page' => 12,
    );
    $query = new WP_Query($args);
    if ($query->have_posts()):
        echo '<div class="grid">';
        while ($query->have_posts()): $query->the_post();
            get_template_part('template-parts/case-card');
        endwhile;
        echo '</div>';
    endif;
    wp_reset_postdata();
    ?>
</section>
<?php get_footer(); ?>
