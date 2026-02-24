<?php
/**
 * Search Results Template
 * @package law-firm-dpattorney
 */
get_header();
?>
<main id="primary" class="site-main">
  <header class="search-header">
    <h1><?php printf( esc_html__('Hasil pencarian untuk: %s', 'law-firm-dpattorney'), '<span>' . get_search_query() . '</span>' ); ?></h1>
  </header>
  <?php if ( have_posts() ) :
    echo '<div class="search-grid">';
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
