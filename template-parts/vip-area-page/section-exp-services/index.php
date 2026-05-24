<?php
$exp_services = get_field('exp_services') ?: [];

// Experiences
$experiences = $exp_services['experiences'] ?? [];
$experiences_title = $experiences['title'] ?? '';
$experiences_description = $experiences['description'] ?? '';
$exp_cards = $experiences['exp_cards'] ?? [];

// Services
$services = $exp_services['services'] ?? [];
$services_title = $services['title'] ?? '';
$service_cards = $services['service_cards'] ?? [];

// Button link
// $services_link = $exp_services['link'] ?? [];
// $services_link_url = $services_link['url'] ?? '';
// $services_link_title = $services_link['title'] ?? '';
// $services_link_target = $services_link['target'] ?? '_self';

// Images
$exp_services_decor_2 = 1197;
$exp_services_bg = 1206;
$exp_services_decor = 1200;
$service_card_bg = 1198;
?>

<div class="section-exp-services">
    <?= wp_get_attachment_image($exp_services_decor_2, 'full', false, array('class' => 'section-exp-services__decor-2')) ?>

    <div class="section-exp-services__container">
        <?= wp_get_attachment_image($exp_services_bg, 'full', false, array('class' => 'section-exp-services__background')) ?>
        <?= wp_get_attachment_image($exp_services_decor, 'full', false, array('class' => 'section-exp-services__decor')) ?>

        <!-- Experience Section -->
        <section class="section-exp">

            <div class="section-exp__content">
                <p class="section-exp__content-label"><?= esc_html($experiences_title) ?></p>
                <p class="section-exp__content-description"><?= esc_html($experiences_description) ?></p>
            </div>

            <div class="section-exp__list">
                <?php foreach ($exp_cards as $card): ?>
                    <?php
                    $image_desktop = $card['image_desktop'] ?? '';
                    $image_mobile = $card['image_mobile'] ?? '';
                    $title = $card['title'] ?? '';
                    $description = $card['description'] ?? '';
                    ?>
                    <article class="section-exp__card">
                        <?= wp_get_attachment_image($image_desktop, 'full', false, array('class' => 'section-exp__card-image')) ?>
                        <?= wp_get_attachment_image($image_mobile, 'full', false, array('class' => 'section-exp__card-image mobile')) ?>
                        <div class="section-exp__card-content">
                            <h3 class="section-exp__card-title">
                                <?= esc_html($title) ?>
                            </h3>
                            <p class="section-exp__card-description">
                                <?= esc_html($description) ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

        </section>

        <!-- Services Section -->
        <section class="section-services">

            <h2 class="section-services__title"><?= esc_html($services_title) ?></h2>

            <div class="section-services__slider">
                <div class="section-services__list swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($service_cards as $card): ?>
                            <?php
                            $image = $card['image'] ?? '';
                            $title = $card['title'] ?? '';
                            $items = $card['items'] ?? [];
                            ?>

                            <article class="section-services__card swiper-slide">
                                <?= wp_get_attachment_image($service_card_bg, 'full', false, array('class' => 'section-services__card-bg')); ?>
                                <h3 class="section-services__card-title">
                                    <?= esc_html($title) ?>
                                </h3>
                                <div class="section-services__card-list">
                                    <?php foreach ($items as $item): ?>
                                        <?php
                                        $text = $item['text'] ?? '';
                                        ?>
                                        <div class="section-services__card-item">
                                            <div class="section-services__card-item-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="9" viewBox="0 0 11 9"
                                                    fill="none">
                                                    <path d="M0.4375 4.66665L2.95992 7.18908L9.71223 0.436768" stroke="white"
                                                        stroke-width="1.23528" />
                                                </svg>
                                            </div>
                                            <p class="section-services__card-item-text">
                                                <?= esc_html($text) ?>
                                            </p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?= wp_get_attachment_image($image, 'full', false, array('class' => 'section-services__card-image')); ?>
                            </article>

                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if (count($service_cards) >= 4): ?>
                    <div class="section-services__navigation">
                        <div class="section-services__navigation-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                <path
                                    d="M10.266 13.4357L11.2779 13.1645L10.7355 11.1407L9.72363 11.4118L9.99481 12.4237L10.266 13.4357ZM8.48456 11.7439C7.9257 11.8937 7.59406 12.4681 7.74384 13.027C7.89361 13.5859 8.46807 13.9175 9.02693 13.7677L8.75575 12.7558L8.48456 11.7439ZM15.5952 20.6429L15.5952 21.6905L17.6904 21.6905L17.6904 20.6429L16.6428 20.6429L15.5952 20.6429ZM9.33665 11.9154C8.82871 11.6383 8.19235 11.8255 7.91531 12.3334C7.63826 12.8414 7.82544 13.4777 8.33338 13.7548L8.83502 12.8351L9.33665 11.9154ZM8.4426 11.7845C7.90616 12.0012 7.647 12.6118 7.86375 13.1483C8.08051 13.6847 8.69111 13.9439 9.22755 13.7271L8.83508 12.7558L8.4426 11.7845ZM17.6905 4.94803L17.6905 3.90041L15.5952 3.90041L15.5952 4.94803L16.6429 4.94803L17.6905 4.94803ZM9.99481 12.4237L9.72363 11.4118L8.70314 11.6853L8.97433 12.6972L9.24551 13.7091L10.266 13.4357L9.99481 12.4237ZM8.97433 12.6972L8.70314 11.6853L8.48456 11.7439L8.75575 12.7558L9.02693 13.7677L9.24551 13.7091L8.97433 12.6972ZM16.6428 20.6429L17.6904 20.6429C17.6904 19.3916 17.0175 18.2242 16.235 17.2638C15.4316 16.2779 14.3861 15.3569 13.3795 14.5791C12.3667 13.7965 11.3591 13.1328 10.6078 12.666C10.2311 12.4321 9.91647 12.2461 9.69469 12.118C9.58375 12.0538 9.4959 12.0041 9.43498 11.9699C9.40451 11.9529 9.38077 11.9397 9.36423 11.9305C9.35595 11.926 9.34948 11.9224 9.34486 11.9199C9.34256 11.9186 9.34071 11.9176 9.33934 11.9168C9.33866 11.9165 9.33809 11.9162 9.33764 11.9159C9.33742 11.9158 9.33717 11.9157 9.33706 11.9156C9.33684 11.9155 9.33665 11.9154 8.83502 12.8351C8.33338 13.7548 8.33325 13.7547 8.33315 13.7547C8.33316 13.7547 8.33309 13.7546 8.3331 13.7546C8.33313 13.7547 8.33327 13.7547 8.33353 13.7549C8.33405 13.7552 8.33504 13.7557 8.33649 13.7565C8.33938 13.7581 8.3441 13.7607 8.3506 13.7643C8.36361 13.7715 8.3837 13.7826 8.41042 13.7976C8.46388 13.8276 8.54377 13.8728 8.64632 13.932C8.85153 14.0506 9.14687 14.2251 9.50218 14.4458C10.2148 14.8885 11.1592 15.5113 12.0983 16.237C13.0437 16.9675 13.9501 17.7766 14.6107 18.5873C15.2922 19.4237 15.5952 20.1195 15.5952 20.6429L16.6428 20.6429ZM8.83508 12.7558C9.22755 13.7271 9.22757 13.7271 9.22759 13.7271C9.2276 13.7271 9.22762 13.7271 9.22763 13.7271C9.22766 13.7271 9.22769 13.7271 9.22772 13.7271C9.22777 13.727 9.22783 13.727 9.2279 13.727C9.22802 13.7269 9.22816 13.7269 9.22831 13.7268C9.22861 13.7267 9.22896 13.7266 9.22936 13.7264C9.23016 13.7261 9.23114 13.7257 9.23232 13.7252C9.23467 13.7242 9.23778 13.723 9.24163 13.7214C9.24933 13.7182 9.26001 13.7138 9.27353 13.7082C9.30057 13.6969 9.33903 13.6808 9.38792 13.6598L8.97433 12.6972L8.56073 11.7347C8.51938 11.7525 8.48821 11.7656 8.46819 11.7739C8.45818 11.7781 8.45097 11.7811 8.44666 11.7828C8.44451 11.7837 8.44308 11.7843 8.4424 11.7846C8.44206 11.7847 8.44191 11.7848 8.44194 11.7848C8.44196 11.7848 8.44202 11.7847 8.44213 11.7847C8.44218 11.7847 8.44225 11.7846 8.44233 11.7846C8.44237 11.7846 8.44241 11.7846 8.44246 11.7845C8.44248 11.7845 8.4425 11.7845 8.44253 11.7845C8.44254 11.7845 8.44256 11.7845 8.44257 11.7845C8.44258 11.7845 8.4426 11.7845 8.83508 12.7558ZM8.97433 12.6972L9.38792 13.6598C9.94173 13.4218 11.9477 12.5167 13.8323 11.097C15.6546 9.72425 17.6905 7.62523 17.6905 4.94803L16.6429 4.94803L15.5952 4.94803C15.5952 6.55517 14.3213 8.1054 12.5716 9.42348C10.8841 10.6947 9.05578 11.522 8.56073 11.7347L8.97433 12.6972Z"
                                    fill="#B98951" />
                            </svg>
                        </div>
                        <div class="section-services__navigation-next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                <path
                                    d="M14.8769 13.4357L13.865 13.1645L14.4073 11.1407L15.4192 11.4118L15.148 12.4237L14.8769 13.4357ZM16.6583 11.7439C17.2172 11.8937 17.5488 12.4681 17.399 13.027C17.2493 13.5859 16.6748 13.9175 16.1159 13.7677L16.3871 12.7558L16.6583 11.7439ZM9.54768 20.6429L9.54768 21.6905L7.45244 21.6905L7.45244 20.6429L8.50006 20.6429L9.54768 20.6429ZM15.8062 11.9154C16.3141 11.6383 16.9505 11.8255 17.2276 12.3334C17.5046 12.8414 17.3174 13.4777 16.8095 13.7548L16.3078 12.8351L15.8062 11.9154ZM16.7003 11.7845C17.2367 12.0012 17.4959 12.6118 17.2791 13.1483C17.0623 13.6847 16.4518 13.9439 15.9153 13.7271L16.3078 12.7558L16.7003 11.7845ZM7.45238 4.94803L7.45238 3.90041L9.54762 3.90041L9.54762 4.94803L8.5 4.94803L7.45238 4.94803ZM15.148 12.4237L15.4192 11.4118L16.4397 11.6853L16.1685 12.6972L15.8974 13.7091L14.8769 13.4357L15.148 12.4237ZM16.1685 12.6972L16.4397 11.6853L16.6583 11.7439L16.3871 12.7558L16.1159 13.7677L15.8974 13.7091L16.1685 12.6972ZM8.50006 20.6429L7.45244 20.6429C7.45244 19.3916 8.1254 18.2242 8.90788 17.2638C9.71125 16.2779 10.7568 15.3569 11.7634 14.5791C12.7762 13.7965 13.7837 13.1328 14.5351 12.666C14.9117 12.4321 15.2264 12.2461 15.4482 12.118C15.5591 12.0538 15.647 12.0041 15.7079 11.9699C15.7383 11.9529 15.7621 11.9397 15.7786 11.9305C15.7869 11.926 15.7934 11.9224 15.798 11.9199C15.8003 11.9186 15.8021 11.9176 15.8035 11.9168C15.8042 11.9165 15.8048 11.9162 15.8052 11.9159C15.8054 11.9158 15.8057 11.9157 15.8058 11.9156C15.806 11.9155 15.8062 11.9154 16.3078 12.8351C16.8095 13.7548 16.8096 13.7547 16.8097 13.7547C16.8097 13.7547 16.8098 13.7546 16.8098 13.7546C16.8097 13.7547 16.8096 13.7547 16.8093 13.7549C16.8088 13.7552 16.8078 13.7557 16.8064 13.7565C16.8035 13.7581 16.7988 13.7607 16.7923 13.7643C16.7793 13.7715 16.7592 13.7826 16.7324 13.7976C16.679 13.8276 16.5991 13.8728 16.4965 13.932C16.2913 14.0506 15.996 14.2251 15.6407 14.4458C14.9281 14.8885 13.9837 15.5113 13.0445 16.237C12.0992 16.9675 11.1928 17.7766 10.5322 18.5873C9.8507 19.4237 9.54768 20.1195 9.54768 20.6429L8.50006 20.6429ZM16.3078 12.7558C15.9153 13.7271 15.9153 13.7271 15.9153 13.7271C15.9153 13.7271 15.9152 13.7271 15.9152 13.7271C15.9152 13.7271 15.9152 13.7271 15.9151 13.7271C15.9151 13.727 15.915 13.727 15.915 13.727C15.9148 13.7269 15.9147 13.7269 15.9145 13.7268C15.9142 13.7267 15.9139 13.7266 15.9135 13.7264C15.9127 13.7261 15.9117 13.7257 15.9105 13.7252C15.9082 13.7242 15.9051 13.723 15.9012 13.7214C15.8935 13.7182 15.8829 13.7138 15.8693 13.7082C15.8423 13.6969 15.8038 13.6808 15.7549 13.6598L16.1685 12.6972L16.5821 11.7347C16.6235 11.7525 16.6547 11.7656 16.6747 11.7739C16.6847 11.7781 16.6919 11.7811 16.6962 11.7828C16.6984 11.7837 16.6998 11.7843 16.7005 11.7846C16.7008 11.7847 16.701 11.7848 16.7009 11.7848C16.7009 11.7848 16.7008 11.7847 16.7007 11.7847C16.7007 11.7847 16.7006 11.7846 16.7005 11.7846C16.7005 11.7846 16.7004 11.7846 16.7004 11.7845C16.7004 11.7845 16.7004 11.7845 16.7003 11.7845C16.7003 11.7845 16.7003 11.7845 16.7003 11.7845C16.7003 11.7845 16.7003 11.7845 16.3078 12.7558ZM16.1685 12.6972L15.7549 13.6598C15.2011 13.4218 13.1952 12.5167 11.3106 11.097C9.48829 9.72425 7.45238 7.62523 7.45238 4.94803L8.5 4.94803L9.54762 4.94803C9.54762 6.55517 10.8216 8.1054 12.5713 9.42348C14.2588 10.6947 16.0871 11.522 16.5821 11.7347L16.1685 12.6972Z"
                                    fill="#B98951" />
                            </svg>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- "Button Cta" -->
        <div class="section-exp-services__footer">
            <button type="button" class="section-exp-services__footer-cta"
                onclick="document.querySelector('.popup__booking').classList.add('active'); document.documentElement.style.overflow = 'hidden';">
                <span class="section-exp-services__footer-cta-text">Đặt lịch ngay hôm nay</span>
                <?= wp_get_attachment_image(69, 'full', false, array('class' => 'section-exp-services__footer-cta-bg')); ?>
            </button>
            <?= wp_get_attachment_image(70, 'full', false, array('class' => 'section-exp-services__footer-image')); ?>
        </div>
    </div>

    <!-- Overlay bottom -->
    <div class="section-exp-services__bottom"></div>
</div>