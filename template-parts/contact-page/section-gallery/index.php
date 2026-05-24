<?php
$gallery = get_field('contact_gallery') ?: [];

// fallback
$fallback = [
    'large' => 369,
    'top' => 370,
    'bottom_1' => 371,
    'bottom_2' => 372,
];

// helper lấy ID (phòng khi ACF return array)
function get_img_id($img, $fallback)
{
    if (is_array($img) && isset($img['ID'])) return $img['ID'];
    if (is_numeric($img)) return $img;
    return $fallback;
}

$img_large     = get_img_id($gallery['gallery_large'] ?? null, $fallback['large']);
$img_top       = get_img_id($gallery['gallery_top'] ?? null, $fallback['top']);
$img_bottom_1  = get_img_id($gallery['gallery_bottom_1'] ?? null, $fallback['bottom_1']);
$img_bottom_2  = get_img_id($gallery['gallery_bottom_2'] ?? null, $fallback['bottom_2']);
?>

<section class="gallery">
    <div class="gallery__container">
        <!-- left -->
        <div class="gallery__left">
            <?= wp_get_attachment_image(
                $img_large,
                'full',
                false,
                ['class' => 'gallery__image gallery__image--large', 'alt' => 'Gallery Large']
            ); ?>
        </div>

        <!-- right -->
        <div class="gallery__right">
            <!-- top -->
            <div class="gallery__top">
                <?= wp_get_attachment_image(
                    $img_top,
                    'full',
                    false,
                    ['class' => 'gallery__image gallery__image--top', 'alt' => 'Gallery Top']
                ); ?>
            </div>

            <!-- bottom -->
            <div class="gallery__bottom">
                <div class="gallery__bottom-item">
                    <?= wp_get_attachment_image(
                        $img_bottom_1,
                        'full',
                        false,
                        ['class' => 'gallery__image gallery__image--bottom', 'alt' => 'Gallery Bottom 1']
                    ); ?>
                </div>
                <div class="gallery__bottom-item">
                    <?= wp_get_attachment_image(
                        $img_bottom_2,
                        'full',
                        false,
                        ['class' => 'gallery__image gallery__image--bottom', 'alt' => 'Gallery Bottom 2']
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</section>