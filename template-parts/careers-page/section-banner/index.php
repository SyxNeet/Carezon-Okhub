<?php
$d_banner_image = 915;
$banner_image_decor_pc = 1104;
$icon_prev_id = 830;
$icon_pause_id = 829;
$icon_play_id = 840;

$banners = get_field('banner') ?: [];
?>

<section class="career-banner">
    <div class="career-banner__container">
        <div class="career-banner__overlay"></div>
        <div class="career-banner__swiper swiper">
            <div class="career-banner__wrapper swiper-wrapper">
                <?php foreach ($banners as $i => $banner): ?>
                    <div class="career-banner__slider swiper-slide" data-banner-index="<?= esc_attr($i) ?>">
                        <div class="career-banner__slide-inner" data-swiper-parallax="70%">
                            <?= wp_get_attachment_image($banner['image_desktop'], 'full', false, ['class' => 'career-banner__image']) ?>
                            <?= wp_get_attachment_image($banner['image_mobile'], 'full', false, ['class' => 'career-banner__image-mobile']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="career-banner__content">
            <?php foreach ($banners as $i => $banner): ?>
                <div class="career-banner__content-item<?= $i === 0 ? ' is-active' : '' ?>"
                    data-banner-index="<?= esc_attr($i) ?>">
                    <h2 class="career-banner__title">
                        <?= esc_html($banner['title']) ?>
                    </h2>

                    <p class="career-banner__description">
                        <?= esc_html($banner['description']) ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="career-banner__controls">
        <button type="button" class="career-banner__btn career-banner__prev">
            <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'career-banner__btn-icon']) ?>
        </button>
        <div class="career-banner__pagination"></div>
        <button type="button" class="career-banner__play">
            <?= wp_get_attachment_image($icon_play_id, 'full', false, ['class' => 'career-banner__play-icon']) ?>
            <?= wp_get_attachment_image($icon_pause_id, 'full', false, ['class' => 'career-banner__pause-icon']) ?>
        </button>
        <button type="button" class="career-banner__btn career-banner__next">
            <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'career-banner__btn-icon']) ?>
        </button>
    </div>

    <div class="career-banner__decor">
        <?= wp_get_attachment_image($banner_image_decor_pc, 'full', false, ['class' => 'career-banner__decor-image desktop']) ?>
    </div>
</section>