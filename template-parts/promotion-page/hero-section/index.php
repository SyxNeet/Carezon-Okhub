<?php
$pause_icon = 829;
$play_icon = 840;
$data_hero = get_field('hero_data');
$heading = $data_hero['heading'] ?? '';
$title = $heading['title'] ?? '';
$subtitle = $heading['subtitle'] ?? '';
$thumbnails_pc = $data_hero['thumbnails'];
$thumbnails_mb = $data_hero['thumbnail_mobile'];

$decor_pc_id = 1299;
$decor_mb_id = 1376;
?>

<section class="hero-slider-wrapper">
    <div class="hero-static-container">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title"><?= $title ?></h1>
                <p class="hero-subtitle"><?= $subtitle ?></p>
            </div>
        </div>
    </div>

    <div class="swiper hero-swiper-pc desktop-only">
        <div class="swiper-wrapper">
            <?php foreach ($thumbnails_pc as $img): ?>
                <div class="swiper-slide">
                    <div class="hero-slide-item">
                        <div class="hero-bg">
                            <?php echo wp_get_attachment_image($img['ID'], 'full', false, array('class' => 'hero-img')); ?>
                            <div class="overlay-left"></div>
                            <div class="overlay-right"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <div class="swiper hero-swiper-mb mobile-only">
        <div class="swiper-wrapper">
            <?php foreach ($thumbnails_mb as $img): ?>
                <div class="swiper-slide">
                    <div class="hero-slide-item">
                        <div class="hero-bg">
                            <?php echo wp_get_attachment_image($img['ID'], 'full', false, array('class' => 'hero-img')); ?>
                            <div class="overlay-mb"></div>
                            <div class="mobile-overlay-top"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="hero-decor-layers">
        <div class="desktop-only">
            <?php echo wp_get_attachment_image(1299, 'full', false, array('class' => 'hero-cloud')); ?>
        </div>
        <div class="mobile-only">
            <?php echo wp_get_attachment_image(1376, 'full', false, array('class' => 'hero-cloud')); ?>
        </div>
    </div>

    <div class="hero-controls-wrapper desktop-only">
        <div class="hero-pagination-container">
            <div class="hero-prev hero-prev-pc">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                    <path d="M6.2502 8.61263C6.17103 8.61263 6.09186 8.58346 6.02936 8.52096L3.3127 5.8043C2.87103 5.36263 2.87103 4.63763 3.3127 4.19596L6.02936 1.4793C6.1502 1.35846 6.3502 1.35846 6.47103 1.4793C6.59186 1.60013 6.59186 1.80013 6.47103 1.92096L3.75436 4.63763C3.55436 4.83763 3.55436 5.16263 3.75436 5.36263L6.47103 8.0793C6.59186 8.20013 6.59186 8.40013 6.47103 8.52096C6.40853 8.5793 6.32936 8.61263 6.2502 8.61263Z" fill="#292D32" />
                </svg>
            </div>
            <div class="swiper-pagination swiper-pagination-pc"></div>
            <div class="hero-play-pause hero-play-pause-pc toggle">
                <?= wp_get_attachment_image($pause_icon, 'full', false, array('class' => 'icon-pause', 'data-no-lazy' => '1')); ?>
                <?= wp_get_attachment_image($play_icon, 'full', false, array('class' => 'icon-play', 'data-no-lazy' => '1')); ?>
            </div>
            <div class="hero-next hero-next-pc">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                    <path d="M3.71283 8.61263C3.63366 8.61263 3.55449 8.58346 3.49199 8.52096C3.37116 8.40013 3.37116 8.20013 3.49199 8.0793L6.20866 5.36263C6.40866 5.16263 6.40866 4.83763 6.20866 4.63763L3.49199 1.92096C3.37116 1.80013 3.37116 1.60013 3.49199 1.4793C3.61283 1.35846 3.81283 1.35846 3.93366 1.4793L6.65033 4.19596C6.86283 4.40846 6.98366 4.69596 6.98366 5.00013C6.98366 5.3043 6.86699 5.5918 6.65033 5.8043L3.93366 8.52096C3.87116 8.5793 3.79199 8.61263 3.71283 8.61263Z" fill="#292D32" />
                </svg>
            </div>
        </div>
    </div>
    <div class="hero-controls-wrapper mobile-only">
        <div class="hero-pagination-container">
            <div class="hero-prev hero-prev-mb">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                    <path d="M6.2502 8.61263C6.17103 8.61263 6.09186 8.58346 6.02936 8.52096L3.3127 5.8043C2.87103 5.36263 2.87103 4.63763 3.3127 4.19596L6.02936 1.4793C6.1502 1.35846 6.3502 1.35846 6.47103 1.4793C6.59186 1.60013 6.59186 1.80013 6.47103 1.92096L3.75436 4.63763C3.55436 4.83763 3.55436 5.16263 3.75436 5.36263L6.47103 8.0793C6.59186 8.20013 6.59186 8.40013 6.47103 8.52096C6.40853 8.5793 6.32936 8.61263 6.2502 8.61263Z" fill="#292D32" />
                </svg>
            </div>
            <div class="swiper-pagination swiper-pagination-mb"></div>
            <div class="hero-play-pause hero-play-pause-mb toggle">
                <?= wp_get_attachment_image($pause_icon, 'full', false, array('class' => 'icon-pause', 'data-no-lazy' => '1')); ?>
                <?= wp_get_attachment_image($play_icon, 'full', false, array('class' => 'icon-play', 'data-no-lazy' => '1')); ?>
            </div>
            <div class="hero-next hero-next-mb">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                    <path d="M3.71283 8.61263C3.63366 8.61263 3.55449 8.58346 3.49199 8.52096C3.37116 8.40013 3.37116 8.20013 3.49199 8.0793L6.20866 5.36263C6.40866 5.16263 6.40866 4.83763 6.20866 4.63763L3.49199 1.92096C3.37116 1.80013 3.37116 1.60013 3.49199 1.4793C3.61283 1.35846 3.81283 1.35846 3.93366 1.4793L6.65033 4.19596C6.86283 4.40846 6.98366 4.69596 6.98366 5.00013C6.98366 5.3043 6.86699 5.5918 6.65033 5.8043L3.93366 8.52096C3.87116 8.5793 3.79199 8.61263 3.71283 8.61263Z" fill="#292D32" />
                </svg>
            </div>
        </div>
    </div>
</section>