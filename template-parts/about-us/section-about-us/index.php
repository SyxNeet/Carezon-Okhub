<?php
$section_about_us = get_field('section_about_us');

$title = $section_about_us['title'] ?? '';
$description = $section_about_us['description'] ?? '';
$slogans = $section_about_us['slogan'] ?? [];
$bottom_content = $section_about_us['bottom_content'] ?? [];
$bottom_title = $bottom_content['title'] ?? '';
$bottom_description = $bottom_content['description'] ?? '';
$link_desktop = $bottom_content['link_desktop'] ?? [];
$link_mobile = $bottom_content['link_mobile'] ?? [];
$link = wp_is_mobile() ? $link_mobile : $link_desktop;

$anim_inner = 1341;
$anim_bg = 1338;
$anim_flower_top = 1337;
$anim_shadow = 1339;
$anim_outer = 1340;
$anim_pattern = 1343;
$anim_img = 1342;
$anim_flower_bottom = 1344;

$image_mobile = 1335;

$circle_shadow = 1346;
$circle_logo = 1347;
$decor = 1503;
?>

<section class="section-about-us">
    
    <?= wp_get_attachment_image($decor, 'full', false, array('class' => 'section-about-us__decor')); ?>
    
    <div class="section-about-us__container">
        <div class="section-about-us__left">
            <div class="section-about-us__content">
                <p class="section-about-us__title"><?= esc_html($title); ?></p>
                <p class="section-about-us__description"><?= esc_html($description); ?></p>
            </div>
            <div class="section-about-us__anim">
                <div class="box">
                    <?= wp_get_attachment_image($anim_inner, 'full', false, array('class' => 'section-about-us__anim-inner')); ?>
                    <?= wp_get_attachment_image($anim_bg, 'full', false, array('class' => 'section-about-us__anim-bg')); ?>
                </div>
                <?= wp_get_attachment_image($anim_flower_top, 'full', false, array('class' => 'section-about-us__anim-flower-top')); ?>
                <?= wp_get_attachment_image($anim_shadow, 'full', false, array('class' => 'section-about-us__anim-shadow')); ?>
                <?= wp_get_attachment_image($anim_outer, 'full', false, array('class' => 'section-about-us__anim-outer')); ?>
                <?= wp_get_attachment_image($anim_pattern, 'full', false, array('class' => 'section-about-us__anim-pattern')); ?>
                <?= wp_get_attachment_image($anim_img, 'full', false, array('class' => 'section-about-us__anim-img')); ?>
                <?= wp_get_attachment_image($anim_flower_bottom, 'full', false, array('class' => 'section-about-us__anim-flower-bottom')); ?>
            </div>
        </div>

        <div class="section-about-us__right">
            <div class="section-about-us__circle-wrapper">
                <?= wp_get_attachment_image($circle_shadow, 'full', false, array('class' => 'section-about-us__circle-wrapper-bg')); ?>
                <?= wp_get_attachment_image($circle_logo, 'full', false, array('class' => 'section-about-us__circle-wrapper-logo')); ?>
                <div class="section-about-us__circle about-us__right-circle-1"></div>
                <div class="section-about-us__circle about-us__right-circle-2">
                    <span class="section-about-us__circle-dot section-about-us__circle-dot--1"></span>
                    <span class="section-about-us__circle-dot section-about-us__circle-dot--2"></span>
                    <span class="section-about-us__circle-dot section-about-us__circle-dot--3"></span>
                    <span class="section-about-us__circle-dot section-about-us__circle-dot--4"></span>
                </div>
                <div class="section-about-us__circle about-us__right-circle-3">
                    <span class="section-about-us__circle-dot section-about-us__circle-dot--1"></span>
                    <span class="section-about-us__circle-dot section-about-us__circle-dot--2"></span>
                </div>
                <?php foreach ($slogans as $index => $item): ?>
                    <?php
                    $number = $index + 1;
                    $image = $item['image'] ?? '';
                    $title = $item['title'] ?? '';
                    ?>

                    <?= wp_get_attachment_image($image, 'full', false, array('class' => "section-about-us__circle-image section-about-us__circle-image--{$number}")); ?>
                    <p class="section-about-us__circle-text section-about-us__circle-text--<?= $number; ?>">
                        <?= esc_html($title); ?>
                    </p>
                <?php endforeach; ?>
            </div>

            <div class="section-about-us__info">
                <div class="section-about-us__info-content">
                    <p class="section-about-us__info-heading"><?= esc_html($bottom_title); ?></p>
                    <p class="section-about-us__info-description"><?= esc_html($bottom_description); ?></p>
                </div>

                <?= wp_get_attachment_image($image_mobile, 'full', false, array('class' => 'section-about-us__image')); ?>

                <div class="section-about-us__action">
                    <a href="<?= esc_url($link['url']); ?>" class="section-about-us__link"
                        target="<?= esc_attr($link['target'] ?: '_self'); ?>">
                        <?= wp_get_attachment_image(69, 'full', false, array('class' => 'section-about-us__link-bg')); ?>
                        <span class="section-about-us__link-text">
                            <?= esc_html($link['title']); ?>
                        </span>
                    </a>
                    <?= wp_get_attachment_image(70, 'full', false, array('class' => 'section-about-us__action-image')); ?>
                </div>
            </div>
        </div>
    </div>
</section>