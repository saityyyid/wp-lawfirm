<?php
/**
 * Template Name: Fullwidth
 * @package law-firm-dpattorney
 */
get_header();
?>
<main id="primary" class="site-main fullwidth-template">
  <?php
  while ( have_posts() ) : the_post();
    the_content();
  endwhile;
  ?>
</main>
<?php get_footer(); ?>
