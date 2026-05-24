<?php
$intro = get_field('introduce') ?: [];
$label = $intro['label'] ?? '';
$heading = $intro['heading'] ?? '';
$description = $intro['description'] ?? '';

$vip_card = $intro['vip_card'] ?? [];
$vip_card_image_desktop = $vip_card['image_desktop'] ?? '';
$vip_card_image_mobile = $vip_card['image_mobile'] ?? '';
$vip_card_title = $vip_card['title'] ?? '';
$vip_card_description = $vip_card['description'] ?? '';
?>

<section class="section-intro">

    <?= wp_get_attachment_image(1208, 'full', false, array('class' => 'section-intro__background--desktop')) ?>
    <?= wp_get_attachment_image(1207, 'full', false, array('class' => 'section-intro__background--mobile')) ?>

    <div class="section-intro__container">

        <div class="section-intro__content">
            <p class="section-intro__label"><?= esc_html($label) ?></p>
            <p class="section-intro__heading"><?= esc_html($heading) ?></p>
            <p class="section-intro__description"><?= esc_html($description) ?></p>
        </div>

        <div class="section-intro__vip-card">
            <?= wp_get_attachment_image($vip_card_image_desktop, 'full', false, array('class' => 'section-intro__vip-card-image')) ?>
            <?= wp_get_attachment_image($vip_card_image_mobile, 'full', false, array('class' => 'section-intro__vip-card-image mobile')) ?>

            <div class="section-intro__vip-card-content">
                <p class="section-intro__vip-card-title"><?= esc_html($vip_card_title) ?></p>
                <p class="section-intro__vip-card-description"><?= esc_html($vip_card_description) ?></p>
            </div>
        </div>

    </div>
</section>