<?php
$banner_image_decor_pc = 973;
$banner_image_decor_mobile = 942;
$icon_prev_id = 830;
$icon_pause_id = 829;
$icon_play_id = 840;

$banners = get_field('banner') ?: [];
?>

<section class="onsen-banner">
    <div class="onsen-banner__container">
        <div class="onsen-banner__overlay"></div>
        <div class="onsen-banner__swiper swiper">
            <div class="onsen-banner__wrapper swiper-wrapper">
                <?php foreach ($banners as $i => $banner): ?>
                    <div class="onsen-banner__slider swiper-slide" data-banner-index="<?= esc_attr($i) ?>">
                        <div class="onsen-banner__slide-inner" data-swiper-parallax="70%">
                            <?= wp_get_attachment_image($banner['image_desktop'], 'full', false, ['class' => 'onsen-banner__image']) ?>
                            <?= wp_get_attachment_image($banner['image_mobile'], 'full', false, ['class' => 'onsen-banner__image-mobile']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="onsen-banner__content">
            <?php foreach ($banners as $i => $banner): ?>
                <div class="onsen-banner__content-item<?= $i === 0 ? ' is-active' : '' ?>"
                    data-banner-index="<?= esc_attr($i) ?>">
                    <h1 class="onsen-banner__title">
                        <?= esc_html($banner['title']) ?>
                    </h1>

                    <p class="onsen-banner__description">
                        <?= esc_html($banner['description']) ?>
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
    </div>
</section>