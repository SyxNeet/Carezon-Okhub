<?php 
$blogs_page_id = 435;

$home_id = get_option('page_on_front');
$home_title = get_the_title($home_id);  
$home_url = get_permalink($home_id);

$icon_share_copy = 428;
$icon_share_facebook = 429;
$icon_share_linkedin = 430;
$icon_share_twitter = 431;
$icon_close = 432;
$icon_chevron_up = 433;

// Lấy content và tạo mục lục cho SEO
function generateTOC($content) {
	// 1️⃣ Xóa các shortcode [caption] để tránh match sai
	$clean_content = preg_replace('/\[caption[^\]]*\].*?\[\/caption\]/is', '', $content);

	// 2️⃣ Lấy tất cả heading H2–H6
	preg_match_all('/<(h[2-6])[^>]*>(.*?)<\/h[2-6]>/i', $clean_content, $matches, PREG_SET_ORDER);

	$toc = [];
	$slug_counts = [];

	foreach ($matches as $index => $match) {
		$tag   = strtolower($match[1]);
		$title = trim(strip_tags($match[2]));

		// 3️⃣ Sinh slug chuẩn SEO (ví dụ: "Chọn Spa Phù Hợp Với Nhu Cầu" → "chon-spa-phu-hop-voi-nhu-cau")
		$slug = sanitize_title($title);

		// 4️⃣ Nếu slug bị trùng → thêm hậu tố -2, -3,...
		if (isset($slug_counts[$slug])) {
			$slug_counts[$slug]++;
			$slug .= '-' . $slug_counts[$slug];
		} else {
			$slug_counts[$slug] = 1;
		}

		// 5️⃣ Thêm tiền tố heading-
		$anchor = 'heading-' . $slug;

		// 6️⃣ Sinh lại heading mới có id + data attribute
		$new_heading = sprintf(
			'<%1$s id="%2$s" data-toc-target="%2$s" class="toc-heading">%3$s</%1$s>',
			esc_attr($tag),
			esc_attr($anchor),
			$match[2]
		);

		// 7️⃣ Thay thế duy nhất 1 lần trong content (tránh replace trùng)
		$content = preg_replace('/' . preg_quote($match[0], '/') . '/', $new_heading, $content, 1);

		// 8️⃣ Ghi vào danh sách mục lục
		$toc[] = [
			'anchor' => $anchor,
			'title'  => $title,
			'level'  => intval(substr($tag, 1))
		];
	}

	// 9️⃣ Trả kết quả
	return [
		'content' => $content,
		'toc'     => $toc
	];
}

$blog_content = get_the_content();
$content_data = generateTOC($blog_content);
$author_name = get_field('author_name');


$is_mobile = isMobileDevice();
?>

<nav class="breadcrumb">
	<ul class="breadcrumb-list">
		<li class="breadcrumb-item">
			<a href="<?php echo $home_url; ?>" class="breadcrumb-link">
				<?php echo $home_title; ?>
			</a>
		</li>
		<li class="breadcrumb-item">
			<a href="<?php echo get_permalink($blogs_page_id); ?>" class="breadcrumb-link">
				/ <?php echo get_the_title($blogs_page_id); ?>
			</a>
		</li>
		<li class="breadcrumb-item">
			<p class="breadcrumb-link">/ <?php the_title(); ?></p>
		</li>
	</ul>
</nav>

