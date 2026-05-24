<?php
$home_mindful_living = get_field('home_mindful_living');
$title_line_1 = isset($home_mindful_living['title_line_1']) ? $home_mindful_living['title_line_1'] : '';
$title_line_2 = isset($home_mindful_living['title_line_2']) ? $home_mindful_living['title_line_2'] : '';
$link = isset($home_mindful_living['link']) ? $home_mindful_living['link'] : '';
$background = isset($home_mindful_living['background']) ? $home_mindful_living['background'] : '';
$background_mb = isset($home_mindful_living['background_mb']) ? $home_mindful_living['background_mb'] : '';
?>
<section class="mindful-living">
    <div class="mindful-living__image-wrapper"
        style="--mask-image: url('<?= wp_get_attachment_image_url(180, 'full') ?>')">
        <?= wp_get_attachment_image($background, 'full', false, array('class' => 'mindful-living__image')); ?>
        <?= IS_MOBILE ? wp_get_attachment_image($background_mb, 'full', false, array('class' => 'mindful-living__image-mobile')) : ''; ?>
    </div>
    <?= wp_get_attachment_image(121, 'full', false, array('class' => 'mindful-living__border')); ?>
    <?= wp_get_attachment_image(181, 'full', false, array('class' => 'mindful-living__leaf')); ?>
    <?= IS_MOBILE ? wp_get_attachment_image(250, 'full', false, array('class' => 'mindful-living__leaf-mobile')) : ''; ?>
    <?php if ($link):
        $link_title = isset($link['title']) ? $link['title'] : '';
        $link_url = isset($link['url']) ? $link['url'] : '';
        $link_target = isset($link['target']) ? $link['target'] : '';
        ?>
        <div class="mindful-living__link">
            <a href="<?= $link_url ?>" target="<?= $link_target ?>" class="mindful-living__link--btn">
                <p class="mindful-living__link--content">
                    LIÊN HỆ <br> TƯ VẤN NGAY
                </p>
                <?= wp_get_attachment_image(69, 'thumbnail'); ?>
            </a>
        </div>

    <?php endif; ?>
    <div class=" mindful-living__content">
        <p class="mindful-living__title">
            <?= $title_line_1 ?>
        </p>
        <p class="mindful-living__subtitle">
            <?= $title_line_2 ?>
        </p>
    </div>
</section>