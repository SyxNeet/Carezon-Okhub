<?php
$icon_prev_id = 830;
$icon_prev_mobile_id = 828;
$icon_pause_id = 829;
$icon_play_id = 840;

$home_contact = get_field('home_contact');
$link = isset($home_contact['link']) ? $home_contact['link'] : '';
$feedback = isset($home_contact['feedback']) ? $home_contact['feedback'] : '';
$title_line_1 = isset($home_contact['title_line_1']) ? $home_contact['title_line_1'] : '';
$title_line_2 = isset($home_contact['title_line_2']) ? $home_contact['title_line_2'] : '';
$achievement = isset($home_contact['achievement']) ? $home_contact['achievement'] : '';
$option_booking_services = get_field('option_booking_services', 'option');
?>

<div class="background">
    <?= wp_get_attachment_image(909, 'full', false, array('class' => 'background__image--bg')); ?>
    <?= wp_get_attachment_image(184, 'full', false, array('class' => 'background__image--left')); ?>
    <?= wp_get_attachment_image(185, 'full', false, array('class' => 'background__image--right')); ?>
    <?= wp_get_attachment_image(191, 'full', false, array('class' => 'background__image--bottom')); ?>

    <section class="values">
        <?= wp_get_attachment_image(907, 'full', false, array('class' => 'values__bg--left')); ?>
        <?= wp_get_attachment_image(908, 'full', false, array('class' => 'values__bg--right')); ?>
        <?= wp_get_attachment_image(190, 'full', false, array('class' => 'values__bg--bottom')); ?>

        <div class="values__header">
            <p class="values__title">Carezone</p>
            <div class="values__intro">
                <?= $title_line_1 ?><br>
                <span class="values__intro-text">
                    <?= $title_line_2 ?>
                </span>
            </div>
        </div>
        <?php if ($feedback): ?>
            <div class="feedback">
                <div class="feedback__swiper swiper">
                    <div class="feedback__swiper-wrapper swiper-wrapper">
                        <?php foreach ($feedback as $item): ?>
                            <div class="feedback__swiper-slide swiper-slide">
                                <div class="feedback__card">

                                    <?= wp_get_attachment_image(208, 'full', false, array('class' => 'feedback__background')); ?>

                                    <div id="feedback-socials" class="feedback__socials">
                                        <?php
                                        $single_feedback = get_field('single_feedback', $item->ID);
                                        $contact = isset($single_feedback['contact']) ? $single_feedback['contact'] : '';
                                        if ($contact):
                                            foreach ($contact as $contact_item):
                                                $icon = isset($contact_item['icon']) ? $contact_item['icon'] : '';
                                                $link = isset($contact_item['link']) ? $contact_item['link'] : '';
                                                $link_url = isset($contact_item['link_url']) ? $contact_item['link_url'] : '';
                                                $link_title = isset($contact_item['link_title']) ? $contact_item['link_title'] : '';
                                                $link_target = isset($contact_item['link_target']) ? $contact_item['link_target'] : '';
                                        ?>

                                                <a href="<?= $link_url ?>" <?= $link_target ? 'target="' . $link_target . '"' : '' ?>
                                                    class="feedback__socials-item">
                                                    <?= wp_get_attachment_image($icon, 'full', false, array('class' => 'feedback__socials-item-icon')); ?>
                                                </a>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>

                                    <?= wp_get_attachment_image(207, 'full', false, array('class' => 'feedback__quote-icon')); ?>

                                    <div class="feedback__avatar">
                                        <?= get_the_post_thumbnail($item->ID, 'full'); ?>
                                    </div>
                                    <p class="feedback__text">
                                        <?php
                                        $single_feedback = get_field('single_feedback', $item->ID);
                                        $content = isset($single_feedback['content']) ? $single_feedback['content'] : '';
                                        echo $content;
                                        ?>
                                    </p>

                                    <div class="feedback__author">
                                        <p class="feedback__author-name">
                                            <?= get_the_title($item->ID); ?>
                                        </p>
                                        <p class="feedback__role">
                                            <?php
                                            $single_feedback = get_field('single_feedback', $item->ID);
                                            $role = isset($single_feedback['role']) ? $single_feedback['role'] : '';
                                            echo $role;
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="feedback__controls">
                    <button class="feedback__btn--desktop feedback__prev">
                        <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'feedback__btn-icon']) ?>
                    </button>
                    <div class="feedback__pagination"></div>
                    <button type="button" class="feedback__play">
                        <?= wp_get_attachment_image($icon_play_id, 'full', false, ['class' => 'feedback__play-icon']) ?>
                        <?= wp_get_attachment_image($icon_pause_id, 'full', false, ['class' => 'feedback__pause-icon']) ?>
                    </button>
                    <button class="feedback__btn--desktop feedback__next">
                        <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'feedback__btn-icon']) ?>
                    </button>
                </div>
            </div>
        <?php endif; ?>
        
        <div id="achievement" class="achievement">
            <?php foreach ($achievement as $key => $item):
                $icon = isset($item['icon']) ? $item['icon'] : '';
                $number = isset($item['number']) ? $item['number'] : '';
                $label = isset($item['label']) ? $item['label'] : '';
            ?>
                <div class="achievement__item">
                    <div class="achievement__item-image">
                        <?= wp_get_attachment_image($icon, 'full'); ?>
                    </div>
                    <div class="achievement__item-content">
                        <p data-value="<?= $number ?>" class="achievement__item-content-number">
                            <?= $number ?>+
                        </p>
                        <p class="achievement__item-content-text">
                            <?= $label ?>
                        </p>
                    </div>
                </div>
                <?= $key < count($achievement) - 1 ? '<div class="achievement__line"></div>' : '' ?>
            <?php endforeach; ?>
        </div>
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
    </section>

    <!-- news section -->
    <?php get_template_part('template-parts/front-page/section-news/index'); ?>
</div>