<!-- Section: Blog detail -->
<section class="blog-detail">
	<!-- Tiêu đề của bài viết -->
	<div class="blog-detail__title-container">
		<h1 class="blog-detail__title">
			<?php the_title(); ?>
		</h1>
	</div>

	<div class="blog-detail__content-container">
		<div class="blog-detail__content">
			<!-- Nội dung của bài viết -->
			<div id="blog-detail-content" class="blog-detail__content-main">
				<?php echo apply_filters('the_content', $content_data['content']); ?>
			</div>

			<!-- Thông tin của bài viết -->
			<div class="blog-detail__content-footer">
				<div class="blog-detail__content-footer__meta">
					<!-- Tác giả -->
					<p id="blog-detail-author" class="blog-detail__content-footer__meta-item">
						<span class="blog-detail__content-footer__meta-item__label">Đăng bởi:</span>
						<span class="blog-detail__content-footer__meta-item__value">
							<?= $author_name ?? '' ?>
						</span>
					</p>
					<!-- Ngày đăng -->
					<p id="blog-detail-publish" class="blog-detail__content-footer__meta-item">
						<span class="blog-detail__content-footer__meta-item__label">Ngày đăng:</span>
						<span class="blog-detail__content-footer__meta-item__value">
							<?php echo get_the_date('d/m/Y'); ?>
						</span>
					</p>
				</div>
				<!-- Share -->
				<div class="blog-detail__content-footer__share">
					<span class="blog-detail__content-footer__share-label">Chia sẻ:</span>
					<ul class="blog-detail__content-footer__share-list">
						<li class="blog-detail__content-footer__share-item">
							<p id="blog-detail-share-copy" class="blog-detail__content-footer__share-item__btn">
								<?php echo wp_get_attachment_image($icon_share_copy, 'full', false, array( 'class' =>
																										  '')) ?>
							</p>
						</li>
						<li class="blog-detail__content-footer__share-item">
							<a
							   id="blog-detail-share-facebook"
							   href="https://www.facebook.com/sharer/sharer.php?u=<?= get_permalink(); ?>"
							   target="_blank"
							   class="blog-detail__content-footer__share-item__btn"
							   >
								<?php echo wp_get_attachment_image($icon_share_facebook, 'full', false, array( 'class' =>
																											  '')) ?>
							</a>
						</li>
						<li class="blog-detail__content-footer__share-item">
							<a
							   id="blog-detail-share-linkedin"
							   href="https://www.linkedin.com/sharing/share-offsite/?url=<?= get_permalink(); ?>"
							   target="_blank"
							   class="blog-detail__content-footer__share-item__btn"
							   >
								<?php echo wp_get_attachment_image($icon_share_linkedin, 'full', false, array( 'class' =>
																											  '')) ?>
							</a>
						</li>
						<li class="blog-detail__content-footer__share-item">
							<a
							   id="blog-detail-share-twitter"
							   href="https://twitter.com/intent/tweet?url=<?= get_permalink(); ?>"
							   target="_blank"
							   class="blog-detail__content-footer__share-item__btn"
							   >
								<?php echo wp_get_attachment_image($icon_share_twitter, 'full', false, array( 'class' =>
																											 '')) ?>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<?php if(!$is_mobile): ?>
		<div div class="blog-detail__toc-container">
			<div class="blog-detail__toc">
				<?php if (!empty($content_data['toc'])): ?>
				<?php 
				$toc_total = count($content_data['toc']);
				$max_visible = 10;
				?>
				<p class="blog-detail__toc-title">Mục lục bài viết</p>

				<ul class="blog-detail__toc-content <?php echo ($toc_total > $max_visible) ? 'is-collapsed' : ''; ?>" id="table-of-contents">
					<?php foreach ($content_data['toc'] as $index =>
								   $item): ?>
					<li
						class="toc-level-<?php echo $item['level']; ?> blog-detail__toc-level-<?php echo $item['level']; ?> <?php echo ($index >= $max_visible) ? 'hidden-item' : ''; ?>"
						>
						<span class="toc-item blog-detail__toc-item" data-target="<?php echo esc_attr($item['anchor']); ?>">
							<?php echo esc_html($item['title']); ?>
						</span>
					</li>
					<?php endforeach; ?>
				</ul>

				<?php if ($toc_total > $max_visible): ?>
				<button class="blog-detail__toc-btn-toggle" type="button">
					<span class="blog-detail__toc-btn-toggle__content">Xem thêm</span>
				</button>
				<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php if($is_mobile): ?>
<button id="blog-toc-btn-trigger" class="blog-toc__btn-trigger-container">
	<p class="blog-toc__btn-trigger__title">Mục lục bài viết</p>
	<?php echo wp_get_attachment_image($icon_chevron_up, 'full', false, array( 'class' => 'blog-toc__btn-trigger__icon')) ?>
</button>
<div id="blog-detail-drawer" class="blog-toc__drawer-container">
	<div class="blog-toc__drawer-overlay"></div>
	<div class="blog-toc__drawer-main">
		<div class="blog-toc__drawer-title-container">
			<p class="blog-toc__drawer-title">Mục lục bài viết</p>
			<button class="blog-toc__drawer-close-btn">
				<?php echo wp_get_attachment_image($icon_close, 'full', false, array( 'class' => '')) ?>
			</button>
		</div>
		<div class="blog-toc__drawer-content-container">
			<div class="blog-toc__drawer-content-main">
				<?php if (!empty($content_data['toc'])): ?>
				<?php 
				$toc_total = count($content_data['toc']);
				$max_visible = 10;
				?>
				<ul class="blog-detail__toc-content <?php echo ($toc_total > $max_visible) ? 'is-collapsed' : ''; ?>" id="table-of-contents">
					<?php foreach ($content_data['toc'] as $index =>
								   $item): ?>
					<li
						class="toc-level-<?php echo $item['level']; ?> blog-detail__toc-level-<?php echo $item['level']; ?> <?php echo ($index >= $max_visible) ? 'hidden-item' : ''; ?>"
						>
						<span class="toc-item blog-detail__toc-item" data-target="<?php echo esc_attr($item['anchor']); ?>">
							<?php echo esc_html($item['title']); ?>
						</span>
					</li>
					<?php endforeach; ?>
				</ul>

				<?php if ($toc_total > $max_visible): ?>
				<button class="blog-detail__toc-btn-toggle" type="button">
					<span class="blog-detail__toc-btn-toggle__content">Xem thêm</span>
				</button>
				<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>