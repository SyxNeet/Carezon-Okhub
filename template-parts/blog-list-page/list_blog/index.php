<?php
$book_icon = 494;
$search_icon = 493;
$filter_icon = 492;
$arrow_down = 491;
$filter_icon_mobile = 490;
$close_icon = 498; 
$radio_active = 509;
$radio_inactive = 508;
$arrow_mb_icon = 507;
// Get filter params from URL
$category_slug = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
$orderby_filter = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'newest';
$search_query = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
// Use 'paged' instead of 'page' to avoid WordPress conflict
$current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
$posts_per_page = wp_is_mobile() ? 6 : 9;

// Build query args
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => $posts_per_page,
    'paged' => $current_page,
);

// Filter by category (convert slug to ID if needed)
if (!empty($category_slug)) {
    $category_obj = get_category_by_slug($category_slug);
    if ($category_obj) {
        $args['cat'] = $category_obj->term_id;
    }
}

// Order by
if ($orderby_filter === 'oldest') {
    $args['orderby'] = 'date';
    $args['order'] = 'ASC';
} elseif ($orderby_filter === 'title_asc') {
    $args['orderby'] = 'title';
    $args['order'] = 'ASC';
} elseif ($orderby_filter === 'title_desc') {
    $args['orderby'] = 'title';
    $args['order'] = 'DESC';
} else {
    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
}

// Search query
if (!empty($search_query)) {
    $args['s'] = $search_query;
}

$blog_query = new WP_Query($args);

// Get all categories for dropdown
$categories = get_categories(array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => true,
));

// Get selected category name
$selected_category_name = 'Tất cả';
if (!empty($category_slug)) {
    $category_obj = get_category_by_slug($category_slug);
    if ($category_obj) {
        $selected_category_name = $category_obj->name;
    }
}

// Get selected orderby name
$selected_orderby_names = array(
    'newest' => 'Mới nhất',
    'oldest' => 'Cũ nhất',
    'title_asc' => 'Alphabet A-Z',
    'title_desc' => 'Alphabet Z-A'
);
$selected_orderby_name = isset($selected_orderby_names[$orderby_filter]) ? $selected_orderby_names[$orderby_filter] : 'Mới nhất';
$total_pages = $blog_query->max_num_pages;
?>

