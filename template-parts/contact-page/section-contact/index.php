<?php
$contact_form_texture = get_field("form_texture");
$contact_form_decor = get_field("form_decor");
$contact_form_title = get_field("contact_title") ?: '';
$contact_email = get_field("contact_email") ?: "example@gmail.com";
$contact_phone = get_field("contact_phone") ?: "(+84) 971 519 xxx";
$contact_address = get_field("contact_address") ?: "29/40 Ngô Gia Tự, Phường Thủ Dầu Một,<br>Thành phố Hồ Chí Minh";
$contact_maps_link = get_field("contact_maps_link") ?: "#";
$contact_open_time = get_field("contact_open_time") ?: "10:00 - 22:00 (Tất cả các ngày trong tuần)";
$social_title = get_field("social_title") ?: "Theo dõi chúng tôi qua";
$social_icons = get_field("social_icons");
$icon_name = get_field("icon_name") ?: 374;
$icon_phone = get_field("icon_phone") ?: 376;
$icon_email = get_field("icon_email") ?: 373;
$icon_note = get_field("icon_note") ?: 375;
$icon_phone2 = get_field("icon_phone2") ?: 384;
$icon_email2 = get_field("icon_email2") ?: 383;
$icon_address = get_field("icon_address") ?: 382;
$icon_time = get_field("icon_time") ?: 381;
$icon_submit = get_field("icon_submit") ?: 352;
$texture_img = IS_MOBILE ? wp_get_attachment_image(914, "full", false, ["class" => "contact__inner-texture",]) : wp_get_attachment_image(385, "full", false, ["class" => "contact__inner-texture",]);
$form_decor_img = !empty($contact_form_decor) ? wp_get_attachment_image($contact_form_decor, "full") : wp_get_attachment_image(412, "full"); ?>
<section class="contact">
    <div class="contact__container">
        <h2 class="contact__title">
            Liên hệ với chúng tôi
        </h2>
        <div class="contact__inner"><?= $texture_img ?>
            <div class="contact__form-wrapper">
                <div class="contact__form-title">
                    <?= $contact_form_title ?>
                </div>
                <form action="" class="contact__form" id="contactForm">
                    <div class="contact__fields">
                        <div class="contact__field-wrapper">
                            <div class="contact__field contact__field--name">
                                <div class="contact__field-label"><span
                                        class="contact__icon"><?= wp_get_attachment_image($icon_name, "full") ?></span><input
                                        class="contact__input" name="fullName" placeholder="Họ và tên *"></div>
                                <div class="contact__field-error" id="fullNameError"></div>
                            </div>
                        </div>
                        <div class="contact__field-wrapper">
                            <div class="contact__field contact__field--phone">
                                <div class="contact__field-label"><span
                                        class="contact__icon"><?= wp_get_attachment_image($icon_phone, "full") ?></span><input
                                        class="contact__input" name="phone" placeholder="Số điện thoại *" type="tel">
                                </div>
                                <div class="contact__field-error" id="phoneError"></div>
                            </div>
                        </div>
                        <div class="contact__field-wrapper">
                            <div class="contact__field contact__field--email">
                                <div class="contact__field-label"><span
                                        class="contact__icon"><?= wp_get_attachment_image($icon_email, "full") ?></span><input
                                        class="contact__input" name="email" placeholder="Email *" type="email"></div>
                                <div class="contact__field-error" id="emailError"></div>
                            </div>
                        </div>
                        <div class="contact__field-wrapper">
                            <div class="contact__field contact__field--note">
                                <span
                                    class="contact__icon"><?= wp_get_attachment_image($icon_note, "full") ?></span><textarea
                                    class="contact__input contact__input--textarea" name="message" rows="<?= wp_is_mobile() ? '' : 1; ?>"
                                    placeholder="Lưu ý cho chúng tôi"></textarea>
                                <div class="contact__field-error" id="messageError"></div>
                            </div>
                        </div>
                    </div><button class="contact__submit-btn contact__submit-btn--mobile" form="contactForm"
                        type="submit">
                        <p class="contact__submit-btn-text">Gửi thông tin</p><span
                            class="contact__submit-btn-decor"><?= wp_get_attachment_image(59, "icon", false, ["data-no-lazy" => "1",]) ?></span>
                    </button>
                </form>
            </div>
            <div class="contact__info">
                <div class="contact__info-list">
                    <div class="contact__info-item contact__info-item--email"><span
                            class="contact__info-icon"><?= wp_get_attachment_image($icon_email2, "full") ?></span>
                        <p class="contact__info-text">Email: <?= esc_html($contact_email) ?></p>
                    </div>
                    <div class="contact__info-item contact__info-item--phone"><span
                            class="contact__info-icon"><?= wp_get_attachment_image($icon_phone2, "full") ?></span>
                        <p class="contact__info-text">Số điện thoại: <?= esc_html($contact_phone) ?></p>
                    </div>
                    <div class="contact__info-item contact__info-item--address">
                        <div class="contact__info-item--address-span"><span
                                class="contact__info-icon"><?= wp_get_attachment_image($icon_address, "full") ?></span>
                            <p class="contact__info-text">Địa
                                chỉ: <?= wp_kses(nl2br(str_replace(["<br>", "&lt;br&gt;", "&#60;br&#62;"], "<br>", $contact_address)), ["br" => []]) ?>
                            </p>
                        </div><a href="<?= esc_url($contact_maps_link) ?>" rel="noopener" target="_blank">Xem địa chỉ
                            trên
                            Google Maps</a>
                    </div>
                    <div class="contact__info-item contact__info-item--time"><span
                            class="contact__info-icon"><?= wp_get_attachment_image($icon_time, "full") ?></span>
                        <p class="contact__info-text">Giờ mở cửa: <?= esc_html($contact_open_time) ?></p>
                    </div>
                </div>
                <div class="contact__socials">
                    <p class="contact__socials-title"><?= esc_html($social_title) ?></p>
                    <div class="contact__socials-list">
                        <?php $social_icons = get_field("social_icons");
                        $fallback_socials = [["icon_id" => 388, "link" => "#"], ["icon_id" => 393, "link" => "#"], ["icon_id" => 394, "link" => "#"], ["icon_id" => 395, "link" => "#"],]; ?><?php if (!empty($social_icons)): ?>     <?php foreach ($social_icons as $social):
                                                              $icon_id = $social["icon"] ?? null;
                                                              $link = $social["link"] ?? "#"; ?><a
                                    href="<?= esc_url($link) ?>" class="contact__social" rel="noopener"
                                    target="_blank"><?= wp_get_attachment_image($icon_id, "full", false, ["class" => "contact__social-icon"]) ?></a><?php endforeach; ?><?php else: ?><?php foreach ($fallback_socials as $item): ?><a
                                    href="<?= esc_url($item["link"]) ?>"
                                    class="contact__social"><?= wp_get_attachment_image($item["icon_id"], "full", false, ["class" => "contact__social-icon"]) ?></a><?php endforeach; ?><?php endif; ?>
                    </div>
                </div>
                <div class="contact__info-decoration"></div>
            </div>
            <div class="contact__submit-wrapper"><button class="contact__submit-btn contact__submit-btn--desktop"
                    form="contactForm" type="submit">
                    <p class="contact__submit-btn-text">Gửi thông tin</p><span
                        class="contact__submit-btn-decor"><?= wp_get_attachment_image(59, "icon", false, ["data-no-lazy" => "1",]) ?></span>
                </button></div>
            <div class="contact__form-decor"><?= $form_decor_img ?></div>
        </div>
    </div>

    <div class="contact__decoration contact__decoration--left">
        <?= wp_get_attachment_image(390, "full", false, ["alt" => "Decor Left",]) ?>
    </div>
    <div class="contact__decoration contact__decoration--right">
        <?= wp_get_attachment_image(389, "full", false, ["alt" => "Decor Right",]) ?>
    </div>
</section>