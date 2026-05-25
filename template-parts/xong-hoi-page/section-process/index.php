<?php
/**
 * Section: Process — Xông Hơi Page
 */

$asset_base = get_theme_file_uri('/assets/images/xong-hoi-page/process');

$default_journey_groups = [
    [
        'heading' => 'Khởi động (10-15 phút)',
        'items'   => [
            ['image' => $asset_base . '/activity-herbal.png', 'text' => 'Xông Cỏ Thảo Mộc'],
            ['image' => $asset_base . '/activity-earth.png', 'text' => 'Xông Đất Hoàng Thổ'],
        ],
    ],
    [
        'heading' => 'Thanh lọc sâu (10-15 phút)',
        'items'   => [
            ['image' => $asset_base . '/activity-herbal-2.png', 'text' => 'Xông Thuốc Bắc (Tăng tuần hoàn)'],
        ],
    ],
    [
        'heading' => 'Phục hồi & gắn kết (15-20 phút)',
        'items'   => [
            ['image' => $asset_base . '/activity-oxy.png', 'text' => 'Hang hồng ngoại hoặc phòng Oxy thư giãn'],
        ],
    ],
];

$default_healing_groups = [
    [
        'heading' => 'Làm nóng giải độc (10-15 phút)',
        'items'   => [
            ['image' => $asset_base . '/activity-salt.png', 'text' => 'Phòng xông đá muối (tác động sâu)'],
        ],
    ],
    [
        'heading' => 'Cân bằng và tỉnh thức (5-7 phút)',
        'items'   => [
            ['image' => $asset_base . '/activity-snow.png', 'text' => 'Phòng xông Tuyết lạnh'],
        ],
    ],
    [
        'heading' => 'Tìm về chính mình',
        'items'   => [
            ['image' => $asset_base . '/activity-herbal-2.png', 'text' => 'Xông Thuốc Bắc (Tăng tuần hoàn)'],
        ],
    ],
    [
        'heading' => 'Phục hồi & gắn kết (15-20 phút)',
        'items'   => [
            ['image' => $asset_base . '/activity-sound.png', 'text' => 'Phòng thiền âm thanh (trung tâm chữa lành)'],
        ],
    ],
];

$default_tips = [
    ['icon' => 'water', 'image' => $asset_base . '/tip-water.png', 'title' => 'Uống đủ nước', 'text' => 'Hãy uống đủ nước trước, trong và sau khi xông'],
    ['icon' => 'clock', 'image' => $asset_base . '/tip-clock.png', 'title' => 'Lắng nghe cơ thể', 'text' => 'Rời khỏi phòng xông nếu cảm thấy khó chịu'],
    ['icon' => 'quiet', 'image' => $asset_base . '/tip-quiet.png', 'title' => 'Giữ im lặng', 'text' => 'Đặc biệt ở phòng Thiền'],
    ['icon' => 'rest', 'image' => $asset_base . '/tip-rest.png', 'title' => 'Nghỉ giữa các lần xông', 'text' => '5-10 phút tại khu nghỉ'],
];

$process = get_field('xong_hoi_process') ?: [];

$section_title    = ($process['title'] ?? '') ?: __('Quy trình hướng dẫn trải nghiệm nhiệt trị liệu (Jjimjibang Carezone)', 'okhub-theme');
$section_subtitle = ($process['subtitle'] ?? '') ?: __('Nơi tâm hồn tìm thấy bình yên - Kết nối và chữa lành sâu sắc', 'okhub-theme');
$section_note     = ($process['note'] ?? '') ?: __('Cảm ơn bạn đã trải nghiệm Carezone. Hãy nghỉ ngơi và bổ sung nước sau khi kết thúc hành trình !', 'okhub-theme');

