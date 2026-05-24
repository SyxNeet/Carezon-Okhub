<?php
$icon_arrow_right_id = 904;
$background_pc_id = 902;
$background_mobile_id = 903;

$blog_featured = get_field('blog_featured');
$image_decor = $blog_featured['image_decor'];
$image_decor_2 = $blog_featured['image_decor_2'];
$blog_featured_items = $blog_featured['items'];
?>

<section class="blog-featured">
	<h2 class="blog-featured__title">Bài viết nổi bật</h2>
	<div class="blog-featured__image-decor">
		<?= wp_get_attachment_image($image_decor, 'full', false, array('class' => '')) ?>
	</div>
	<div class="blog-featured__image-decor-2">
		<?= wp_get_attachment_image($image_decor_2, 'full', false, array('class' => '')) ?>
	</div>
	<div class="blog-featured-container">
		<div class="blog-featured-inner">
			<div class="blog-featured__background blog-featured__background--pc">
				<?= wp_get_attachment_image($background_pc_id, 'full', false, array('class' => '')) ?>
			</div>
			<div class="blog-featured__background blog-featured__background--mobile">
				<?= wp_get_attachment_image($background_mobile_id, 'full', false, array('class' => '')) ?>
			</div>
			<div class="blog-featured__swiper-thumbnail swiper">
				<div class="swiper-wrapper blog-featured__swiper-thumbnail-wrapper">
					<?php foreach ($blog_featured_items as $post):
						setup_postdata($post); ?>
						<div class="swiper-slide blog-featured__swiper-thumbnail-slide">
							<div class="blog-featured__thumbnail">
								<?php
								if (has_post_thumbnail($post->ID)) {
									echo get_the_post_thumbnail($post->ID, 'medium_large', [
										'class' => 'blog-featured__thumbnail-img',
										'loading' => 'lazy',
									]);
								}
								?>
							</div>
						</div>
					<?php endforeach;
					wp_reset_postdata(); ?>
				</div>
				<div class="blog-featured__swiper-thumbnail-pagination-container">
					<div class="swiper-pagination blog-featured__swiper-thumbnail-pagination"></div>
				</div>
			</div>
			<div class="blog-featured__swiper-content swiper">
				<div class="swiper-wrapper blog-featured__swiper-content-wrapper">
					<?php foreach ($blog_featured_items as $post):
						setup_postdata($post); ?>
						<div data-link="<?= esc_url(get_permalink($post)); ?>"
							class="swiper-slide blog-featured__swiper-content-slide">
							<div class="blog-featured__swiper-content-slide__content">
								<?php
								$categories = get_the_category($post->ID);
								if (!empty($categories)):
									$first_category = $categories[0];
									?>
									<p class="blog-featured__swiper-content-slide__category">
										<span class="blog-featured__swiper-content-slide__category-text">
											<?= esc_html($first_category->name); ?>
										</span>
									</p>
								<?php endif; ?>
								<h3 class="blog-featured__swiper-content-slide__title">
									<a href="<?= esc_url(get_permalink($post)); ?>">
										<?= esc_html(get_the_title($post)); ?>
									</a>
								</h3>
								<?php if (has_excerpt($post)): ?>
									<p class="blog-featured__swiper-content-slide__excerpt">
										<?= get_the_excerpt($post); ?>
									</p>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach;
					wp_reset_postdata(); ?>
				</div>
				<div class="blog-featured__swiper-cta">
					<div class="blog-featured__swiper-nav">
						<button class="blog-featured__swiper-nav-btn blog-featured__swiper-nav-btn--prev">
							<?= wp_get_attachment_image($icon_arrow_right_id, 'full', false, array('class' => '')) ?>
						</button>
						<button class="blog-featured__swiper-nav-btn blog-featured__swiper-nav-btn--next">
							<?= wp_get_attachment_image($icon_arrow_right_id, 'full', false, array('class' => '')) ?>
						</button>
					</div>
					<a href="" id="blog-featured-btn-detail" class="blog-featured__btn-detail">
						<p class="blog-featured__btn-detail-text--mb">Xem chi tiết →</p>
						<p class="blog-featured__btn-detail-text">Xem chi tiết</p>
						<span class="blog-featured__btn-detail-icon">
							<?= wp_get_attachment_image(59, 'icon', false, array('data-no-lazy' => '1')) ?>
						</span>
					</a>

				</div>
			</div>
		</div>
	</div>
</section>