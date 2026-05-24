<?php

/**
 * Section: Offers — Restaurant Page
 * Parts: 1) Social CTA  2) Offer Cards  3) Booking Form
 */

$offers     = get_field('restaurant_offers') ?: [];
$subtitle   = $offers['subtitle'] ?? 'Stay in touch';
$title_raw  = $offers['title'] ?? "Theo dõi chúng tôi\n@carezone qua các nền tảng";
$social     = $offers['social_links'] ?? [];
$cards      = $offers['offer_cards'] ?? [];
$form_image = $offers['form_image'] ?? [];
$services   = $offers['form_service_options'] ?? [];

// Form image
$form_image_id = $form_image['ID'] ?? 0;

// Booking form services (option page) — dùng chung với booking-container ở trang chủ
$option_booking_services = get_field('option_booking_services', 'option') ?: [];

// Social platform icons (static theme assets — xuất từ Figma node section-offers)
$ic_facebook = get_theme_file_uri('/assets/images/restaurant-page/ic-social-facebook.png');
$ic_zalo     = get_theme_file_uri('/assets/images/restaurant-page/ic-social-zalo.png');
$ic_tiktok   = get_theme_file_uri('/assets/images/restaurant-page/ic-social-tiktok.png');

// Fallback static icons by index
$default_icons = [$ic_facebook, $ic_zalo, $ic_tiktok];

// Title lines — split on newline
$title_lines = array_map('trim', explode("\n", $title_raw));
?>

<section id="section-offers" class="section-offers">
    <div class="section-offers__bg-overlay" aria-hidden="true"></div>

    <div class="section-offers__inner">

        <!-- ================================================================
             Part 1: Social CTA
             ================================================================ -->
        <div class="section-offers__social-cta">

            <div class="section-offers__social-text">
                <?php if ($subtitle): ?>
                    <p class="section-offers__subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>

                <h2 class="section-offers__title">
                    <?php foreach ($title_lines as $line): ?>
                        <?php echo esc_html($line); ?><br>
                    <?php endforeach; ?>
                </h2>
            </div>

            <?php if (!empty($social)): ?>
                <div class="section-offers__social-buttons">
                    <?php foreach ($social as $idx => $item):
                        $link       = $item['link'] ?? [];
                        $link_url   = $link['url'] ?? '#';
                        $link_title = $link['title'] ?? '';
                        $link_target = $link['target'] ?? '_blank';
                        $icon_src   = $default_icons[$idx] ?? $ic_facebook;
                    ?>
                        <a
                            href="<?php echo esc_url($link_url); ?>"
                            target="<?php echo esc_attr($link_target); ?>"
                            class="section-offers__social-btn"
                            title="<?php echo esc_attr($link_title); ?>">
                            <img
                                src="<?php echo esc_url($icon_src); ?>"
                                alt=""
                                aria-hidden="true"
                                class="section-offers__social-btn-icon"
                                loading="lazy">
                            <span class="section-offers__social-btn-label"><?php echo esc_html($link_title); ?></span>
                            <span class="section-offers__social-btn-arrow" aria-hidden="true">
                                <span class="section-offers__social-btn-arrow-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#b98951" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </span>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div><!-- /.section-offers__social-cta -->

        <!-- ================================================================
             Part 2: Offer Cards
             ================================================================ -->
        <div class="section-offers__cards-row">
            <div
                class="section-offers__swiper swiper js-offers-swiper"
                aria-label="<?php echo esc_attr__('Ưu đãi nổi bật', 'okhub-theme'); ?>">
                <div class="section-offers__swiper-wrapper swiper-wrapper">
                    <?php
                    // Determine alternating layout: card 1,3 = full-height; card 2,4 = short
                    foreach ($cards as $card_idx => $card):
                        $card_image_id  = $card['image']['ID'] ?? 0;
                        $card_badge     = $card['badge'] ?? 'FACEBOOK';
                        $is_full        = ($card_idx % 2 === 0); // 0-based: even = full
                        $card_modifier  = $is_full ? 'section-offers__card--full' : 'section-offers__card--short';
                    ?>
                        <div class="section-offers__card <?php echo esc_attr($card_modifier); ?> swiper-slide">
                            <div class="section-offers__card-inner">
                                <?php if ($card_image_id): ?>
                                    <?php echo wp_get_attachment_image($card_image_id, 'large', false, [
                                        'class'   => 'section-offers__card-img',
                                        'loading' => 'lazy',
                                        'decoding' => 'async',
                                        'alt'     => '',
                                    ]); ?>
                                <?php endif; ?>

                                <div class="section-offers__card-badge" aria-hidden="true">
                                    <div class="section-offers__card-badge-icon">
                                        <img
                                            src="<?php echo esc_url(get_theme_file_uri('/assets/images/restaurant-page/ic-social-facebook.png')); ?>"
                                            alt="">
                                    </div>
                                    <span class="section-offers__card-badge-label"><?php echo esc_html($card_badge); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div><!-- /.swiper-wrapper -->

                <!-- <div class="section-offers__swiper-pagination swiper-pagination" aria-hidden="true"></div> -->
            </div><!-- /.swiper -->
        </div><!-- /.section-offers__cards-row -->
    </div><!-- /.section-offers__inner -->
</section><!-- /#section-offers -->