<?php
$home_about_us = get_field('home_about_us');
$title = isset($home_about_us['title']) ? $home_about_us['title'] : '';
$description = isset($home_about_us['description']) ? $home_about_us['description'] : '';
$image = isset($home_about_us['image']) ? $home_about_us['image'] : '';
$slogans = isset($home_about_us['slogan']) && is_array($home_about_us['slogan']) ? $home_about_us['slogan'] : [];
$bottom_content = isset($home_about_us['bottom_content']) && is_array($home_about_us['bottom_content']) ? $home_about_us['bottom_content'] : [];
$bottom_content_title = isset($bottom_content['title']) ? $bottom_content['title'] : '';
$bottom_content_description = isset($bottom_content['description']) ? $bottom_content['description'] : '';
$bottom_content_link = isset($bottom_content['link']) ? $bottom_content['link'] : '';
?>

<section class="about-us">
    <?= wp_get_attachment_image(77, 'full', false, array('class' => 'about-us__background-deco')); ?>
    <div class="about-us__container">
        <div class="about-us__left">
            <div class="about-us__left__content">
                <div class="about-us__left__content__item">
                    <?php
                    $is_carezone = strcasecmp(trim($title), 'carezone') === 0;
                    ?>
                    <h2 class="<?= $is_carezone ? 'about-us__title--carezone' : '' ?>">
                        <?= $title ?>
                    </h2>
                    <p>
                        <?= $description ?>
                    </p>
                </div>
                <?php foreach ($slogans as $slogan): ?>
                    <div class="about-us__left__content__item">
                        <h2>
                            <?= isset($slogan['title']) ? $slogan['title'] : '' ?>
                        </h2>
                        <p>
                            <?= isset($slogan['description']) ? $slogan['description'] : '' ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (!IS_MOBILE): ?>
                <div class="about-us__left__image">
                    <?= wp_get_attachment_image($image, 'full'); ?>
                </div>
            <?php endif; ?>
            <?php if (IS_MOBILE): ?>

                <div class="about-us__right__content">


                    <?= wp_get_attachment_image(60, 'full', false, array('class' => 'about-us__right__content__image')); ?>
                    <?php
                    foreach ($slogans as $key => $slogan):
                        $word = isset($slogan['word']) ? $slogan['word'] : '';
                        $icon = isset($slogan['icon']) ? $slogan['icon'] : '';
                        ?>
                        <div class="about-us__right-circle about-us__right-circle-<?php echo $key + 1; ?>">
                            <?php if ($key > 0): ?>
                                <span class="about-us__right-circle__dot about-us__right-circle__dot-1">
                                </span>
                                <span class="about-us__right-circle__dot about-us__right-circle__dot-2">
                                </span>
                                <span class="about-us__right-circle__dot about-us__right-circle__dot-3">
                                </span>
                            <?php endif; ?>
                            <div class="about-us__right-circle__content">
                                <?= wp_get_attachment_image($icon, 'full', false, array('class' => 'about-us__right-circle__image')); ?>
                                <p class="about-us__right-circle__text">
                                    <?php echo $word; ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="about-us__right">
            <div class="about-us__right__content__decoration">
                <?= wp_get_attachment_image(451, 'full', false); ?>
            </div>

            <?php if (!IS_MOBILE): ?>

                <div class="about-us__right__content">
                    <?= wp_get_attachment_image(78, 'full', false, array('class' => 'about-us__right__content__background')); ?>
                    <?= wp_get_attachment_image(60, 'full', false, array('class' => 'about-us__right__content__image')); ?>
                    <?php
                    foreach ($slogans as $key => $slogan):
                        $word = isset($slogan['word']) ? $slogan['word'] : '';
                        $icon = isset($slogan['icon']) ? $slogan['icon'] : '';
                        ?>
                        <div class="about-us__right-circle about-us__right-circle-<?php echo $key + 1; ?>">
                            <?php if ($key > 0): ?>
                                <span class="about-us__right-circle__dot about-us__right-circle__dot-1">
                                </span>
                                <span class="about-us__right-circle__dot about-us__right-circle__dot-2">
                                </span>
                                <span class="about-us__right-circle__dot about-us__right-circle__dot-3">
                                </span>
                            <?php endif; ?>
                            <div class="about-us__right-circle__content">
                                <?= wp_get_attachment_image($icon, 'full', false, array('class' => 'about-us__right-circle__image')); ?>
                                <p class="about-us__right-circle__text">
                                    <?php echo $word; ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="about-us__right-bottom">
                <div class="about-us__right-bottom__content">
                    <p class="about-us__right-bottom__content__title"><?= $bottom_content_title ?></p>
                    <p class="about-us__right-bottom__content__text">
                        <?= $bottom_content_description ?>
                    </p>
                </div>
                <?php if (IS_MOBILE): ?>
                    <div class="about-us__left__image">
                        <?= wp_get_attachment_image($image, 'full'); ?>
                    </div>
                <?php endif; ?>
                <div class="about-us__right-bottom__image">
                    <?php if ($bottom_content_link && is_array($bottom_content_link)):
                        $link = isset($bottom_content_link['url']) ? $bottom_content_link['url'] : '';
                        $link_text = isset($bottom_content_link['title']) ? $bottom_content_link['title'] : '';
                        $link_target = isset($bottom_content_link['target']) ? $bottom_content_link['target'] : '';
                        ?>
                        <a href="<?= $link ?>" target="<?= $link_target ?>" class="about-us__right-bottom__image__btn">
                            <p class="about-us__right-bottom__image__btn__text">
                                <?= $link_text ?>
                            </p>
                            <?= wp_get_attachment_image(69, 'thumbnail'); ?>
                        </a>
                    <?php endif; ?>
                    <?= wp_get_attachment_image(70, 'large', false, array('class' => 'about-us__right-bottom__image__img')); ?>
                </div>
            </div>
        </div>
    </div>
    <?= wp_get_attachment_image(74, 'medium', false, array('class' => 'about-us__deco')); ?>
</section>