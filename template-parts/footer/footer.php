<?php
$footer = get_field('footer', 'option');
$background_top = isset($footer['background_top']) ? $footer['background_top'] : '';
$background_bottom = isset($footer['background_bottom']) ? $footer['background_bottom'] : '';
$text_1 = isset($footer['text_1']) ? $footer['text_1'] : '';
$text_2 = isset($footer['text_2']) ? $footer['text_2'] : '';
$text_3 = isset($footer['text_3']) ? $footer['text_3'] : '';
$text_4 = isset($footer['text_4']) ? $footer['text_4'] : '';
$logo = isset($footer['logo']) ? $footer['logo'] : '';
$services = isset($footer['services']) ? $footer['services'] : [];
$address = isset($footer['address']) ? $footer['address'] : '';
$address_detail = isset($footer['address_detail']) ? $footer['address_detail'] : '';
$socials = isset($footer['socials']) ? $footer['socials'] : [];
$contact = isset($footer['contact']) ? $footer['contact'] : '';
$link = isset($contact['link']) ? $contact['link'] : '';
$cta = isset($footer['cta']) ? $footer['cta'] : '';
$business_license = isset($footer['business_license']) ? $footer['business_license'] : '';
$icon_cta_mobile = 692;
?>
<div class="cta">
    <div class="cta__btn-booking--wrapper">
        <button type="button" class="cta__btn-booking">
            <?= IS_MOBILE
                ? wp_get_attachment_image(278, 'full', false, [
                    'class' => 'cta__btn-booking--icon-mobile',
                ])
                : '' ?>
            <span class="cta__btn-booking--text">
                <p>Đăng ký đặt chỗ</p>
                <p>Hỗ trợ tư vấn 24/7 </p>
            </span>
            <div class="cta__btn-booking--icon-wrapper">
                <?= wp_get_attachment_image(279, 'full', false, [
                'class' => 'cta__btn-booking--icon',
            ]) ?>
            </div>
            <span>Đặt chỗ</span>
        </button>
        <div class="cta__btn-booking--socials">
            <div class="cta__btn-booking--socials-item">
                <?php if (isset($cta['phone']) && $cta['phone']): ?>
                <a href="<?= isset($cta['phone']['url'])
                            ? $cta['phone']['url']
                            : '' ?>" title="Gọi ngay">
                    <?= wp_get_attachment_image(282, 'full', false, ['class' => 'cta__icon']) ?>
                </a>
                <?php endif; ?>
            </div>
            <div class="cta__btn-booking--socials-item">
                <?php if (isset($cta['zalo']) && $cta['zalo']): ?>
                <a style="--icon: url(<?= wp_get_attachment_image_url(280, 'full') ?>);"
                    href="<?= isset($cta['zalo']['url']) ? $cta['zalo']['url'] : '' ?>" target="_blank"
                    title="Zalo">
                    <?= wp_get_attachment_image(283, 'full', false, ['class' => 'cta__icon']) ?>
                    <div class="cta__notification"></div>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="cta__socials">
        <?php if (isset($cta['phone']) && $cta['phone']): ?>
        <a href="<?= isset($cta['phone']['url'])
                            ? $cta['phone']['url']
                            : '' ?>" class="cta__btn cta__btn-call" title="Gọi ngay">
            <?= wp_get_attachment_image(282, 'full', false, ['class' => 'cta__icon']) ?>
        </a>
        <?php endif; ?>
        <?php if (isset($cta['zalo']) && $cta['zalo']): ?>
        <a style="--icon: url(<?= wp_get_attachment_image_url(280, 'full') ?>);"
            href="<?= isset($cta['zalo']['url']) ? $cta['zalo']['url'] : '' ?>" target="_blank"
            class="cta__btn cta__btn-zalo" title="Zalo">
            <?= wp_get_attachment_image(283, 'full', false, ['class' => 'cta__icon']) ?>
            <div class="cta__notification"></div>
        </a>
        <?php endif; ?>
        <?php if (isset($cta['messenger']) && $cta['messenger']): ?>
        <a href="<?= isset($cta['messenger']['url'])
                            ? $cta['messenger']['url']
                            : '' ?>" target="_blank" class="cta__btn cta__btn-messenger" title="Messenger">
            <?= wp_get_attachment_image(281, 'full', false, ['class' => 'cta__icon']) ?>
        </a>
        <?php endif; ?>

        <div class="move-to-top">
            <?= wp_get_attachment_image(496, 'icon', false, [
                'class' => 'move-to-top__icon cta__icon',
            ]) ?>
        </div>
    </div>
</div>

