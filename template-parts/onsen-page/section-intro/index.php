<?php
$decor_left_id = 970;
$decor_right_id = 972;
$bg_id = 971;
$button_bg_id = 969;
$button_image_desktop_id = 968;
$button_image_mobile_id = 965;
$benefit_bg_id = 967;
$brand_img_id = 966;

$intro = get_field('intro') ?: [];
$subtitle = $intro['subtitle'] ?? '';
$title = $intro['title'] ?? '';
$description = $intro['description'] ?? '';
$benefits = $intro['benefits'] ?? [];

$icon_arrow_id = '
<svg xmlns="http://www.w3.org/2000/svg" width="10" height="17" viewBox="0 0 10 17" fill="none">
  <path d="M7.087 7.8796L6.12109 8.13846L6.63881 10.0703L7.60472 9.81143L7.34586 8.84552L7.087 7.8796ZM8.78747 9.49446C9.32093 9.3515 9.63749 8.80314 9.49452 8.26969C9.35156 7.73623 8.80321 7.41967 8.26975 7.56263L8.52861 8.52855L8.78747 9.49446ZM2.00006 1V0H6.10352e-05V1H1.00006H2.00006ZM7.97411 9.33078C8.45896 9.59524 9.06639 9.41657 9.33085 8.93172C9.5953 8.44686 9.41663 7.83943 8.93178 7.57498L8.45294 8.45288L7.97411 9.33078ZM8.82752 9.45572C9.33959 9.24881 9.58696 8.66597 9.38005 8.1539C9.17314 7.64184 8.5903 7.39447 8.07824 7.60138L8.45288 8.52855L8.82752 9.45572ZM0 15.9814V16.9814H2V15.9814H1H0ZM7.34586 8.84552L7.60472 9.81143L8.57883 9.55038L8.31997 8.58446L8.06111 7.61855L7.087 7.8796L7.34586 8.84552ZM8.31997 8.58446L8.57883 9.55038L8.78747 9.49446L8.52861 8.52855L8.26975 7.56263L8.06111 7.61855L8.31997 8.58446ZM1.00006 1H6.10352e-05C6.10352e-05 2.19437 0.642426 3.30876 1.38934 4.22543C2.1562 5.16659 3.15423 6.04572 4.11506 6.78817C5.08178 7.53517 6.04355 8.16871 6.76076 8.61423C7.1203 8.83758 7.42064 9.01507 7.63234 9.13741C7.73824 9.19861 7.8221 9.24609 7.88025 9.27869C7.90933 9.29499 7.932 9.30758 7.94779 9.31631C7.95568 9.32067 7.96186 9.32407 7.96627 9.32649C7.96847 9.3277 7.97023 9.32867 7.97154 9.32938C7.97219 9.32974 7.97273 9.33004 7.97316 9.33027C7.97338 9.33039 7.97361 9.33052 7.97372 9.33057C7.97393 9.33069 7.97411 9.33078 8.45294 8.45288C8.93178 7.57498 8.9319 7.57504 8.93199 7.57509C8.93199 7.57509 8.93205 7.57513 8.93204 7.57512C8.93202 7.57511 8.93188 7.57503 8.93163 7.57489C8.93113 7.57462 8.93019 7.57411 8.92881 7.57335C8.92605 7.57183 8.92154 7.56935 8.91534 7.56592C8.90293 7.55906 8.88374 7.54841 8.85823 7.53411C8.80721 7.50551 8.73095 7.46235 8.63306 7.40578C8.43718 7.29258 8.15526 7.12602 7.8161 6.91534C7.1359 6.4928 6.23444 5.89833 5.33794 5.20559C4.43556 4.5083 3.57037 3.73596 2.93981 2.96209C2.28931 2.16374 2.00006 1.49955 2.00006 1H1.00006ZM8.45288 8.52855C8.07824 7.60138 8.07822 7.60138 8.07821 7.60139C8.0782 7.60139 8.07818 7.6014 8.07817 7.60141C8.07814 7.60142 8.07811 7.60143 8.07809 7.60144C8.07803 7.60146 8.07797 7.60148 8.07791 7.60151C8.07779 7.60156 8.07766 7.60161 8.07752 7.60167C8.07723 7.60179 8.07689 7.60192 8.07652 7.60208C8.07576 7.60238 8.07482 7.60277 8.07369 7.60322C8.07145 7.60414 8.06848 7.60535 8.06481 7.60685C8.05745 7.60987 8.04727 7.61407 8.03436 7.61944C8.00854 7.63019 7.97184 7.64564 7.92517 7.66569L8.31997 8.58446L8.71476 9.50323C8.75423 9.48627 8.78399 9.47376 8.8031 9.4658C8.81265 9.46182 8.81954 9.45899 8.82365 9.4573C8.82571 9.45646 8.82707 9.4559 8.82772 9.45564C8.82804 9.45551 8.82819 9.45545 8.82816 9.45546C8.82814 9.45547 8.82808 9.45549 8.82798 9.45553C8.82792 9.45555 8.82786 9.45558 8.82778 9.45561C8.82775 9.45563 8.82771 9.45564 8.82766 9.45566C8.82764 9.45567 8.82762 9.45568 8.8276 9.45569C8.82758 9.45569 8.82757 9.4557 8.82756 9.4557C8.82754 9.45571 8.82752 9.45572 8.45288 8.52855ZM8.31997 8.58446L7.92517 7.66569C7.39653 7.89285 5.48175 8.75683 3.68285 10.1119C1.94336 11.4223 0 13.4259 0 15.9814H1H2C2 14.4473 3.21603 12.9676 4.88623 11.7094C6.49702 10.496 8.24221 9.70628 8.71476 9.50323L8.31997 8.58446Z" fill="#B98951"/>