$step_one = array_replace(
    [
        'kicker'      => __('Bước 1', 'okhub-theme'),
        'title'       => __('Chuẩn bị đồng phục', 'okhub-theme'),
        'description' => __('Khách gửi đồ cá nhân tại tủ locker. Nhận quần áo Jjimjibang và khăn tắm', 'okhub-theme'),
        'image'       => $asset_base . '/step-container.png',
        'caption'     => __('Chuẩn bị', 'okhub-theme'),
    ],
    array_filter($process['step_one'] ?? [])
);

$step_two = array_replace(
    [
        'kicker'   => __('Bước 2', 'okhub-theme'),
        'title'    => __('Hãy bắt đầu hành trình cho bạn', 'okhub-theme'),
        'journeys' => [
            [
                'label'  => __('Kết nối chia sẻ yêu thương (Jjimjibang1)', 'okhub-theme'),
                'groups' => $default_journey_groups,
            ],
            [
                'label'  => __('Chữa lành - Chánh niệm, tỉnh thức (Jjimjibang 2)', 'okhub-theme'),
                'groups' => $default_healing_groups,
            ],
        ],
        'choice' => __('Lựa chọn hành trình Jjimjibang', 'okhub-theme'),
    ],
    array_filter($process['step_two'] ?? [])
);

$step_three = array_replace(
    [
        'kicker' => __('Bước 3', 'okhub-theme'),
        'title'  => __('Lưu ý quan trọng và kết thúc', 'okhub-theme'),
        'tips'   => $default_tips,
        'relax'  => __('Thư giãn sâu', 'okhub-theme'),
    ],
    array_filter($process['step_three'] ?? [])
);

$get_image_url = static function ($image) {
    if (is_array($image)) {
        return $image['url'] ?? '';
    }

    if (is_numeric($image)) {
        return wp_get_attachment_image_url(absint($image), 'full') ?: '';
    }

    return $image ?: '';
};
?>

