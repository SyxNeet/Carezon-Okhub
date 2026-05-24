<?php
// Get header options from ACF
$header = get_field('main_menu', 'option');
$header_logo = isset($header['logo']) ? $header['logo'] : null;
$header_link = isset($header['link']) ? $header['link'] : null;

// Get current page type for JavaScript
$page_type = '';
if (is_single()) {
    $post_type = get_post_type();
    $page_type = "single-{$post_type}";
} elseif (is_archive()) {
    $post_type = get_post_type();
    $page_type = "archive-{$post_type}";
} elseif (is_page()) {
    $page_slug = get_post_field('post_name');
    $page_type = "page-{$page_slug}";
}

// Special page types that need header--color class
$special_page_types = [
    'single-tours',
    'single-products',
    'single-services',
    'archive-tours',
    'archive-products',
];

// Build header classes
$header_classes = ['header'];
if (in_array($page_type, $special_page_types)) {
    $header_classes[] = 'header--color';
} else {
    $header_classes[] = 'header--transparent';
}
?>

<header class="<?= esc_attr(implode(' ', $header_classes)) ?>" id="header" data-page-type="<?= esc_attr($page_type) ?>">
    <nav class="header__nav">
        <div class="header__left">
            <button class="header__menu-btn" type="button" aria-label="Toggle menu">
                <?= wp_get_attachment_image(61, 'thumbnail', false, array('class' => 'header__menu-icon', 'data-no-lazy' => '1')) ?>
                <span>Menu</span>
            </button>
        </div>
        <a class="header__center" href="<?= home_url() ?>">
            <?php if ($header_logo): ?>
                <?= wp_get_attachment_image($header_logo, 'medium', false, array('class' => 'header__logo', 'data-no-lazy' => '1')) ?>
            <?php endif; ?>
        </a>
        <div class="header__right">
            <?php if ($header_link && isset($header_link['url']) && !empty($header_link['url'])):
                $header_link_text = $header_link['title'];
                $header_link_url = esc_url($header_link['url']);
                $header_link_target = esc_attr($header_link['target']);
                ?>
                <a href="<?= $header_link_url ?>" target="<?= $header_link_target ?>" class="header__contact-btn">
                    <p><?= esc_html($header_link_text) ?></p>
                    <span>
                        <?= wp_get_attachment_image(59, 'icon', false, array('data-no-lazy' => '1')) ?>
                    </span>
                </a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<?php get_template_part('template-parts/components/main-menu-v2/index'); ?>