</svg>';
?>

<section class="onsen-intro">
    <?= wp_get_attachment_image($decor_left_id, 'full', false, array('class' => 'onsen-intro__decor-left')) ?>
    <?= wp_get_attachment_image($decor_right_id, 'full', false, array('class' => 'onsen-intro__decor-right')) ?>
    <?= wp_get_attachment_image($bg_id, 'full', false, array('class' => 'onsen-intro__bg')) ?>

    <div class="onsen-intro__container">
        <div class="onsen-intro__content">
            <p class="onsen-intro__subtitle"><?= esc_html($subtitle) ?></p>
            <h2 class="onsen-intro__title"><?= esc_html($title) ?></h2>
            <p class="onsen-intro__description"><?= esc_html($description) ?></p>

            <div class="onsen-intro__btn desktop">
                <?= wp_get_attachment_image($button_image_desktop_id, 'full', false, array('class' => 'onsen-intro__btn-img onsen-intro__btn-img--desktop')) ?>
                <button type="button" class="onsen-intro__btn-link"
                    onclick="document.querySelector('.popup__booking').classList.add('active'); document.documentElement.style.overflow = 'hidden';">
                    <?= wp_get_attachment_image($button_bg_id, 'full', false, array('class' => 'onsen-intro__btn-link-bg')) ?>
                    <p class="onsen-intro__btn-link-text">
                        Đăng ký trải nghiệm ngay
                    </p>
                    <span class="onsen-intro__btn-link-icon">
                        <!--<?= wp_get_attachment_image(59, 'icon', false, array('data-no-lazy' => '1')) ?>-->
                        <?php echo $icon_arrow_id; ?>
                    </span>
                </button>
            </div>
        </div>

        <div class="onsen-intro__benefits">

            <div class="onsen-intro__brand">
                <?= wp_get_attachment_image($brand_img_id, 'full', false, array('class' => 'onsen-intro__brand-img')) ?>
            </div>

            <?php if (!empty($benefits)): ?>
                <?php foreach ($benefits as $index => $benefit): ?>
                    <div class="onsen-intro__benefit">
                        <?= wp_get_attachment_image($benefit_bg_id, 'full', false, ['class' => 'onsen-intro__benefit-bg']) ?>
                        <p class="onsen-intro__benefit-number"><?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?></p>
                        <p class="onsen-intro__benefit-title"><?= esc_html($benefit['title'] ?? '') ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

        <!-- Mobile Button -->
        <div class="onsen-intro__btn mobile">
            <?= wp_get_attachment_image($button_image_mobile_id, 'full', false, array('class' => 'onsen-intro__btn-img onsen-intro__btn-img--mobile')) ?>
            <div onclick="document.querySelector('.popup__booking').classList.add('active'); document.documentElement.style.overflow = 'hidden';"
                class="onsen-intro__btn-link">
                <?= wp_get_attachment_image($button_bg_id, 'full', false, array('class' => 'onsen-intro__btn-link-bg')) ?>
                <p class="onsen-intro__btn-link-text">Đăng ký trải nghiệm</p>
                <span class="onsen-intro__btn-link-icon">
                    <!--<?= wp_get_attachment_image(59, 'icon', false, array('data-no-lazy' => '1')) ?>-->
                    <?php echo $icon_arrow_id; ?>
                </span>
            </div>
        </div>
    </div>
</section>