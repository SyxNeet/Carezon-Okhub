<?php
$social_section = get_field('social_section', 'option');

$label = $social_section['label'] ?? '';
$title = $social_section['title'] ?? '';

$social_platforms = $social_section['social_platforms'] ?? [];
$social_gallery = $social_section['social_gallery'] ?? [];
?>

<section class="section-socials">

    <?= wp_get_attachment_image(1268, 'full', false, ['class' => 'section-socials__bg--left']) ?>
    <?= wp_get_attachment_image(1270, 'full', false, ['class' => 'section-socials__bg--right']) ?>

    <div class="section-socials__head">
        <p class="section-socials__label"><?= esc_html($label) ?></p>
        <h2 class="section-socials__title"><?= esc_html($title) ?></h2>

        <?php if ($social_platforms): ?>
            <div class="section-socials__platforms">

                <?php foreach ($social_platforms as $item):
                    $icon = $item['icon'] ?? '';
                    $link = $item['link'] ?? '';

                    if (!$link)
                        continue;

                    $url = $link['url'] ?? '#';
                    $text = $link['title'] ?? '';
                    $target = $link['target'] ?: '_self';
                    ?>

                    <a href="<?= esc_url($url) ?>" target="<?= esc_attr($target) ?>" class="section-socials__platform">
                        <div class="section-socials__platform-image"><?= wp_get_attachment_image($icon, 'full') ?></div>
                        <span class="section-socials__platform-text"><?= esc_html($text) ?></span>
                        <div class="section-socials__platform-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M14.587 11.3796L13.6211 11.6385L14.1388 13.5703L15.1047 13.3114L14.8459 12.3455L14.587 11.3796ZM16.2875 12.9945C16.8209 12.8515 17.1375 12.3031 16.9945 11.7697C16.8516 11.2362 16.3032 10.9197 15.7697 11.0626L16.0286 12.0285L16.2875 12.9945ZM9.50006 4.5V3.5H7.50006V4.5H8.50006H9.50006ZM15.4741 12.8308C15.959 13.0952 16.5664 12.9166 16.8308 12.4317C17.0953 11.9469 16.9166 11.3394 16.4318 11.075L15.9529 11.9529L15.4741 12.8308ZM16.3275 12.9557C16.8396 12.7488 17.087 12.166 16.8801 11.6539C16.6731 11.1418 16.0903 10.8945 15.5782 11.1014L15.9529 12.0285L16.3275 12.9557ZM7.5 19.4814V20.4814H9.5V19.4814H8.5H7.5ZM14.8459 12.3455L15.1047 13.3114L16.0788 13.0504L15.82 12.0845L15.5611 11.1185L14.587 11.3796L14.8459 12.3455ZM15.82 12.0845L16.0788 13.0504L16.2875 12.9945L16.0286 12.0285L15.7697 11.0626L15.5611 11.1185L15.82 12.0845ZM8.50006 4.5H7.50006C7.50006 5.69437 8.14243 6.80876 8.88934 7.72543C9.6562 8.66659 10.6542 9.54572 11.6151 10.2882C12.5818 11.0352 13.5435 11.6687 14.2608 12.1142C14.6203 12.3376 14.9206 12.5151 15.1323 12.6374C15.2382 12.6986 15.3221 12.7461 15.3803 12.7787C15.4093 12.795 15.432 12.8076 15.4478 12.8163C15.4557 12.8207 15.4619 12.8241 15.4663 12.8265C15.4685 12.8277 15.4702 12.8287 15.4715 12.8294C15.4722 12.8297 15.4727 12.83 15.4732 12.8303C15.4734 12.8304 15.4736 12.8305 15.4737 12.8306C15.4739 12.8307 15.4741 12.8308 15.9529 11.9529C16.4318 11.075 16.4319 11.075 16.432 11.0751C16.432 11.0751 16.4321 11.0751 16.432 11.0751C16.432 11.0751 16.4319 11.075 16.4316 11.0749C16.4311 11.0746 16.4302 11.0741 16.4288 11.0733C16.4261 11.0718 16.4215 11.0694 16.4153 11.0659C16.4029 11.0591 16.3837 11.0484 16.3582 11.0341C16.3072 11.0055 16.231 10.9623 16.1331 10.9058C15.9372 10.7926 15.6553 10.626 15.3161 10.4153C14.6359 9.9928 13.7344 9.39833 12.8379 8.70559C11.9356 8.0083 11.0704 7.23596 10.4398 6.46209C9.78931 5.66374 9.50006 4.99955 9.50006 4.5H8.50006ZM15.9529 12.0285C15.5782 11.1014 15.5782 11.1014 15.5782 11.1014C15.5782 11.1014 15.5782 11.1014 15.5782 11.1014C15.5781 11.1014 15.5781 11.1014 15.5781 11.1014C15.578 11.1015 15.578 11.1015 15.5779 11.1015C15.5778 11.1016 15.5777 11.1016 15.5775 11.1017C15.5772 11.1018 15.5769 11.1019 15.5765 11.1021C15.5758 11.1024 15.5748 11.1028 15.5737 11.1032C15.5714 11.1041 15.5685 11.1053 15.5648 11.1069C15.5575 11.1099 15.5473 11.1141 15.5344 11.1194C15.5085 11.1302 15.4718 11.1456 15.4252 11.1657L15.82 12.0845L16.2148 13.0032C16.2542 12.9863 16.284 12.9738 16.3031 12.9658C16.3127 12.9618 16.3195 12.959 16.3237 12.9573C16.3257 12.9565 16.3271 12.9559 16.3277 12.9556C16.328 12.9555 16.3282 12.9554 16.3282 12.9555C16.3281 12.9555 16.3281 12.9555 16.328 12.9555C16.3279 12.9556 16.3279 12.9556 16.3278 12.9556C16.3277 12.9556 16.3277 12.9556 16.3277 12.9557C16.3276 12.9557 16.3276 12.9557 16.3276 12.9557C16.3276 12.9557 16.3276 12.9557 16.3276 12.9557C16.3275 12.9557 16.3275 12.9557 15.9529 12.0285ZM15.82 12.0845L15.4252 11.1657C14.8965 11.3928 12.9817 12.2568 11.1829 13.6119C9.44336 14.9223 7.5 16.9259 7.5 19.4814H8.5H9.5C9.5 17.9473 10.716 16.4676 12.3862 15.2094C13.997 13.996 15.7422 13.2063 16.2148 13.0032L15.82 12.0845Z"
                                    fill="#B98951" />
                            </svg>
                        </div>
                    </a>

                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($social_gallery): ?>
        <div class="section-socials__slider swiper">
            <div class="section-socials__wrapper swiper-wrapper">

                <?php foreach ($social_gallery as $index => $item):
                    $image = $item['image'] ?? '';
                    $icon = $item['icon'] ?? '';
                    $link = $item['link'] ?? '';

                    if (!$image || !$link)
                        continue;

                    $url = $link['url'] ?? '#';
                    $text = $link['title'] ?? '';
                    $target = $link['target'] ?: '_self';

                    $slide_classes = [
                        'section-socials__slide',
                        'swiper-slide',
                    ];

                    // item chẵn => thêm modifier
                    if ($index % 2) {
                        $slide_classes[] = 'section-socials__slide--small';
                    }
                    ?>

                    <a href="<?= esc_url($url) ?>" target="<?= esc_attr($target) ?>"
                        class="<?= esc_attr(implode(' ', $slide_classes)) ?>">
                        <?= wp_get_attachment_image($image, 'full', false, ['class' => 'section-socials__image']) ?>
                        <div class="section-socials__badge">
                            <div class="section-socials__badge-icon">
                                <?= wp_get_attachment_image($icon, 'full') ?>
                            </div>
                            <span class="section-socials__badge-text">
                                <?= esc_html($text) ?>
                            </span>
                        </div>
                    </a>

                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>