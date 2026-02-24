<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header authority-header">
    <div class="container">
        <div class="header-row">
            <div class="logo">
                <?php if (has_custom_logo()) { the_custom_logo(); } else { ?>
                    <span class="site-title">DPATTORNEY</span>
                <?php } ?>
            </div>
            <nav class="main-nav">
                <?php wp_nav_menu(['theme_location' => 'primary', 'menu_class' => 'nav-list']); ?>
            </nav>
            <div class="header-cta">
                <a href="#emergency" class="cta-btn cta-emergency">Konsultasi Darurat</a>
                <a href="tel:0812XXXXXXX" class="header-phone">0812-XXXX-XXXX</a>
                <div class="lang-switcher">ID | EN</div>
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
