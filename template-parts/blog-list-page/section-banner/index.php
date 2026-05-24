<?php 

$banner = get_field('banner');
$title = $banner['title'];
$text_decor = $banner['text_decor'];
$image_decor = $banner['image_decor'];
$background_pc = $banner['background_pc'];
$background_mobile = $banner['background_mobile'];

$home_id = get_option('page_on_front');
$home_title = get_the_title($home_id);  
$home_url = get_permalink($home_id);
?>

<section class="blog-list-banner">
	<div class="blog-list-banner__background banner__background--pc">
		<?= wp_get_attachment_image($background_pc, 'full', false, array( 'class' => '')) ?>
	</div>
	<div class="blog-list-banner__background blog-list-banner__background--mobile">
		<?= wp_get_attachment_image($background_mobile, 'full', false, array( 'class' => '')) ?>
	</div>
	<div class="blog-list-banner__image-decor">
		<?= wp_get_attachment_image($image_decor, 'full', false, array( 'class' => '')) ?>
	</div>
	<div class="blog-list-banner__overlay"></div>
	<div class="blog-list-banner__content-wrapper">
		<div class="blog-list-banner__content-inner">
			<nav class="blog-list-banner__breadcrumb">
				<ul class="blog-list-banner__breadcrumb-list">
					<li class="blog-list-banner__breadcrumb-item">
						<a href="<?= $home_url; ?>" class="blog-list-banner__breadcrumb-item__link">
							<?= $home_title; ?>
						</a>
					</li>
					<li class="blog-list-banner__breadcrumb-item">
						<p class="blog-list-banner__breadcrumb-item__link">
							<?php echo get_the_title(); ?>
						</p>
					</li>
				</ul>
			</nav>
			<p class="blog-list-banner__text-decor">
				<?= $text_decor; ?>
			</p>
			<h1 class="blog-list-banner__title">
				<?= $title; ?>
			</h1>
		</div>
	</div>
</section>