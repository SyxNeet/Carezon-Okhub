<?php
$decor_image_id = 1101;

$paged_var = function_exists('get_query_var') ? get_query_var('paged') : null;
$paged = max(1, (int) ($_GET['paged'] ?? $paged_var ?? 1));
$limit = 9;
$args = [
    'post_type' => 'career',
    'posts_per_page' => $limit,
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'DESC'
];
$careers_query = new WP_Query($args);

$total_careers = (int) $careers_query->found_posts;
$total_pages = (int) $careers_query->max_num_pages;
?>

<section class="career-list">

    <!-- Decorative Image -->
    <?= wp_get_attachment_image($decor_image_id, 'full', false, array('class' => 'career-list__decor')) ?>

    <div class="career-list__container">

        <!-- Title -->
        <h2 class="career-list__title">
            Danh sách tuyển dụng
        </h2>

        <!-- Career Items -->
        <div class="career-list__items">
            <?php
            if ($careers_query->have_posts()) {
                while ($careers_query->have_posts()):
                    $careers_query->the_post();
                    get_template_part('template-parts/components/career-item/index');
                endwhile;
                wp_reset_postdata();
            }
            ?>
        </div>

        <!-- Pagination -->
        <?php
        $pagination_data = paginate(array(
            'current' => $paged,
            'max' => $careers_query->max_num_pages,
        ));
        ?>
        <div class="career-list__pagination" style="display: <?= $total_pages > 1 ? 'flex' : 'none'; ?>;">
            <?php if ($pagination_data): ?>
                <div class="career-list__pagination-container">
                    <?php if ($pagination_data['prev']): ?>
                        <button class="career-list__pagination-btn career-list__pagination-btn--prev"
                            data-page="<?php echo esc_attr($pagination_data['prev']); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path
                                    d="M10.0603 13.78C10.1869 13.78 10.3136 13.7333 10.4136 13.6333C10.6069 13.44 10.6069 13.12 10.4136 12.9267L6.06693 8.58001C5.74693 8.26001 5.74693 7.74001 6.06693 7.42001L10.4136 3.07335C10.6069 2.88001 10.6069 2.56001 10.4136 2.36668C10.2203 2.17335 9.90026 2.17335 9.70693 2.36668L5.36026 6.71335C5.02026 7.05335 4.82693 7.51335 4.82693 8.00001C4.82693 8.48668 5.01359 8.94668 5.36026 9.28668L9.70693 13.6333C9.80693 13.7267 9.93359 13.78 10.0603 13.78Z"
                                    fill="#292D32" />
                            </svg>
                        </button>
                    <?php endif; ?>

                    <div class="career-list__pagination-numbers">
                        <?php foreach ($pagination_data['items'] as $page_item): ?>
                            <?php if ($page_item === '…'): ?>
                                <span class="career-list__pagination-ellipsis">…</span>
                            <?php else: ?>
                                <button
                                    class="career-list__pagination-btn <?php echo ($page_item === $pagination_data['current']) ? 'career-list__pagination-btn--active' : ''; ?>"
                                    data-page="<?php echo esc_attr($page_item); ?>">
                                    <?php echo esc_html($page_item); ?>
                                </button>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($pagination_data['next']): ?>
                        <button class="career-list__pagination-btn career-list__pagination-btn--next"
                            data-page="<?php echo esc_attr($pagination_data['next']); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path
                                    d="M5.93974 13.78C5.81307 13.78 5.68641 13.7333 5.58641 13.6333C5.39307 13.44 5.39307 13.12 5.58641 12.9267L9.93307 8.58001C10.2531 8.26001 10.2531 7.74001 9.93307 7.42001L5.58641 3.07335C5.39307 2.88001 5.39307 2.56001 5.58641 2.36668C5.77974 2.17335 6.09974 2.17335 6.29307 2.36668L10.6397 6.71335C10.9797 7.05335 11.1731 7.51335 11.1731 8.00001C11.1731 8.48668 10.9864 8.94668 10.6397 9.28668L6.29307 13.6333C6.19307 13.7267 6.06641 13.78 5.93974 13.78Z"
                                    fill="#292D32" />
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>