<?php
/**
 * Emergency CTA Bar
 * @package DPATTORNEY
 */
$phone = get_theme_mod('emergency_phone', '+62 812-3456-7890');
$enabled = get_theme_mod('emergency_bar_enabled', true);
if (!$enabled) return;
?>
<div id="emergency-bar" class="emergency-cta" style="position:fixed;bottom:0;left:0;width:100%;z-index:9999;display:flex;align-items:center;justify-content:center;background:#8B2635;color:#fff;padding:1em;">
    <span style="margin-right:1em;"><strong><?php _e('Konsultasi Darurat 24/7', 'law-firm-dpattorney'); ?></strong></span>
    <a href="tel:<?php echo esc_attr($phone); ?>" style="color:#fff;margin-right:1em;"><span class="dashicons dashicons-phone"></span> <?php echo esc_html($phone); ?></a>
    <a href="https://wa.me/<?php echo preg_replace('/\D/','',$phone); ?>" target="_blank" rel="noopener" style="color:#fff;margin-right:1em;"><span class="dashicons dashicons-whatsapp"></span> WhatsApp</a>
    <button id="close-emergency-bar" style="background:none;border:none;color:#fff;font-size:1.5em;margin-left:auto;cursor:pointer;">&times;</button>
</div>
<script>
(function(){
    var bar = document.getElementById('emergency-bar');
    var closeBtn = document.getElementById('close-emergency-bar');
    if(localStorage.getItem('emergencyBarClosed')){
        bar.style.display = 'none';
        setTimeout(function(){
            localStorage.removeItem('emergencyBarClosed');
            bar.style.display = 'flex';
        }, 30000);
    }
    closeBtn.onclick = function(){
        bar.style.display = 'none';
        localStorage.setItem('emergencyBarClosed', '1');
        setTimeout(function(){
            localStorage.removeItem('emergencyBarClosed');
            bar.style.display = 'flex';
        }, 30000);
    };
})();
</script>
