<?php
$contact_page_id = 365;
// Get contact information from ACF
$contact_email = get_field('contact_email', $contact_page_id) ?: 'example@gmail.com';
$contact_phone = get_field('contact_phone', $contact_page_id) ?: '(+84) 971 519 xxx';
$contact_address = get_field('contact_address', $contact_page_id) ?: '29/40 Ngô Gia Tự, Phường Thủ Dầu Một, Thành phố Hồ Chí Minh';
$contact_maps_link = get_field('contact_maps_link', $contact_page_id) ?: '#';
$contact_open_time = get_field('contact_open_time', $contact_page_id) ?: '10:00 - 22:00 (Tất cả các ngày trong tuần)';

// Get menu background and decoration images
$menu_background = get_field('menu_background', 'option') ?: 627;
$menu_decoration1 = get_field('menu_decoration1', 'option') ?: 630;
$menu_right_background = get_field('menu_right_background', 'option') ?: 628;
$menu_right_decoration1 = get_field('menu_right_decoration1', 'option') ?: 626;
$menu_right_decoration2 = get_field('menu_right_decoration2', 'option') ?: 629;

// Get icon IDs from ACF or use defaults
$icon_email = get_field('icon_email2', 'option') ?: 383;
$icon_phone = get_field('icon_phone2', 'option') ?: 384;
$icon_address = get_field('icon_address', 'option') ?: 382;
$icon_time = get_field('icon_time', 'option') ?: 381;
?>

