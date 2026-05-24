<?php
$contact_page_id = 365;
$contact_form_title = get_field('contact_title', $contact_page_id) ?: '';
$contact_email = get_field('contact_email', $contact_page_id) ?: 'example@gmail.com';
$contact_phone = get_field('contact_phone', $contact_page_id) ?: '(+84) 971 519 xxx';
$contact_address = get_field('contact_address', $contact_page_id)
    ?: '29/40 Ngô Gia Tự, Phường Thủ Dầu Một,<br>Thành phố Hồ Chí Minh';
$contact_maps_link = get_field('contact_maps_link', $contact_page_id) ?: '#';
$contact_open_time = get_field('contact_open_time', $contact_page_id)
    ?: '10:00 - 22:00 (Tất cả các ngày trong tuần)';
$social_title = get_field('social_title', $contact_page_id)
    ?: 'Theo dõi chúng tôi qua';
$social_icons = get_field('social_icons', $contact_page_id);

$icon_name = 374;
$icon_phone = 376;
$icon_email = 373;
$icon_note = 375;
$icon_phone2 = 384;
$icon_email2 = 383;
$icon_address = 382;
$icon_time = 381;
$icon_submit = 59;
$texture_img = 385;
$form_decor_img = 412;
?>

<section class="career-form" id="careerFormSection">
    <div class="career-form__container">
        <div class="career-form__inner">
            <?= wp_get_attachment_image($texture_img, "full", false, ["class" => "career-form__inner-texture",]) ?>
            <div class="career-form__form-wrapper">
                <h2 class="career-form__form-title">
                    Gia nhập đội ngũ của Carezone
                </h2>
                <form action="" class="career-form__form" id="careerForm">

                    <div class="career-form__fields">
                        <!-- Họ và tên -->
                        <div class="career-form__field-wrapper">
                            <div class="career-form__field career-form__field--name">
                                <div class="career-form__field-label">
                                    <span class="career-form__field-icon">
                                        <?= wp_get_attachment_image($icon_name, "full") ?>
                                    </span>
                                    <input class="career-form__field-input" name="fullName" placeholder="Họ và tên *">
                                </div>
                                <div class="career-form__field-error" id="fullNameError"></div>
                            </div>
                        </div>

                        <!-- Số điện thoại -->
                        <div class="career-form__field-wrapper">
                            <div class="career-form__field career-form__field--phone">
                                <div class="career-form__field-label">
                                    <span class="career-form__field-icon">
                                        <?= wp_get_attachment_image($icon_phone, "full") ?>
                                    </span>
                                    <input class="career-form__field-input" name="phone" placeholder="Số điện thoại *"
                                        type="tel">
                                </div>
                                <div class="career-form__field-error" id="phoneError"></div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="career-form__field-wrapper">
                            <div class="career-form__field career-form__field--email">
                                <div class="career-form__field-label">
                                    <span class="career-form__field-icon">
                                        <?= wp_get_attachment_image($icon_email, "full") ?>
                                    </span>
                                    <input class="career-form__field-input" name="email" placeholder="Email *"
                                        type="email">
                                </div>
                                <div class="career-form__field-error" id="emailError"></div>
                            </div>
                        </div>

                        <!-- Upload CV -->
                        <div class="career-form__upload">
                            <label for="career-cv" class="career-form__upload-label">
                                <div class="career-form__upload-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M21 15V16.2C21 17.8802 21 18.7202 20.673 19.362C20.3854 19.9265 19.9265 20.3854 19.362 20.673C18.7202 21 17.8802 21 16.2 21H7.8C6.11984 21 5.27976 21 4.63803 20.673C4.07354 20.3854 3.6146 19.9265 3.32698 19.362C3 18.7202 3 17.8802 3 16.2V15M7 8L12 3L17 8M12 3V15"
                                            stroke="#824508" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>

                                <p class="career-form__upload-text">Tải CV của bạn lên</p>

                                <input type="file" id="career-cv" name="career_cv" accept=".pdf,.doc,.docx" hidden>
                            </label>
                        </div>
                    </div>

                    <!-- Nút ứng tuyển ngay -->
                    <button class="career-form__submit-btn" form="careerForm" type="submit">
                        <p class="career-form__submit-btn-text">Ứng tuyển ngay</p>
                        <span class="career-form__submit-btn-decor">
                            <?= wp_get_attachment_image($icon_submit, "icon", false, ["data-no-lazy" => "1",]) ?>
                        </span>
                    </button>
                </form>
            </div>

            <div class="career-form__info">
                <div class="career-form__info-list">

                    <!-- Email -->
                    <div class="career-form__info-item career-form__info-item--email">
                        <span class="career-form__info-icon">
                            <?= wp_get_attachment_image($icon_email2, "full") ?>
                        </span>
                        <p class="career-form__info-text">Email: <?= esc_html($contact_email) ?></p>
                    </div>

                    <!-- Số điện thoại -->
                    <div class="career-form__info-item career-form__info-item--phone">
                        <span class="career-form__info-icon">
                            <?= wp_get_attachment_image($icon_phone2, "full") ?>
                        </span>
                        <p class="career-form__info-text">Số điện thoại: <?= esc_html($contact_phone) ?></p>
                    </div>

                    <!-- Địa chỉ -->
                    <div class="career-form__info-item career-form__info-item--address">
                        <div class="career-form__info-item--address-span">
                            <span class="career-form__info-icon">
                                <?= wp_get_attachment_image($icon_address, "full") ?>
                            </span>
                            <p class="career-form__info-text">
                                Địa chỉ:
                                <?= wp_kses(nl2br(str_replace(["<br>", "&lt;br&gt;", "&#60;br&#62;"], "<br>", $contact_address)), ["br" => []]) ?>
                            </p>
                        </div>
                        <a href="<?= esc_url($contact_maps_link) ?>" rel="noopener" target="_blank">
                            Xem địa chỉ trên Google Maps
                        </a>
                    </div>

                    <!-- Giờ mở cửa -->
                    <div class="career-form__info-item career-form__info-item--time">
                        <span class="career-form__info-icon">
                            <?= wp_get_attachment_image($icon_time, "full") ?>
                        </span>
                        <p class="career-form__info-text">Giờ mở cửa: <?= esc_html($contact_open_time) ?></p>
                    </div>
                </div>

                <!-- Mạng xã hội -->
                <div class="career-form__socials">
                    <p class="career-form__socials-title"><?= esc_html($social_title) ?></p>
                    <div class="career-form__socials-list">
                        <?php $social_icons = get_field("social_icons");
                        $fallback_socials = [["icon_id" => 388, "link" => "#"], ["icon_id" => 393, "link" => "#"], ["icon_id" => 394, "link" => "#"], ["icon_id" => 395, "link" => "#"],]; ?>
                        <?php if (!empty($social_icons)): ?>
                            <?php foreach ($social_icons as $social):
                                $icon_id = $social["icon"] ?? null;
                                $link = $social["link"] ?? "#"; ?>
                                <a href="<?= esc_url($link) ?>" class="career-form__social" rel="noopener" target="_blank">
                                    <?= wp_get_attachment_image($icon_id, "full", false, ["class" => "career-form__social-icon"]) ?>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php foreach ($fallback_socials as $item): ?>
                                <a href="<?= esc_url($item["link"]) ?>" class="career-form__social">
                                    <?= wp_get_attachment_image($item["icon_id"], "full", false, ["class" => "career-form__social-icon"]) ?>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="career-form__form-decor">
                <?= wp_get_attachment_image($form_decor_img, "full") ?>
            </div>
        </div>
    </div>
</section>