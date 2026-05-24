<?php
$background_aspiration_pc = 1380;
$background_aspiration_mb = 1381;

$section_aspiration_acf = get_field('section-aspiration');

$aspiration_title       = $section_aspiration_acf['title'] ?? '';
$aspiration_description = $section_aspiration_acf['descriptioon'] ?? '';
$aspiration_items       = $section_aspiration_acf['aspirations'] ?? [];
?>


<section class="section-aspiration">
    <div class="aspiration-container">
        <?php echo wp_get_attachment_image($background_aspiration_pc, 'full', false, array('class' => 'background_aspiration is_pc')) ?>
        <?php echo wp_get_attachment_image($background_aspiration_mb, 'full', false, array('class' => 'background_aspiration is_mb')) ?>

        <div class="aspiration-content">
            <div class="aspiration-content__heading">
                <?php if ($aspiration_title) : ?>
                <div class="aspiration-content__title">
                    <?= esc_html($aspiration_title); ?>
                </div>
                <?php endif; ?>

                <?php if ($aspiration_description) : ?>
                <div class="aspiration-content__desc">
                    <?= esc_html($aspiration_description); ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($aspiration_items)) : ?>
            <div class="aspiration-content__wrapper">
                <?php foreach ($aspiration_items as $item) :
                        $icon        = $item['icon'] ?? '';
                        $title       = $item['title'] ?? '';
                        $description = $item['description'] ?? '';
                    ?>
                <div class="aspiration-content__item">
                    <?php if ($icon) : ?>
                    <div class="aspiration-content__item--image">
                        <?php echo wp_get_attachment_image($icon, 'full', false, array(
                                        'class' => '',
                                        'loading' => 'lazy',
                                    )); ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($title) : ?>
                    <div class="aspiration-content__item--title">
                        <?= esc_html($title); ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($description) : ?>
                    <div class="aspiration-content__item--desc">
                        <?= esc_html($description); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>