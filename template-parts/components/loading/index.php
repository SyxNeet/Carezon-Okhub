<?php
$home_banner = get_field('home_banner');
$text_line_1 = isset($home_banner['text_line_1']) ? $home_banner['text_line_1'] : '';
$text_line_2 = isset($home_banner['text_line_2']) ? $home_banner['text_line_2'] : '';
$title = isset($home_banner['title']) ? $home_banner['title'] : '';
$foreground_pc = isset($home_banner['foreground_pc']) ? $home_banner['foreground_pc'] : '';
$background_pc = isset($home_banner['background_pc']) ? $home_banner['background_pc'] : '';
$background_mb = isset($home_banner['background_mb']) ? $home_banner['background_mb'] : '';
$foreground_mb = isset($home_banner['foreground_mb']) ? $home_banner['foreground_mb'] : '';
$logo = isset($home_banner['logo']) ? $home_banner['logo'] : '';
?>
<div class="page-loading">
    <div class="loading__background">
        <?= wp_get_attachment_image(IS_MOBILE ? $foreground_mb : $foreground_pc, 'full', false, array(
            'class' => 'loading__background-image',
            'data-no-lazy' => '1',
            'fetchpriority' => 'high'
        )) ?>
    </div>
    <div class="loading__content-text">
        <p class="loading__content-line-1"><?= $text_line_1 ?></p>
        <p class="loading__content-line-2"><?= $text_line_2 ?></p>
    </div>
    <div class="loading__content-title">
        <?= $title ?>
    </div>
    <div class="loading-ellipse-background">
        <?= wp_get_attachment_image(182, 'large', false, array(
            'class' => 'loading-ellipse-background-image',
            'data-no-lazy' => '1',
            'fetchpriority' => 'high'
        )) ?>

    </div>
    <div class="loading-ellipse-container" style="--border-image: url(<?= wp_get_attachment_image_url(57, 'full') ?>)">
        <div class="loading-ellipse-container-background">
            <div class="swiper loading-ellipse-swiper">
                <div class="swiper-wrapper">
                    <?php
                    $slides = IS_MOBILE ? $home_banner['slide_mobile'] : $home_banner['slide_pc'];
                    foreach ($slides as $slide) :
                        $type = isset($slide['type']) ? $slide['type'] : '';
                        if ($type === 'image') :
                    ?>
                            <div class="swiper-slide">
                                <?= wp_get_attachment_image($slide['image'], 'full', false, array(
                                    'class' => 'loading-ellipse-container-background-image',
                                    'data-no-lazy' => '1',
                                    'fetchpriority' => 'high'
                                )) ?>
                            </div>
                        <?php elseif ($type === 'video') : ?>
                            <div class="swiper-slide">
                                <video data-src="<?= $slide['video'] ?>" class="loading-ellipse-container-background-video"
                                    autoplay muted loop></video>
                            </div>
                        <?php elseif ($type === 'youtube') : ?>
                            <div class="swiper-slide">
                                <iframe data-src="<?= $slide['youtube'] ?>" class="loading-ellipse-container-background-youtube"
                                    autoplay muted loop></iframe>
                                <div class="loading-ellipse-container-background-youtube-overlay"></div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- <div class="loading-ellipse">
            <?= wp_get_attachment_image(58, 'full', false, array(
                'class' => 'loading-ellipse-image',
                'data-no-lazy' => '1',
                'fetchpriority' => 'high'
            )) ?>
        </div> -->
        <div class="loading-logo">
            <?= wp_get_attachment_image($logo, 'large', false, array(
                'class' => 'loading-logo-image',
                'data-no-lazy' => '1',
                'fetchpriority' => 'high'
            )) ?>
        </div>

        <div class="loading-leaf loading-leaf--1">
            <?= wp_get_attachment_image(47, 'large', false, array(
                'class' => 'loading-leaf-image',
                'data-no-lazy' => '1',
                'fetchpriority' => 'high'
            )) ?>
        </div>
        <div class="loading-leaf loading-leaf--2">
            <?= wp_get_attachment_image(48, 'large', false, array(
                'class' => 'loading-leaf-image',
                'data-no-lazy' => '1',
                'fetchpriority' => 'high'
            )) ?>
        </div>
        <div class="loading-leaf loading-leaf--3">
            <?= wp_get_attachment_image(49, 'large', false, array(
                'class' => 'loading-leaf-image',
                'data-no-lazy' => '1',
                'fetchpriority' => 'high'
            )) ?>
        </div>
        <div class="loading-leaf loading-leaf--4">
            <?= wp_get_attachment_image(50, 'large', false, array(
                'class' => 'loading-leaf-image',
                'data-no-lazy' => '1',
                'fetchpriority' => 'high'
            )) ?>
        </div>
        <div class="loading-leaf loading-leaf--5">
            <?= wp_get_attachment_image(51, 'large', false, array(
                'class' => 'loading-leaf-image',
                'data-no-lazy' => '1',
                'fetchpriority' => 'high'
            )) ?>
        </div>
        <div class="loading-leaf loading-leaf--6">
            <?= wp_get_attachment_image(52, 'large', false, array(
                'class' => 'loading-leaf-image',
                'data-no-lazy' => '1',
                'fetchpriority' => 'high'
            )) ?>
        </div>
        <div class="loading-leaf loading-leaf--7">
            <?= wp_get_attachment_image(53, 'large', false, array(
                'class' => 'loading-leaf-image',
                'data-no-lazy' => '1',
                'fetchpriority' => 'high'
            )) ?>
        </div>
    </div>
</div>