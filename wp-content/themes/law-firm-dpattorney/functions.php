// Performance & SEO Enhancements
// Lazy loading for all images
add_filter('wp_get_attachment_image_attributes', function($attr) {
    $attr['loading'] = 'lazy';
    return $attr;
});

// WebP support check
add_action('admin_notices', function() {
    if (!function_exists('imagewebp')) {
        echo '<div class="notice notice-warning"><p>' . __('WebP image support is not enabled on this server.', 'law-firm-dpattorney') . '</p></div>';
    }
});

// Schema.org LegalService JSON-LD
add_action('wp_head', function() {
    if (is_singular('case_study')) {
        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'LegalService',
            'name' => get_bloginfo('name'),
            'url' => get_permalink(),
            'areaServed' => 'Indonesia',
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($data) . '</script>';
    }
});

// Breadcrumb navigation
function dpattorney_breadcrumb() {
    echo '<nav class="breadcrumb">';
    echo '<a href="' . esc_url(home_url('/')) . '">' . __('Home', 'law-firm-dpattorney') . '</a> / ';
    if (is_singular('case_study')) {
        echo '<a href="' . get_post_type_archive_link('case_study') . '">' . __('Kasus', 'law-firm-dpattorney') . '</a> / ';
        the_title();
    } elseif (is_singular('attorney')) {
        echo '<a href="' . get_post_type_archive_link('attorney') . '">' . __('Attorney', 'law-firm-dpattorney') . '</a> / ';
        the_title();
    } else {
        the_title();
    }
    echo '</nav>';
}

// Open Graph meta tags for case studies
add_action('wp_head', function() {
    if (is_singular('case_study')) {
        global $post;
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '" />';
        echo '<meta property="og:type" content="article" />';
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />';
        if (has_post_thumbnail($post->ID)) {
            $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
            echo '<meta property="og:image" content="' . esc_url($img[0]) . '" />';
        }
        echo '<meta property="og:description" content="' . esc_attr(get_the_excerpt()) . '" />';
    }
});

// Canonical URLs
add_action('wp_head', function() {
    if (is_singular()) {
        echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '" />';
    }
});
// Register custom Gutenberg blocks
add_action('init', function() {
    $blocks = [
        'case-study/card',
        'case-study/grid',
        'stats/counter',
        'attorney/card',
        'practice-area/card',
    ];
    foreach ($blocks as $block) {
        register_block_type(get_template_directory() . '/blocks/' . $block);
    }
});
<?php
// Theme setup and support
function law_firm_dpattorney_setup() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('custom-background');
    add_theme_support('custom-header');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'law_firm_dpattorney_setup');

// Enqueue styles and scripts
function law_firm_dpattorney_enqueue_scripts() {
    wp_enqueue_style('law-firm-dpattorney-style', get_stylesheet_uri());
    // Add additional CSS/JS here
}
add_action('wp_enqueue_scripts', 'law_firm_dpattorney_enqueue_scripts');

// Enqueue vanilla JS (no jQuery)
function law_firm_dpattorney_enqueue_scripts_vanilla() {
    wp_enqueue_script('law-firm-dpattorney-main', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'law_firm_dpattorney_enqueue_scripts_vanilla');

// Lazy loading for images
add_filter('wp_get_attachment_image_attributes', function($attr) {
    $attr['loading'] = 'lazy';
    return $attr;
});

// Critical CSS inline (example)
function law_firm_dpattorney_inline_critical_css() {
    echo '<style>.site-header-inner,.hero-section,.container{display:block;} /* Add more critical CSS here */</style>';
}
add_action('wp_head', 'law_firm_dpattorney_inline_critical_css', 1);

// Schema.org markup for SEO
add_action('wp_head', function() {
    echo '<script type="application/ld+json">'.json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'LegalService',
        'name' => get_bloginfo('name'),
        'url' => home_url(),
        'logo' => get_theme_mod('law_firm_logo_dark'),
        'telephone' => get_theme_mod('law_firm_header_contact_bar'),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => '',
            'addressLocality' => '',
            'addressRegion' => '',
            'postalCode' => '',
            'addressCountry' => ''
        ]
    ]).'</script>';
});

// Accessibility: Add ARIA labels and alt text reminders
add_filter('nav_menu_link_attributes', function($atts, $item, $args) {
    $atts['aria-label'] = $item->title;
    return $atts;
}, 10, 3);

