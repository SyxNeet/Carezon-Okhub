<?php 
$icon_arrow_right_id = 434;

// Lấy category của bài viết hiện tại
$current_post_id = get_the_ID();
$current_categories = wp_get_post_categories($current_post_id);

$args = array(
	'posts_per_page' => 3,
	'post__not_in' => array($current_post_id), // loại trừ bài hiện tại
	'category__in' => $current_categories,     // cùng chuyên mục
	'orderby' => 'date',
	'order' => 'DESC',
);

$related_posts = new WP_Query($args);
?>

<?php if ($related_posts->have_posts()): ?>
<section class="blog-related">
	<div class="blog-related-container">
		<div class="blog-related__header">
			<div class="blog-related__title">
				Bài viết liên quan
			</div>
			<a href="" class="blog-related__btn-more">
				<span class="blog-related__btn-more-text--mb">Xem thêm→</span>
				<span class="blog-related__btn-more-text">Xem thêm</span>
				<span class="blog-related__btn-more-icon">
					<?php echo wp_get_attachment_image($icon_arrow_right_id, 'full', false, array( 'class' => '')) ?>
				</span>
			</a>
		</div>
		<div class="blog-related__main">
			<div class="blog-related__grid">
				<?php while ($related_posts->have_posts()): $related_posts->the_post(); ?>
					<?php get_template_part('/template-parts/components/blog-item/index');?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>