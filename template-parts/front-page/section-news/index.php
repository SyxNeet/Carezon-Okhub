<?php
// Get 2 most recent posts for main section
$main_posts_args = array(
    'post_type' => 'post',
    'posts_per_page' => 2,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'ignore_sticky_posts' => true
);

// Get 3 recent posts for sub-section (excluding the ones in main posts)
$main_posts = new WP_Query($main_posts_args);
$exclude_ids = array();

if ($main_posts->have_posts()) {
    while ($main_posts->have_posts()) {
        $main_posts->the_post();
        $exclude_ids[] = get_the_ID();
    }
    wp_reset_postdata();
}

$recent_args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'post__not_in' => $exclude_ids, // Exclude posts already shown in main section
    'orderby' => 'date',
    'order' => 'DESC',
    'ignore_sticky_posts' => true
);

$recent_posts = new WP_Query($recent_args);
$has_posts = $main_posts->have_posts() || $recent_posts->have_posts();
?>

<?php if ($has_posts): ?>
    <section class="section-news">
        <div class="section-news__container">
            <!-- heading -->
            <div class="section-news__heading">
                <h2>Bài viết mới nhất</h2>

                <a class="section-news-button" href="/tin-tuc">
                    <p>Xem tất cả</p>
                    <span>
                        <?= wp_get_attachment_image(59, 'thumbnail', false, array('data-no-lazy' => '1')) ?>
                    </span>
                </a>
            </div>

            <div class="section-news__content">
                <!-- 2 featured posts -->
                <div class="section-news__main-posts">
                    <?php
                    if ($main_posts->have_posts()):
                        while ($main_posts->have_posts()):
                            $main_posts->the_post();
                            get_template_part('template-parts/components/blog-item/index');
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

                <!-- 3 recent posts -->
                <div class="section-news__sub-posts">
                    <?php
                    if ($recent_posts->have_posts()):
                        while ($recent_posts->have_posts()):
                            $recent_posts->the_post();
                            $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                            $categories = get_the_category();
                            $category_name = !empty($categories) ? esc_html($categories[0]->name) : 'Blog';
                            ?>
                            <a href="<?php the_permalink(); ?>">
                                <div class="section-news__sub-posts-card">
                                    <div class="section-news__sub-posts-card__img">
                                        <?php if ($featured_image): ?>
                                            <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title_attribute(); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="section-news__sub-posts-card__content">
                                        <!-- category -->
                                        <div class="section-news__category">
                                            <p><?php echo $category_name; ?></p>
                                        </div>

                                        <!-- title -->
                                        <h4 class="section-news__title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo wp_trim_words(get_the_title(), 10, '...'); ?>
                                            </a>
                                        </h4>

                                        <!-- publish -->
                                        <div class="blog-item__publish">
                                            <span class="blog-item__publish-icon">
                                                <?php echo wp_get_attachment_image(426, 'full', false, array('class' => '')) ?>
                                            </span>
                                            <span class="blog-item__publish-text">
                                                <?php echo get_the_date('d/m/Y'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>