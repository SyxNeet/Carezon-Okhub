<?php
/**
 * Section: Menu
 * Page: Restaurant Page
 *
 * Mỗi tab = 1 ảnh thực đơn (ACF restaurant_menu.tabs[].menu_image).
 * Theo annotation Figma: "cả section menu này là ảnh, để KH post ảnh".
 * Carousel dùng Swiper (global). Tabs + prev/next/play điều khiển swiper.
 */

$menu_data = get_field('restaurant_menu') ?: [];
$subtitle  = $menu_data['subtitle'] ?? 'Menu món ăn';
$title     = $menu_data['title'] ?? 'Thực đơn chay – Tinh hoa từ thiên nhiên';
$tabs      = $menu_data['tabs'] ?? [];

// Control icons (giống section-banner)
$icon_prev_id  = 830;
$icon_pause_id = 829;
$icon_play_id  = 840;
?>

<section id="section-menu" class="section-menu">
    <div class="section-menu__container container">

        <!-- Header: subtitle + title -->
        <div class="section-menu__header">
            <p class="section-menu__subtitle">
                <?php echo esc_html($subtitle); ?>
            </p>
            <h2 class="section-menu__title">
                <?php echo esc_html($title); ?>
            </h2>
        </div>

        <!-- Main content area -->
        <div class="section-menu__main">

            <!-- Tabs row -->
            <?php if (!empty($tabs)): ?>
            <div class="section-menu__tabs" role="tablist" aria-label="<?php echo esc_attr($subtitle); ?>">
                <?php foreach ($tabs as $i => $tab):
                    $tab_name  = $tab['tab_name'] ?? '';
                    $is_active = ($i === 0);
                ?>
                <button
                    class="section-menu__tab<?php echo $is_active ? ' is-active' : ''; ?>"
                    role="tab"
                    aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
                    data-tab-index="<?php echo esc_attr($i); ?>"
                    type="button"
                >
                    <?php echo esc_html($tab_name); ?>
                </button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Swiper: mỗi slide là 1 ảnh thực đơn -->
            <?php if (!empty($tabs)): ?>
            <div class="section-menu__swiper swiper js-menu-swiper">
                <div class="section-menu__swiper-wrapper swiper-wrapper">
                    <?php foreach ($tabs as $i => $tab):
                        $image_id  = $tab['menu_image']['ID'] ?? 0;
                        $image_alt = $tab['menu_image']['alt'] ?? ($tab['tab_name'] ?? '');
                    ?>
                    <div class="section-menu__panel swiper-slide">
                        <?php if ($image_id): ?>
                            <?php echo wp_get_attachment_image($image_id, 'full', false, [
                                'class'    => 'section-menu__panel-img',
                                'loading'  => ($i === 0) ? 'eager' : 'lazy',
                                'decoding' => 'async',
                                'alt'      => esc_attr($image_alt),
                            ]); ?>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        </div><!-- /.section-menu__main -->

        <!-- Controls bar (copy từ section-banner__controls) -->
        <?php if (count($tabs) > 1): ?>
        <div class="section-menu__controls">
            <button type="button" class="section-menu__btn section-menu__prev" aria-label="Tab trước">
                <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'section-menu__btn-icon']) ?>
            </button>
            <div class="section-menu__pagination" aria-label="Phân trang thực đơn"></div>
            <button type="button" class="section-menu__play" aria-label="Tạm dừng / phát">
                <?= wp_get_attachment_image($icon_play_id, 'full', false, ['class' => 'section-menu__play-icon']) ?>
                <?= wp_get_attachment_image($icon_pause_id, 'full', false, ['class' => 'section-menu__pause-icon']) ?>
            </button>
            <button type="button" class="section-menu__btn section-menu__next" aria-label="Tab sau">
                <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'section-menu__btn-icon']) ?>
            </button>
        </div>
        <?php endif; ?>

    </div><!-- /.section-menu__container -->
</section>
