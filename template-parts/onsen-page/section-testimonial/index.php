<?php
$leaf_left_id = 936;
$leaf_right_id = 938;
$cloud_desktop_id = 937;
$cloud_mobile_id = 932;
$quote_icon_id = 934;
$d_video_image_id = 935;
$video_play_id = 931;

$testimonial = get_field('testimonial');
$feedback = $testimonial['review'] ?? [];
$media = $testimonial['media'] ?? [];

function get_youtube_embed_url($url)
{
    preg_match('/(youtu\.be\/|v=)([^&]+)/', $url, $matches);
    $video_id = $matches[2] ?? '';

    return $video_id
        ? "https://www.youtube.com/embed/{$video_id}?autoplay=0&mute=1&rel=0"
        : '';
}
?>

<section class="onsen-testimonial">

    <?= wp_get_attachment_image($leaf_left_id, 'full', false, array('class' => 'onsen-testimonial__leaf--left')) ?>
    <?= wp_get_attachment_image($leaf_right_id, 'full', false, array('class' => 'onsen-testimonial__leaf--right')) ?>
    <?= wp_get_attachment_image($cloud_desktop_id, 'full', false, array('class' => 'onsen-testimonial__cloud--desktop')) ?>
    <?= wp_get_attachment_image($cloud_mobile_id, 'full', false, array('class' => 'onsen-testimonial__cloud--mobile')) ?>

    <div class="onsen-testimonial__container">

        <?php if ($media && isset($media['type']) && $media['type'] === 'video'): ?>
            <div class="onsen-testimonial__video">
                <?php
                $video_data = $media['video'] ?? [];
                $video_type = isset($video_data['type_video']) ? $video_data['type_video'] : '';
                ?>

                <?php if ($video_type === 'upload'): ?>
                    <!-- Thumbnail + play -->
                    <?= wp_get_attachment_image($d_video_image_id, 'full', false, ['class' => 'onsen-testimonial__video-image']) ?>
                    <?= wp_get_attachment_image($video_play_id, 'full', false, ['class' => 'onsen-testimonial__video-play']) ?>

                    <!-- Video file -->
                    <video class="onsen-testimonial__video-file" controls preload="none">
                        <source src="<?= esc_url(wp_get_attachment_url($video_data['upload']['ID'])); ?>" type="video/mp4">
                    </video>
                <?php elseif ($video_type === 'youtube'): ?>
                    <iframe class="onsen-testimonial__video-embed js-youtube"
                        data-src="<?= esc_url(get_youtube_embed_url($video_data['youtube'])); ?>" src="" frameborder="0"
                        allow="autoplay; encrypted-media" allowfullscreen>
                    </iframe>
                <?php endif; ?>
            </div>
        <?php elseif ($media && isset($media['type']) && $media['type'] === 'slides'): ?>

            <?php $slides = $media['slides'] ?? []; ?>

            <?php if (!empty($slides)): ?>
                <div class="onsen-testimonial__media-swiper swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($slides as $index => $image_id): ?>
                            <div class="swiper-slide">
                                <?= wp_get_attachment_image($image_id, 'full') ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php endif; ?>

        <div class="onsen-testimonial__quote">
            <div class="onsen-testimonial__swiper swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($feedback as $item):
                        $post_id = is_object($item) && isset($item->ID) ? (int) $item->ID : (int) $item;
                        if (!$post_id) {
                            continue;
                        }

                        $single_feedback = get_field('single_feedback', $post_id);
                        $quote = $single_feedback['content'] ?? '';
                        $author_name = get_the_title($post_id);

                        if (!$quote && !$author_name) {
                            continue;
                        }
                        ?>
                        <div class="onsen-testimonial__slide swiper-slide" data-author="<?= esc_attr($author_name) ?>">

                            <!-- <div class="onsen-testimonial__content"> -->
                            <span class="onsen-testimonial__text">
                                <?= esc_html($quote) ?>
                            </span>
                            <!-- </div> -->

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="onsen-testimonial__author">
                <?= wp_get_attachment_image($quote_icon_id, 'full', false, array('class' => 'onsen-testimonial__icon onsen-testimonial__icon--left')) ?>
                <span class="onsen-testimonial__name">Khách hàng</span>
                <?= wp_get_attachment_image($quote_icon_id, 'full', false, array('class' => 'onsen-testimonial__icon onsen-testimonial__icon--right')) ?>
            </div>
        </div>
    </div>
</section>