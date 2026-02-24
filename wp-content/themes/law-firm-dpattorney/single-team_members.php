<?php
/**
 * Single Team Member Template
 * @package law-firm-dpattorney
 */
get_header();
?>
<main id="primary" class="site-main single-team-member">
  <?php
  while ( have_posts() ) : the_post();
    get_template_part( 'template-parts/sections/hero-team' );
    get_template_part( 'template-parts/components/team-card' );
    // ...additional meta, sidebar, CTA...
  endwhile;
  ?>
</main>
<?php get_footer(); ?>
