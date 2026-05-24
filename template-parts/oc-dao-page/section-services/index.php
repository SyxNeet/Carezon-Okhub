<?php
$decor_id = 964;
$img_id = 963;

$services = get_field('services') ?: [];
?>

<section class="onsen-services">

    
 
    <div class="onsen-services__container">
        <!-- button -->
    <div class="btn__book__group">
        <div class="btn__book__group-item">
            <img src="https://carezone.vn/wp-content/uploads/2026/05/Special-button.svg" alt="">
            <p>Đặt lịch </br> ngay hôm nay</p>
        </div>
        <img src="https://carezone.vn/wp-content/uploads/2026/05/Info-Image.svg" alt="" class="decor__image">
    </div>
        <?= wp_get_attachment_image($img_id, 'full', false, array('class' => 'onsen-services__img')) ?>

        <!-- Tabs -->
        <div class="onsen-services__tabs">
            <?php foreach ($services as $index => $service): ?>
                <div class="onsen-services__tab <?= $index == 0 ? 'active' : '' ?>">
                    <img class="overlay" src="https://carezone.vn/wp-content/uploads/2026/05/Image.png" alt="">
                    <?= esc_html($service['tab']) ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Content -->
        <div class="onsen-services__main">
            <?php if(isMobileDevice()) : ?>
                <img src="https://carezone.vn/wp-content/uploads/2026/05/d_ch_v_-1.webp" alt="" class="background_services">
            <?php else : ?>
                <img src="https://carezone.vn/wp-content/uploads/2026/05/d_ch_v_.webp" alt="" class="background_services">
            <?php endif; ?>
            <?php foreach ($services as $index => $service): ?>
                <div class="onsen-services__content <?= $index == 0 ? 'active' : '' ?>" data-index="<?= $index ?>">
                    <p class="onsen-services__content-subtitle">
                        <?= esc_html($service['subtitle']) ?>
                    </p>
                    <p class="onsen-services__content-title">
                        <?= esc_html($service['title']) ?>
                    </p>
                    <p class="onsen-services__content-description">
                        <?= esc_html($service['description']) ?>
                    </p>
                    <div class="onsen-services__line"></div>
                    <div class="onsen-services__features">
                        <?php if (isset($service['features']) && is_array($service['features'])): ?>
                            <?php foreach ($service['features'] as $feature): ?>
                                <div class="onsen-services__feature">
                                    <div class="onsen-services__feature-icon">
                                        <?= wp_get_attachment_image($feature['icon'], 'full', false, array('class' => 'onsen-services__feature-icon-img')) ?>
                                    </div>
                                    <p class="onsen-services__feature-content">
                                        <?= esc_html($feature['title']) ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="onsen-services__image">
                <?php foreach ($services as $index => $service): ?>
                    <?= wp_get_attachment_image($service['image_desktop'], 'full', false, array('class' => 'onsen-services__image-img onsen-services__image-img--pc ' . ($index == 0 ? 'active' : ''))) ?>
                    <?= wp_get_attachment_image($service['image_mobile'], 'full', false, array('class' => 'onsen-services__image-img onsen-services__image-img--mobile ' . ($index == 0 ? 'active' : ''))) ?>
                <?php endforeach; ?>
                <div class="onsen-services__overlay"></div>
            </div>
        </div>
    </div>
</section>