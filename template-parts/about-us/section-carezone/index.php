<?php
$background_mb = 1382;

$background_sky = 1383;
$background_green = 1384;
$roof = 1385;
$flash_light = 1386;

$lachuoiblur = 1387;

$lachuoi_bottom_left = 1388;
$lachuoi_left = 1389;
$lachuoi_right = 1390;
$background_content = 1391;
$deco_content_1 = 1392;
$deco_content_2 = 1393;
$home = 1394;

$section_carezone_acf = get_field('section-carezone');

$carezone_logo        = $section_carezone_acf['logo'] ?? '';
$carezone_description = $section_carezone_acf['description'] ?? '';
?>

<section class="section-carezone">
    <div class="static-deco is_pc">
        <?php echo wp_get_attachment_image($background_sky, 'full', false, array( 'class' => 'background-sky')) ?>
        <?php echo wp_get_attachment_image($roof, 'full', false, array( 'class' => 'roof')) ?>
        <?php echo wp_get_attachment_image($background_green, 'full', false, array( 'class' => 'background-green')) ?>

    </div>
    <div class="dynamic-deco is_pc">
        <?php echo wp_get_attachment_image($flash_light, 'full', false, array( 'class' => 'flash-light')) ?>
        <?php echo wp_get_attachment_image($lachuoiblur, 'full', false, array( 'class' => 'lachuoiblur')) ?>
        <?php echo wp_get_attachment_image($lachuoi_bottom_left, 'full', false, array( 'class' => 'lachuoi-bottom-left')) ?>
        <?php echo wp_get_attachment_image($lachuoi_left, 'full', false, array( 'class' => 'lachuoi-left')) ?>
        <?php echo wp_get_attachment_image($lachuoi_right, 'full', false, array( 'class' => 'lachuoi-right')) ?>
        <?php echo wp_get_attachment_image($home, 'full', false, array( 'class' => 'deco-home')) ?>
        <div class="carezone-content">
            <?php echo wp_get_attachment_image($deco_content_1, 'full', false, array( 'class' => 'deco-content deco-content-1')) ?>
            <?php echo wp_get_attachment_image($deco_content_2, 'full', false, array( 'class' => 'deco-content deco-content-2')) ?>
            <div class="content-shadow"></div>
            <?php echo wp_get_attachment_image($background_content, 'full', false, array( 'class' => 'background-content')) ?>
            <div class="carezone-content___wrapper">
                <?php if ($carezone_logo) : ?>
                <?php echo wp_get_attachment_image($carezone_logo, 'full', false, array(
            'class' => 'carezone-content__logo',
            'loading' => 'lazy',
        )); ?>
                <?php endif; ?>

                <?php if ($carezone_description) : ?>
                <div class="carezone-content__text">
                    <?= nl2br(esc_html($carezone_description)); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="content-mb is_mb">
        <?php echo wp_get_attachment_image($background_mb, 'full', false, array( 'class' => 'background-mb')) ?>
        <?php echo wp_get_attachment_image($roof, 'full', false, array( 'class' => 'roof')) ?>
        <div class="carezone-content___wrapper">
            <?php if ($carezone_logo) : ?>
            <?php echo wp_get_attachment_image($carezone_logo, 'full', false, array(
            'class' => 'carezone-content__logo',
            'loading' => 'lazy',
        )); ?>
            <?php endif; ?>

            <?php if ($carezone_description) : ?>
            <div class="carezone-content__text">
                <?= nl2br(esc_html($carezone_description)); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>