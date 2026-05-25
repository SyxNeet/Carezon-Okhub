<?php

/**
 * Section: Story — Xong Hơi Page
 * ACF Group: xong_hoi_story (slides repeater) hoặc fallback restaurant_about
 */

$story    = get_field('xong_hoi_story') ?: get_field('restaurant_about') ?: [];
$subtitle = $story['subtitle'] ?? $story['subtile'] ?? 'Câu chuyện';
$label    = $story['label'] ?? 'Jjimjillbang';
$slides   = $story['slides'] ?? [];

$d_main_img = get_theme_file_uri('/assets/images/restaurant-page/d-about-main.png');

if (empty($slides) && ! empty($story['images'])) {
    $description = $story['description'] ?? '';
    $paragraphs  = $story['body_paragraphs'] ?? [];
    $content     = $paragraphs[0]['text'] ?? '';

    foreach ($story['images'] as $i => $img) {
        $slides[] = [
            'tab_label' => sprintf(__('Mục %d', 'okhub-theme'), $i + 1),
            'title'     => $description,
            'content'   => $content,
            'image'     => $img,
        ];
    }
}

if (empty($slides)) {
    $slides = [
        [
            'tab_label' => 'Jjimjillbang là gì ?',
            'title'     => 'Jjim Jil Bang là một loại spa truyền thống của Hàn Quốc, nổi bật với các phòng xông hơi và nhiệt trị liệu. Đây là nơi khách hàng có thể thư giãn, thải độc, và phục hồi cơ thể',
            'content'   => 'Các phương pháp xông hơi như xông hơi ướt, khô, và thảo mộc. Các phòng xông hơi trong Jjim Jil Bang được thiết kế với nhiệt độ cao và không gian yên tĩnh, giúp cải thiện tuần hoàn máu, giảm căng thẳng, làm sạch da và hỗ trợ quá trình phục hồi cơ thể.',
            'image'     => ['url' => 'https://carezone.vn/wp-content/uploads/2026/05/image-1888.png', 'alt' => 'Jjimjillbang Carezone'],
        ],
        [
            'tab_label' => 'Nguồn gốc xuất xứ',
            'title'     => 'Nguồn Gốc Từ Văn Hóa Chăm Sóc Sức Khỏe Hàn Quốc',
            'content'   => 'Jjimjillbang xuất phát từ văn hóa tắm xông hơi truyền thống Hàn Quốc, phát triển thành không gian giải trí và phục hồi sức khỏe được yêu thích tại nhiều quốc gia.',
            'image'     => ['url' => 'https://carezone.vn/wp-content/uploads/2026/05/image-1887.png', 'alt' => 'Nguồn gốc Jjimjillbang'],
        ],
        [
            'tab_label' => 'Lợi ích',
            'title'     => 'Lợi Ích Cho Cơ Thể Và Tinh Thần',
            'content'   => 'Tắm xông hơi giúp thải độc, lưu thông tuần hoàn, giảm căng thẳng và cải thiện chất lượng giấc ngủ — mang lại cảm giác nhẹ nhàng, sảng khoái và cân bằng năng lượng.',
            'image'     => ['url' => 'https://carezone.vn/wp-content/uploads/2026/05/image-1886.png', 'alt' => 'Lợi ích Jjimjillbang'],
        ],
    ];
}

$slide_count = count($slides);
?>

