<?php
$section_special_offer = get_field('section_special_offer');
?>
<section class="mobile-offer-container">
    <div class="mobile-offer">
        <div class="mobile-offer__text">
            <?php echo $section_special_offer['title_mobile']; ?>
        </div>

        <div class="mobile-offer__list">
            <div class="mobile-swiper swiper">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <?php foreach ($section_special_offer['offers'] as $item) {
                        // Convert from dd/mm/yyyy to yyyy-mm-dd format
                        $date_start_formatted = DateTime::createFromFormat('d/m/Y', $item['date_start'])->format('Y-m-d');
                        $date_end_formatted = DateTime::createFromFormat('d/m/Y', $item['date_end'])->format('Y-m-d');
                        ?>
                        <div class="swiper-slide swiper-slide-active">
                            <div class="mobile-card-container">
                                <img src="<?= wp_get_attachment_url($item['thumb']); ?>" alt="<?= $item['name']; ?>"
                                    class="mobile-card-content-image" />
                                <img src="<?= wp_get_attachment_url($item['thumb']); ?>" alt="<?= $item['name']; ?>"
                                    class="mobile-card-content-image_main" />
                                <div class="mobile-card-content">
                                    <div class="special-offer__list-container-content-top">
                                        <div class="special-offer__list-container-content-top-head">
                                            <div class="special-offer__list-container-content-top-head-calendar">
                                                <p class="special-offer__list-container-content-top-head-calendar-day">
                                                    <?= date('d', strtotime($date_start_formatted)); ?>
                                                </p>
                                                <p class="special-offer__list-container-content-top-head-calendar-month">
                                                    Tháng <?= date('m', strtotime($date_start_formatted)); ?>
                                                </p>
                                            </div>
                                            <p class="special-offer__list-container-content-top-head-title">
                                                <?= $item['name']; ?>
                                            </p>
                                        </div>
                                        <div class="special-offer__list-container-content-top-body">
                                            <div class="special-offer__list-container-content-top-body-row">
                                                <p class="special-offer__list-container-content-top-body-row-text">
                                                    Giờ mở cửa:
                                                </p>
                                                <p class="special-offer__list-container-content-top-body-row-time">
                                                    <?= $item['time_open']; ?>
                                                </p>
                                            </div>
                                            <p class="special-offer__list-container-content-top-body-text">
                                                <?= $item['description']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="special-offer__list-container-content-bottom">
                                        <div class="special-offer__list-container-content-bottom-head">
                                            <div class="special-offer__list-container-content-bottom-head-bg"></div>
                                            <div class="special-offer__list-container-content-bottom-head-progress"></div>
                                            <p class="special-offer__list-container-content-bottom-head-text">
                                                HẾT HẠN NGÀY <?= date('d/m/Y', strtotime($date_end_formatted)); ?>
                                            </p>
                                        </div>
                                        <div class="special-offer__list-container-content-bottom-body">
                                            <div class="mobile-card-content-booking">
                                                <div class="special-offer__list-container-content-bottom-body-service">
                                                    <div
                                                        class="special-offer__list-container-content-bottom-body-service-row">
                                                        <p
                                                            class="special-offer__list-container-content-bottom-body-service-row-text">
                                                            Giá dịch vụ :
                                                        </p>
                                                        <p
                                                            class="special-offer__list-container-content-bottom-body-service-row-price">
                                                            <?= number_format($item['price'], 0, ',', '.'); ?> đ
                                                        </p>
                                                    </div>
                                                    <p
                                                        class="special-offer__list-container-content-bottom-body-service-row-text"
                                                        Còn <strong><?= esc_html($item['slot']); ?></strong>/<?= esc_html($item['total_slot']); ?> suất
                                                    </p>
                                                </div>
                                                <div class="special-offer__list-container-content-bottom-body-button">
                                                    <button class="special-offer-button" type="button"
                                                        onclick="document.querySelector('.popup__booking').classList.add('active'); document.documentElement.style.overflow = 'hidden';">
                                                        <p>Đặt chỗ ngay</p>
                                                        <span>
                                                            <?= wp_get_attachment_image(59, 'icon', false, array('data-no-lazy' => '1')) ?>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="special-offer__list-container-content-image-content-title">
                                            <?= $item['name']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>