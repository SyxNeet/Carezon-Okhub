<?php

/**
 * Section: Philosophy
 * Part 1 — Philosophy Cards (Sticky scroll on desktop, vertical stack on mobile)
 * Part 2 — Benefits section (3-col desktop / horizontal scroll mobile)
 * Floating CTA — absolute-positioned, overlaps into section-offers
 */

// ACF data
$philosophy = get_field('restaurant_philosophy') ?: [];
$subtitle         = $philosophy['subtitle']        ?? 'Triết lý ẩm thực';
$description      = $philosophy['description']     ?? '';
$cards            = $philosophy['cards']           ?? [];
$benefits_title   = $philosophy['benefits_title']  ?? 'Lợi ích của việc ăn chay';
$benefits         = $philosophy['benefits']        ?? [];

// Canonical card content (đúng theo Figma). Dùng làm fallback + bù nội dung
// khi data ACF bị cắt ngắn (ACF MCP không ghi được repeater lồng trong group).
$card_defaults = [
    [
        'number'   => '01',
        'title'    => 'Phong cách món ăn',
        'body'     => 'Phong cách ẩm thực tại Carezone là sự hòa quyện giữa truyền thống và hiện đại, mang lại trải nghiệm ẩm thực tinh tế, thanh đạm nhưng vẫn đầy đủ dưỡng chất. Các món ăn được chế biến tỉ mỉ, giữ trọn hương vị tự nhiên, mang đến sự cân bằng giữa cơ thể và tâm hồn. Với sự kết hợp giữa các nguyên liệu thuần chay và thảo mộc, mỗi món ăn không chỉ là sự thưởng thức mà còn là một hành trình về sức khỏe bền vững.',
        'bg_color' => '#aedbc7',
    ],
    [
        'number'   => '02',
        'title'    => 'Chọn nguyên liệu',
        'body'     => 'Chúng tôi luôn lựa chọn nguyên liệu tươi mới và tự nhiên, không chứa hóa chất hay phẩm màu. Mỗi nguyên liệu được chọn lọc kỹ lưỡng, từ rau củ quả, ngũ cốc cho đến thảo mộc thiên nhiên, nhằm đảm bảo giá trị dinh dưỡng tối đa và hương vị tươi ngon. Carezone tin rằng nguyên liệu tốt chính là nền tảng cho món ăn ngon và lành mạnh.',
        'bg_color' => '#fbf1cb',
    ],
    [
        'number'   => '03',
        'title'    => 'Phương pháp chế biến',
        'body'     => 'Phương pháp chế biến tại Carezone chú trọng đến việc giữ trọn dưỡng chất và hương vị của nguyên liệu. Chúng tôi sử dụng các kỹ thuật chế biến nhẹ nhàng như hấp, luộc, nướng để bảo toàn dưỡng chất, hạn chế tối đa việc sử dụng dầu mỡ. Các món ăn được chế biến theo từng công thức riêng biệt để phù hợp với nhu cầu dinh dưỡng của từng thực khách, đảm bảo không chỉ ngon mà còn là sự kết hợp hài hòa giữa sức khỏe và sự sáng tạo.',
        'bg_color' => '#d4da7a',
    ],
];

if (empty($cards)) {
    $cards = $card_defaults;
} else {
    // Bù nội dung từ bản chuẩn nếu body ACF rỗng hoặc bị cắt ngắn hơn Figma
    foreach ($cards as $i => &$c) {
        $def = $card_defaults[$i] ?? null;
        if (!$def) {
            continue;
        }
        if (empty($c['body']) || mb_strlen($c['body']) < mb_strlen($def['body'])) {
            $c['body'] = $def['body'];
        }
        if (empty($c['number'])) {
            $c['number']   = $def['number'];
        }
        if (empty($c['title'])) {
            $c['title']    = $def['title'];
        }
        if (empty($c['bg_color'])) {
            $c['bg_color'] = $def['bg_color'];
        }
    }
    unset($c);
}

// Lotus trang trí (line-art) — tái dùng SVG nhóm từ section-about
$lotus_svg = get_theme_file_uri('/assets/images/restaurant-page/lotus.png');
$lotus_classes = [
    'section-philosophy__lotus-g1',
    'section-philosophy__lotus-g2',
    'section-philosophy__lotus-g3',
    'section-philosophy__lotus-g4',
    'section-philosophy__lotus-g5',
    'section-philosophy__lotus-g6',
    'section-philosophy__lotus-g7',
];

// Benefit image assets (static)
$benefit_images = [
    get_theme_file_uri('/assets/images/restaurant-page/d-philosophy-benefit1.png'),
    get_theme_file_uri('/assets/images/restaurant-page/d-philosophy-benefit2.png'),
    get_theme_file_uri('/assets/images/restaurant-page/d-philosophy-benefit3.png'),
];

// Card CSS modifier index map
$card_modifiers = ['1', '2', '3'];
?>