<section id="section-about" class="section-about">
    <img src="https://carezone.vn/wp-content/uploads/2026/05/Object-1-1-1.png" alt="" class="deco__right">
    <img src="https://carezone.vn/wp-content/uploads/2026/05/Leaf-1.png" alt="" class="deco__left">
    <img class="background_story" src="https://carezone.vn/wp-content/uploads/2026/05/74cd0d727e5e73f2b09b94110f9b33d7-1.png" alt="">

    <div class="section-about__container">
        
        <div class="section-about__inner">

        <?php if(!isMobileDevice()): ?>
            <div class="btn__book__group">
                <div class="btn__book__group-item">
                    <img src="https://carezone.vn/wp-content/uploads/2026/05/Link.svg" alt="">
                    <p>Đặt lịch </br> ngay hôm nay</p>
                </div>
                <img src="https://carezone.vn/wp-content/uploads/2026/05/Info-Image.svg" alt="" class="decor__image">
            </div>
        <?php endif;?>
            <div class="section-about__label-col">
                <?php if ($slide_count > 1) : ?>
                    <nav class="section-about__tabs" aria-label="<?php esc_attr_e('Danh mục câu chuyện', 'okhub-theme'); ?>">
                        <?php foreach ($slides as $i => $slide) : ?>
                            <button
                                type="button"
                                class="section-about__tab<?php echo $i === 0 ? ' is-active' : ''; ?>"
                                data-slide-index="<?php echo esc_attr($i); ?>"
                                aria-current="<?php echo $i === 0 ? 'true' : 'false'; ?>">
                                <span class="section-about__tab-dot" aria-hidden="true"></span>
                                <span class="section-about__tab-text"><?php echo esc_html($slide['tab_label'] ?? ''); ?></span>
                            </button>
                            <?php if (isMobileDevice() && $i < $slide_count - 1) : ?>
                                <div class="line__mobile"></div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </nav>
                <?php endif; ?>
            </div>

            <div class="section-about__content-col">
                <div class="section-about__slider swiper" data-total="<?php echo esc_attr($slide_count); ?>">
                    <div class="section-about__slider-track swiper-wrapper">
                        <?php foreach ($slides as $i => $slide) :
                            $title   = $slide['title'] ?? '';
                            $content = $slide['content'] ?? $slide['description'] ?? '';
                            $image   = $slide['image'] ?? [];
                            $image_id = is_array($image) ? ($image['ID'] ?? 0) : 0;
                            $image_url = is_array($image) ? ($image['url'] ?? '') : '';
                            $image_alt = is_array($image) ? ($image['alt'] ?? $title) : $title;
                            ?>
                            <div class="section-about__slide swiper-slide">
                                <div class="section-about__text-block">
                                    <div class="section-about__text-group">
                                        <?php if ($title) : ?>
                                            <h2 class="section-about__description"><?php echo esc_html($title); ?></h2>
                                        <?php endif; ?>

                                        <?php if ($content) : ?>
                                            <p class="section-about__paragraph"><?php echo esc_html($content); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if(isMobileDevice()): ?>
                                <div class="btn__book__group">
                                    <div class="btn__book__group-item">
                                        <img src="https://carezone.vn/wp-content/uploads/2026/05/Link.svg" alt="">
                                        <p>Đặt lịch </br> ngay hôm nay</p>
                                    </div>
                                    <img src="https://carezone.vn/wp-content/uploads/2026/05/Info-Image.svg" alt="" class="decor__image">
                                </div>
                                <?php endif; ?>

                                <div class="section-about__media">
                                    <?php if ($image_id) : ?>
                                        <?php echo wp_get_attachment_image($image_id, 'large', false, [
                                            'class'    => 'section-about__media-img',
                                            'loading'  => $i === 0 ? 'eager' : 'lazy',
                                            'decoding' => 'async',
                                            'alt'      => esc_attr($image_alt),
                                        ]); ?>
                                    <?php elseif ($image_url) : ?>
                                        <img
                                            src="<?php echo esc_url($image_url); ?>"
                                            alt="<?php echo esc_attr($image_alt); ?>"
                                            class="section-about__media-img"
                                            width="546"
                                            height="546"
                                            loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>"
                                            decoding="async">
                                    <?php else : ?>
                                        <img
                                            src="<?php echo esc_url($d_main_img); ?>"
                                            alt="<?php echo esc_attr($title); ?>"
                                            class="section-about__media-img"
                                            width="546"
                                            height="546"
                                            loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>"
                                            decoding="async">
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if ($slide_count > 1) : ?>
                    <div class="section-about__nav">
                        <button
                            class="section-about__nav-btn section-about__nav-btn--prev"
                            type="button"
                            aria-label="<?php esc_attr_e('Nội dung trước', 'okhub-theme'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                <path d="M9.43202 12.7928L10.4439 12.5217L9.90155 10.4978L8.88964 10.769L9.16083 11.7809L9.43202 12.7928ZM7.65058 11.1011C7.09171 11.2509 6.76008 11.8253 6.90985 12.3842C7.05962 12.943 7.63409 13.2747 8.19295 13.1249L7.92176 12.113L7.65058 11.1011ZM14.7612 20L14.7612 21.0477L16.8564 21.0477L16.8564 20L15.8088 20L14.7612 20ZM8.50267 11.2725C7.99473 10.9955 7.35837 11.1827 7.08132 11.6906C6.80428 12.1986 6.99145 12.8349 7.49939 13.112L8.00103 12.1923L8.50267 11.2725ZM7.60862 11.1417C7.07217 11.3584 6.81301 11.969 7.02977 12.5055C7.24653 13.0419 7.85712 13.3011 8.39357 13.0843L8.00109 12.113L7.60862 11.1417ZM16.8565 4.30521L16.8565 3.25759L14.7613 3.25759L14.7613 4.30521L15.8089 4.30521L16.8565 4.30521ZM9.16083 11.7809L8.88964 10.769L7.86915 11.0425L8.14034 12.0544L8.41153 13.0663L9.43202 12.7928L9.16083 11.7809ZM8.14034 12.0544L7.86915 11.0425L7.65058 11.1011L7.92176 12.113L8.19295 13.1249L8.41153 13.0663L8.14034 12.0544ZM15.8088 20L16.8564 20C16.8564 18.7488 16.1835 17.5813 15.401 16.621C14.5976 15.635 13.5521 14.714 12.5455 13.9362C11.5327 13.1537 10.5252 12.49 9.7738 12.0232C9.39713 11.7892 9.08249 11.6033 8.86071 11.4751C8.74977 11.411 8.66191 11.3613 8.60099 11.3271C8.57053 11.31 8.54678 11.2969 8.53024 11.2877C8.52197 11.2831 8.5155 11.2796 8.51088 11.277C8.50857 11.2758 8.50673 11.2748 8.50536 11.274C8.50467 11.2736 8.50411 11.2733 8.50366 11.2731C8.50343 11.273 8.50319 11.2728 8.50307 11.2728C8.50286 11.2727 8.50267 11.2725 8.00103 12.1923C7.49939 13.112 7.49927 13.1119 7.49917 13.1118C7.49917 13.1118 7.49911 13.1118 7.49912 13.1118C7.49915 13.1118 7.49929 13.1119 7.49955 13.1121C7.50007 13.1123 7.50106 13.1129 7.5025 13.1137C7.50539 13.1153 7.51012 13.1179 7.51662 13.1215C7.52962 13.1286 7.54972 13.1398 7.57644 13.1548C7.62989 13.1847 7.70979 13.23 7.81234 13.2892C8.01755 13.4078 8.31289 13.5823 8.6682 13.803C9.38079 14.2457 10.3252 14.8685 11.2644 15.5942C12.2097 16.3247 13.1161 17.1338 13.7767 17.9445C14.4582 18.7809 14.7612 19.4767 14.7612 20L15.8088 20ZM8.00109 12.113C8.39357 13.0843 8.39359 13.0843 8.39361 13.0843C8.39361 13.0843 8.39363 13.0843 8.39365 13.0843C8.39368 13.0843 8.3937 13.0843 8.39373 13.0842C8.39379 13.0842 8.39385 13.0842 8.39391 13.0842C8.39404 13.0841 8.39418 13.0841 8.39433 13.084C8.39463 13.0839 8.39498 13.0837 8.39538 13.0836C8.39617 13.0833 8.39716 13.0829 8.39834 13.0824C8.40069 13.0814 8.4038 13.0802 8.40765 13.0786C8.41535 13.0754 8.42602 13.071 8.43955 13.0654C8.46659 13.0541 8.50505 13.0379 8.55393 13.0169L8.14034 12.0544L7.72675 11.0919C7.68539 11.1097 7.65423 11.1228 7.63421 11.1311C7.6242 11.1353 7.61698 11.1382 7.61268 11.14C7.61052 11.1409 7.6091 11.1415 7.60842 11.1417C7.60808 11.1419 7.60792 11.1419 7.60795 11.1419C7.60797 11.1419 7.60803 11.1419 7.60815 11.1419C7.6082 11.1418 7.60827 11.1418 7.60835 11.1418C7.60839 11.1418 7.60843 11.1417 7.60847 11.1417C7.6085 11.1417 7.60852 11.1417 7.60854 11.1417C7.60856 11.1417 7.60858 11.1417 7.60858 11.1417C7.6086 11.1417 7.60862 11.1417 8.00109 12.113ZM8.14034 12.0544L8.55393 13.0169C9.10775 12.779 11.1137 11.8738 12.9983 10.4542C14.8206 9.08143 16.8565 6.98241 16.8565 4.30521L15.8089 4.30521L14.7613 4.30521C14.7613 5.91235 13.4873 7.46258 11.7376 8.78066C10.0501 10.0519 8.2218 10.8792 7.72675 11.0919L8.14034 12.0544Z" fill="#B98951" />
                            </svg>
                        </button>
                        <button
                            class="section-about__nav-btn section-about__nav-btn--next"
                            type="button"
                            aria-label="<?php esc_attr_e('Nội dung tiếp theo', 'okhub-theme'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                <path d="M15.7108 12.7928L14.6989 12.5217L15.2413 10.4978L16.2532 10.769L15.982 11.7809L15.7108 12.7928ZM17.4923 11.1011C18.0512 11.2509 18.3828 11.8253 18.233 12.3842C18.0832 12.943 17.5088 13.2747 16.9499 13.1249L17.2211 12.113L17.4923 11.1011ZM10.3817 20L10.3817 21.0477L8.28643 21.0477L8.28643 20L9.33405 20L10.3817 20ZM16.6402 11.2725C17.1481 10.9955 17.7845 11.1827 18.0615 11.6906C18.3386 12.1986 18.1514 12.8349 17.6435 13.112L17.1418 12.1923L16.6402 11.2725ZM17.5342 11.1417C18.0707 11.3584 18.3298 11.969 18.1131 12.5055C17.8963 13.0419 17.2857 13.3011 16.7493 13.0843L17.1418 12.113L17.5342 11.1417ZM8.28637 4.30521L8.28637 3.25759L10.3816 3.25759L10.3816 4.30521L9.33399 4.30521L8.28637 4.30521ZM15.982 11.7809L16.2532 10.769L17.2737 11.0425L17.0025 12.0544L16.7313 13.0663L15.7108 12.7928L15.982 11.7809ZM17.0025 12.0544L17.2737 11.0425L17.4923 11.1011L17.2211 12.113L16.9499 13.1249L16.7313 13.0663L17.0025 12.0544ZM9.33405 20L8.28643 20C8.28643 18.7488 8.95938 17.5813 9.74186 16.621C10.5452 15.635 11.5908 14.714 12.5974 13.9362C13.6101 13.1537 14.6177 12.49 15.3691 12.0232C15.7457 11.7892 16.0604 11.6033 16.2822 11.4751C16.3931 11.411 16.4809 11.3613 16.5419 11.3271C16.5723 11.31 16.5961 11.2969 16.6126 11.2877C16.6209 11.2831 16.6274 11.2796 16.632 11.277C16.6343 11.2758 16.6361 11.2748 16.6375 11.274C16.6382 11.2736 16.6388 11.2733 16.6392 11.2731C16.6394 11.273 16.6397 11.2728 16.6398 11.2728C16.64 11.2727 16.6402 11.2725 17.1418 12.1923C17.6435 13.112 17.6436 13.1119 17.6437 13.1118C17.6437 13.1118 17.6438 13.1118 17.6437 13.1118C17.6437 13.1118 17.6436 13.1119 17.6433 13.1121C17.6428 13.1123 17.6418 13.1129 17.6404 13.1137C17.6375 13.1153 17.6327 13.1179 17.6262 13.1215C17.6132 13.1286 17.5931 13.1398 17.5664 13.1548C17.513 13.1847 17.4331 13.23 17.3305 13.2892C17.1253 13.4078 16.83 13.5823 16.4747 13.803C15.7621 14.2457 14.8177 14.8685 13.8785 15.5942C12.9331 16.3247 12.0267 17.1338 11.3662 17.9445C10.6847 18.7809 10.3817 19.4767 10.3817 20L9.33405 20ZM17.1418 12.113C16.7493 13.0843 16.7493 13.0843 16.7493 13.0843C16.7492 13.0843 16.7492 13.0843 16.7492 13.0843C16.7492 13.0843 16.7492 13.0843 16.7491 13.0842C16.7491 13.0842 16.749 13.0842 16.7489 13.0842C16.7488 13.0841 16.7487 13.0841 16.7485 13.084C16.7482 13.0839 16.7479 13.0837 16.7475 13.0836C16.7467 13.0833 16.7457 13.0829 16.7445 13.0824C16.7422 13.0814 16.7391 13.0802 16.7352 13.0786C16.7275 13.0754 16.7168 13.071 16.7033 13.0654C16.6763 13.0541 16.6378 13.0379 16.5889 13.0169L17.0025 12.0544L17.4161 11.0919C17.4575 11.1097 17.4886 11.1228 17.5087 11.1311C17.5187 11.1353 17.5259 11.1382 17.5302 11.14C17.5323 11.1409 17.5338 11.1415 17.5344 11.1417C17.5348 11.1419 17.5349 11.1419 17.5349 11.1419C17.5349 11.1419 17.5348 11.1419 17.5347 11.1419C17.5347 11.1418 17.5346 11.1418 17.5345 11.1418C17.5345 11.1418 17.5344 11.1417 17.5344 11.1417C17.5344 11.1417 17.5343 11.1417 17.5343 11.1417C17.5343 11.1417 17.5343 11.1417 17.5343 11.1417C17.5343 11.1417 17.5342 11.1417 17.1418 12.113ZM17.0025 12.0544L16.5889 13.0169C16.0351 12.779 14.0291 11.8738 12.1446 10.4542C10.3223 9.08143 8.28637 6.98241 8.28637 4.30521L9.33399 4.30521L10.3816 4.30521C10.3816 5.91235 11.6555 7.46258 13.4053 8.78066C15.0928 10.0519 16.9211 10.8792 17.4161 11.0919L17.0025 12.0544Z" fill="#B98951" />
                            </svg>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        <div class="section-about__deco-group" aria-hidden="true">
            <img
                src="https://carezone.vn/wp-content/uploads/2026/05/Frame-2147263488-1.png"
                alt=""
                aria-hidden="true"
                class="section-about__deco-img"
                width="1070"
                height="666"
                loading="lazy">
        </div>
        </div>
    </div>

    
</section>
