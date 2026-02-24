<?php
/**
 * Single Practice Area Template
 * @package law-firm-dpattorney
 */
get_header();
?>
<main id="primary" class="site-main single-practice-area">
  <?php
  while ( have_posts() ) : the_post();
    get_template_part( 'template-parts/sections/hero-practice' );
    get_template_part( 'template-parts/components/practice-card' );
    // ...additional meta, sidebar, CTA...
  endwhile;
  ?>
</main>
<?php get_footer(); ?>
