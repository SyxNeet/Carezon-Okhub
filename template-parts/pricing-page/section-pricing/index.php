<?php
$pricing = get_field('pricing');
$section_title = $pricing['title'];
$pricing_items = $pricing['service'];
// fallback
$arrow_icon = 352;
$blink_icon = 353;
$close_icon = 354;
$bottom_image = 348;
$decor_1 = 349;
$decor_2 = 350;

// Prepare pricing data for JavaScript
$pricing_data = [];
foreach ($pricing_items as $index => $item) {
    $item_title = $item['name_service'] ?? '';
    $item_images = $item['images'] ?? [];

    $pricing_data[] = [
        'title' => $item_title,
        'images' => array_map(function ($image) {
            // Handle attachment object structure
            if (is_array($image) && isset($image['url'])) {
                return $image['url'];
            } elseif (is_string($image)) {
                return $image;
            } else {
                return '';
            }
        }, $item_images)
    ];
}
?>

<section class="pricing">
    <div class="pricing__header">
        <h2 class="pricing__title"><?= $section_title; ?></h2>
    </div>

    <div class="pricing__content">
        <!-- Sidebar -->
        <div class="pricing__sidebar">
            <div class="pricing__sidebar-inner">
                <?php foreach ($pricing_items as $index => $item):
                    $is_active = $index === 0;
                    $item_title = $item['name_service'] ?? '';
                    ?>
                    <button class="pricing__sidebar-item<?php echo $is_active ? ' active' : ''; ?>"
                        data-index="<?php echo esc_attr($index); ?>">

                        <span class="pricing__sidebar-blink-icon">
                            <?= wp_get_attachment_image($blink_icon, 'full', false, ['class' => 'pricing__sidebar-blink-icon-img']) ?>
                        </span>

                        <span class="pricing__sidebar-text">
                            <?php echo esc_html($item_title); ?>
                        </span>

                        <span class="pricing__sidebar-arrow-icon">
                            <?= wp_get_attachment_image($arrow_icon, 'full', false, ['class' => 'pricing__sidebar-arrow-icon-img']) ?>
                        </span>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Plans -->
        <!-- Plans - NESTED SWIPER STRUCTURE -->
        <div class="pricing__plans-wrapper-outer">
            <div class="pricing__plans">
                <!-- PARENT SWIPER (Horizontal navigation between services) -->
                <div class="pricing__plans-slider swiper">
                    <div class="pricing__plans-wrapper swiper-wrapper">
                        <?php foreach ($pricing_items as $parent_index => $item):
                            $item_title = $item['name_service'] ?? '';
                            $item_images = $item['images'] ?? [];
                            ?>
                            <!-- PARENT SLIDE = 1 Service Category -->
                            <div class="pricing__parent-slide swiper-slide" data-parent-index="<?= $parent_index ?>">

                                <!-- CHILD SWIPER (Vertical scroll for images) -->
                                <div class="pricing__child-slider swiper" data-child-index="<?= $parent_index ?>">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($item_images as $img_index => $image):
                                            $image_url = is_array($image) && isset($image['url']) ? $image['url'] : (is_string($image) ? $image : '');
                                            ?>
                                            <!-- CHILD SLIDE = 1 Image -->
                                            <div class="pricing__child-slide swiper-slide">
                                                <img src="<?= esc_url($image_url) ?>" alt="<?= esc_attr($item_title) ?>"
                                                    class="pricing__plans-image"
                                                    loading="<?= $img_index === 0 ? 'eager' : 'lazy' ?>" />
                                            </div>
                                        <?php endforeach; ?>
                                    </div>


                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>


            <!-- Parent Pagination (for services) -->
            <!-- <div class="pricing__plans-pagination swiper-pagination"></div> -->
            <!-- Child Pagination (per service) -->
            <div class="pricing__child-pagination swiper-pagination"></div>

            <!-- Decorations (unchanged) -->
            <div class="pricing__decoration pricing__decoration--left">
                <?= wp_get_attachment_image($decor_1, 'full', false, ['class' => 'pricing__decoration-img']) ?>
            </div>
            <div class="pricing__decoration pricing__decoration--right">
                <?= wp_get_attachment_image($decor_2, 'full', false, ['class' => 'pricing__decoration-img']) ?>
            </div>
        </div>

        <div class="pricing__plans-bottom-decoration">
            <?= wp_get_attachment_image($bottom_image, 'full', false, ['class' => 'pricing__plans-bottom-decoration-img']) ?>
        </div>
    </div>


    <!-- Popup mobile -->
    <div class="pricing__popup" id="pricingPopup">
        <div class="pricing__popup-panel">
            <div class="pricing__popup-header">
                <span class="pricing__sidebar-blink-icon">
                    <?= wp_get_attachment_image($blink_icon, 'full', false, ['class' => 'pricing__sidebar-blink-icon-img']) ?>
                </span>

                <span class="pricing__popup-title" id="pricingPopupTitle">
                </span>

                <button class="pricing__popup-close">
                    <?= wp_get_attachment_image($close_icon, 'full', false, ['class' => 'pricing__popup-close-img']) ?>
                </button>
            </div>

            <div class="pricing__popup-body">
                <div class="pricing__plans-slider swiper">
                    <div class="pricing__plans-wrapper swiper-wrapper">
                        <!-- Popup slides will be dynamically loaded here -->
                    </div>
                </div>
            </div>

            <div class="pricing__popup-footer">
                <button class="pricing__popup-more">
                    <p>Xem giá dịch vụ khác</p>
                    <span class="pricing__popup-arrow-icon">
                        <?= wp_get_attachment_image($arrow_icon, 'full', false, ['class' => 'pricing__popup-arrow-icon-img']) ?>
                    </span>
                </button>

                <div class="pricing__popup-pagination swiper-pagination"></div>
            </div>
        </div>

        <!-- popup bottom sheet -->
        <div class="pricing__bottom-sheet" id="pricingBottomSheet">
            <div class="pricing__bottom-sheet-content">
                <div class="pricing__bottom-sheet-header">
                    <p class="pricing__popup-title">
                        <?= $pricing['bottom_sheet_title']; ?>
                    </p>

                    <button class="pricing__bottom-sheet-close">
                        <?= wp_get_attachment_image($close_icon, 'full', false, ['class' => 'pricing__bottom-sheet-close-img']) ?>
                    </button>
                </div>
                <div class="pricing__bottom-sheet-body">
                    <div class="pricing__bottom-sheet-items">
                        <?php foreach ($pricing_items as $index => $item):
                            $is_active = $index === 0;
                            $item_title = $item['name_service'] ?? '';
                            ?>
                            <button class="pricing__sidebar-item<?php echo $is_active ? ' active' : ''; ?>"
                                data-index="<?php echo esc_attr($index); ?>">

                                <span class="pricing__sidebar-blink-icon">
                                    <?= wp_get_attachment_image($blink_icon, 'full', false, ['class' => 'pricing__sidebar-blink-icon-img']) ?>
                                </span>

                                <span class="pricing__sidebar-text">
                                    <?= $item_title; ?>
                                </span>

                                <span class="pricing__sidebar-arrow-icon">
                                    <?= wp_get_attachment_image($arrow_icon, 'full', false, ['class' => 'pricing__sidebar-arrow-icon-img']) ?>
                                </span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pass pricing data to JavaScript -->
    <script>
        window.pricingData = <?php echo json_encode($pricing_data); ?>;
    </script>
</section>