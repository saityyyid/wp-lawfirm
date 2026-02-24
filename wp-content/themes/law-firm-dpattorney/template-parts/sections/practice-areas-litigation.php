<?php
/**
 * Practice Areas Litigation Section
 * @package DPATTORNEY
 */
$areas = [
    [
        'icon' => 'building-shield',
        'title' => __('Hukum Pidana Korporasi', 'law-firm-dpattorney'),
        'desc' => __('Pembelaan korporasi dalam perkara pidana berat dan fraud. Corporate criminal defense for major fraud and white-collar crime.', 'law-firm-dpattorney'),
    ],
    [
        'icon' => 'scale-balanced',
        'title' => __('Litigasi Strategis', 'law-firm-dpattorney'),
        'desc' => __('Strategi litigasi untuk kasus berdampak tinggi. Strategic litigation for high-impact cases.', 'law-firm-dpattorney'),
    ],
    [
        'icon' => 'gavel',
        'title' => __('Pra-peradilan', 'law-firm-dpattorney'),
        'desc' => __('Pembelaan dan gugatan praperadilan. Pretrial defense and motions.', 'law-firm-dpattorney'),
    ],
    [
        'icon' => 'user-shield',
        'title' => __('Perlindungan Eksekutif', 'law-firm-dpattorney'),
        'desc' => __('Perlindungan hukum bagi eksekutif dan pejabat. Legal protection for executives and officials.', 'law-firm-dpattorney'),
    ],
    [
        'icon' => 'file-contract',
        'title' => __('Hukum Administrasi', 'law-firm-dpattorney'),
        'desc' => __('Sengketa administrasi dan perizinan. Administrative and licensing disputes.', 'law-firm-dpattorney'),
    ],
    [
        'icon' => 'people-group',
        'title' => __('Hukum Keluarga', 'law-firm-dpattorney'),
        'desc' => __('Sengketa keluarga dan waris. Family and inheritance disputes.', 'law-firm-dpattorney'),
    ],
];
?>
<section class="practice-areas-litigation">
    <div class="practice-areas-grid">
        <?php foreach ($areas as $area): ?>
            <div class="practice-area-card">
                <div class="practice-area-icon"><span class="icon-<?php echo esc_attr($area['icon']); ?>"></span></div>
                <h3><?php echo $area['title']; ?></h3>
                <div class="practice-area-desc"> <?php echo $area['desc']; ?> </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
