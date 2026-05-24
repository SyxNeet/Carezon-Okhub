<?php
$section_cta = get_field('section_cta') ?: [];

$background = $section_cta['background'] ?? null;
$title = $section_cta['title'] ?? '';

$link = $section_cta['link'] ?? [];
$link_url = $link['url'] ?? '#';
$link_title = $link['title'] ?? 'Tặng vé cho người thương';
$link_target = $link['target'] ?? '_self';

$roof_image_id = 928;
$icon_id = 59;
?>

<section class="section-cta">

    <?= wp_get_attachment_image($roof_image_id, 'full', false, array('class' => 'section-cta__roof')); ?>
    <?= wp_get_attachment_image($background, 'full', false, array('class' => 'section-cta__background')); ?>

    <div class="section-cta__container">
        <div class="section-cta__content">
            <h2 class="section-cta__title"><?= esc_html($title); ?></h2>
            <div class="section-cta__actions">
                <button type="button" class="section-cta__booking"
                    onclick="document.querySelector('.popup__booking').classList.add('active'); document.documentElement.style.overflow = 'hidden';">
                    <span class="section-cta__booking-text">Đặt chỗ ngay</span>
                    <span class="section-cta__booking-icon">
                        <?= wp_get_attachment_image($icon_id, 'icon', false, array('data-no-lazy' => '1')) ?>
                    </span>
                </button>
                <a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"
                    class="section-cta__donate">
                    <span class="section-cta__donate-text"><?= esc_html($link_title); ?></span>
                    <span class="section-cta__donate-icon">
                        <?= wp_get_attachment_image($icon_id, 'icon', false, array('data-no-lazy' => '1')) ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>