<section
    id="section-process"
    class="section-process"
    aria-labelledby="section-process-title"
    style="
        --process-bg: url('<?php echo esc_url($asset_base . '/process-bg.png'); ?>');
        --process-paper: url('<?php echo esc_url($asset_base . '/paper-texture-white.png'); ?>');
    ">
    <div class="section-process__shell">
        <!-- <div class="section-process__container">
            <img
                class="section-process__object"
                src="<?php echo esc_url($asset_base . '/object-1.png'); ?>"
                alt=""
                loading="lazy"
                decoding="async">
        </div> -->
        <img
            class="section-process__cherry section-process__cherry--left"
            src="<?php echo esc_url($asset_base . '/cherry-1.png'); ?>"
            alt=""
            loading="lazy"
            decoding="async">
        <img
            class="section-process-mobile__cherry section-process__building--left"
            src="<?php echo esc_url($asset_base . '/decor_left_mobile.png'); ?>"
            alt=""
            loading="lazy"
            decoding="async">
        <img
            class="section-process__cherry section-process__cherry--right"
            src="<?php echo esc_url($asset_base . '/cherry-2.png'); ?>"
            alt=""
            loading="lazy"
            decoding="async">
        <img
            class="section-process-mobile__cherry section-process__flower--right"
            src="<?php echo esc_url($asset_base . '/decor_right_mobile.png'); ?>"
            alt=""
            loading="lazy"
            decoding="async">
        <img
            class="section-process__deco section-process__deco--left"
            src="<?php echo esc_url($asset_base . '/image-container.png'); ?>"
            alt=""
            loading="lazy"
            decoding="async">
        <img
            class="section-process__deco section-process__deco--right"
            src="<?php echo esc_url($asset_base . '/frame.png'); ?>"
            alt=""
            loading="lazy"
            decoding="async">

        <div class="section-process__card">
            <div class="section-process__heading">
                <h2 id="section-process-title" class="section-process__title">
                    <?php echo esc_html($section_title); ?>
                </h2>
                <p class="section-process__subtitle">
                    <?php echo esc_html($section_subtitle); ?>
                </p>
            </div>

            <div class="section-process__grid">
                <article class="section-process__step section-process__step--one">
                    <span class="section-process__badge section-process__badge--one">1</span>
                    <div class="section-process__step-inner">
                        <p class="section-process__step-kicker"><?php echo esc_html($step_one['kicker']); ?></p>
                        <h3 class="section-process__step-title"><?php echo esc_html($step_one['title']); ?></h3>
                        <p class="section-process__step-desc">
                            <?php echo esc_html($step_one['description']); ?>
                        </p>
                        <figure class="section-process__prepare">
                            <img
                                src="<?php echo esc_url($get_image_url($step_one['image'])); ?>"
                                alt="<?php echo esc_attr($step_one['title']); ?>"
                                loading="lazy"
                                decoding="async">
                            <figcaption><?php echo esc_html($step_one['caption']); ?></figcaption>
                        </figure>
                    </div>
                </article>

                <article class="section-process__step section-process__step--two">
                    <span class="section-process__badge section-process__badge--two">2</span>
                    <div class="section-process__step-inner">
                        <div>
                            <p class="section-process__step-kicker"><?php echo esc_html($step_two['kicker']); ?></p>
                            <h3 class="section-process__journey-title"><?php echo esc_html($step_two['title']); ?></h3>
                        </div>
                        
                        <div class="section-process__journeys">
                            <?php foreach ($step_two['journeys'] as $journey_index => $journey) : ?>
                                <div class="section-process__journey<?php echo $journey_index > 0 ? ' section-process__journey--healing' : ''; ?>">
                                    <p class="section-process__journey-tab"><?php echo esc_html($journey['label'] ?? ''); ?></p>
                                    <?php foreach (($journey['groups'] ?? []) as $group) : ?>
                                    <div class="section-process__group">
                                        <h4><?php echo esc_html($group['heading'] ?? ''); ?></h4>
                                        <?php foreach (($group['items'] ?? []) as $item) : ?>
                                            <div class="section-process__activity">
                                                <?php if ($get_image_url($item['image'] ?? '')) : ?>
                                                    <img src="<?php echo esc_url($get_image_url($item['image'])); ?>" alt="" loading="lazy" decoding="async">
                                                <?php endif; ?>
                                                <span><?php echo esc_html($item['text'] ?? ''); ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <p class="section-process__choice"><?php echo esc_html($step_two['choice']); ?></p>
                    </div>
                </article>

                <article class="section-process__step section-process__step--three">
                    <span class="section-process__badge section-process__badge--three">3</span>
                    <div class="section-process__step-inner">
                        <div>
                            <p class="section-process__step-kicker"><?php echo esc_html($step_three['kicker']); ?></p>
                            <h3 class="section-process__step-title"><?php echo esc_html($step_three['title']); ?></h3>
                        </div>
                        
                        <div class="section-process__tips">
                            <?php foreach ($step_three['tips'] as $tip) :
                                $tip_icon = sanitize_html_class($tip['icon'] ?? 'custom') ?: 'custom';
                                ?>
                                <div class="section-process__tip">
                                    <span class="section-process__tip-icon section-process__tip-icon--<?php echo esc_attr($tip_icon); ?>" aria-hidden="true">
                                        <?php if ($get_image_url($tip['image'] ?? '')) : ?>
                                            <img src="<?php echo esc_url($get_image_url($tip['image'])); ?>" alt="" loading="lazy" decoding="async">
                                        <?php endif; ?>
                                    </span>
                                    <span>
                                        <strong><?php echo esc_html($tip['title'] ?? ''); ?></strong>
                                        <?php echo esc_html($tip['text'] ?? ''); ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <p class="section-process__relax"><?php echo esc_html($step_three['relax']); ?></p>
                    </div>
                </article>
            </div>

            <p class="section-process__note">
                <?php echo esc_html($section_note); ?>
            </p>
        </div>
    </div>
</section>
