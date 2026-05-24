<?php
$home_services = get_field('home_services');
$title = $home_services['title'];
$left_services = isset($home_services['left_services']) ? $home_services['left_services'] : null;
$right_services = isset($home_services['right_services']) ? $home_services['right_services'] : null;
$slide_videos = isset($home_services['slide_video']) ? $home_services['slide_video'] : [];
$left_services_service_1 = isset($left_services['service_1']) ? $left_services['service_1'] : null;
$left_services_service_2 = isset($left_services['service_2']) ? $left_services['service_2'] : null;
$left_services_service_3 = isset($left_services['service_3']) ? $left_services['service_3'] : null;
$right_services_service_1 = isset($right_services['service_1']) ? $right_services['service_1'] : null;
$right_services_service_2 = isset($right_services['service_2']) ? $right_services['service_2'] : null;
$right_services_service_3 = isset($right_services['service_3']) ? $right_services['service_3'] : null;
?>
<section class="experience">
    <h2 class="experience__section-title"><?= esc_html($title); ?></h2>
    <div class="experience__container">
        <div class="experience__list">
            <?php if ($left_services_service_1) : ?>
            <div class="experience__item experience__item--spa">
                <div class="experience__spa">
                    <?= wp_get_attachment_image($left_services_service_1['background'], 'full', false, array('class' => 'experience__image')); ?>
                    <div class="experience__content">
                        <h3 class="experience__title">
                            <?= isset($left_services_service_1['title']) ? $left_services_service_1['title'] : '' ?>
                        </h3>
                        <?php if (isset($left_services_service_1['link'])) : ?>
                        <a target="<?= isset($left_services_service_1['link']['target']) ? $left_services_service_1['link']['target'] : '' ?>"
                            href="<?= isset($left_services_service_1['link']['url']) ? $left_services_service_1['link']['url'] : '' ?>"
                            class="experience__link">
                            <span>
                                <?= isset($left_services_service_1['link']['title']) ? $left_services_service_1['link']['title'] : '' ?>
                            </span>
                            <?= wp_get_attachment_image(84, 'full', false, array('class' => 'experience__icon')); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($left_services_service_2) : ?>
            <div class="experience__item experience__item--onsen">
                <?= wp_get_attachment_image($left_services_service_2['background'], 'full', false, array('class' => 'experience__image')); ?>
                <div class="experience__content">
                    <h3 class="experience__title">
                        <?= isset($left_services_service_2['title']) ? $left_services_service_2['title'] : '' ?>
                    </h3>
                    <?php if (isset($left_services_service_2['link'])) : ?>
                    <a target="<?= isset($left_services_service_2['link']['target']) ? $left_services_service_2['link']['target'] : '' ?>"
                        href="<?= isset($left_services_service_2['link']['url']) ? $left_services_service_2['link']['url'] : '' ?>"
                        class="experience__link">
                        <span>
                            <?= isset($left_services_service_2['link']['title']) ? $left_services_service_2['link']['title'] : '' ?>
                        </span>
                        <?= wp_get_attachment_image(84, 'full', false, array('class' => 'experience__icon')); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($left_services_service_3) : ?>
            <div class="experience__item experience__item--relax">
                <?= wp_get_attachment_image($left_services_service_3['background'], 'full', false, array('class' => 'experience__back-image')); ?>
                <div class="experience__overlay"></div>
                <div class="experience__content">
                    <h3 class="experience__title">
                        <?= isset($left_services_service_3['title']) ? $left_services_service_3['title'] : '' ?>
                    </h3>
                    <?php if (isset($left_services_service_3['link'])) : ?>
                    <a target="<?= isset($left_services_service_3['link']['target']) ? $left_services_service_3['link']['target'] : '' ?>"
                        href="<?= isset($left_services_service_3['link']['url']) ? $left_services_service_3['link']['url'] : '' ?>"
                        class="experience__link">
                        <span>
                            <?= isset($left_services_service_3['link']['title']) ? $left_services_service_3['link']['title'] : '' ?>
                        </span>
                        <?= wp_get_attachment_image(85, 'full', false, array('class' => 'experience__icon')); ?>
                    </a>
                    <?php endif; ?>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php if ($slide_videos) : ?>
        <div class="experience__tiktok">
            <div class="swiper experience__tiktok-swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($slide_videos as $slide_video) :
                            $type = isset($slide_video['type']) ? $slide_video['type'] : '';
                            $upload = isset($slide_video['upload']) ? $slide_video['upload'] : '';
                            $tiktok = isset($slide_video['tiktok']) ? $slide_video['tiktok'] : '';
                            $upload_url = isset($upload['url']) ? $upload['url'] : '';
                        ?>
                    <div class="swiper-slide">
                        <?php if ($type === 'upload') : ?>
                        <video data-src="<?= $upload_url ?>" data-type="<?= $type ?>" poster="<?= wp_get_attachment_image_url(177, 'full') ?>"
                            class="experience__video" autoplay muted loop>
                        </video>
                        <?php elseif ($type === 'tiktok') : ?>
                        <iframe data-src="<?= $tiktok ?>" data-type="<?= $type ?>" poster="<?= wp_get_attachment_image_url(177, 'full') ?>"
                            class="experience__video experience__iframe" autoplay muted loop frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next experience__tiktok-swiper-next">
                    <?= wp_get_attachment_image(59, 'thumbnail', false, array('data-no-lazy' => '1')) ?></div>
                <div class="swiper-button-prev experience__tiktok-swiper-prev">
                    <?= wp_get_attachment_image(59, 'thumbnail', false, array('data-no-lazy' => '1')) ?></div>
            </div>
            <div class="swiper-pagination experience__tiktok-pagination"></div>
        </div>
        <?php endif; ?>
        <div class="experience__list">
            <?php if ($right_services_service_1) : ?>
            <div class="experience__item experience__item--korea">
                <?= wp_get_attachment_image($right_services_service_1['background'], 'full', false, array('class' => 'experience__back-image')); ?>
                <div class="experience__overlay"></div>
                <div class="experience__content">
                    <h3 class="experience__title">
                        <?= isset($right_services_service_1['title']) ? $right_services_service_1['title'] : '' ?>
                    </h3>
                    <?php if (isset($right_services_service_1['link'])) : ?>
                    <a target="<?= isset($right_services_service_1['link']['target']) ? $right_services_service_1['link']['target'] : '' ?>"
                        href="<?= isset($right_services_service_1['link']['url']) ? $right_services_service_1['link']['url'] : '' ?>"
                        class="experience__link">
                        <span>
                            <?= isset($right_services_service_1['link']['title']) ? $right_services_service_1['link']['title'] : '' ?>
                        </span>
                        <?= wp_get_attachment_image(84, 'full', false, array('class' => 'experience__icon')); ?>
                    </a>
                    <?php endif; ?>
                    </a>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($right_services_service_2) : ?>
            <div class="experience__item experience__item--vip">
                <?= wp_get_attachment_image($right_services_service_2['background'], 'full', false, array('class' => 'experience__image')); ?>
                <div class="experience__content">
                    <h3 class="experience__title">
                        <?= isset($right_services_service_2['title']) ? $right_services_service_2['title'] : '' ?>
                    </h3>
                    <?php if (isset($right_services_service_2['link'])) : ?>
                    <a target="<?= isset($right_services_service_2['link']['target']) ? $right_services_service_2['link']['target'] : '' ?>"
                        href="<?= isset($right_services_service_2['link']['url']) ? $right_services_service_2['link']['url'] : '' ?>"
                        class="experience__link">
                        <span>
                            <?= isset($right_services_service_2['link']['title']) ? $right_services_service_2['link']['title'] : '' ?>
                        </span>
                        <?= wp_get_attachment_image(85, 'full', false, array('class' => 'experience__icon')); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($right_services_service_3) : ?>
            <div class="experience__item experience__item--restaurant">
                <?= wp_get_attachment_image($right_services_service_3['background'], 'full', false, array('class' => 'experience__image')); ?>
                <div class="experience__content">
                    <h3 class="experience__title">
                        <?= isset($right_services_service_3['title']) ? $right_services_service_3['title'] : '' ?>
                    </h3>
                    <?php if (isset($right_services_service_3['link'])) : ?>
                    <a target="<?= isset($right_services_service_3['link']['target']) ? $right_services_service_3['link']['target'] : '' ?>"
                        href="<?= isset($right_services_service_3['link']['url']) ? $right_services_service_3['link']['url'] : '' ?>"
                        class="experience__link">
                        <span>
                            <?= isset($right_services_service_3['link']['title']) ? $right_services_service_3['link']['title'] : '' ?>
                        </span>
                        <?= wp_get_attachment_image(84, 'full', false, array('class' => 'experience__icon')); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>