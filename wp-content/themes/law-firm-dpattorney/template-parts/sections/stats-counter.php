<?php
/**
 * Stats Counter Section
 * @package DPATTORNEY
 */
?>
<section class="stats-counter">
    <div class="stat-item">
        <span class="stat-number" data-count="50">0</span>+
        <div class="stat-label"><?php _e('Kasus High-Profile', 'law-firm-dpattorney'); ?></div>
    </div>
    <div class="stat-item">
        <span class="stat-number" data-count="85">0</span>%
        <div class="stat-label"><?php _e('Tingkat Keberhasilan Praperadilan', 'law-firm-dpattorney'); ?></div>
    </div>
    <div class="stat-item">
        <span class="stat-number" data-count="30">0</span>+
        <div class="stat-label"><?php _e('Kasasi di Mahkamah Agung', 'law-firm-dpattorney'); ?></div>
    </div>
    <div class="stat-item">
        <span class="stat-number" data-count="15">0</span>+
        <div class="stat-label"><?php _e('Tahun Pengalaman', 'law-firm-dpattorney'); ?></div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function animateCounter(el) {
        const target = +el.getAttribute('data-count');
        let count = 0;
        const step = Math.ceil(target / 60);
        const update = () => {
            count += step;
            if (count > target) count = target;
            el.textContent = count;
            if (count < target) requestAnimationFrame(update);
        };
        update();
    }
    const counters = document.querySelectorAll('.stat-number');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach(counter => observer.observe(counter));
});
</script>