<section id="section-philosophy" class="section-philosophy">
    <div class="section-philosophy__green-panel">

        <!-- Background image (thay cho background-image CSS) -->
        <img
            class="section-philosophy__green-bg"
            src="<?php echo esc_url(get_theme_file_uri('/assets/images/restaurant-page/d-bg-green.jpg')); ?>"
            alt=""
            aria-hidden="true"
            loading="lazy"
            decoding="async"
        >

        <!-- ── Part 1: Philosophy Cards ─────────────────────── -->
        <div class="section-philosophy__cards-section">
            <div class="section-philosophy__cards-inner">

                <!-- Left: sticky subtitle + description -->
                <div class="section-philosophy__left">
                    <div class="section-philosophy__left-inner">
                        <p class="section-philosophy__subtitle">
                            <?php echo esc_html($subtitle); ?>
                        </p>
                        <?php if ($description): ?>
                            <p class="section-philosophy__description">
                                <?php echo esc_html($description); ?>
                            </p>
                        <?php else: ?>
                            <p class="section-philosophy__description">
                                Nhà hàng chay Carezone mang đến không gian ấm cúng, thư giãn với các món ăn thanh đạm và bổ dưỡng từ thiên nhiên.
                            </p>
                        <?php endif; ?>

                        <!-- Lotus line-art decoration -->
                        <div class="section-philosophy__lotus" aria-hidden="true">
                            <img src="<?php echo esc_url($lotus_svg); ?>" alt="" aria-hidden="true" loading="lazy">
                        </div>
                    </div>
                </div>

                <!-- Right: stacking cards -->
                <div class="section-philosophy__cards-right">
                    <?php foreach ($cards as $i => $card):
                        $modifier = $card_modifiers[$i] ?? ($i + 1);
                        $sticky_class = 'section-philosophy__card-sticky-' . ($i + 1);
                        $bg_color = isset($card['bg_color']) ? esc_attr($card['bg_color']) : '';
                        $inline_bg = $bg_color ? ' style="background-color:' . $bg_color . ';"' : '';
                    ?>
                        <div class="<?php echo esc_attr($sticky_class); ?>">
                            <div
                                class="section-philosophy__card section-philosophy__card--<?php echo esc_attr($modifier); ?>"
                                data-card-index="<?php echo esc_attr($i); ?>"
                                <?php echo $inline_bg; // already escaped above 
                                ?>>
                                <div class="section-philosophy__card-header">
                                    <span class="section-philosophy__card-number">
                                        <?php echo esc_html($card['number'] ?? '0' . ($i + 1)); ?>
                                    </span>
                                    <span class="section-philosophy__card-title">
                                        <?php echo esc_html($card['title'] ?? ''); ?>
                                    </span>
                                </div>
                                <p class="section-philosophy__card-body">
                                    <?php echo esc_html($card['body'] ?? ''); ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>

        <!-- ── Part 2: Benefits Section ─────────────────────── -->
        <div class="section-philosophy__benefits">
            <div class="section-philosophy__benefits-inner">

                <h2 class="section-philosophy__benefits-title">
                    <?php echo esc_html($benefits_title); ?>
                </h2>

                <div class="section-philosophy__benefits-row">
                    <?php
                    // Use ACF benefits if available, else fallback
                    $benefit_defaults = [
                        [
                            'title' => 'Kết nối với lối sống lành mạnh',
                            'body'  => 'Ăn chay không chỉ là dinh dưỡng mà còn là cách sống, giúp con người hướng đến sự cân bằng giữa cơ thể – tâm trí – thiên nhiên.',
                            'image' => null,
                        ],
                        [
                            'title' => 'Duy trì vóc dáng và năng lượng ổn định',
                            'body'  => 'Thực phẩm giàu dinh dưỡng, ít chế biến giúp kiểm soát cân nặng, cung cấp năng lượng bền vững, hạn chế cảm giác mệt mỏi.',
                            'image' => null,
                        ],
                        [
                            'title' => 'Cân bằng tinh thần, giảm căng thẳng',
                            'body'  => 'Ẩm thực thuần tự nhiên giúp cơ thể nhẹ nhàng hơn, từ đó mang lại sự thư thái, cải thiện tâm trạng và giấc ngủ.',
                            'image' => null,
                        ],
                    ];

                    $display_benefits = !empty($benefits) ? $benefits : $benefit_defaults;

                    foreach ($display_benefits as $j => $benefit):
                        $b_modifier = $j + 1;
                        $image_id   = $benefit['image']['ID'] ?? 0;
                        $static_img = $benefit_images[$j] ?? '';
                    ?>
                        <article class="section-philosophy__benefit-card section-philosophy__benefit-card--<?php echo esc_attr($b_modifier); ?>">
                            <div class="section-philosophy__benefit-text">
                                <h3 class="section-philosophy__benefit-card-title">
                                    <?php echo esc_html($benefit['title'] ?? ''); ?>
                                </h3>
                                <p class="section-philosophy__benefit-body">
                                    <?php echo esc_html($benefit['body'] ?? ''); ?>
                                </p>
                            </div>

                            <div class="section-philosophy__benefit-img-wrap">
                                <?php if ($image_id): ?>
                                    <?php echo wp_get_attachment_image($image_id, 'large', false, [
                                        'class'   => 'section-philosophy__benefit-img',
                                        'loading' => 'lazy',
                                        'decoding' => 'async',
                                        'alt'     => esc_attr($benefit['title'] ?? ''),
                                    ]); ?>
                                <?php elseif ($static_img): ?>
                                    <img
                                        src="<?php echo esc_url($static_img); ?>"
                                        alt="<?php echo esc_attr($benefit['title'] ?? ''); ?>"
                                        class="section-philosophy__benefit-img"
                                        loading="lazy"
                                        decoding="async"
                                        width="438"
                                        height="274">
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>

    </div><!-- /.section-philosophy__green-panel -->

    <!-- ── Floating CTA button (absolute, overlaps into section-offers) ── -->
    <div class="section-philosophy__floating-cta">
        <?php get_template_part('template-parts/components/animated-button/index', null, [
            'text' => 'Đặt lịch ngay hôm nay',
            'url'  => '#dat-lich',
        ]); ?>
    </div>

</section>