<?php
// Add CSS to hide footer - using wp_head with high priority
add_action('wp_head', function () {
    echo '<style>
        footer, 
        .site-footer, 
        #footer, 
        .footer, 
        .footer-wrapper, 
        .site-footer-wrapper, 
        .site-info { 
            display: none !important; 
            visibility: hidden !important; 
            height: 0 !important; 
            width: 0 !important; 
            padding: 0 !important; 
            margin: 0 !important; 
            overflow: hidden !important; 
            position: absolute !important; 
            clip: rect(0, 0, 0, 0) !important; 
        }
    </style>';
}, 1); // Using priority 1 to ensure it's added early

get_header();
?>
<section class="error-section">
    <div class="error-section__container">
        <div class="error-section__content">
            <div class="error-section__content-text">
                <h1 class="error-section__content-text-h1">404</h1>
                <p class="error-section__content-text-p1">Đã xảy ra lỗi. Vui lòng thử lại sau!</p>
                <p class="error-section__content-text-p2">Vui lòng tải lại trang hoặc quay lại sau vài phút.</p>
            </div>
            <a class="error-section__content-button" href="/">
                <p>Về trang chủ</p>
                <span>
                    <?= wp_get_attachment_image(59, 'thumbnail', false, array('data-no-lazy' => '1')) ?>
                </span>
            </a>
        </div>
    </div>

    <div class="error-section__cta">
        <?php get_template_part('template-parts/components/cta-social/index'); ?>
    </div>

    <!-- decorations -->
    <div class="error-section__decorations">
        <div class="error-section__decorations-item1">
            <?= wp_get_attachment_image(544, 'full', false, array('data-no-lazy' => '1', 'alt' => '')) ?>
        </div>
        <div class="error-section__decorations-item2">
            <?= wp_get_attachment_image(543, 'full', false, array('data-no-lazy' => '1', 'alt' => '')) ?>
        </div>
        <div class="error-section__decorations-item3">
            <?= wp_get_attachment_image(542, 'full', false, array('data-no-lazy' => '1', 'alt' => '')) ?>
        </div>
    </div>

    <!-- texture -->
    <div class="error-section__texture">
        <div class="error-section__texture-item">
            <?= wp_get_attachment_image(385, 'full', false, array('data-no-lazy' => '1', 'alt' => '')) ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>