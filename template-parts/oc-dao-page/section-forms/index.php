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
        <div class="section-offers__form-section">
            <div class="booking-container booking-container-fb">
                <div class="booking">
                    <div class="booking__content">
                        <div class="overlay"></div>
                        <?= wp_get_attachment_image(IS_MOBILE ? 1622 : 1623, 'full', false, array('class' => 'booking__bg')); ?>
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