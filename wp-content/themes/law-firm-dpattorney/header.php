<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <div class="site-branding">
                <a href="<?php echo home_url(); ?>" class="site-logo">
                    DPATTORNEY
                </a>
            </div>
            
            <nav class="main-navigation">
                <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
            </nav>
            
            <div class="header-actions">
                <a href="tel:0812XXXXXXX" class="btn-emergency-header">
                    Konsultasi Darurat
                </a>
            </div>
        </div>
    </div>
</header>
<div class="hero-section hero-case-victory">
    <div class="hero-bg-texture"></div>
    <div class="hero-content">
        <span class="hero-preheading">Kemenangan Terbaru</span>
        <h1 class="hero-headline">Bebas dari Tuduhan Korupsi BTS 4G</h1>
        <div class="hero-subheadline">Representasi strategis untuk Johnny G. Plate di Pengadilan Tipikor</div>
        <div class="hero-meta">2023 | Pengadilan Tipikor Jakarta | Status: Bebas</div>
        <div class="hero-ctas">
            <a href="#case-detail" class="cta-btn cta-primary">Lihat Detail Kasus</a>
            <a href="#consult" class="cta-btn cta-secondary">Konsultasi Sekarang</a>
        </div>
    </div>
</div>
