<?php
$option_booking_services = get_field('option_booking_services', 'option');
?>
<section class="booking-container">
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
                    <input class="booking__form-item-input" type="text" name="fullName" placeholder="Họ và tên *">
                    <div class="booking__form-item-error" id="fullNameError"></div>
                </div>
                <div class="booking__form-item">
                    <div class="booking__form-item-icon">
                        <?= wp_get_attachment_image(212, 'full'); ?>
                    </div>
                    <input class="booking__form-item-input" type="tel" name="phone" placeholder="Số điện thoại *">
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
                                        <button class="booking__form-option-quantity__control-icon" type="button">
                                            <?= wp_get_attachment_image(211, 'full'); ?>
                                        </button>
                                        <input class="booking__form-option-quantity__control-input" type="number"
                                            name="adults" value="01" min="0" max="20">
                                        <button class="booking__form-option-quantity__control-icon" type="button">
                                            <?= wp_get_attachment_image(213, 'full'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="booking__form-option-quantity__control-item">
                                <label>Trẻ em</label>
                                <div class="booking__form-option-quantity__control-wrapper">
                                    <div class="booking__form-option-quantity__control-container">
                                        <button class="booking__form-option-quantity__control-icon" type="button">
                                            <?= wp_get_attachment_image(211, 'full'); ?>
                                        </button>
                                        <input class="booking__form-option-quantity__control-input" type="number"
                                            name="children" value="01" min="0" max="20">
                                        <button class="booking__form-option-quantity__control-icon" type="button">
                                            <?= wp_get_attachment_image(213, 'full'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="booking__form-item-error" id="adultsError"></div>
                    <button class="booking__form-option-button" type="submit" id="bookingForm">
                        <p class="booking__form-option-button-text">Đặt chỗ ngay</p>
                        <span class="contact__submit-btn-decor">
                            <?= wp_get_attachment_image(59, 'icon', false, array('data-no-lazy' => '1')) ?>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>