<div class="main-menu">
    <!-- Close Button -->
    <button class="main-menu__close" aria-label="Close Menu">
        <?php echo wp_get_attachment_image(510, 'icon'); ?>
    </button>

    <!-- Background -->
    <!-- <div class="main-menu__background">
        <?php echo wp_get_attachment_image($menu_background, 'full'); ?>
    </div> -->

    <!-- header decoration -->
    <div class="main-menu__decoration1">
        <?php echo wp_get_attachment_image($menu_decoration1, 'full'); ?>
    </div>

    <!-- main menu -->
    <div class="main-menu__content">
        <!-- left -->
        <div class="main-menu__left">
            <!-- background -->
            <div class="main-menu__left-background">
                <style>
                    .main-menu {
                        --hover-icon: url('<?php echo wp_get_attachment_image_url(631, 'icon'); ?>');
                    }
                </style>
                <?php echo wp_get_attachment_image(625, 'full'); ?>
            </div>

            <!-- main left content -->
            <div class="main-menu__left-content">
                <?php
                // Get header data from ACF Options
                $header = get_field('main_menu', 'option');

                // Extract menu items (Option 1: nested in main_menu)
                $menu_items = isset($header['menu_options']) ? $header['menu_options'] : null;

                // Fallback: Try top-level field (Option 2: if menu_options is separate)
                if (!$menu_items) {
                    $menu_items = get_field('menu_options', 'option');
                }

                if ($menu_items && is_array($menu_items)) {
                    $i = 1;

                    foreach ($menu_items as $item) {
                        // Check if item has children
                        $has_children = !empty($item['children']) && is_array($item['children']);
                        $item_classes = $has_children ? 'has-submenu' : '';
                        ?>
                        <div class="main-menu__left-content-item <?php echo esc_attr($item_classes); ?>"
                            data-menu-item="<?php echo $i; ?>">
                            <span class="main-menu__left-content-item-number">
                                (<?php echo $i; ?>)
                            </span>

                            <?php if ($has_children): ?>
                                <span class="main-menu__left-content-item-link">
                                    <?php echo esc_html($item['title']); ?>
                                </span>
                            <?php else: ?>
                                <a href="<?php echo esc_url($item['url']); ?>" class="main-menu__left-content-item-link">
                                    <?php echo esc_html($item['title']); ?>
                                </a>
                            <?php endif; ?>

                            <?php if ($has_children): ?>
                                <span class="main-menu__dropdown-icon">
                                    <?php
                                    echo wp_get_attachment_image(
                                        632,
                                        'icon',
                                        false,
                                        ['class' => 'dropdown-arrow']
                                    );
                                    ?>
                                </span>

                                <?php if (!wp_is_mobile()): ?>
                                    <!-- Desktop Submenu -->
                                    <div class="main-menu__submenu" id="submenu-<?php echo $i; ?>">
                                        <div class="main-menu__submenu-inner">
                                            <?php foreach ($item['children'] as $child): ?>
                                                <a href="<?php echo esc_url($child['url']); ?>" class="main-menu__submenu-item">
                                                    <span style="margin-right: 1rem; transform: scale(-0.8);">●</span>
                                                    <?php echo esc_html($child['title']); ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- Mobile Submenu Sheet -->
                                    <div class="main-menu__submenu-sheet" id="submenu-<?php echo $i; ?>">
                                        <div class="main-menu__left-background">
                                            <?php echo wp_get_attachment_image(625, 'full'); ?>
                                        </div>
                                        <div class="main-menu__submenu-content">
                                            <div class="main-menu__submenu-header">
                                                <button type="button" class="main-menu__back-button" data-back>
                                                    <?php echo wp_get_attachment_image(632, 'icon', false, [
                                                        'class' => 'main-menu__back-icon',
                                                        'style' => 'transform: rotate(180deg); margin-left: 0; margin-right: 0.5rem;',
                                                    ]); ?>
                                                    <span class="main-menu__back-text"><?php echo esc_html($item['title']); ?></span>
                                                </button>
                                            </div>
                                            <div class="main-menu__submenu-body">
                                                <?php foreach ($item['children'] as $child): ?>
                                                    <a href="<?php echo esc_url($child['url']); ?>" class="main-menu__submenu-item">
                                                        <span style="margin-right: 1rem; transform: scale(-0.8);">●</span>
                                                        <?php echo esc_html($child['title']); ?>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                        $i++;
                    }
                } else {
                    // Fallback menu when ACF field is empty
                    $default_items = [
                        [
                            'title' => 'Trang chủ',
                            'url' => home_url('/'),
                            'children' => [],
                        ],
                        [
                            'title' => 'Giới thiệu',
                            'url' => '/coming-soon',
                            'children' => [],
                        ],
                        [
                            'title' => 'Dịch vụ',
                            'url' => '#',
                            'children' => [
                                ['title' => 'Xông hơi Jjim Jil Bang', 'url' => '/coming-soon'],
                                ['title' => 'Osen - Tắm khoáng', 'url' => '/coming-soon'],
                                ['title' => 'Vườn thư giãn', 'url' => '/coming-soon'],
                                ['title' => 'Nhà hàng chay', 'url' => '/coming-soon'],
                                ['title' => 'Spa trị liệu', 'url' => '/coming-soon'],
                                ['title' => 'Khu VIP', 'url' => '/coming-soon'],
                            ],
                        ],
                        [
                            'title' => 'Bảng giá dịch vụ',
                            'url' => '/bang-gia',
                            'children' => [],
                        ],
                        [
                            'title' => 'Danh sách bài viết',
                            'url' => '/danh-sach-bai-viet',
                            'children' => [],
                        ],
                        [
                            'title' => 'Liên hệ',
                            'url' => '/lien-he',
                            'children' => [],
                        ],
                    ];

                    $i = 1;
                    foreach ($default_items as $item) {
                        $has_children = !empty($item['children']);
                        $item_class = $has_children ? 'has-submenu' : '';
                        ?>
                        <div class="main-menu__left-content-item <?php echo $item_class; ?>" data-menu-item="<?php echo $i; ?>">
                            <span class="main-menu__left-content-item-number">
                                (<?php echo $i; ?>)
                            </span>

                            <?php if ($has_children): ?>
                                <span class="main-menu__left-content-item-link">
                                    <?php echo esc_html($item['title']); ?>
                                </span>
                            <?php else: ?>
                                <a href="<?php echo esc_url($item['url']); ?>" class="main-menu__left-content-item-link">
                                    <?php echo esc_html($item['title']); ?>
                                </a>
                            <?php endif; ?>

                            <?php if ($has_children): ?>
                                <span class="main-menu__dropdown-icon">
                                    <?php echo wp_get_attachment_image(632, 'icon', false, ['class' => 'dropdown-arrow']); ?>
                                </span>

                                <?php if (!wp_is_mobile()): ?>
                                    <!-- Desktop Submenu -->
                                    <div class="main-menu__submenu" id="submenu-<?php echo $i; ?>">
                                        <div class="main-menu__submenu-inner">
                                            <?php foreach ($item['children'] as $child): ?>
                                                <a href="<?php echo esc_url($child['url']); ?>" class="main-menu__submenu-item">
                                                    <span style="margin-right: 1rem; transform: scale(-0.8);">●</span>
                                                    <?php echo esc_html($child['title']); ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- Mobile Submenu Sheet -->
                                    <div class="main-menu__submenu-sheet" id="submenu-<?php echo $i; ?>">
                                        <div class="main-menu__left-background">
                                            <?php echo wp_get_attachment_image(625, 'full'); ?>
                                        </div>
                                        <div class="main-menu__submenu-content">
                                            <div class="main-menu__submenu-header">
                                                <button type="button" class="main-menu__back-button" data-back>
                                                    <?php echo wp_get_attachment_image(632, 'icon', false, [
                                                        'class' => 'main-menu__back-icon',
                                                        'style' => 'transform: rotate(180deg); margin-left: 0; margin-right: 0.5rem;',
                                                    ]); ?>
                                                    <span class="main-menu__back-text"><?php echo esc_html($item['title']); ?></span>
                                                </button>
                                            </div>
                                            <div class="main-menu__submenu-body">
                                                <?php foreach ($item['children'] as $child): ?>
                                                    <a href="<?php echo esc_url($child['url']); ?>" class="main-menu__submenu-item">
                                                        <span style="margin-right: 1rem; transform: scale(-0.8);">●</span>
                                                        <?php echo esc_html($child['title']); ?>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                        $i++;
                    }
                }
                ?>
            </div>
        </div>

        <!-- right -->
        <div class="main-menu__right">
            <!-- background -->
            <div class="main-menu__right-background">
                <?= wp_get_attachment_image($menu_right_background, "full") ?>
            </div>

            <!-- decoration 1 -->
            <div class="main-menu__right-decoration1">
                <?= wp_get_attachment_image($menu_right_decoration1, "full") ?>
            </div>

            <!-- decoration 2 -->
            <div class="main-menu__right-decoration2">
                <?= wp_get_attachment_image($menu_right_decoration2, "full") ?>
            </div>

            <!-- main content right -->
            <div class="main-menu__right-content">
                <!-- Email -->
                <div class="main-menu__right-content-item">
                    <span class="main-menu__right-content-item-icon">
                        <?= wp_get_attachment_image($icon_email, "icon") ?>
                    </span>
                    <p>Email: <?= esc_html($contact_email) ?></p>
                </div>

                <!-- Phone -->
                <div class="main-menu__right-content-item">
                    <span class="main-menu__right-content-item-icon">
                        <?= wp_get_attachment_image($icon_phone, "icon") ?>
                    </span>
                    <p>Số điện thoại: <?= esc_html($contact_phone) ?></p>
                </div>

                <!-- Address -->
                <div class="main-menu__right-content-item main-menu__address">
                    <div class="main-menu__address-wrapper">
                        <span class="main-menu__right-content-item-icon">
                            <?= wp_get_attachment_image(
                                $icon_address,
                                "icon"
                            ) ?>
                        </span>
                        <p>Địa chỉ: <?= wp_kses_post($contact_address) ?></p>
                    </div>
                    <a href="<?= esc_url(
                        $contact_maps_link
                    ) ?>" target="_blank" rel="noopener" class="main-menu__map-link">
                        Xem địa chỉ trên Google Maps
                    </a>
                </div>

                <!-- Opening Hours -->
                <div class="main-menu__right-content-item">
                    <span class="main-menu__right-content-item-icon">
                        <?= wp_get_attachment_image($icon_time, "icon") ?>
                    </span>
                    <p>Giờ mở cửa: <?= esc_html($contact_open_time) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>