<?php
/**
 * Template Name: Home
 * @package law-firm-dpattorney
 */
get_header();
?>
<main id="primary" class="site-main home-template">
  <?php
    get_template_part('template-parts/sections/hero-case');
    get_template_part('template-parts/sections/section-stats');
    get_template_part('template-parts/sections/section-cases');
    get_template_part('template-parts/sections/section-practices');
    get_template_part('template-parts/sections/section-team');
    get_template_part('template-parts/sections/section-testimonials');
    get_template_part('template-parts/sections/section-insights');
    get_template_part('template-parts/sections/section-cta');
  ?>
</main>
<?php get_footer(); ?>
