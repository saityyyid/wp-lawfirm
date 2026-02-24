<?php
/**
 * Single Attorney Template
 * @package DPATTORNEY
 */
get_header();
$bar = get_post_meta(get_the_ID(), 'bar_admission', true);
$edu = get_post_meta(get_the_ID(), 'education', true);
$langs = get_post_meta(get_the_ID(), 'languages', true);
$email = get_post_meta(get_the_ID(), 'contact_email', true);
$phone = get_post_meta(get_the_ID(), 'contact_phone', true);
?>
<section class="attorney-hero">
    <?php if (has_post_thumbnail()): ?>
        <div class="attorney-portrait"><?php the_post_thumbnail('large'); ?></div>
    <?php endif; ?>
    <h1><?php the_title(); ?></h1>
    <div class="attorney-title"> <?php _e('Attorney', 'law-firm-dpattorney'); ?> </div>
</section>
<aside class="attorney-meta-sidebar">
    <?php if ($bar): ?><div><strong><?php _e('Bar Admission', 'law-firm-dpattorney'); ?>:</strong> <?php echo esc_html($bar); ?></div><?php endif; ?>
    <?php if ($edu): ?><div><strong><?php _e('Education', 'law-firm-dpattorney'); ?>:</strong> <?php echo nl2br(esc_html($edu)); ?></div><?php endif; ?>
    <?php if ($langs): ?><div><strong><?php _e('Languages', 'law-firm-dpattorney'); ?>:</strong> <?php echo esc_html($langs); ?></div><?php endif; ?>
    <?php if ($email): ?><div><strong><?php _e('Email', 'law-firm-dpattorney'); ?>:</strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></div><?php endif; ?>
    <?php if ($phone): ?><div><strong><?php _e('Phone', 'law-firm-dpattorney'); ?>:</strong> <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></div><?php endif; ?>
    <button class="btn btn-primary"> <?php _e('Jadwalkan Konsultasi', 'law-firm-dpattorney'); ?> </button>
</aside>
<section class="attorney-content">
    <h2><?php _e('Profil', 'law-firm-dpattorney'); ?></h2>
    <div><?php the_content(); ?></div>
    <h2><?php _e('Keahlian', 'law-firm-dpattorney'); ?></h2>
    <!-- List expertise areas -->
    <h2><?php _e('Kasus Terkemuka', 'law-firm-dpattorney'); ?></h2>
    <!-- List notable cases handled -->
    <h2><?php _e('Media Mentions', 'law-firm-dpattorney'); ?></h2>
    <!-- List media mentions -->
</section>
<?php get_footer(); ?>
