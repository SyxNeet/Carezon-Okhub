<?php
$option_booking_services = get_field('option_booking_services', 'option');
?>
<!-- Toast Notification Container -->
<div id="toastContainer" class="toast-container">
    <!-- Toast notifications will be dynamically inserted here -->
</div>
<div class="popup__booking">
    <div class="popup__booking-container">
        <button type="button" class="popup__close-btn">
            <?= wp_get_attachment_image(498, 'full'); ?>
        </button>
        <?= wp_get_attachment_image(301, 'full', false, array('class' => 'popup__booking-background')) ?>
        <form action="" class="booking__form" id="bookingForm">
            <p class="booking__form-title">Đăng ký trải nghiệm</p>
            <div class="booking__form-list">
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
                <div class="booking__form-item booking__form-item-textarea">
                    <textarea class="booking__form-item-input" name="message"
                        placeholder="Lời nhắn cho chúng tôi"></textarea>
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
                        <span>
                            <?= wp_get_attachment_image(59, 'icon', false, array('data-no-lazy' => '1')) ?>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php get_template_part('template-parts/footer/footer'); ?>
<?php wp_footer(); ?>