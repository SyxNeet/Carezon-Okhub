<?php

/**
 * Section: Offers — Restaurant Page
 * Parts: 1) Social CTA  2) Offer Cards  3) Booking Form
 */

$offers     = get_field('restaurant_offers') ?: [];
$subtitle   = $offers['subtitle'] ?? 'Stay in touch';
$title_raw  = $offers['title'] ?? "Theo dõi chúng tôi\n@carezone qua các nền tảng";
$social     = $offers['social_links'] ?? [];
$cards      = $offers['offer_cards'] ?? [];
$form_image = $offers['form_image'] ?? [];
$services   = $offers['form_service_options'] ?? [];

// Form image
$form_image_id = $form_image['ID'] ?? 0;

// Booking form services (option page) — dùng chung với booking-container ở trang chủ
$option_booking_services = get_field('option_booking_services', 'option') ?: [];

// Social platform icons (static theme assets — xuất từ Figma node section-offers)
$ic_facebook = get_theme_file_uri('/assets/images/restaurant-page/ic-social-facebook.png');
$ic_zalo     = get_theme_file_uri('/assets/images/restaurant-page/ic-social-zalo.png');
$ic_tiktok   = get_theme_file_uri('/assets/images/restaurant-page/ic-social-tiktok.png');

// Fallback static icons by index
$default_icons = [$ic_facebook, $ic_zalo, $ic_tiktok];

// Title lines — split on newline
$title_lines = array_map('trim', explode("\n", $title_raw));
?>

