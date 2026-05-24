<?php
$banner = get_field('banner');
$banner_title = $banner['title'];
$banner_bg_image = $banner['background_pc'];
$banner_bg_image_mobile = $banner['background_mb'];
$icon = 355;
?>

<section class="banner">
    <?php
    if (wp_is_mobile()) {
        echo wp_get_attachment_image($banner_bg_image_mobile, 'full', false, ['class' => 'banner__background']);
    } else {
        echo wp_get_attachment_image($banner_bg_image, 'full', false, ['class' => 'banner__background']);
    }
    ?>

    <!-- mobile overlay -->
    <div class="banner__overlay-1-mb"></div>
    <div class="banner__overlay-2-mb"></div>


    <!-- heading -->
    <div class="banner__content">
        <h1 class="banner__title"><?= $banner_title ?></h1>
    </div>

    <!-- scroll icon -->
    <div class="banner__scroll">
        <?= wp_get_attachment_image($icon, 'full', false, ['class' => 'banner__scroll-icon']) ?>
    </div>


</section>