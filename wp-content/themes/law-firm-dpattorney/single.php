<?php
/**
 * Single Post Template
 * @package law-firm-dpattorney
 */
get_header();
?>
<main id="primary" class="site-main">
  <?php
  while ( have_posts() ) : the_post();
    get_template_part( 'template-parts/components/breadcrumb' );
    get_template_part( 'template-parts/components/post-card' );
    the_post_navigation();
  endwhile;
  ?>
</main>
<?php get_footer(); ?>
