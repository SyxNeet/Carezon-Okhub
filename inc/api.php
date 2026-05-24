<?php
/**
 * RESTful API endpoints
 */

// Register REST API route for blog list
add_action('rest_api_init', function () {
    register_rest_route('blog-list/v1', '/posts', array(
        'methods' => 'GET',
        'callback' => 'rest_get_blog_list',
        'permission_callback' => '__return_true',
    ));
    
    register_rest_route('career-list/v1', '/posts', array(
        'methods' => 'GET',
        'callback' => 'rest_get_career_list',
        'permission_callback' => '__return_true',
    ));
});

function rest_get_blog_list($request) {
    // Get filter params from request
    $category_slug = isset($request['category']) ? sanitize_text_field($request['category']) : '';
    $orderby_filter = isset($request['orderby']) ? sanitize_text_field($request['orderby']) : 'newest';
    $search_query = isset($request['search']) ? sanitize_text_field($request['search']) : '';
    // Use 'paged' instead of 'page' to avoid WordPress conflict
    $current_page = isset($request['paged']) ? max(1, intval($request['paged'])) : 1;
    $posts_per_page = isset($request['limit']) ? intval($request['limit']) : 9;

    // Build query args
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $current_page,
    );

    // Filter by category (convert slug to ID)
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

    // Start output buffering
    ob_start();

    if ($blog_query->have_posts()):
        ?>
        <div class="blog-list__grid">
            <?php while ($blog_query->have_posts()): $blog_query->the_post(); ?>
                <?php get_template_part('template-parts/components/blog-item/index'); ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <?php
    else:
        ?>
        <p class="blog-list__no-results">Không tìm thấy bài viết nào.</p>
        <?php
    endif;

    $html = ob_get_clean();

    // Get pagination
    $pagination_html = '';
    if ($blog_query->have_posts() && $blog_query->max_num_pages > 1) {
        $pagination_data = paginate(array(
            'current' => $current_page,
            'max' => $blog_query->max_num_pages,
        ));

        if ($pagination_data) {
            ob_start();
            ?>
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
                                data-page="<?php echo esc_attr($page_item); ?>"
                            >
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
            <?php
            $pagination_html = ob_get_clean();
        }
    }

    return new WP_REST_Response(array(
        'html' => $html,
        'pagination' => $pagination_html,
        'has_pagination' => !empty($pagination_html),
    ), 200);
}

function rest_get_career_list($request)
{
    $current_page = isset($request['paged']) ? max(1, intval($request['paged'])) : 1;
    $posts_per_page = isset($request['limit']) ? intval($request['limit']) : 9;

    $args = array(
        'post_type' => 'career',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $current_page,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $careers_query = new WP_Query($args);

    ob_start();

    if ($careers_query->have_posts()):
        while ($careers_query->have_posts()):
            $careers_query->the_post();
            get_template_part('template-parts/components/career-item/index');
        endwhile;
        wp_reset_postdata();
    else:
        ?>
        <p class="career-list__no-results">Không tìm thấy tin tuyển dụng nào.</p>
        <?php
    endif;

    $html = ob_get_clean();

    $pagination_html = '';
    if ($careers_query->have_posts() && $careers_query->max_num_pages > 1) {
        $pagination_data = paginate(array(
            'current' => $current_page,
            'max' => $careers_query->max_num_pages,
        ));

        if ($pagination_data) {
            ob_start();
            ?>
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
            <?php
            $pagination_html = ob_get_clean();
        }
    }

    return new WP_REST_Response(array(
        'html' => $html,
        'pagination' => $pagination_html,
        'has_pagination' => !empty($pagination_html),
    ), 200);
}

