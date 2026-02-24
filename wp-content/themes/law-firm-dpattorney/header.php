<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="site-header">
    <?php
    // Contact Info Bar
    $contact_bar = get_theme_mod('law_firm_header_contact_bar');
    if ($contact_bar) {
        echo '<div class="header-contact-bar">' . esc_html($contact_bar) . '</div>';
    }

    // Header classes
    $header_classes = '';
    if (get_theme_mod('law_firm_header_sticky')) $header_classes .= ' sticky-header';
    if (get_theme_mod('law_firm_header_transparent')) $header_classes .= ' transparent-header';

    // Header style
    $header_style = 'height:' . esc_attr(get_theme_mod('law_firm_header_height', '80px')) . ';';
    $header_style .= 'background:' . esc_attr(get_theme_mod('law_firm_header_bg_color', '#0A0A0A')) . ';';
    $header_style .= 'opacity:' . esc_attr(get_theme_mod('law_firm_header_opacity', '1')) . ';';
    if (get_theme_mod('law_firm_header_border_bottom')) $header_style .= 'border-bottom:1px solid #A1A1A6;';

    ?>
    <div class="site-header-inner<?php echo $header_classes; ?>" style="<?php echo $header_style; ?>">
        <div class="header-logo">
            <?php
            // Logo variants
            $logo_dark = get_theme_mod('law_firm_logo_dark');
            $logo_light = get_theme_mod('law_firm_logo_light');
            if ($logo_dark || $logo_light) {
                $logo = get_theme_mod('law_firm_header_transparent') ? $logo_light : $logo_dark;
                if ($logo) {
                    echo '<img src="' . esc_url($logo) . '" alt="Logo">';
                }
            } elseif (has_custom_logo()) {
                the_custom_logo();
            } else {
                echo '<h1>' . get_bloginfo('name') . '</h1>';
            }
            ?>
        </div>
        <nav id="site-navigation">
            <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
        </nav>
        <div class="header-cta">
            <a href="<?php echo esc_url(get_theme_mod('law_firm_header_cta_url', '#')); ?>" class="cta-btn accent">
                <?php echo esc_html(get_theme_mod('law_firm_header_cta_text', __('Free Consultation', 'law-firm-dpattorney'))); ?>
            </a>
        </div>
        <?php if (get_theme_mod('law_firm_header_search_icon')) { ?>
            <div class="header-search-icon">
                <span>&#128269;</span>
            </div>
        <?php } ?>
        <?php
        $social_icons = get_theme_mod('law_firm_header_social_icons');
        if ($social_icons) {
            echo '<div class="header-social-icons">';
            $icons = explode(',', $social_icons);
            foreach ($icons as $icon) {
                $icon = trim($icon);
                if ($icon) echo '<span class="social-icon">' . esc_html($icon) . '</span>';
            }
            echo '</div>';
        }
        ?>
    </div>
</header>
