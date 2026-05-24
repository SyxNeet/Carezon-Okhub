<?php
$button_icon = 59;
$prev_icon = 830;

$career_query = new WP_Query([
    'post_type' => 'career',
    'posts_per_page' => 4,
    'post__not_in' => [get_the_ID()],
    'post_status' => 'publish',
]);
?>

<section class="career-other">
    <div class="career-other__container">

        <div class="career-other__header">
            <h2 class="career-other__title">Các tin tuyển dụng khác</h2>

            <a class="career-other__link" href="/tuyen-dung">
                <span class="career-other__link-text"> Xem thêm</span>
                <span class="career-other__link-icon">
                    <?= wp_get_attachment_image($button_icon, 'full') ?>
                </span>
            </a>
        </div>

        <?php if ($career_query->have_posts()): ?>
            <div class="career-other__slider">
                <div class="career-other__swiper swiper">
                    <div class="swiper-wrapper">

                        <?php while ($career_query->have_posts()):
                            $career_query->the_post(); ?>
                            <div class="swiper-slide">
                                <?php get_template_part('template-parts/components/career-item/index', null, ['post_id' => get_the_ID()]); ?>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>

                    </div>
                </div>
                <div class="career-other__controls">
                    <button class="career-other__btn career-other__prev">
                        <?= wp_get_attachment_image($prev_icon, 'full', false, ['class' => 'career-other__btn-icon']) ?>
                    </button>
                    <div class="career-other__pagination"></div>
                    <button class="career-other__btn career-other__next">
                        <?= wp_get_attachment_image($prev_icon, 'full', false, ['class' => 'career-other__btn-icon']) ?>
                    </button>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>