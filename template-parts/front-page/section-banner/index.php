<?php
// Get ACF field data with validation
$home_banner = get_field('home_banner');

$slides = IS_MOBILE ? $home_banner['slide_mobile'] : $home_banner['slide_pc'];

$pause_icon = 829;
$play_icon = 840;
$prev_icon = 830;
?>

<section class="section-banner">
    <div class="swiper">
        <div class="swiper-wrapper">
            <?php foreach($slides as $slide): ?>
            <?php 
            $type = $slide['type'];
            $image = $slide['image'];
            $video = $slide['video'];
            $youtube = $slide['youtube'];
            ?>
                <div class="swiper-slide">
                    <?php if ($type === 'image'): ?>
                        <?= wp_get_attachment_image($image, 'full', false, array('class' => 'banner-img', 'data-no-lazy' => '1', 'fetchpriority' => 'high')); ?>
                    <?php endif; ?>
                    <?php if ($type === 'youtube'): ?>
                        <div class="banner-youtube-wrapper">
                            <iframe data-src="<?= esc_url($youtube); ?>"title="YouTube video player" class="banner-youtube"></iframe>
                            <div class="banner-youtube-overlay"></div>
                        </div>
                    <?php endif; ?>
                    <?php if ($type === 'video'): ?>
                        <video src="<?= esc_url($video); ?>" alt="Video" class="banner-video" autoplay muted loop playsinline />
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="custom-pagination hidden">
            <button class="nav prev">
                <?= wp_get_attachment_image($prev_icon, 'full', false, array('class' => 'nav-icon', 'data-no-lazy' => '1')); ?>
            </button>
        
            <div class="dots"></div>
        
            <button class="toggle">
                <?= wp_get_attachment_image($pause_icon, 'full', false, array('class' => 'icon-pause', 'data-no-lazy' => '1')); ?>
                <?= wp_get_attachment_image($play_icon, 'full', false, array('class' => 'icon-play', 'data-no-lazy' => '1')); ?>
            </button>
            
            <button class="nav next">
                <?= wp_get_attachment_image($prev_icon, 'full', false, array('class' => 'nav-icon right', 'data-no-lazy' => '1')); ?>
            </button>
        </div>
    </div>
</section>