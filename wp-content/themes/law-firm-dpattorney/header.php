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