add_filter('the_content', function($content) {
    // Remind for alt text in images
    return preg_replace('/<img(?!.*alt=)/', '<img alt="Image description"', $content);
});

// Accessibility: focus-visible outline
add_action('wp_head', function() {
  echo '<style>:focus-visible { outline: 2px solid #C5A572 !important; outline-offset: 2px; }</style>';
});

// Accessibility: add ARIA landmarks
add_filter('body_class', function($classes) {
  $classes[] = 'wp-lawfirm-accessible';
  return $classes;
});

// Security: add nonce to AJAX scripts
add_action('wp_enqueue_scripts', function() {
  wp_localize_script('law-firm-dpattorney-main', 'lawFirmAjax', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('law_firm_dpattorney_filter_cases'),
  ));
});

// Security: Sanitize inputs/outputs, nonce verification for forms
function law_firm_dpattorney_sanitize($data) {
    return esc_html($data);
}

function law_firm_dpattorney_verify_nonce() {
    if (!isset($_POST['law_firm_nonce']) || !wp_verify_nonce($_POST['law_firm_nonce'], 'law_firm_action')) {
        wp_die('Security check failed');
    }
}

// No inline scripts for CSP compliance (handled by enqueue)


// === Customizer Settings ===
function law_firm_dpattorney_customize_register($wp_customize) {
    // Site Identity
    $wp_customize->add_section('law_firm_site_identity', array(
        'title' => __('Site Identity', 'law-firm-dpattorney'),
        'priority' => 10,
    ));
    $wp_customize->add_setting('law_firm_logo_dark', array('type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_logo_light', array('type' => 'theme_mod'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'law_firm_logo_dark', array(
        'label' => __('Logo (Dark Variant)', 'law-firm-dpattorney'),
        'section' => 'law_firm_site_identity',
    )));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'law_firm_logo_light', array(
        'label' => __('Logo (Light Variant)', 'law-firm-dpattorney'),
        'section' => 'law_firm_site_identity',
    )));

    // Colors
    $wp_customize->add_section('law_firm_colors', array(
        'title' => __('Colors', 'law-firm-dpattorney'),
        'priority' => 20,
    ));
    $wp_customize->add_setting('law_firm_primary_color', array('default' => '#0A0A0A', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_secondary_color', array('default' => '#1C1C1E', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_accent_color', array('default' => '#C9A962', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_background_color', array('default' => '#0A0A0A', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_text_color', array('default' => '#FFFFFF', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_link_hover_color', array('default' => '#C9A962', 'type' => 'theme_mod'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'law_firm_primary_color', array(
        'label' => __('Primary Color', 'law-firm-dpattorney'),
        'section' => 'law_firm_colors',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'law_firm_secondary_color', array(
        'label' => __('Secondary Color', 'law-firm-dpattorney'),
        'section' => 'law_firm_colors',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'law_firm_accent_color', array(
        'label' => __('Accent Color', 'law-firm-dpattorney'),
        'section' => 'law_firm_colors',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'law_firm_background_color', array(
        'label' => __('Background Color', 'law-firm-dpattorney'),
        'section' => 'law_firm_colors',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'law_firm_text_color', array(
        'label' => __('Text Color', 'law-firm-dpattorney'),
        'section' => 'law_firm_colors',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'law_firm_link_hover_color', array(
        'label' => __('Link Hover Color', 'law-firm-dpattorney'),
        'section' => 'law_firm_colors',
    )));

    // Typography
    $wp_customize->add_section('law_firm_typography', array(
        'title' => __('Typography', 'law-firm-dpattorney'),
        'priority' => 30,
    ));
    $wp_customize->add_setting('law_firm_font_heading', array('default' => 'Inter', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_font_body', array('default' => 'Inter', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_base_font_size', array('default' => '18px', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_line_height', array('default' => '1.6', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_letter_spacing', array('default' => '0.01em', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_font_weight_heading', array('default' => '700', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_font_weight_body', array('default' => '400', 'type' => 'theme_mod'));
    $wp_customize->add_control('law_firm_font_heading', array(
        'label' => __('Heading Font', 'law-firm-dpattorney'),
        'section' => 'law_firm_typography',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_font_body', array(
        'label' => __('Body Font', 'law-firm-dpattorney'),
        'section' => 'law_firm_typography',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_base_font_size', array(
        'label' => __('Base Font Size', 'law-firm-dpattorney'),
        'section' => 'law_firm_typography',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_line_height', array(
        'label' => __('Line Height', 'law-firm-dpattorney'),
        'section' => 'law_firm_typography',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_letter_spacing', array(
        'label' => __('Letter Spacing', 'law-firm-dpattorney'),
        'section' => 'law_firm_typography',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_font_weight_heading', array(
        'label' => __('Heading Font Weight', 'law-firm-dpattorney'),
        'section' => 'law_firm_typography',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_font_weight_body', array(
        'label' => __('Body Font Weight', 'law-firm-dpattorney'),
        'section' => 'law_firm_typography',
        'type' => 'text',
    ));

    // Layout
    $wp_customize->add_section('law_firm_layout', array(
        'title' => __('Layout', 'law-firm-dpattorney'),
        'priority' => 40,
    ));
    $wp_customize->add_setting('law_firm_container_max_width', array('default' => '1200px', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_content_padding', array('default' => '2rem', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_grid_gap', array('default' => '2rem', 'type' => 'theme_mod'));
    $wp_customize->add_control('law_firm_container_max_width', array(
        'label' => __('Container Max Width', 'law-firm-dpattorney'),
        'section' => 'law_firm_layout',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_content_padding', array(
        'label' => __('Content Padding', 'law-firm-dpattorney'),
        'section' => 'law_firm_layout',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_grid_gap', array(
        'label' => __('Grid Gap', 'law-firm-dpattorney'),
        'section' => 'law_firm_layout',
        'type' => 'text',
    ));
}
add_action('customize_register', 'law_firm_dpattorney_customize_register');

// Register navigation menu
function law_firm_dpattorney_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'law-firm-dpattorney'),
        'mega' => __('Mega Menu', 'law-firm-dpattorney'),
    ));
}
add_action('init', 'law_firm_dpattorney_register_menus');

// Customizer: Header Options
function law_firm_dpattorney_customize_header($wp_customize) {
    $wp_customize->add_section('law_firm_header', array(
        'title' => __('Header Options', 'law-firm-dpattorney'),
        'priority' => 50,
    ));
    $wp_customize->add_setting('law_firm_header_sticky', array('default' => false, 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_header_transparent', array('default' => false, 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_header_layout', array('default' => 'split', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_header_height', array('default' => '80px', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_header_bg_color', array('default' => '#0A0A0A', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_header_opacity', array('default' => '1', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_header_border_bottom', array('default' => false, 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_header_cta_text', array('default' => __('Free Consultation', 'law-firm-dpattorney'), 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_header_cta_url', array('default' => '#', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_header_contact_bar', array('default' => '', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_header_search_icon', array('default' => true, 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_header_social_icons', array('default' => '', 'type' => 'theme_mod'));
    $wp_customize->add_control('law_firm_header_sticky', array(
        'label' => __('Sticky Header', 'law-firm-dpattorney'),
        'section' => 'law_firm_header',
        'type' => 'checkbox',
    ));
    $wp_customize->add_control('law_firm_header_transparent', array(
        'label' => __('Transparent Header', 'law-firm-dpattorney'),
        'section' => 'law_firm_header',
        'type' => 'checkbox',
    ));
    $wp_customize->add_control('law_firm_header_layout', array(
        'label' => __('Header Layout', 'law-firm-dpattorney'),
        'section' => 'law_firm_header',
        'type' => 'select',
        'choices' => array('centered' => 'Centered', 'left' => 'Left-Aligned', 'split' => 'Split'),
    ));
    $wp_customize->add_control('law_firm_header_height', array(
        'label' => __('Header Height', 'law-firm-dpattorney'),
        'section' => 'law_firm_header',
        'type' => 'text',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'law_firm_header_bg_color', array(
        'label' => __('Header Background Color', 'law-firm-dpattorney'),
        'section' => 'law_firm_header',
    )));
    $wp_customize->add_control('law_firm_header_opacity', array(
        'label' => __('Header Opacity', 'law-firm-dpattorney'),
        'section' => 'law_firm_header',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_header_border_bottom', array(
        'label' => __('Header Border Bottom', 'law-firm-dpattorney'),
        'section' => 'law_firm_header',
        'type' => 'checkbox',
    ));
    $wp_customize->add_control('law_firm_header_cta_text', array(
        'label' => __('CTA Button Text', 'law-firm-dpattorney'),
        'section' => 'law_firm_header',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_header_cta_url', array(
        'label' => __('CTA Button URL', 'law-firm-dpattorney'),
        'section' => 'law_firm_header',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_header_contact_bar', array(
        'label' => __('Contact Info Bar', 'law-firm-dpattorney'),
        'section' => 'law_firm_header',
        'type' => 'textarea',
    ));
    $wp_customize->add_control('law_firm_header_search_icon', array(
        'label' => __('Show Search Icon', 'law-firm-dpattorney'),
        'section' => 'law_firm_header',
        'type' => 'checkbox',
    ));
    $wp_customize->add_control('law_firm_header_social_icons', array(
        'label' => __('Social Icons (comma separated)', 'law-firm-dpattorney'),
        'section' => 'law_firm_header',
        'type' => 'text',
    ));
}
add_action('customize_register', 'law_firm_dpattorney_customize_header');

// Customizer: Hero Section
function law_firm_dpattorney_customize_hero($wp_customize) {
    $wp_customize->add_section('law_firm_hero', array(
        'title' => __('Hero Section', 'law-firm-dpattorney'),
        'priority' => 60,
    ));
    $wp_customize->add_setting('law_firm_hero_layout', array('default' => 'full', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_bg_type', array('default' => 'color', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_bg_color', array('default' => '#0A0A0A', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_bg_gradient', array('default' => '', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_bg_image', array('type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_bg_video', array('type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_bg_parallax', array('default' => false, 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_overlay_opacity', array('default' => '0.5', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_preheading', array('default' => '', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_headline', array('default' => 'Welcome to Our Law Firm', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_subheadline', array('default' => '', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_primary_cta_text', array('default' => 'Get Started', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_primary_cta_url', array('default' => '#', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_secondary_cta_text', array('default' => '', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_secondary_cta_url', array('default' => '#', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_scroll_indicator', array('default' => false, 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_text_align', array('default' => 'center', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_text_color', array('default' => '#FFFFFF', 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_text_shadow', array('default' => false, 'type' => 'theme_mod'));
    $wp_customize->add_setting('law_firm_hero_animation', array('default' => 'fade-in', 'type' => 'theme_mod'));
    $wp_customize->add_control('law_firm_hero_layout', array(
        'label' => __('Hero Layout', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'select',
        'choices' => array('full' => 'Full-Screen', 'split' => 'Split', 'minimal' => 'Minimal Center', 'slider' => 'Slider/Carousel'),
    ));
    $wp_customize->add_control('law_firm_hero_bg_type', array(
        'label' => __('Background Type', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'select',
        'choices' => array('color' => 'Solid Color', 'gradient' => 'Gradient', 'image' => 'Image', 'video' => 'Video'),
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'law_firm_hero_bg_color', array(
        'label' => __('Background Color', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
    )));
    $wp_customize->add_control('law_firm_hero_bg_gradient', array(
        'label' => __('Background Gradient', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'text',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'law_firm_hero_bg_image', array(
        'label' => __('Background Image', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
    )));
    $wp_customize->add_control('law_firm_hero_bg_video', array(
        'label' => __('Background Video URL', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_hero_bg_parallax', array(
        'label' => __('Parallax Background', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'checkbox',
    ));
    $wp_customize->add_control('law_firm_hero_overlay_opacity', array(
        'label' => __('Overlay Opacity', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_hero_preheading', array(
        'label' => __('Pre-heading Text', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_hero_headline', array(
        'label' => __('Main Headline', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_hero_subheadline', array(
        'label' => __('Subheadline', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'textarea',
    ));
    $wp_customize->add_control('law_firm_hero_primary_cta_text', array(
        'label' => __('Primary CTA Text', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_hero_primary_cta_url', array(
        'label' => __('Primary CTA URL', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_hero_secondary_cta_text', array(
        'label' => __('Secondary CTA Text', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_hero_secondary_cta_url', array(
        'label' => __('Secondary CTA URL', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'text',
    ));
    $wp_customize->add_control('law_firm_hero_scroll_indicator', array(
        'label' => __('Show Scroll Down Indicator', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'checkbox',
    ));
    $wp_customize->add_control('law_firm_hero_text_align', array(
        'label' => __('Hero Text Alignment', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'select',
        'choices' => array('left' => 'Left', 'center' => 'Center', 'right' => 'Right'),
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'law_firm_hero_text_color', array(
        'label' => __('Hero Text Color', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
    )));
    $wp_customize->add_control('law_firm_hero_text_shadow', array(
        'label' => __('Text Shadow', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'checkbox',
    ));
    $wp_customize->add_control('law_firm_hero_animation', array(
        'label' => __('Hero Animation', 'law-firm-dpattorney'),
        'section' => 'law_firm_hero',
        'type' => 'select',
        'choices' => array('fade-in' => 'Fade In', 'fade-up' => 'Fade Up', 'slide-in' => 'Slide In', 'typewriter' => 'Typewriter'),
    ));
}
add_action('customize_register', 'law_firm_dpattorney_customize_hero');

// === Customizer: Additional Theme Options ===
function law_firm_dpattorney_customize_extra($wp_customize) {
    // General Settings
    $wp_customize->add_section('law_firm_general', array(
        'title' => __('General Settings', 'law-firm-dpattorney'),
        'priority' => 5,
    ));
    // Blog Settings
    $wp_customize->add_section('law_firm_blog', array(
        'title' => __('Blog Settings', 'law-firm-dpattorney'),
        'priority' => 70,
    ));
    // Attorney Settings
    $wp_customize->add_section('law_firm_attorney', array(
        'title' => __('Attorney Settings', 'law-firm-dpattorney'),
        'priority' => 80,
    ));
    // Footer Settings
    $wp_customize->add_section('law_firm_footer', array(
        'title' => __('Footer Settings', 'law-firm-dpattorney'),
        'priority' => 90,
    ));
    // Custom CSS
    $wp_customize->add_section('law_firm_custom_css', array(
        'title' => __('Custom CSS', 'law-firm-dpattorney'),
        'priority' => 100,
    ));
    $wp_customize->add_setting('law_firm_custom_css_code', array('type' => 'theme_mod'));
    $wp_customize->add_control('law_firm_custom_css_code', array(
        'label' => __('Custom CSS', 'law-firm-dpattorney'),
        'section' => 'law_firm_custom_css',
        'type' => 'textarea',
    ));
    // Import/Export Settings
    $wp_customize->add_section('law_firm_import_export', array(
        'title' => __('Import/Export Settings', 'law-firm-dpattorney'),
        'priority' => 110,
    ));
    // Preset Themes
    $wp_customize->add_section('law_firm_presets', array(
        'title' => __('Preset Color Schemes', 'law-firm-dpattorney'),
        'priority' => 120,
    ));
    $wp_customize->add_setting('law_firm_preset_scheme', array('default' => 'classic-dark', 'type' => 'theme_mod'));
    $wp_customize->add_control('law_firm_preset_scheme', array(
        'label' => __('Preset Theme', 'law-firm-dpattorney'),
        'section' => 'law_firm_presets',
        'type' => 'select',
        'choices' => array(
            'classic-dark' => __('Classic Dark (umbra.law)', 'law-firm-dpattorney'),
            'professional-light' => __('Professional Light', 'law-firm-dpattorney'),
            'modern-minimal' => __('Modern Minimal (ahp.id)', 'law-firm-dpattorney'),
        ),
    ));
}
add_action('customize_register', 'law_firm_dpattorney_customize_extra');

// === Custom Post Type: Attorney ===
function law_firm_dpattorney_register_attorney_cpt() {
    $labels = array(
        'name' => __('Attorneys', 'law-firm-dpattorney'),
        'singular_name' => __('Attorney', 'law-firm-dpattorney'),
        'add_new' => __('Add New', 'law-firm-dpattorney'),
        'add_new_item' => __('Add New Attorney', 'law-firm-dpattorney'),
        'edit_item' => __('Edit Attorney', 'law-firm-dpattorney'),
        'new_item' => __('New Attorney', 'law-firm-dpattorney'),
        'view_item' => __('View Attorney', 'law-firm-dpattorney'),
        'search_items' => __('Search Attorneys', 'law-firm-dpattorney'),
        'not_found' => __('No attorneys found', 'law-firm-dpattorney'),
        'not_found_in_trash' => __('No attorneys found in Trash', 'law-firm-dpattorney'),
        'all_items' => __('All Attorneys', 'law-firm-dpattorney'),
        'menu_name' => __('Attorneys', 'law-firm-dpattorney'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'attorneys'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-businessman',
    );
    register_post_type('attorney', $args);
}
add_action('init', 'law_firm_dpattorney_register_attorney_cpt');

// === Taxonomy: Practice Area ===
function law_firm_dpattorney_register_practice_area_taxonomy() {
    $labels = array(
        'name' => __('Practice Areas', 'law-firm-dpattorney'),
        'singular_name' => __('Practice Area', 'law-firm-dpattorney'),
        'search_items' => __('Search Practice Areas', 'law-firm-dpattorney'),
        'all_items' => __('All Practice Areas', 'law-firm-dpattorney'),
        'edit_item' => __('Edit Practice Area', 'law-firm-dpattorney'),
        'add_new_item' => __('Add New Practice Area', 'law-firm-dpattorney'),
        'menu_name' => __('Practice Areas', 'law-firm-dpattorney'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'practice-area'),
    );
    register_taxonomy('practice_area', array('attorney'), $args);
}
add_action('init', 'law_firm_dpattorney_register_practice_area_taxonomy');

// === Custom Post Type: Practice Area ===
function law_firm_dpattorney_register_practice_area_cpt() {
    $labels = array(
        'name' => __('Practice Areas', 'law-firm-dpattorney'),
        'singular_name' => __('Practice Area', 'law-firm-dpattorney'),
        'add_new' => __('Add New', 'law-firm-dpattorney'),
        'add_new_item' => __('Add New Practice Area', 'law-firm-dpattorney'),
        'edit_item' => __('Edit Practice Area', 'law-firm-dpattorney'),
        'new_item' => __('New Practice Area', 'law-firm-dpattorney'),
        'view_item' => __('View Practice Area', 'law-firm-dpattorney'),
        'search_items' => __('Search Practice Areas', 'law-firm-dpattorney'),
        'not_found' => __('No practice areas found', 'law-firm-dpattorney'),
        'not_found_in_trash' => __('No practice areas found in Trash', 'law-firm-dpattorney'),
        'all_items' => __('All Practice Areas', 'law-firm-dpattorney'),
        'menu_name' => __('Practice Areas', 'law-firm-dpattorney'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'practice-areas'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-portfolio',
    );
    register_post_type('practice_area_cpt', $args);
}
add_action('init', 'law_firm_dpattorney_register_practice_area_cpt');

// Practice Area Icon Meta
function law_firm_dpattorney_add_practice_area_icon_meta() {
    add_meta_box('practice_area_icon', __('Practice Area Icon', 'law-firm-dpattorney'), 'law_firm_dpattorney_practice_area_icon_callback', 'practice_area_cpt', 'side');
}
add_action('add_meta_boxes', 'law_firm_dpattorney_add_practice_area_icon_meta');

function law_firm_dpattorney_practice_area_icon_callback($post) {
    $icon = get_post_meta($post->ID, 'practice_area_icon', true);
    echo '<input type="text" name="practice_area_icon" value="' . esc_attr($icon) . '" placeholder="SVG URL or icon name">';
}

function law_firm_dpattorney_save_practice_area_icon($post_id) {
    if (isset($_POST['practice_area_icon'])) {
        update_post_meta($post_id, 'practice_area_icon', sanitize_text_field($_POST['practice_area_icon']));
    }
}
add_action('save_post_practice_area_cpt', 'law_firm_dpattorney_save_practice_area_icon');

// === Custom Post Type: Testimonial ===
function law_firm_dpattorney_register_testimonial_cpt() {
    $labels = array(
        'name' => __('Testimonials', 'law-firm-dpattorney'),
        'singular_name' => __('Testimonial', 'law-firm-dpattorney'),
        'add_new' => __('Add New', 'law-firm-dpattorney'),
        'add_new_item' => __('Add New Testimonial', 'law-firm-dpattorney'),
        'edit_item' => __('Edit Testimonial', 'law-firm-dpattorney'),
        'new_item' => __('New Testimonial', 'law-firm-dpattorney'),
        'view_item' => __('View Testimonial', 'law-firm-dpattorney'),
        'search_items' => __('Search Testimonials', 'law-firm-dpattorney'),
        'not_found' => __('No testimonials found', 'law-firm-dpattorney'),
        'not_found_in_trash' => __('No testimonials found in Trash', 'law-firm-dpattorney'),
        'all_items' => __('All Testimonials', 'law-firm-dpattorney'),
        'menu_name' => __('Testimonials', 'law-firm-dpattorney'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'testimonials'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-testimonial',
    );
    register_post_type('testimonial', $args);
}
add_action('init', 'law_firm_dpattorney_register_testimonial_cpt');

// === Custom Post Type: Case Study ===
function law_firm_dpattorney_register_case_study_cpt() {
    $labels = array(
        'name' => __('Case Studies', 'law-firm-dpattorney'),
        'singular_name' => __('Case Study', 'law-firm-dpattorney'),
        'add_new' => __('Add New', 'law-firm-dpattorney'),
        'add_new_item' => __('Add New Case Study', 'law-firm-dpattorney'),
        'edit_item' => __('Edit Case Study', 'law-firm-dpattorney'),
        'new_item' => __('New Case Study', 'law-firm-dpattorney'),
        'view_item' => __('View Case Study', 'law-firm-dpattorney'),
        'search_items' => __('Search Case Studies', 'law-firm-dpattorney'),
        'not_found' => __('No case studies found', 'law-firm-dpattorney'),
        'not_found_in_trash' => __('No case studies found in Trash', 'law-firm-dpattorney'),
        'all_items' => __('All Case Studies', 'law-firm-dpattorney'),
        'menu_name' => __('Case Studies', 'law-firm-dpattorney'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'case-studies'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-analytics',
    );
    register_post_type('case_study', $args);
}
add_action('init', 'law_firm_dpattorney_register_case_study_cpt');

// === Custom Post Type: FAQ ===
function law_firm_dpattorney_register_faq_cpt() {
    $labels = array(
        'name' => __('FAQs', 'law-firm-dpattorney'),
        'singular_name' => __('FAQ', 'law-firm-dpattorney'),
        'add_new' => __('Add New', 'law-firm-dpattorney'),
        'add_new_item' => __('Add New FAQ', 'law-firm-dpattorney'),
        'edit_item' => __('Edit FAQ', 'law-firm-dpattorney'),
        'new_item' => __('New FAQ', 'law-firm-dpattorney'),
        'view_item' => __('View FAQ', 'law-firm-dpattorney'),
        'search_items' => __('Search FAQs', 'law-firm-dpattorney'),
        'not_found' => __('No FAQs found', 'law-firm-dpattorney'),
        'not_found_in_trash' => __('No FAQs found in Trash', 'law-firm-dpattorney'),
        'all_items' => __('All FAQs', 'law-firm-dpattorney'),
        'menu_name' => __('FAQs', 'law-firm-dpattorney'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'faqs'),
        'supports' => array('title', 'editor', 'custom-fields'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-editor-help',
    );
    register_post_type('faq', $args);
}
add_action('init', 'law_firm_dpattorney_register_faq_cpt');

// === Taxonomy: Locations ===
function law_firm_dpattorney_register_locations_taxonomy() {
    $labels = array(
        'name' => __('Locations', 'law-firm-dpattorney'),
        'singular_name' => __('Location', 'law-firm-dpattorney'),
        'search_items' => __('Search Locations', 'law-firm-dpattorney'),
        'all_items' => __('All Locations', 'law-firm-dpattorney'),
        'edit_item' => __('Edit Location', 'law-firm-dpattorney'),
        'add_new_item' => __('Add New Location', 'law-firm-dpattorney'),
        'menu_name' => __('Locations', 'law-firm-dpattorney'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'location'),
    );
    register_taxonomy('location', array('attorney', 'case_study'), $args);
}
add_action('init', 'law_firm_dpattorney_register_locations_taxonomy');

// === Taxonomy: Attorney Roles ===
function law_firm_dpattorney_register_attorney_roles_taxonomy() {
    $labels = array(
        'name' => __('Attorney Roles', 'law-firm-dpattorney'),
        'singular_name' => __('Attorney Role', 'law-firm-dpattorney'),
        'search_items' => __('Search Roles', 'law-firm-dpattorney'),
        'all_items' => __('All Roles', 'law-firm-dpattorney'),
        'edit_item' => __('Edit Role', 'law-firm-dpattorney'),
        'add_new_item' => __('Add New Role', 'law-firm-dpattorney'),
        'menu_name' => __('Attorney Roles', 'law-firm-dpattorney'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'attorney-role'),
    );
    register_taxonomy('attorney_role', array('attorney'), $args);
}
add_action('init', 'law_firm_dpattorney_register_attorney_roles_taxonomy');
