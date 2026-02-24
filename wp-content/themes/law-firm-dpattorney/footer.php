<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-row">
            <div class="footer-col brand">
                <div class="footer-logo">
                    <?php if (has_custom_logo()) { the_custom_logo(); } else { ?>
                        <span class="site-title">DPATTORNEY</span>
                    <?php } ?>
                </div>
                <div class="footer-desc">Litigation Powerhouse. Proven in Court. Trusted by Leaders.</div>
                <div class="footer-social">
                    <a href="#" class="social-link">LinkedIn</a>
                    <a href="#" class="social-link">Instagram</a>
                </div>
            </div>
            <div class="footer-col practice-areas">
                <h4>Practice Areas</h4>
                <ul>
                    <li><a href="#">Hukum Pidana Korporasi</a></li>
                    <li><a href="#">Litigasi Strategis</a></li>
                    <li><a href="#">Pra-peradilan</a></li>
                    <li><a href="#">Hukum Administrasi & Regulasi</a></li>
                    <li><a href="#">Perlindungan Eksekutif</a></li>
                </ul>
            </div>
            <div class="footer-col quick-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kasus Terkemuka</a></li>
                    <li><a href="#">Partner</a></li>
                    <li><a href="#">Wawasan</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-col contact">
                <h4>Contact</h4>
                <div>Jakarta Office</div>
                <div>Jl. Example No. 1, Jakarta</div>
                <div>0812-XXXX-XXXX</div>
                <div>info@dionpongkor.com</div>
                <div>Mon-Fri: 09.00-18.00</div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright">&copy; <?php echo date('Y'); ?> Dion Pongkor & Partners. All rights reserved.</div>
            <div class="footer-links">
                <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
            </div>
            <div class="footer-disclaimer">Informasi di website ini tidak merupakan nasihat hukum...</div>
        </div>
    </div>
    <?php wp_footer(); ?>
</footer>
</body>
</html>