<?php
$is_special_page = is_front_page() || is_home() || is_page_template('onsen-page.php');
?>
<footer class="footer <?php echo !$is_special_page ? 'not-front' : ''; ?>">
    <div class="footer-top">
        <?= wp_get_attachment_image($background_top, 'full', false, [
            'class' => 'footer-top__image',
        ]) ?>
        <?= wp_get_attachment_image(159, 'full', false, ['class' => 'footer-top__roof']) ?>
        <div class="footer-top__content">
            <p class="footer-top__title">
                <span class="footer-top__line-1"> <?= $text_1 ?> </span>
                <span class="footer-top__line-2">
                    <span> <?= $text_2 ?> </span>
                    <span> <?= $text_3 ?> </span>
                </span>
                <span class="footer-top__line-3"> <?= $text_4 ?> </span>
            </p>
            <?= wp_get_attachment_image(157, 'full', false, ['class' => 'footer-top__layer']) ?>
        </div>
    </div>
    <div class="footer-bottom">
        <?= wp_get_attachment_image($background_bottom, 'full', false, [
            'class' => 'footer-bottom__image',
        ]) ?>
        <div class="footer-bottom__container">
            <div class="footer-bottom__inner">
                <div style="--background-image: url('<?= wp_get_attachment_image_url(
                                                            IS_MOBILE ? 246 : 153,
                                                            'full',
                                                        ) ?>');" class="footer-bottom__background"></div>
                <?= wp_get_attachment_image(IS_MOBILE ? 248 : 154, 'full', false, [
                    'class' => 'footer-bottom__decoration-1',
                ]) ?>
                <?= wp_get_attachment_image(IS_MOBILE ? 488 : 489, 'full', false, [
                    'class' => IS_MOBILE
                        ? 'footer-bottom__decoration-2-mobile'
                        : 'footer-bottom__decoration-2',
                ]) ?>
                <div class="footer-bottom__phone">
                    <a href="tel:0889227888" class="footer-bottom__phone-content">
                        <p class="footer-bottom__phone-link">0889.227.888</p>
                        <p class="footer-bottom__phone-desc">LIÊN HỆ ĐẶT LỊCH</p>
                    </a>
                </div>
                <a href="tel:0889227888" class="footer-bottom__btn">
                    <div class="footer-bottom__btn-bg">
                        <?= wp_get_attachment_image(69, 'full') ?>
                    </div>
                    <div class="footer-bottom__btn-content">
                        <p>tư vấn ngay</p>
                        <span></span>
                    </div>
                </a>
                <div class="footer-bottom__content">
                    <div class="footer-bottom__header">
                        <a href="<?= home_url() ?>">
                            <?= wp_get_attachment_image($logo, 'full', false, [
                                'class' => 'footer-bottom__logo',
                            ]) ?>
                        </a>
                    </div>
                    <div class="footer-bottom__main">
                        <div class="footer-bottom__service">
                            <p class="footer-bottom__service-title">
                                Dịch vụ tại Carezone
                            </p>
                            <div class="footer-bottom__service-list">
                                <?php foreach ($services as $service):

                                    $service_link = $service['link'];
                                    $service_icon = $service['icon'];
                                    $service_link_title = isset($service_link['title'])
                                        ? $service_link['title']
                                        : '';
                                    $service_link_url = isset($service_link['url'])
                                        ? $service_link['url']
                                        : '';
                                    $service_link_target = isset($service_link['target'])
                                        ? $service_link['target']
                                        : '';
                                ?>
                                <a href="<?= $service_link_url ?>" target="<?= $service_link_target ?>"
                                    class="footer-bottom__service-item">
                                    <div class="footer-bottom__service-image">
                                        <?= wp_get_attachment_image($service_icon, 'full') ?>
                                    </div>
                                    <span><?= nl2br(
                                                    str_replace(
                                                        ['<br>', '&lt;br&gt;', '&#60;br&#62;'],
                                                        '<br>',
                                                        $service_link_title,
                                                    ),
                                                ) ?></span>
                                </a>
                                <?php
                                endforeach; ?>
                            </div>
                        </div>
                        <div class="footer-bottom__contact">
                            <div class="footer-bottom__address">
                                <p class="footer-bottom__address-city">
                                    <?= $address ?>
                                </p>
                                <?php if ($address_detail):

                                    $address_detail_link_title = isset($address_detail['title'])
                                        ? $address_detail['title']
                                        : '';
                                    $address_detail_link_url = isset($address_detail['url'])
                                        ? $address_detail['url']
                                        : '';
                                    $address_detail_link_target = isset($address_detail['target'])
                                        ? $address_detail['target']
                                        : '';
                                ?>
                                <a href="<?= $address_detail_link_url ?>" target="<?= $address_detail_link_target ?>"
                                    class="footer-bottom__address-detail">
                                    <?= nl2br(
                                            str_replace(
                                                ['<br>', '&lt;br&gt;', '&#60;br&#62;'],
                                                '<br>',
                                                $address_detail_link_title,
                                            ),
                                        ) ?>
                                </a>
                                <?php
                                endif; ?>
                            </div>
                            <div class="footer-bottom__social">
                                <p class="footer-bottom__social-title">
                                    Theo dõi chúng tôi qua:
                                </p>
                                <div class="footer-bottom__icons">
                                    <?php foreach ($socials as $social):

                                        $social_link = $social['link'];
                                        $social_icon = $social['icon'];
                                        $social_link_title = isset($social_link['title'])
                                            ? $social_link['title']
                                            : '';
                                        $social_link_url = isset($social_link['url'])
                                            ? $social_link['url']
                                            : '';
                                        $social_link_target = isset($social_link['target'])
                                            ? $social_link['target']
                                            : '';
                                    ?>
                                    <a href="<?= $social_link_url ?>" target="<?= $social_link_target ?>"
                                        aria-label="<?= $social_link_title ?>" class="footer-bottom__icon">
                                        <?= wp_get_attachment_image($social_icon, 'full') ?>
                                    </a>
                                    <?php
                                    endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer-bottom__copyright">
                            <span> ©2025 CareZone </span>
                            <span>|</span>
                            <span> <?= $business_license ?> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= wp_get_attachment_image(149, 'full', false, ['class' => 'footer__leaf']) ?>
</footer>