<section class="blog-list">
    <div class="blog-list__container">
        <!-- Category tabs -->
        <div class="blog-list__tabs" data-value="<?= esc_attr($category_slug); ?>">
                <button type="button" class="blog-list__tab <?= empty($category_slug) ? 'active' : ''; ?>" data-value="" style="--i:0">Tất cả</button>
            <?php foreach($categories as $i => $category): ?>
                <button type="button" class="blog-list__tab <?= $category_slug === $category->slug ? 'active' : '' ?>" data-value="<?= esc_attr($category->slug); ?>" style="--i:<?= $i + 1 ?>"><?= esc_html($category->name); ?></button>
            <?php endforeach; ?>
        </div>
        <!-- Filter Bar -->
        <div class="blog-list__filter-bar">
            <div class="blog-list__filter-group blog-list__filter-group--search">
                <div class="blog-list__search-wrapper">
                    <?php echo wp_get_attachment_image($search_icon, 'full', false, array('class' => 'blog-list__search-icon')) ?>
                    <input
                        type="text"
                        class="blog-list__search-input"
                        id="search-input"
                        placeholder="Nhập từ khóa tìm kiếm"
                        value="<?php echo esc_attr($search_query); ?>">
                </div>
                <!-- Mobile Filter Button -->
                <button class="blog-list__mobile-filter-btn" id="mobile-filter-btn" type="button">
                    <?php echo wp_get_attachment_image($filter_icon_mobile, 'full', false, array('class' => 'blog-list__mobile-filter-icon')) ?>
                </button>
            </div>
            
            <div class="blog-list__filter-bar-group">
                <!--<div class="blog-list__filter-group">-->

                <!--    <div class="custom-dropdown" id="category-dropdown">-->
                        <!-- Hidden select for form submission -->
                <!--        <select class="custom-dropdown__select" id="category-filter" data-filter="category">-->
                <!--            <option value="">Tất cả</option>-->
                <!--            <?php foreach ($categories as $category): ?>-->
                <!--                <option value="<?php echo esc_attr($category->slug); ?>" <?php selected($category_slug, $category->slug); ?>>-->
                <!--                    <?php echo esc_html($category->name); ?>-->
                <!--                </option>-->
                <!--            <?php endforeach; ?>-->
                <!--        </select>-->

                        <!-- Custom button -->
                <!--        <button type="button" class="custom-dropdown__button">-->
                <!--            <span class="custom-dropdown__icon">-->
                <!--                <?php echo wp_get_attachment_image($book_icon, 'full', false, array('class' => 'custom-dropdown__icon-img')) ?>-->
                <!--            </span>-->
                <!--            <label class="blog-list__filter-label">Loại bài viết:</label>-->
                <!--            <span class="custom-dropdown__text"> <?php echo esc_html($selected_category_name); ?></span>-->
                <!--            <span class="custom-dropdown__arrow">-->
                <!--                <?php echo wp_get_attachment_image($arrow_down, 'full', false, array('class' => 'custom-dropdown__arrow-img')) ?>-->
                <!--            </span>-->
                <!--        </button>-->

                        <!-- Custom dropdown menu -->
                <!--        <ul class="custom-dropdown__menu">-->
                <!--            <li class="custom-dropdown__item <?php echo empty($category_slug) ? 'custom-dropdown__item--active' : ''; ?>" data-value="">-->
                <!--                <span>Tất cả</span>-->
                <!--            </li>-->
                <!--            <?php foreach ($categories as $category): ?>-->
                <!--                <li class="custom-dropdown__item <?php echo $category_slug === $category->slug ? 'custom-dropdown__item--active' : ''; ?>" data-value="<?php echo esc_attr($category->slug); ?>">-->
                <!--                    <span><?php echo esc_html($category->name); ?></span>-->
                <!--                </li>-->
                <!--            <?php endforeach; ?>-->
                <!--        </ul>-->
                <!--    </div>-->
                <!--</div>-->

                <div class="blog-list__filter-group">

                    <div class="custom-dropdown" id="orderby-dropdown">
                        <!-- Hidden select for form submission -->
                        <select class="custom-dropdown__select" id="orderby-filter" data-filter="orderby">
                            <option value="newest" <?php selected($orderby_filter, 'newest'); ?>>Mới nhất</option>
                            <option value="oldest" <?php selected($orderby_filter, 'oldest'); ?>>Cũ nhất</option>
                            <option value="title_asc" <?php selected($orderby_filter, 'title_asc'); ?>>Alphabet A-Z</option>
                            <option value="title_desc" <?php selected($orderby_filter, 'title_desc'); ?>>Alphabet Z-A</option>
                        </select>

                        <!-- Custom button -->
                        <button type="button" class="custom-dropdown__button">
                            <span class="custom-dropdown__icon">
                                <?php echo wp_get_attachment_image($filter_icon, 'full', false, array('class' => 'custom-dropdown__icon-img')) ?>
                            </span>
                            <label class="blog-list__filter-label">Sắp xếp theo:</label>
                            <span class="custom-dropdown__text"> <?php echo esc_html($selected_orderby_name); ?></span>
                            <span class="custom-dropdown__arrow">
                                <?php echo wp_get_attachment_image($arrow_down, 'full', false, array('class' => 'custom-dropdown__arrow-img')) ?>
                            </span>
                        </button>

                        <!-- Custom dropdown menu -->
                        <ul class="custom-dropdown__menu">
                            <li class="custom-dropdown__item <?php echo $orderby_filter === 'newest' ? 'custom-dropdown__item--active' : ''; ?>" data-value="newest">
                                <span>Mới nhất</span>
                            </li>
                            <li class="custom-dropdown__item <?php echo $orderby_filter === 'oldest' ? 'custom-dropdown__item--active' : ''; ?>" data-value="oldest">
                                <span>Cũ nhất</span>
                            </li>
                            <li class="custom-dropdown__item <?php echo $orderby_filter === 'title_asc' ? 'custom-dropdown__item--active' : ''; ?>" data-value="title_asc">
                                <span>Alphabet A-Z</span>
                            </li>
                            <li class="custom-dropdown__item <?php echo $orderby_filter === 'title_desc' ? 'custom-dropdown__item--active' : ''; ?>" data-value="title_desc">
                                <span>Alphabet Z-A</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            
        </div>

        <!-- Mobile Filter Popup -->
        <div class="blog-list__mobile-filter-popup" id="mobile-filter-popup">
            <!-- Popup Overlay -->
            <div class="blog-list__mobile-filter-overlay"></div>
            
            <!-- Popup Content -->
            <div class="blog-list__mobile-filter-content">
                <!-- Header -->
                <div class="blog-list__mobile-filter-header">
                    <h3 class="blog-list__mobile-filter-title">Bộ lọc</h3>
                    <button class="blog-list__mobile-filter-close" id="mobile-filter-close" type="button">
                        <?php echo wp_get_attachment_image($close_icon, 'full', false, array('class' => 'blog-list__mobile-filter-close-icon')) ?>
                    </button>
                </div>

                <!-- Body -->
                <div class="blog-list__mobile-filter-body">
                    <!-- Category Filter -->
                    <div class="blog-list__mobile-filter-section">
                        <div class="blog-list__mobile-filter-section-header">
                            <span class="blog-list__mobile-filter-section-icon">
                                <?php echo wp_get_attachment_image($book_icon, 'full', false, array('class' => 'blog-list__mobile-filter-section-icon-img')) ?>
                            </span>
                            <h4 class="blog-list__mobile-filter-section-title">Loại bài viết</h4>
                        </div>
                        <div class="blog-list__mobile-filter-options">
                            <label class="blog-list__mobile-filter-option">
                                <input type="radio" name="mobile-category-filter" value="" <?php echo empty($category_slug) ? 'checked' : ''; ?>>
                                <span class="blog-list__radio-icon-inactive">
                                    <?php echo wp_get_attachment_image($radio_inactive, 'full', false, array('class' => 'blog-list__radio-icon-img')) ?>
                                </span>
                                <span class="blog-list__radio-icon-active">
                                    <?php echo wp_get_attachment_image($radio_active, 'full', false, array('class' => 'blog-list__radio-icon-img')) ?>
                                </span>
                                <span class="blog-list__mobile-filter-option-label">Tất cả</span>
                            </label>
                            <?php foreach ($categories as $category): ?>
                                <label class="blog-list__mobile-filter-option">
                                    <input type="radio" name="mobile-category-filter" value="<?php echo esc_attr($category->slug); ?>" <?php echo $category_slug === $category->slug ? 'checked' : ''; ?>>
                                    <span class="blog-list__radio-icon-inactive">
                                        <?php echo wp_get_attachment_image($radio_inactive, 'full', false, array('class' => 'blog-list__radio-icon-img')) ?>
                                    </span>
                                    <span class="blog-list__radio-icon-active">
                                        <?php echo wp_get_attachment_image($radio_active, 'full', false, array('class' => 'blog-list__radio-icon-img')) ?>
                                    </span>
                                    <span class="blog-list__mobile-filter-option-label"><?php echo esc_html($category->name); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Orderby Filter -->
                    <div class="blog-list__mobile-filter-section">
                        <div class="blog-list__mobile-filter-section-header">
                            <span class="blog-list__mobile-filter-section-icon">
                                <?php echo wp_get_attachment_image($filter_icon, 'full', false, array('class' => 'blog-list__mobile-filter-section-icon-img')) ?>
                            </span>
                            <h4 class="blog-list__mobile-filter-section-title">Sắp xếp theo</h4>
                        </div>
                        <div class="blog-list__mobile-filter-options">
                            <label class="blog-list__mobile-filter-option">
                                <input type="radio" name="mobile-orderby-filter" value="newest" <?php echo $orderby_filter === 'newest' ? 'checked' : ''; ?>>
                                <span class="blog-list__radio-icon-inactive">
                                    <?php echo wp_get_attachment_image($radio_inactive, 'full', false, array('class' => 'blog-list__radio-icon-img')) ?>
                                </span>
                                <span class="blog-list__radio-icon-active">
                                    <?php echo wp_get_attachment_image($radio_active, 'full', false, array('class' => 'blog-list__radio-icon-img')) ?>
                                </span>
                                <span class="blog-list__mobile-filter-option-label">Mới nhất</span>
                            </label>
                            <label class="blog-list__mobile-filter-option">
                                <input type="radio" name="mobile-orderby-filter" value="oldest" <?php echo $orderby_filter === 'oldest' ? 'checked' : ''; ?>>
                                <span class="blog-list__radio-icon-inactive">
                                    <?php echo wp_get_attachment_image($radio_inactive, 'full', false, array('class' => 'blog-list__radio-icon-img')) ?>
                                </span>
                                <span class="blog-list__radio-icon-active">
                                    <?php echo wp_get_attachment_image($radio_active, 'full', false, array('class' => 'blog-list__radio-icon-img')) ?>
                                </span>
                                <span class="blog-list__mobile-filter-option-label">Cũ nhất</span>
                            </label>
                            <label class="blog-list__mobile-filter-option">
                                <input type="radio" name="mobile-orderby-filter" value="title_asc" <?php echo $orderby_filter === 'title_asc' ? 'checked' : ''; ?>>
                                <span class="blog-list__radio-icon-inactive">
                                    <?php echo wp_get_attachment_image($radio_inactive, 'full', false, array('class' => 'blog-list__radio-icon-img')) ?>
                                </span>
                                <span class="blog-list__radio-icon-active">
                                    <?php echo wp_get_attachment_image($radio_active, 'full', false, array('class' => 'blog-list__radio-icon-img')) ?>
                                </span>
                                <span class="blog-list__mobile-filter-option-label">Alphabet A-Z</span>
                            </label>
                            <label class="blog-list__mobile-filter-option">
                                <input type="radio" name="mobile-orderby-filter" value="title_desc" <?php echo $orderby_filter === 'title_desc' ? 'checked' : ''; ?>>
                                <span class="blog-list__radio-icon-inactive">
                                    <?php echo wp_get_attachment_image($radio_inactive, 'full', false, array('class' => 'blog-list__radio-icon-img')) ?>
                                </span>
                                <span class="blog-list__radio-icon-active">
                                    <?php echo wp_get_attachment_image($radio_active, 'full', false, array('class' => 'blog-list__radio-icon-img')) ?>
                                </span>
                                <span class="blog-list__mobile-filter-option-label">Alphabet Z-A</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="blog-list__mobile-filter-footer">
                    <button class="blog-list__mobile-filter-apply-btn" id="mobile-filter-apply-btn" type="button">
                        <span>Áp dụng</span>
                        <?php echo wp_get_attachment_image($arrow_mb_icon, 'full', false, array('class' => 'blog-list__mobile-filter-apply-btn-icon')) ?>
                    </button>
                </div>
            </div>
        </div>
        
        <h2 class="blog-list__title">Tin tức</h2>

        <!-- Blog Grid -->
        <div class="blog-list__content" id="blog-list-content">
            <?php if ($blog_query->have_posts()): ?>
                <div class="blog-list__grid">
                    <?php while ($blog_query->have_posts()): $blog_query->the_post(); ?>
                        <?php get_template_part('template-parts/components/blog-item/index'); ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            <?php else: ?>
                <p class="blog-list__no-results">Không tìm thấy bài viết nào.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php
        $pagination_data = paginate(array(
            'current' => $current_page,
            'max' => $blog_query->max_num_pages,
        ));
        ?>
        <div class="blog-list__pagination" id="blog-list-pagination" style="display: <?= $total_pages > 1 ? 'flex' : 'none'; ?>">
            <?php if ($pagination_data): ?>
                <div class="blog-list__pagination-container">
                    <?php if ($pagination_data['prev']): ?>
                        <button class="blog-list__pagination-btn blog-list__pagination-btn--prev" data-page="<?php echo esc_attr($pagination_data['prev']); ?>">
                            ‹
                        </button>
                    <?php endif; ?>

                    <div class="blog-list__pagination-numbers">
                        <?php foreach ($pagination_data['items'] as $page_item): ?>
                            <?php if ($page_item === '…'): ?>
                                <span class="blog-list__pagination-ellipsis">…</span>
                            <?php else: ?>
                                <button
                                    class="blog-list__pagination-btn <?php echo ($page_item === $pagination_data['current']) ? 'blog-list__pagination-btn--active' : ''; ?>"
                                    data-page="<?php echo esc_attr($page_item); ?>">
                                    <?php echo esc_html($page_item); ?>
                                </button>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($pagination_data['next']): ?>
                        <button class="blog-list__pagination-btn blog-list__pagination-btn--next" data-page="<?php echo esc_attr($pagination_data['next']); ?>">
                            ›
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>