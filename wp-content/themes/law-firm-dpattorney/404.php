<?php
/**
 * 404 Template
 * @package law-firm-dpattorney
 */
get_header();
?>
<main id="primary" class="site-main not-found">
  <section class="error-404">
    <h1>404</h1>
    <h2><?php esc_html_e('Halaman tidak ditemukan', 'law-firm-dpattorney'); ?></h2>
    <p><?php esc_html_e('Maaf, halaman yang Anda cari tidak tersedia.', 'law-firm-dpattorney'); ?></p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary"><?php esc_html_e('Kembali ke Beranda', 'law-firm-dpattorney'); ?></a>
  </section>
</main>
<?php get_footer(); ?>
