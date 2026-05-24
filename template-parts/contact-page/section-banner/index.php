<?php
$contact_banner_title = get_field('banner_title') ?: 'Carezone';
$contact_banner_desc = get_field('banner_desc') ?: 'Trải nghiệm nghệ thuật chăm sóc Thân - Tâm - Trí với những liệu trình chữa lành chuyên sâu mang lại sự tái sinh từng khoảnh khắc';
$contact_banner_bg_image = get_field('banner_background_image');
$contact_avatar_image = get_field('avatar_image');

// fallback
$fallback_bg = 367;
$fallback_avatar = 368;

?>

<section>
    <div class="contact-banner">
        <!-- background -->
        <?php
        if (!empty($contact_banner_bg_image)) {
            echo wp_get_attachment_image(
                $contact_banner_bg_image['ID'],
                'full',
                false,
                ['class' => 'contact-banner__background', 'alt' => esc_attr($contact_banner_title)]
            );
        } else {
            echo wp_get_attachment_image(
                $fallback_bg,
                'full',
                false,
                ['class' => 'contact-banner__background', 'alt' => esc_attr($contact_banner_title)]
            );
        }
        ?>

        <!-- content -->
        <div class="contact-banner__content">
            <!-- heading -->
            <h1 class="contact-banner__title"><?php echo esc_html($contact_banner_title); ?></h1>

            <!-- desc -->
            <p class="contact-banner__description"><?php echo esc_html($contact_banner_desc); ?></p>
        </div>
    </div>

    <!-- breadcrumb -->
<!--     <div class="contact-banner__breadcrumb">
        <div class="contact-banner__breadcrumb-wrapper">
            <a href="/">Trang chủ</a>
            <span>/</span>
            <a href="contact">Liên hệ</a>
        </div>
    </div> -->

    <!-- avatar -->
    <div class="contact-banner__avatar-wrapper">
        <?php
        if (!empty($contact_avatar_image)) {
            echo wp_get_attachment_image(
                $contact_avatar_image['ID'],
                'full',
                ['class' => 'contact-banner__avatar', 'alt' => 'Avatar']
            );
        } else {
            echo wp_get_attachment_image(
                $fallback_avatar,
                'full',
                ['class' => 'contact-banner__avatar', 'alt' => 'Avatar']
            );
        }
        ?>
    </div>
</section>