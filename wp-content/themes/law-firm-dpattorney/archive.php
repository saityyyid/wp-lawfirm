<?php
/**
 * Archive Template
 * @package law-firm-dpattorney
 */
get_header();
?>
<main id="primary" class="site-main">
  <header class="archive-header">
    <h1><?php the_archive_title(); ?></h1>
    <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
  </header>
  <?php if ( have_posts() ) :
    echo '<div class="archive-grid">';
    while ( have_posts() ) : the_post();
      get_template_part( 'template-parts/components/post-card' );
    endwhile;
    echo '</div>';
    the_posts_navigation();
  else :
    get_template_part( 'template-parts/components/content', 'none' );
  endif; ?>
</main>
<?php get_footer(); ?>
