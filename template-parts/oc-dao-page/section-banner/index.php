<?php
/**
 * Section: Banner — Nhà hàng chay (restaurant-page)
 * Cloned from onsen-banner pattern.
 * Has H1: true (chỉ slide đầu tiên)
 */

// Decor + control icons (reuse media giống onsen-banner)
$banner_image_decor_pc     = 973;
$banner_image_decor_mobile = 942;
$icon_prev_id  = 830;
$icon_pause_id = 829;
$icon_play_id  = 840;

// ACF: repeater "banner" — giống onsen (image_desktop, image_mobile, title, description)
$banners = get_field('banner') ?: [];

// Fallback: nếu chưa có data "banner", migrate từ group restaurant_banner.slides cũ
if (empty($banners)) {
    $legacy = get_field('restaurant_banner') ?: [];
    $slides = $legacy['slides'] ?? [];
    foreach ($slides as $slide) {
        $img_d = $slide['image_desktop'] ?? 0;
        $img_m = $slide['image_mobile'] ?? 0;
        $banners[] = [
            'image_desktop' => is_array($img_d) ? ($img_d['ID'] ?? 0) : $img_d,
            'image_mobile'  => is_array($img_m) ? ($img_m['ID'] ?? 0) : $img_m,
            'title'         => $slide['heading'] ?? '',
            'description'   => $slide['subheading'] ?? '',
        ];
    }
}
?>

<section id="section-banner" class="section-banner">
    <div class="section-banner__container">
        <div class="section-banner__overlay"></div>
        <div class="section-banner__swiper swiper">
            <div class="section-banner__wrapper swiper-wrapper">
                <?php foreach ($banners as $i => $banner): ?>
                    <div class="section-banner__slider swiper-slide" data-banner-index="<?= esc_attr($i) ?>">
                        <div class="section-banner__slide-inner" data-swiper-parallax="70%">
                            <?= wp_get_attachment_image($banner['image_desktop'], 'full', false, ['class' => 'section-banner__image']) ?>
                            <?= wp_get_attachment_image($banner['image_mobile'], 'full', false, ['class' => 'section-banner__image-mobile']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="section-banner__content">
            <?php foreach ($banners as $i => $banner): ?>
                <div class="section-banner__content-item<?= $i === 0 ? ' is-active' : '' ?>"
                    data-banner-index="<?= esc_attr($i) ?>">
                    <?php if ($i === 0): ?>
                        <h1 class="section-banner__title">
                            <?= esc_html($banner['title']) ?>
                        </h1>
                    <?php else: ?>
                        <p class="section-banner__title">
                            <?= esc_html($banner['title']) ?>
                        </p>
                    <?php endif; ?>

                    <p class="section-banner__description">
                        <?= esc_html($banner['description']) ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="section-banner__controls">
            <button type="button" class="section-banner__btn section-banner__prev">
                <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'section-banner__btn-icon']) ?>
            </button>
            <div class="section-banner__pagination"></div>
            <button type="button" class="section-banner__play">
                <?= wp_get_attachment_image($icon_play_id, 'full', false, ['class' => 'section-banner__play-icon']) ?>
                <?= wp_get_attachment_image($icon_pause_id, 'full', false, ['class' => 'section-banner__pause-icon']) ?>
            </button>
            <button type="button" class="section-banner__btn section-banner__next">
                <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'section-banner__btn-icon']) ?>
            </button>
        </div>

        <div class="section-banner__decor">
            <?= wp_get_attachment_image($banner_image_decor_pc, 'full', false, ['class' => 'section-banner__decor-image desktop']) ?>
            <?= wp_get_attachment_image($banner_image_decor_mobile, 'full', false, ['class' => 'section-banner__decor-image mobile']) ?>
        </div>
    </div>
</section>
