<?php
/**
 * Single Case Study Template
 * @package law-firm-dpattorney
 */
get_header();
?>
<main id="primary" class="site-main single-case-study">
  <?php
  while ( have_posts() ) : the_post();
    get_template_part( 'template-parts/sections/hero-case' );
    get_template_part( 'template-parts/components/case-card' );
    // ...additional meta, sidebar, CTA...
  endwhile;
  ?>
</main>
<?php get_footer(); ?>
