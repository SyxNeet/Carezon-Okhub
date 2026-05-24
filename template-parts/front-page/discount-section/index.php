<?php
$section_special_offer = get_field('section_special_offer');

$offers = $section_special_offer['offers'];

if (count($offers) > 0 && count($offers) < 6) {
    $original = $offers;

    while (count($offers) < 6) {
        $offers = array_merge($offers, $original);
    }

    // Cắt về đúng 6 phần tử (tránh dư)
    $offers = array_slice($offers, 0, 6);
}


$pause_icon = 829;
$play_icon = 840;
$prev_icon = 830;
?>


<section class="special-offer">
    <div class="special-offer-container">
        <div class="special-offer-content">
            <div class="special-offer__text">
                <?php echo $section_special_offer['title_pc']; ?>
            </div>
            <div class="special-offer__list">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                        <?php foreach ($offers as $item) { ?>
                            <div class="swiper-slide">
                                <div class="special-offer__list-container">
                                    <div class="special-offer__list-container-content card-content">
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
                                            
                                            <div class="special-offer__list-container-content-bottom-body-service-row-text">
                                              Còn <strong><?= esc_html($item['slot']); ?></strong>/<?= esc_html($item['total_slot']); ?> suất
                                            </div>
                                            
                                            <div class="special-offer__list-container-content-bottom-head">
                                                <div class="special-offer__list-container-content-bottom-head-bg"></div>
                                                <?php
                                                // Calculate progress percentage based on date range
                                                // Convert from dd/mm/yyyy to yyyy-mm-dd format
                                                $date_start_formatted = DateTime::createFromFormat('d/m/Y', $item['date_start'])->format('Y-m-d');
                                                $date_end_formatted = DateTime::createFromFormat('d/m/Y', $item['date_end'])->format('Y-m-d');

                                                $start_date = strtotime($date_start_formatted);
                                                $end_date = strtotime($date_end_formatted);
                                                $current_date = time();

                                                $total_days = ($end_date - $start_date) / (60 * 60 * 24);
                                                $elapsed_days = ($current_date - $start_date) / (60 * 60 * 24);

                                                $progress_percentage = min(100, max(0, ($elapsed_days / $total_days) * 100));
                                                ?>
                                                <div class="special-offer__list-container-content-bottom-head-progress"
                                                    style="width: calc(max(0%, <?= $progress_percentage; ?>%) - 0.25rem)"></div>
                                                <p class="special-offer__list-container-content-bottom-head-text">
                                                    HẾT HẠN NGÀY <?= date('d/m/Y', strtotime($date_end_formatted)); ?>
                                                </p>
                                            </div>
                                            <div class="special-offer__list-container-content-bottom-body">
                                                <div class="special-offer__list-container-content-bottom-body-service">
                                                    <div class="special-offer__list-container-content-bottom-body-service-row">
                                                        <p
                                                            class="special-offer__list-container-content-bottom-body-service-row-text">
                                                            Giá dịch vụ :
                                                        </p>
                                                        <div class="special-offer__list-container-content-bottom-body-service-row-wrapper">
                                                            <p
                                                                class="special-offer__list-container-content-bottom-body-service-row-price">
                                                                <?= number_format($item['price'], 0, ',', '.'); ?> đ
                                                            </p>
                                                            <p
                                                                class="special-offer__list-container-content-bottom-body-service-row-price price-old">
                                                                <?= number_format($item['price'], 0, ',', '.'); ?> đ
                                                            </p>
                                                        </div>
                                                    </div>
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
                                    </div>
                                    <div class="special-offer__list-container-content-image img-container">
                                        <?= wp_get_attachment_image($item['thumb'], 'full'); ?>
                                        <div class="special-offer__list-container-content-image-overlay"></div>
                                        <div class="special-offer__list-container-content-image-content">
                                            <p class="special-offer__list-container-content-image-content-title">
                                                <?= $item['name']; ?>
                                            </p>
                                            <div class="special-offer__list-container-content-image-content-progress">
                                                <div class="special-offer__list-container-content-image-content-progress-bg">
                                                </div>
                                                <div class="special-offer__list-container-content-image-content-progress-progress"
                                                    style="width: calc(max(0%, <?= $progress_percentage; ?>%) - 0.25rem)"></div>
                                                <p class="special-offer__list-container-content-image-content-progress-text">
                                                    HẾT HẠN NGÀY <?= date('d/m/Y', strtotime($date_end_formatted)); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
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
                <!--<div class="special-offer-pagination swiper-pagination"></div>-->
                <!--<div class="swiper-button-prev">-->
                <!--    <?= wp_get_attachment_image(59, 'thumbnail', false, array('data-no-lazy' => '1')) ?>-->
                <!--</div>-->
                <!--<div class="swiper-button-next">-->
                <!--    <?= wp_get_attachment_image(59, 'thumbnail', false, array('data-no-lazy' => '1')) ?>-->
                <!--</div>-->
            </div>

        </div>
    </div>
</section>