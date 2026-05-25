<?php
$services_section = get_field('xong_hoi_services') ?: [];
$section_title    = $services_section['section_title'] ?? 'Trải nghiệm thư giãn và phục hồi năng lượng tự nhiên';
$decor_image_id   = $services_section['decor_image'] ?? 963;
$categories       = $services_section['categories'] ?? [];

// Fallback dữ liệu cũ (repeater services từ clone service_od)
if (empty($categories)) {
    $legacy_services = get_field('services') ?: [];
    if (! empty($legacy_services)) {
        $categories = [
            [
                'tab_label' => 'Jjimjillbang Kết nối',
                'items'     => $legacy_services,
            ],
        ];
    }
}

$category_count = count($categories);
?>

<section class="onsen-services">
    <?php if (isMobileDevice()) : ?>
        <img src="https://carezone.vn/wp-content/uploads/2026/05/Mask-group-1.png" alt="" class="onsen-services__decor-image--mb">
    <?php endif; ?>
    <div class="onsen-services__container">
        <div class="onsen-services__heading-container">
            <?php if ($section_title) : ?>
                <h2 class="onsen-services__heading"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>
        </div>

            <?php echo wp_get_attachment_image(963, 'full', false, ['class' => 'onsen-services__img']); ?>

        <?php if ($category_count > 0) : ?>
            <div class="onsen-services__primary-tabs" role="tablist" aria-label="<?php esc_attr_e('Loại Jimjilbang', 'okhub-theme'); ?>">
                <div class="onsen-services__primary-tabs-container">
                    <?php foreach ($categories as $cat_index => $category) : ?>
                    <button
                        type="button"
                        class="onsen-services__primary-tab<?php echo $cat_index === 0 ? ' active' : ''; ?>"
                        role="tab"
                        aria-selected="<?php echo $cat_index === 0 ? 'true' : 'false'; ?>"
                        data-category-index="<?php echo esc_attr($cat_index); ?>"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <g clip-path="url(#clip0_20858_38165)">
                        <path d="M8 0.5C7.66563 7.39062 7.39062 7.66563 0.5 8C7.39062 8.33437 7.66563 8.60938 8 15.5C8.33437 8.60938 8.60938 8.33437 15.5 8C8.60938 7.66563 8.33437 7.39062 8 0.5Z" fill="white"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_20858_38165">
                        <rect width="16" height="16" fill="white"/>
                        </clipPath>
                    </defs>
                    </svg>
                        <?php echo esc_html($category['tab_label'] ?? ''); ?>
                    </button>
                <?php endforeach; ?>
                </div>
            </div>

            <?php foreach ($categories as $cat_index => $category) :
                $items = $category['items'] ?? [];
                if (empty($items)) {
                    continue;
                }
                ?>
                <div
                    class="onsen-services__panel<?php echo $cat_index === 0 ? ' active' : ''; ?>"
                    data-category-index="<?php echo esc_attr($cat_index); ?>"
                    role="tabpanel"
                    <?php echo $cat_index !== 0 ? 'hidden' : ''; ?>>

                    <div class="onsen-services__tabs">
                        <?php foreach ($items as $index => $service) : ?>
                            <div
                                class="onsen-services__tab<?php echo $index === 0 ? ' active' : ''; ?>"
                                data-index="<?php echo esc_attr($index); ?>">
                                <?php echo esc_html($service['tab'] ?? ''); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="onsen-services__main">
                        <?php foreach ($items as $index => $service) : ?>
                            <div
                                class="onsen-services__content<?php echo $index === 0 ? ' active' : ''; ?>"
                                data-index="<?php echo esc_attr($index); ?>">
                                <?php if (! empty($service['subtitle'])) : ?>
                                    <p class="onsen-services__content-subtitle">
                                        <?php echo esc_html($service['subtitle']); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (! empty($service['title'])) : ?>
                                    <p class="onsen-services__content-title">
                                        <?php echo esc_html($service['title']); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (! empty($service['description'])) : ?>
                                    <p class="onsen-services__content-description">
                                        <?php echo esc_html($service['description']); ?>
                                    </p>
                                <?php endif; ?>
                                <div class="onsen-services__line"></div>
                                <?php if (! empty($service['features']) && is_array($service['features'])) : ?>
                                    <div class="onsen-services__features">
                                        <?php foreach ($service['features'] as $feature) : ?>
                                            <div class="onsen-services__feature">
                                                <?php if (! empty($feature['icon'])) : ?>
                                                    <div class="onsen-services__feature-icon">
                                                        <?php echo wp_get_attachment_image($feature['icon'], 'full', false, ['class' => 'onsen-services__feature-icon-img']); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <p class="onsen-services__feature-content">
                                                    <?php echo esc_html($feature['title'] ?? ''); ?>
                                                </p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                        <div class="onsen-services__image">
                            <?php foreach ($items as $index => $service) : ?>
                                <?php if (! empty($service['image_desktop'])) : ?>
                                    <?php echo wp_get_attachment_image(
                                        $service['image_desktop'],
                                        'full',
                                        false,
                                        [
                                            'class' => 'onsen-services__image-img onsen-services__image-img--pc ' . ($index === 0 ? 'active' : ''),
                                        ]
                                    ); ?>
                                <?php endif; ?>
                                <?php if (! empty($service['image_mobile'])) : ?>
                                    <?php echo wp_get_attachment_image(
                                        $service['image_mobile'],
                                        'full',
                                        false,
                                        [
                                            'class' => 'onsen-services__image-img onsen-services__image-img--mobile ' . ($index === 0 ? 'active' : ''),
                                        ]
                                    ); ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div class="onsen-services__overlay"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
