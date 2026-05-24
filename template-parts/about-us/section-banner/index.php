<?php
$banner_image_decor_pc = 973;
$banner_image_decor_mobile = 942;
$icon_prev_id = 830;
$icon_pause_id = 829;
$icon_play_id = 840;

$banner_field = get_field('banner');
$banners = [];

if (is_array($banner_field)) {
    $is_single_banner = array_key_exists('image_desktop', $banner_field)
        || array_key_exists('image_mobile', $banner_field)
        || array_key_exists('title', $banner_field)
        || array_key_exists('description', $banner_field);

    $banners = $is_single_banner ? [$banner_field] : array_values(array_filter($banner_field, 'is_array'));
}

if (empty($banners)) {
    return;
}

$render_banner_image = static function ($image, $class) {
    if (empty($image)) {
        return '';
    }

    if (is_numeric($image)) {
        return wp_get_attachment_image((int) $image, 'full', false, ['class' => $class]);
    }

    if (is_array($image)) {
        $image_id = $image['ID'] ?? $image['id'] ?? null;

        if ($image_id) {
            return wp_get_attachment_image((int) $image_id, 'full', false, ['class' => $class]);
        }

        if (!empty($image['url'])) {
            return sprintf(
                '<img src="%s" alt="%s" class="%s" loading="lazy">',
                esc_url($image['url']),
                esc_attr($image['alt'] ?? ''),
                esc_attr($class)
            );
        }
    }

    if (is_string($image)) {
        return sprintf(
            '<img src="%s" alt="" class="%s" loading="lazy">',
            esc_url($image),
            esc_attr($class)
        );
    }

    return '';
};
?>

<section class="onsen-banner">
    <div class="onsen-banner__container">
        <div class="onsen-banner__overlay"></div>
        <div class="onsen-banner__swiper swiper">
            <div class="onsen-banner__wrapper swiper-wrapper">
                <?php foreach ($banners as $i => $banner): ?>
                    <div class="onsen-banner__slider swiper-slide" data-banner-index="<?= esc_attr($i) ?>">
                        <div class="onsen-banner__slide-inner" data-swiper-parallax="70%">
                            <?= $render_banner_image($banner['image_desktop'] ?? '', 'onsen-banner__image') ?>
                            <?= $render_banner_image($banner['image_mobile'] ?? '', 'onsen-banner__image-mobile') ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="onsen-banner__content">
            <?php foreach ($banners as $i => $banner): ?>
                <div class="onsen-banner__content-item<?= $i === 0 ? ' is-active' : '' ?>"
                    data-banner-index="<?= esc_attr($i) ?>">
                    <div class="onsen-banner__title">
                        <?= wp_kses_post($banner['title'] ?? '') ?>
                    </div>

                    <p class="onsen-banner__description">
                        <?= esc_html($banner['description'] ?? '') ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="onsen-banner__controls">
        <button type="button" class="onsen-banner__btn onsen-banner__prev">
            <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'onsen-banner__btn-icon']) ?>
        </button>
        <div class="onsen-banner__pagination"></div>
        <button type="button" class="onsen-banner__play">
            <?= wp_get_attachment_image($icon_play_id, 'full', false, ['class' => 'onsen-banner__play-icon']) ?>
            <?= wp_get_attachment_image($icon_pause_id, 'full', false, ['class' => 'onsen-banner__pause-icon']) ?>
        </button>
        <button type="button" class="onsen-banner__btn onsen-banner__next">
            <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'onsen-banner__btn-icon']) ?>
        </button>
    </div>

    <div class="onsen-banner__decor">
        <?= wp_get_attachment_image($banner_image_decor_pc, 'full', false, ['class' => 'onsen-banner__decor-image desktop']) ?>
        <?= wp_get_attachment_image($banner_image_decor_mobile, 'full', false, ['class' => 'onsen-banner__decor-image mobile']) ?>
    </div>
</section>
