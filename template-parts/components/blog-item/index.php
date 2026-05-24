<?php 
$icon_calendar_id = 426;
?>
<article class="blog-item">
	<a href="<?php the_permalink(); ?>" class="blog-item__link">
		<?php 
		$categories = get_the_category();
		if (!empty($categories)) :
		$first_category = $categories[0];
		?>
		<p class="blog-item__category">
			<span class="blog-item__category-text">
				<?php echo esc_html($first_category->name); ?>
			</span>
		</p>
		<?php endif; ?>
		<div class="blog-item__thumbnail">
			<?php 
			if (has_post_thumbnail()) {
				the_post_thumbnail('full', ['class' => 'blog-item__img','loading' => 'lazy','fetchpriority' => 'low']);
			}
			?>
		</div>
		<div class="blog-item__content">
			<div class="blog-item__publish">
				<span class="blog-item__publish-icon">
					<?php echo wp_get_attachment_image($icon_calendar_id, 'full', false, array('class' => '')) ?>
				</span>
				<span class="blog-item__publish-text">
					<?php echo get_the_date('d/m/Y'); ?>
				</span>
			</div>
			<h3 class="blog-item__title">
				<?php the_title(); ?>
			</h3>
		</div>
	</a>
</article>