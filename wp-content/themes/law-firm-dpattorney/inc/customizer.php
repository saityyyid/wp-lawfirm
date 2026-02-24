// Emergency Bar Customizer Settings
add_action('customize_register', function($wp_customize) {
    $wp_customize->add_section('emergency_bar_section', array(
        'title' => __('Emergency Bar', 'law-firm-dpattorney'),
        'priority' => 30,
    ));
    $wp_customize->add_setting('emergency_bar_enabled', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('emergency_bar_enabled', array(
        'label' => __('Enable Emergency Bar', 'law-firm-dpattorney'),
        'section' => 'emergency_bar_section',
        'type' => 'checkbox',
    ));
    $wp_customize->add_setting('emergency_phone', array(
        'default' => '+62 812-3456-7890',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('emergency_phone', array(
        'label' => __('Emergency Phone Number', 'law-firm-dpattorney'),
        'section' => 'emergency_bar_section',
        'type' => 'text',
    ));
});
<?php
// Theme Customizer: Colors, Typography, Layout, Header/Footer

function law_firm_dpattorney_customize_register($wp_customize) {
    // Panel
    $wp_customize->add_panel('law_firm_dpattorney_options', array(
        'title' => __('Law Firm Theme Options', 'law-firm-dpattorney'),
        'priority' => 10,
    ));

    // Site Identity Section
    $wp_customize->add_section('law_firm_dpattorney_site_identity', array(
        'title' => __('Site Identity', 'law-firm-dpattorney'),
        'panel' => 'law_firm_dpattorney_options',
    ));
    $wp_customize->add_setting('logo_dark');
    $wp_customize->add_setting('logo_light');
    $wp_customize->add_setting('logo_mobile');
    $wp_customize->add_setting('tagline_indonesia', array('default' => ''));
    $wp_customize->add_setting('tagline_english', array('default' => ''));
    // ...add controls for each setting...

    // Colors Section
    $wp_customize->add_section('law_firm_dpattorney_colors', array(
        'title' => __('Colors', 'law-firm-dpattorney'),
        'panel' => 'law_firm_dpattorney_options',
    ));
    $wp_customize->add_setting('color_primary_dark', array('default' => '#0F1419'));
    $wp_customize->add_setting('color_secondary_dark', array('default' => '#1A1F2E'));
    $wp_customize->add_setting('color_accent_gold', array('default' => '#C5A572'));
    $wp_customize->add_setting('color_accent_red', array('default' => '#8B2635'));
    $wp_customize->add_setting('color_text_light', array('default' => '#F5F5F0'));
    $wp_customize->add_setting('color_text_muted', array('default' => '#8B92A8'));
    // ...add controls for each color...

    // Typography Section
    $wp_customize->add_section('law_firm_dpattorney_typography', array(
        'title' => __('Typography', 'law-firm-dpattorney'),
        'panel' => 'law_firm_dpattorney_options',
    ));
    $wp_customize->add_setting('font_heading', array('default' => 'Playfair Display'));
    $wp_customize->add_setting('font_body', array('default' => 'Inter'));
    $wp_customize->add_setting('font_size_base', array('default' => 16, 'type' => 'option'));
    $wp_customize->add_setting('line_height_base', array('default' => 1.6, 'type' => 'option'));
    $wp_customize->add_setting('letter_spacing_heading', array('default' => 0, 'type' => 'option'));
    // ...add controls for each typography option...

    // Layout Section
    $wp_customize->add_section('law_firm_dpattorney_layout', array(
        'title' => __('Layout', 'law-firm-dpattorney'),
        'panel' => 'law_firm_dpattorney_options',
    ));
    $wp_customize->add_setting('container_width', array('default' => 1280));
    $wp_customize->add_setting('section_padding_desktop', array('default' => 120));
    $wp_customize->add_setting('section_padding_mobile', array('default' => 60));
    $wp_customize->add_setting('border_radius', array('default' => 0));
    $wp_customize->add_setting('enable_animations', array('default' => true));
    // ...add controls for each layout option...

    // Header Section
    $wp_customize->add_section('law_firm_dpattorney_header', array(
        'title' => __('Header', 'law-firm-dpattorney'),
        'panel' => 'law_firm_dpattorney_options',
    ));
    $wp_customize->add_setting('header_type', array('default' => 'transparent'));
    $wp_customize->add_setting('header_height', array('default' => 80));
    $wp_customize->add_setting('header_sticky_background', array('default' => '#fff'));
    $wp_customize->add_setting('show_top_bar', array('default' => false));
    $wp_customize->add_setting('top_bar_text', array('default' => ''));
    $wp_customize->add_setting('emergency_phone', array('default' => ''));
    $wp_customize->add_setting('cta_button_text', array('default' => 'Konsultasi Sekarang'));
    $wp_customize->add_setting('cta_button_link', array('default' => ''));
    $wp_customize->add_setting('cta_button_color', array('default' => 'gold'));
    // ...add controls for each header option...

    // Hero Section
    $wp_customize->add_section('law_firm_dpattorney_hero', array(
        'title' => __('Hero (Homepage)', 'law-firm-dpattorney'),
        'panel' => 'law_firm_dpattorney_options',
    ));
    $wp_customize->add_setting('hero_type', array('default' => 'case_victory'));
    $wp_customize->add_setting('hero_preheading', array('default' => ''));
    $wp_customize->add_setting('hero_headline', array('default' => ''));
    $wp_customize->add_setting('hero_subheadline', array('default' => ''));
    $wp_customize->add_setting('hero_background_type', array('default' => 'image'));
    $wp_customize->add_setting('hero_background_image');
    $wp_customize->add_setting('hero_background_video');
    $wp_customize->add_setting('hero_overlay_opacity', array('default' => 0.5));
    $wp_customize->add_setting('hero_animation', array('default' => 'fade_up'));
    $wp_customize->add_setting('hero_cta_primary_text', array('default' => ''));
    $wp_customize->add_setting('hero_cta_primary_link', array('default' => ''));
    $wp_customize->add_setting('hero_cta_secondary_text', array('default' => ''));
    $wp_customize->add_setting('hero_cta_secondary_link', array('default' => ''));
    // ...add controls for each hero option...

    // Stats Section
    $wp_customize->add_section('law_firm_dpattorney_stats', array(
        'title' => __('Stats Section', 'law-firm-dpattorney'),
        'panel' => 'law_firm_dpattorney_options',
    ));
    $wp_customize->add_setting('stat_1_number', array('default' => '50+'));
    $wp_customize->add_setting('stat_1_label', array('default' => 'Kasus High-Profile'));
    $wp_customize->add_setting('stat_2_number', array('default' => '85%'));
    $wp_customize->add_setting('stat_2_label', array('default' => 'Tingkat Keberhasilan'));
    $wp_customize->add_setting('stat_3_number', array('default' => '30+'));
    $wp_customize->add_setting('stat_3_label', array('default' => 'Kasasi di MA'));
    $wp_customize->add_setting('stat_4_number', array('default' => '15+'));
    $wp_customize->add_setting('stat_4_label', array('default' => 'Tahun Pengalaman'));
    // ...add controls for each stat...

    // Footer Section
    $wp_customize->add_section('law_firm_dpattorney_footer', array(
        'title' => __('Footer', 'law-firm-dpattorney'),
        'panel' => 'law_firm_dpattorney_options',
    ));
    $wp_customize->add_setting('footer_columns', array('default' => 3));
    $wp_customize->add_setting('footer_logo');
    $wp_customize->add_setting('footer_about', array('default' => ''));
    $wp_customize->add_setting('footer_copyright', array('default' => ''));
    $wp_customize->add_setting('footer_disclaimer', array('default' => ''));
    // ...add controls for each footer option...

    // Contact Section
    $wp_customize->add_section('law_firm_dpattorney_contact', array(
        'title' => __('Contact', 'law-firm-dpattorney'),
        'panel' => 'law_firm_dpattorney_options',
    ));
    $wp_customize->add_setting('contact_address', array('default' => ''));
    $wp_customize->add_setting('contact_phone', array('default' => ''));
    $wp_customize->add_setting('contact_email', array('default' => ''));
    $wp_customize->add_setting('contact_whatsapp', array('default' => ''));
    $wp_customize->add_setting('contact_hours', array('default' => ''));
    $wp_customize->add_setting('contact_map_embed', array('default' => ''));
    $wp_customize->add_setting('contact_form_shortcode', array('default' => ''));
    // ...add controls for each contact option...
}
add_action('customize_register', 'law_firm_dpattorney_customize_register');
