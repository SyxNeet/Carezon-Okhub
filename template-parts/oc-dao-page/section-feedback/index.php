<?php
$icon_prev_id = 830;
$icon_prev_mobile_id = 828;
$icon_pause_id = 829;
$icon_play_id = 840;

$home_contact = get_field('home_contact');
$link = isset($home_contact['link']) ? $home_contact['link'] : '';
$feedback = isset($home_contact['feedback']) ? $home_contact['feedback'] : '';
$title_line_1 = isset($home_contact['title_line_1']) ? $home_contact['title_line_1'] : '';
$title_line_2 = isset($home_contact['title_line_2']) ? $home_contact['title_line_2'] : '';
$achievement = isset($home_contact['achievement']) ? $home_contact['achievement'] : '';
$option_booking_services = get_field('option_booking_services', 'option');
?>

<div class="background">
    <?= wp_get_attachment_image(909, 'full', false, array('class' => 'background__image--bg')); ?>
    <?= wp_get_attachment_image(184, 'full', false, array('class' => 'background__image--left')); ?>
    <?= wp_get_attachment_image(185, 'full', false, array('class' => 'background__image--right')); ?>
    <?= wp_get_attachment_image(191, 'full', false, array('class' => 'background__image--bottom')); ?>

    <section class="values">
        <?= wp_get_attachment_image(907, 'full', false, array('class' => 'values__bg--left')); ?>
        <?= wp_get_attachment_image(908, 'full', false, array('class' => 'values__bg--right')); ?>
        <?= wp_get_attachment_image(190, 'full', false, array('class' => 'values__bg--bottom')); ?>

        <div class="values__header">
            <p class="values__title">Carezone</p>
            <div class="values__intro">
                <?= $title_line_1 ?><br>
                <span class="values__intro-text">
                    <?= $title_line_2 ?>
                </span>
            </div>
        </div>
        <?php if ($feedback): ?>
            <div class="feedback">
                <div class="feedback__swiper swiper">
                    <div class="feedback__swiper-wrapper swiper-wrapper">
                        <?php foreach ($feedback as $item): ?>
                            <div class="feedback__swiper-slide swiper-slide">
                                <div class="feedback__card">

                                    <?= wp_get_attachment_image(208, 'full', false, array('class' => 'feedback__background')); ?>

                                    <div id="feedback-socials" class="feedback__socials">
                                        <?php
                                        $single_feedback = get_field('single_feedback', $item->ID);
                                        $contact = isset($single_feedback['contact']) ? $single_feedback['contact'] : '';
                                        if ($contact):
                                            foreach ($contact as $contact_item):
                                                $icon = isset($contact_item['icon']) ? $contact_item['icon'] : '';
                                                $link = isset($contact_item['link']) ? $contact_item['link'] : '';
                                                $link_url = isset($contact_item['link_url']) ? $contact_item['link_url'] : '';
                                                $link_title = isset($contact_item['link_title']) ? $contact_item['link_title'] : '';
                                                $link_target = isset($contact_item['link_target']) ? $contact_item['link_target'] : '';
                                        ?>

                                                <a href="<?= $link_url ?>" <?= $link_target ? 'target="' . $link_target . '"' : '' ?>
                                                    class="feedback__socials-item">
                                                    <?= wp_get_attachment_image($icon, 'full', false, array('class' => 'feedback__socials-item-icon')); ?>
                                                </a>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>

                                    <?= wp_get_attachment_image(207, 'full', false, array('class' => 'feedback__quote-icon')); ?>

                                    <div class="feedback__avatar">
                                        <?= get_the_post_thumbnail($item->ID, 'full'); ?>
                                    </div>
                                    <p class="feedback__text">
                                        <?php
                                        $single_feedback = get_field('single_feedback', $item->ID);
                                        $content = isset($single_feedback['content']) ? $single_feedback['content'] : '';
                                        echo $content;
                                        ?>
                                    </p>

                                    <div class="feedback__author">
                                        <p class="feedback__author-name">
                                            <?= get_the_title($item->ID); ?>
                                        </p>
                                        <p class="feedback__role">
                                            <?php
                                            $single_feedback = get_field('single_feedback', $item->ID);
                                            $role = isset($single_feedback['role']) ? $single_feedback['role'] : '';
                                            echo $role;
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="feedback__controls">
                    <button class="feedback__btn--desktop feedback__prev">
                        <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'feedback__btn-icon']) ?>
                    </button>
                    <div class="feedback__pagination"></div>
                    <button type="button" class="feedback__play">
                        <?= wp_get_attachment_image($icon_play_id, 'full', false, ['class' => 'feedback__play-icon']) ?>
                        <?= wp_get_attachment_image($icon_pause_id, 'full', false, ['class' => 'feedback__pause-icon']) ?>
                    </button>
                    <button class="feedback__btn--desktop feedback__next">
                        <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'feedback__btn-icon']) ?>
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </section>
</div>