<section id="section-offers" class="section-offers">
    <div class="section-offers__bg-overlay" aria-hidden="true"></div>

    <div class="section-offers__inner">

        <!-- ================================================================
             Part 1: Social CTA
             ================================================================ -->
        <div class="section-offers__social-cta">

            <div class="section-offers__social-text">
                <?php if ($subtitle): ?>
                    <p class="section-offers__subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>

                <h2 class="section-offers__title">
                    <?php foreach ($title_lines as $line): ?>
                        <?php echo esc_html($line); ?><br>
                    <?php endforeach; ?>
                </h2>
            </div>

            <?php if (!empty($social)): ?>
                <div class="section-offers__social-buttons">
                    <?php foreach ($social as $idx => $item):
                        $link       = $item['link'] ?? [];
                        $link_url   = $link['url'] ?? '#';
                        $link_title = $link['title'] ?? '';
                        $link_target = $link['target'] ?? '_blank';
                        $icon_src   = $default_icons[$idx] ?? $ic_facebook;
                    ?>
                        <a
                            href="<?php echo esc_url($link_url); ?>"
                            target="<?php echo esc_attr($link_target); ?>"
                            class="section-offers__social-btn"
                            title="<?php echo esc_attr($link_title); ?>">
                            <img
                                src="<?php echo esc_url($icon_src); ?>"
                                alt=""
                                aria-hidden="true"
                                class="section-offers__social-btn-icon"
                                loading="lazy">
                            <span class="section-offers__social-btn-label"><?php echo esc_html($link_title); ?></span>
                            <span class="section-offers__social-btn-arrow" aria-hidden="true">
                                <span class="section-offers__social-btn-arrow-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#b98951" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </span>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div><!-- /.section-offers__social-cta -->

        <!-- ================================================================
             Part 2: Offer Cards
             ================================================================ -->
        <div class="section-offers__cards-row">
            <div
                class="section-offers__swiper swiper js-offers-swiper"
                aria-label="<?php echo esc_attr__('Ưu đãi nổi bật', 'okhub-theme'); ?>">
                <div class="section-offers__swiper-wrapper swiper-wrapper">
                    <?php
                    // Determine alternating layout: card 1,3 = full-height; card 2,4 = short
                    foreach ($cards as $card_idx => $card):
                        $card_image_id  = $card['image']['ID'] ?? 0;
                        $card_badge     = $card['badge'] ?? 'FACEBOOK';
                        $is_full        = ($card_idx % 2 === 0); // 0-based: even = full
                        $card_modifier  = $is_full ? 'section-offers__card--full' : 'section-offers__card--short';
                    ?>
                        <div class="section-offers__card <?php echo esc_attr($card_modifier); ?> swiper-slide">
                            <div class="section-offers__card-inner">
                                <?php if ($card_image_id): ?>
                                    <?php echo wp_get_attachment_image($card_image_id, 'large', false, [
                                        'class'   => 'section-offers__card-img',
                                        'loading' => 'lazy',
                                        'decoding' => 'async',
                                        'alt'     => '',
                                    ]); ?>
                                <?php endif; ?>

                                <div class="section-offers__card-badge" aria-hidden="true">
                                    <div class="section-offers__card-badge-icon">
                                        <img
                                            src="<?php echo esc_url(get_theme_file_uri('/assets/images/restaurant-page/ic-social-facebook.png')); ?>"
                                            alt="">
                                    </div>
                                    <span class="section-offers__card-badge-label"><?php echo esc_html($card_badge); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div><!-- /.swiper-wrapper -->

                <!-- <div class="section-offers__swiper-pagination swiper-pagination" aria-hidden="true"></div> -->
            </div><!-- /.swiper -->
        </div><!-- /.section-offers__cards-row -->

        <!-- ================================================================
             Part 3: Booking Form
             ================================================================ -->
        <div class="section-offers__form-section">
            <div class="booking-container booking-container-fb">
                <div class="booking">
                    <img class="booking__image" src="/wp-content/uploads/2025/10/booking-family.webp" alt="Booking Family">

                    <div class="booking__content">
                        <?= wp_get_attachment_image(IS_MOBILE ? 257 : 199, 'full', false, array('class' => 'booking__bg')); ?>
                        <?= wp_get_attachment_image(194, 'full', false, array('class' => 'booking__bg--primary')); ?>
                        <?= wp_get_attachment_image(195, 'full', false, array('class' => 'booking__bg--secondary')); ?>
                        <?= wp_get_attachment_image(196, 'full', false, array('class' => 'booking__bg--tertiary')); ?>
                        <?= wp_get_attachment_image(197, 'full', false, array('class' => 'booking__bg--quaternary')); ?>
                        <?= wp_get_attachment_image(198, 'full', false, array('class' => 'booking__bg--quinary')); ?>

                        <?php if (IS_MOBILE): ?>
                            <?= wp_get_attachment_image(264, 'full', false, array('class' => 'booking__bg--primary-secondary-mobile')); ?>
                            <?= wp_get_attachment_image(265, 'full', false, array('class' => 'booking__bg--primary-tertiary-mobile')); ?>
                            <?= wp_get_attachment_image(266, 'full', false, array('class' => 'booking__bg--secondary-mobile')); ?>
                            <?= wp_get_attachment_image(268, 'full', false, array('class' => 'booking__bg--tertiary-mobile')); ?>
                            <?= wp_get_attachment_image(269, 'full', false, array('class' => 'booking__bg--tertiary-secondary-mobile')); ?>
                            <?= wp_get_attachment_image(269, 'full', false, array('class' => 'booking__bg--quinary-mobile')); ?>
                        <?php endif; ?>

                        <form action="" class="booking__form" id="bookingForm">
                            <div class="booking__form-item">
                                <div class="booking__form-item-icon">
                                    <?= wp_get_attachment_image(214, 'full'); ?>
                                </div>
                                <input class="booking__form-item-input" type="text" name="fullName"
                                    placeholder="Họ và tên *">
                                <div class="booking__form-item-error" id="fullNameError"></div>
                            </div>
                            <div class="booking__form-item">
                                <div class="booking__form-item-icon">
                                    <?= wp_get_attachment_image(212, 'full'); ?>
                                </div>
                                <input class="booking__form-item-input" type="tel" name="phone"
                                    placeholder="Số điện thoại *">
                                <div class="booking__form-item-error" id="phoneError"></div>
                            </div>
                            <div class="booking__form-item booking__form-item-select-custom">
                                <div class="custom-select" id="serviceSelect">
                                    <div class="custom-select__trigger">
                                        <span class="custom-select__value">Chọn dịch vụ tại Carezone</span>
                                        <div style="--icon: url(<?= wp_get_attachment_image_url(210, 'full') ?>);"
                                            class="custom-select__arrow"></div>
                                    </div>
                                    <div class="custom-select__options">
                                        <?php foreach ($option_booking_services as $item): ?>
                                            <div class="custom-select__option" data-value="<?= $item['label'] ?>">
                                                <?= $item['label'] ?>
                                                <div class='custom-select__option-desc'>
                                                    <?= $item['description'] ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="booking__form-item-error" id="serviceError"></div>
                            </div>

                            <div class="booking__form-option">
                                <div class="booking__form-option-quantity">
                                    <div class="booking__form-option-quantity__row">
                                        <div class="booking__form-option-quantity__row-icon">
                                            <?= wp_get_attachment_image(214, 'full', false, array('class' => 'booking__form-option-quantity__row-icon')); ?>
                                        </div>
                                        <label class="booking__form-option-quantity__row-label">Số lượng người</label>
                                    </div>
                                    <div class="booking__form-option-quantity__controls">
                                        <div class="booking__form-option-quantity__control-item">
                                            <label>Người lớn</label>
                                            <div class="booking__form-option-quantity__control-wrapper">
                                                <div class="booking__form-option-quantity__control-container">
                                                    <button class="booking__form-option-quantity__control-icon"
                                                        type="button">
                                                        <?= wp_get_attachment_image(211, 'full'); ?>
                                                    </button>
                                                    <input class="booking__form-option-quantity__control-input"
                                                        type="number" name="adults" value="01" min="0" max="20">
                                                    <button class="booking__form-option-quantity__control-icon"
                                                        type="button">
                                                        <?= wp_get_attachment_image(213, 'full'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="booking__form-option-quantity__control-item">
                                            <label>Trẻ em</label>
                                            <div class="booking__form-option-quantity__control-wrapper">
                                                <div class="booking__form-option-quantity__control-container">
                                                    <button class="booking__form-option-quantity__control-icon"
                                                        type="button">
                                                        <?= wp_get_attachment_image(211, 'full'); ?>
                                                    </button>
                                                    <input class="booking__form-option-quantity__control-input"
                                                        type="number" name="children" value="01" min="0" max="20">
                                                    <button class="booking__form-option-quantity__control-icon"
                                                        type="button">
                                                        <?= wp_get_attachment_image(213, 'full'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking__form-item-error" id="adultsError"></div>
                                <button class="booking__form-option-button" type="submit" form="bookingForm">
                                    <p class="booking__form-option-button-text">Đặt chỗ ngay</p>
                                    <span>
                                        <?= wp_get_attachment_image(59, 'icon', false, array('data-no-lazy' => '1')) ?>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.section-offers__form-section -->

    </div><!-- /.section-offers__inner -->
</section><!-- /#section-offers -->