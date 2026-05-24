<?php
$background_story = 1379;
$leaf_story = 1378;
$section_story_acf = get_field('section-story');
$story_title           = $section_story_acf['title'] ?? '';
$story_description     = $section_story_acf['description'] ?? '';
$story_sub_description = $section_story_acf['sub_description'] ?? '';
$story_items           = $section_story_acf['items'] ?? [];
?>

<section class="section-story">
    <?php echo wp_get_attachment_image($background_story, 'full', false, array('class' => 'background_story')) ?>
    <?php echo wp_get_attachment_image($leaf_story, 'full', false, array('class' => 'leaf_story')) ?>
    <?php get_template_part('template-parts/components/deco-right-leaf/index', null, [ 'section' => 'section-story']);?>
    <div class="story-content">
        <div class="content-left">
            <?php if ($story_title) : ?>
            <div class="content__title">
                <?= esc_html($story_title); ?>
            </div>
            <?php endif; ?>

            <?php if ($story_description) : ?>
            <div class="content__desc">
                <?= esc_html($story_description); ?>
            </div>
            <?php endif; ?>

            <?php if ($story_sub_description) : ?>
            <div class="content__small">
                <?= esc_html($story_sub_description); ?>
            </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($story_items)) : ?>
        <div class="content-right">
            <?php foreach ($story_items as $item) :
                    $icon  = $item['icon'] ?? '';
                    $title = $item['title'] ?? '';
                ?>
            <div class="content-right__item">
                <?php if ($icon) : ?>
                <?php echo wp_get_attachment_image($icon, 'full', false, array(
                                'class' => 'content-right__item--icon',
                                'loading' => 'lazy',
                            )); ?>
                <?php endif; ?>

                <?php if ($title) : ?>
                <div class="content-right__item--title">
                    <?= esc_html($title); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="content-right__overlay"></div>
</section>