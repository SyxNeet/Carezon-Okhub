<?php
$background_tong = 1395;
$background_sky= 1383;
$background_tong_mb = 1396;
$section_vision_acf = get_field('seciton-vision');

$vision_title       = $section_vision_acf['title'] ?? '';
$vision_description = $section_vision_acf['description'] ?? '';
$vision_items       = $section_vision_acf['vision'] ?? [];
?>

<section class="seciton-vision">
    <div class="bg-overlay"></div>

    <?php echo wp_get_attachment_image($background_sky, 'full', false, array('class' => 'background-sky')) ?>

    <div class="background-tong__wrapper">
        <?php echo wp_get_attachment_image($background_tong, 'full', false, array('class' => 'background-tong')) ?>
        <div class="background-tong__ovelay"></div>
    </div>

    <div class="vision-content">
        <div class="vision-content__heading">
            <?php if ($vision_title) : ?>
            <div class="vision-content__title">
                <?= esc_html($vision_title); ?>
            </div>
            <?php endif; ?>

            <?php if ($vision_description) : ?>
            <div class="vision-content__desc">
                <?= nl2br(esc_html($vision_description)); ?>
            </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($vision_items)) : ?>
        <div class="vision-content__wrapper">
            <?php foreach ($vision_items as $index => $item) :
                    $image       = $item['image'] ?? '';
                    $title       = $item['title'] ?? '';
                    $description = $item['description'] ?? '';
                ?>
            <div class="vision-content__item">
                <?php if ($image) : ?>
                <?php echo wp_get_attachment_image($image, 'full', false, array(
                                'class' => 'vision-content__item--image',
                                'loading' => 'lazy',
                            )); ?>
                <?php endif; ?>

                <span class="vision-content__item--number">
                    <?= esc_html(sprintf('%02d', $index + 1)); ?>
                </span>

                <div class="vision-content__item--content">
                    <?php if ($title) : ?>
                    <div class="vision-content__item--title">
                        <?= esc_html($title); ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($description) : ?>
                    <div class="vision-content__item--desc">
                        <?= nl2br(esc_html($description)); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>