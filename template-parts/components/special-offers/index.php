<?php
$offers = $args['offers'] ?? [];
$pause_icon = 829;
$play_icon = 840;
$prev_icon = 830;
?>

<div id="special-offer" class="special-offer__list">
    <div class="swiper">
        <div class="swiper-wrapper">
            <!-- Slide -->
            <?php foreach ($offers as $item) {
                if (!is_array($item)) {
                    $post_id = (int) $item;
                    $item = [];
                    $item['name'] = get_the_title($post_id);
                    $item['thumb'] = get_post_thumbnail_id($post_id);

                    if (function_exists('get_field')) {
                        $item['date_start'] = get_field('date_start', $post_id);
                        $item['date_end'] = get_field('date_end', $post_id);
                        $item['time_open'] = get_field('time_open', $post_id);
                        $item['description'] = get_field('description', $post_id);
                        $item['slot'] = get_field('slot', $post_id);
                        $item['total_slot'] = get_field('total_slot', $post_id);
                        $item['price'] = get_field('price', $post_id);
                        $item['price_old'] = get_field('price_old', $post_id);
                    }
                }

                $date_start_raw = $item['date_start'] ?? '';
                $date_end_raw = $item['date_end'] ?? '';

                $date_start_dt = $date_start_raw ? DateTime::createFromFormat('d/m/Y', $date_start_raw) : false;
                $date_end_dt = $date_end_raw ? DateTime::createFromFormat('d/m/Y', $date_end_raw) : false;

                $date_start_formatted = $date_start_dt ? $date_start_dt->format('Y-m-d') : date('Y-m-d');
                $date_end_formatted = $date_end_dt ? $date_end_dt->format('Y-m-d') : date('Y-m-d');

                $start_date = strtotime($date_start_formatted);
                $end_date = strtotime($date_end_formatted);
                $current_date = time();

                $total_days = ($end_date - $start_date) / (60 * 60 * 24);
                $elapsed_days = ($current_date - $start_date) / (60 * 60 * 24);

                $progress_percentage = $total_days > 0 ? min(100, max(0, ($elapsed_days / $total_days) * 100)) : 0;
                ?>
                <div class="swiper-slide">
                    <div class="special-offer__list-container">
                        <div class="special-offer__list-container-content card-content">
                            <div class="special-offer__list-container-content-top">
                                <div class="special-offer__list-container-content-top-left">
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
                                                <?= $item['time_open'] ?? ''; ?>
                                            </p>
                                        </div>
                                        <p class="special-offer__list-container-content-top-body-text">
                                            <?= $item['description'] ?? ''; ?>
                                        </p>
                                    </div>
                                </div>

                                <!-- mobile -->
                                <div
                                    class="special-offer__list-container-content-image special-offer__list-container-content-image--mobile img-container">
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
                                                style="width: calc(max(0%, <?= $progress_percentage; ?>%) - 0.25rem)">
                                            </div>
                                            <p class="special-offer__list-container-content-image-content-progress-text">
                                                HẾT HẠN NGÀY
                                                <?= date('d/m/Y', strtotime($date_end_formatted)); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="special-offer__list-container-content-bottom">

                                <div
                                    class="special-offer__list-container-content-bottom-body-service-row-text slot slot--desktop">
                                    Còn
                                    <strong><?= esc_html($item['slot'] ?? ''); ?></strong>/<?= esc_html($item['total_slot'] ?? ''); ?>
                                    suất
                                </div>

                                <div class="special-offer__list-container-content-bottom-head">
                                    <div class="special-offer__list-container-content-bottom-head-bg"></div>
                                    <div class="special-offer__list-container-content-bottom-head-progress"
                                        style="width: calc(max(0%, <?= $progress_percentage; ?>%) - 0.25rem)"></div>
                                    <p class="special-offer__list-container-content-bottom-head-text">
                                        HẾT HẠN NGÀY <?= date('d/m/Y', strtotime($date_end_formatted)); ?>
                                    </p>
                                </div>
                                <div class="special-offer__list-container-content-bottom-body">
                                    <div class="special-offer__list-container-content-bottom-body-service">
                                        <div class="special-offer__list-container-content-bottom-body-service-row">
                                            <p class="special-offer__list-container-content-bottom-body-service-row-text">
                                                Giá dịch vụ :
                                            </p>
                                            <div
                                                class="special-offer__list-container-content-bottom-body-service-row-wrapper">
                                                <p
                                                    class="special-offer__list-container-content-bottom-body-service-row-price">
                                                    <?= number_format((float) ($item['price'] ?? 0), 0, ',', '.'); ?> đ
                                                </p>
                                                <p
                                                    class="special-offer__list-container-content-bottom-body-service-row-price price-old">
                                                    <?= number_format((float) ($item['price_old'] ?? 0), 0, ',', '.'); ?> đ
                                                </p>
                                            </div>
                                            <div
                                                class="special-offer__list-container-content-bottom-body-service-row-text slot slot--mobile">
                                                Còn
                                                <strong>
                                                    <?= esc_html($item['slot'] ?? ''); ?>
                                                </strong>/
                                                <?= esc_html($item['total_slot'] ?? ''); ?>
                                                suất
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

                        <!-- pc -->
                        <div
                            class="special-offer__list-container-content-image special-offer__list-container-content-image--pc img-container">
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
</div>