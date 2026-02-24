<?php get_header(); ?>
<main id="main" class="site-main">
    <?php
    // Hero Section
    $layout = get_theme_mod('law_firm_hero_layout', 'full');
    $bg_type = get_theme_mod('law_firm_hero_bg_type', 'color');
    $bg_color = get_theme_mod('law_firm_hero_bg_color', '#0A0A0A');
    $bg_gradient = get_theme_mod('law_firm_hero_bg_gradient');
    $bg_image = get_theme_mod('law_firm_hero_bg_image');
    $bg_video = get_theme_mod('law_firm_hero_bg_video');
    $bg_parallax = get_theme_mod('law_firm_hero_bg_parallax');
    $overlay_opacity = get_theme_mod('law_firm_hero_overlay_opacity', '0.5');
    $preheading = get_theme_mod('law_firm_hero_preheading');
    $headline = get_theme_mod('law_firm_hero_headline', 'Welcome to Our Law Firm');
    $subheadline = get_theme_mod('law_firm_hero_subheadline');
    $primary_cta_text = get_theme_mod('law_firm_hero_primary_cta_text', 'Get Started');
    $primary_cta_url = get_theme_mod('law_firm_hero_primary_cta_url', '#');
    $secondary_cta_text = get_theme_mod('law_firm_hero_secondary_cta_text');
    $secondary_cta_url = get_theme_mod('law_firm_hero_secondary_cta_url');
    $scroll_indicator = get_theme_mod('law_firm_hero_scroll_indicator');
    $text_align = get_theme_mod('law_firm_hero_text_align', 'center');
    $text_color = get_theme_mod('law_firm_hero_text_color', '#FFFFFF');
    $text_shadow = get_theme_mod('law_firm_hero_text_shadow');
    $animation = get_theme_mod('law_firm_hero_animation', 'fade-in');

    $hero_style = '';
    if ($bg_type === 'color') {
        $hero_style .= 'background:' . esc_attr($bg_color) . ';';
    } elseif ($bg_type === 'gradient' && $bg_gradient) {
        $hero_style .= 'background:' . esc_attr($bg_gradient) . ';';
    } elseif ($bg_type === 'image' && $bg_image) {
        $hero_style .= 'background-image:url(' . esc_url($bg_image) . ');';
        if ($bg_parallax) $hero_style .= 'background-attachment:fixed;';
    }

    ?>
        <!-- About Section -->
        <section class="about-section container">
            <h2>About Our Firm</h2>
            <div class="about-timeline">Timeline/history placeholder</div>
            <div class="about-stats">Stats: years, cases, attorneys, etc.</div>
            <div class="about-mission">Mission/vision statement placeholder</div>
        </section>

        <?php
        // Testimonials Preview
        $testimonials = new WP_Query(array(
            'post_type' => 'testimonial',
            'posts_per_page' => 3,
        ));
        if ($testimonials->have_posts()) {
            echo '<section class="testimonials-section container">';
            echo '<h2>Client Testimonials</h2>';
            echo '<div class="testimonials-grid grid">';
            while ($testimonials->have_posts()) {
                $testimonials->the_post();
                $photo = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                $name = get_the_title();
                $text = get_the_excerpt();
                echo '<div class="testimonial-card">';
                if ($photo) echo '<div class="testimonial-photo"><img src="' . esc_url($photo) . '" alt="' . esc_attr($name) . '"></div>';
                echo '<div class="testimonial-name">' . esc_html($name) . '</div>';
                echo '<div class="testimonial-text">' . esc_html($text) . '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</section>';
            wp_reset_postdata();
        }
        ?>

        <?php
        // Case Studies Preview
        $case_studies = new WP_Query(array(
            'post_type' => 'case_study',
            'posts_per_page' => 3,
        ));
        if ($case_studies->have_posts()) {
            echo '<section class="case-studies-section container">';
            echo '<h2>Case Studies</h2>';
            echo '<div class="case-studies-grid grid">';
            while ($case_studies->have_posts()) {
                $case_studies->the_post();
                $title = get_the_title();
                $desc = get_the_excerpt();
                echo '<div class="case-study-card">';
                echo '<h3>' . esc_html($title) . '</h3>';
                echo '<div class="case-study-desc">' . esc_html($desc) . '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</section>';
            wp_reset_postdata();
        }
        ?>

        <!-- Blog Preview -->
        <section class="blog-section container">
            <h2>Latest Insights</h2>
            <?php
            $blog_posts = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 3,
            ));
            if ($blog_posts->have_posts()) {
                echo '<div class="blog-grid grid">';
                while ($blog_posts->have_posts()) {
                    $blog_posts->the_post();
                    $title = get_the_title();
                    $excerpt = get_the_excerpt();
                    $author = get_the_author();
                    $avatar = get_avatar(get_the_author_meta('ID'), 32);
                    echo '<div class="blog-card">';
                    echo $avatar;
                    echo '<h3>' . esc_html($title) . '</h3>';
                    echo '<div class="blog-excerpt">' . esc_html($excerpt) . '</div>';
                    echo '<div class="blog-author">By ' . esc_html($author) . '</div>';
                    echo '</div>';
                }
                echo '</div>';
                wp_reset_postdata();
            }
            ?>
        </section>

        <!-- Contact Section -->
        <section class="contact-section container">
            <h2>Contact Us</h2>
            <div class="contact-map">Map integration placeholder</div>
            <div class="contact-hours">Working hours placeholder</div>
            <div class="contact-form">Contact form placeholder</div>
            <div class="contact-emergency">Emergency contact highlight placeholder</div>
        </section>

        <!-- Footer Preview -->
        <footer class="site-footer container">
            <div class="footer-widgets">Footer widgets placeholder</div>
            <div class="footer-newsletter">Newsletter signup placeholder</div>
            <div class="footer-copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</div>
            <div class="footer-backtotop">Back-to-top button placeholder</div>
        </footer>
        <?php
        // Practice Areas Grid Preview (for homepage demo)
        $practice_areas = new WP_Query(array(
            'post_type' => 'practice_area_cpt',
            'posts_per_page' => 6,
        ));
        if ($practice_areas->have_posts()) {
            echo '<section class="practice-areas-section container">';
            echo '<h2>Practice Areas</h2>';
            echo '<div class="practice-areas-grid grid">';
            while ($practice_areas->have_posts()) {
                $practice_areas->the_post();
                $icon = get_post_meta(get_the_ID(), 'practice_area_icon', true);
                $title = get_the_title();
                $desc = get_the_excerpt();
                echo '<div class="practice-area-card">';
                if ($icon) echo '<div class="practice-area-icon"><img src="' . esc_url($icon) . '" alt="Icon"></div>';
                echo '<h3>' . esc_html($title) . '</h3>';
                echo '<div class="practice-area-desc">' . esc_html($desc) . '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</section>';
            wp_reset_postdata();
        }
        ?>
    <section class="hero-section <?php echo esc_attr($layout); ?>" style="<?php echo $hero_style; ?>">
        <?php if ($bg_type === 'video' && $bg_video) { ?>
            <video class="hero-bg-video" autoplay loop muted playsinline>
                <source src="<?php echo esc_url($bg_video); ?>" type="video/mp4">
            </video>
        <?php } ?>
        <div class="hero-overlay" style="background:rgba(0,0,0,<?php echo esc_attr($overlay_opacity); ?>);"></div>
        <div class="hero-content" style="text-align:<?php echo esc_attr($text_align); ?>;color:<?php echo esc_attr($text_color); ?>;<?php if ($text_shadow) echo 'text-shadow:0 2px 8px #000;'; ?>">
            <?php if ($preheading) echo '<div class="hero-preheading text-muted">' . esc_html($preheading) . '</div>'; ?>
            <h1 class="hero-headline <?php echo esc_attr($animation); ?>"><?php echo esc_html($headline); ?></h1>
            <?php if ($subheadline) echo '<div class="hero-subheadline">' . esc_html($subheadline) . '</div>'; ?>
            <div class="hero-cta-buttons">
                <?php if ($primary_cta_text) { ?>
                    <a href="<?php echo esc_url($primary_cta_url); ?>" class="cta-btn accent">
                        <?php echo esc_html($primary_cta_text); ?>
                    </a>
                <?php } ?>
                <?php if ($secondary_cta_text) { ?>
                    <a href="<?php echo esc_url($secondary_cta_url); ?>" class="cta-btn">
                        <?php echo esc_html($secondary_cta_text); ?>
                    </a>
                <?php } ?>
            </div>
            <?php if ($scroll_indicator) echo '<div class="hero-scroll-indicator">&#8595;</div>'; ?>
        </div>
    </section>
    <!-- Main content continues here -->
        <?php
        // Attorneys Archive Preview (for homepage demo)
        $attorneys = new WP_Query(array(
            'post_type' => 'attorney',
            'posts_per_page' => 4,
        ));
        if ($attorneys->have_posts()) {
            echo '<section class="attorneys-section container">';
            echo '<h2>Our Attorneys</h2>';
            echo '<div class="attorneys-grid grid">';
            while ($attorneys->have_posts()) {
                $attorneys->the_post();
                $photo = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                $name = get_the_title();
                $title = get_post_meta(get_the_ID(), 'attorney_title', true);
                $bio = get_the_excerpt();
                $linkedin = get_post_meta(get_the_ID(), 'attorney_linkedin', true);
                $email = get_post_meta(get_the_ID(), 'attorney_email', true);
                echo '<div class="attorney-card">';
                if ($photo) echo '<div class="attorney-photo"><img src="' . esc_url($photo) . '" alt="' . esc_attr($name) . '"></div>';
                echo '<div class="attorney-info">';
                echo '<h3>' . esc_html($name) . '</h3>';
                if ($title) echo '<div class="attorney-title text-muted">' . esc_html($title) . '</div>';
                echo '<div class="attorney-bio">' . esc_html($bio) . '</div>';
                echo '<div class="attorney-social">';
                if ($linkedin) echo '<a href="' . esc_url($linkedin) . '" target="_blank">LinkedIn</a> ';
                if ($email) echo '<a href="mailto:' . esc_attr($email) . '">Email</a> ';
                echo '</div>';
                echo '<a href="' . get_permalink() . '" class="view-profile-btn">View Profile</a>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</section>';
            wp_reset_postdata();
        }
        ?>
</main>
<?php get_footer(); ?>
