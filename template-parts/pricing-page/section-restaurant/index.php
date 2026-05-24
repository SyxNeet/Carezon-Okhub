<?php
$icon_prev_id = 830;
$icon_prev_mobile_id = 828;
$icon_pause_id = 829;
$icon_play_id = 840;

$restaurant = get_field('restaurant');
$restaurant_title = $restaurant['title'] ?? '';
$restaurant_gallery = $restaurant['gallery'] ?? [];
?>

<section class="pricing__restaurant">
  <div class="pricing__restaurant-container">
    <h2 class="pricing__restaurant-title">
      <?= esc_html($restaurant_title) ?>
    </h2>
    <?php if (!empty($restaurant_gallery)): ?>
      <div class="pricing__restaurant-swiper swiper">
        <div class="swiper-wrapper">
          <?php foreach ($restaurant_gallery as $image_id): ?>
            <div class="pricing__restaurant-slide swiper-slide">
              <?= wp_get_attachment_image($image_id, 'full', false, ['class' => 'pricing__restaurant-image']) ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="pricing__restaurant-controls">
        <button class="pricing__restaurant-btn--desktop pricing__restaurant-prev">
          <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'pricing__restaurant-btn-icon']) ?>
        </button>
        <div class="pricing__restaurant-pagination"></div>
        <button class="pricing__restaurant-play">
          <?= wp_get_attachment_image($icon_play_id, 'full', false, ['class' => 'pricing__restaurant-play-icon']) ?>
          <?= wp_get_attachment_image($icon_pause_id, 'full', false, ['class' => 'pricing__restaurant-pause-icon']) ?>
        </button>
        <button class="pricing__restaurant-btn--desktop pricing__restaurant-next">
          <?= wp_get_attachment_image($icon_prev_id, 'full', false, ['class' => 'pricing__restaurant-btn-icon']) ?>
        </button>

        <div class="pricing__restaurant-navigation--mobile">
          <button class="pricing__restaurant-btn--mobile pricing__restaurant-prev">
            <?= wp_get_attachment_image($icon_prev_mobile_id, 'full', false, ['class' => 'pricing__restaurant-btn-icon']) ?>
          </button>
          <button class="pricing__restaurant-btn--mobile pricing__restaurant-next">
            <?= wp_get_attachment_image($icon_prev_mobile_id, 'full', false, ['class' => 'pricing__restaurant-btn-icon']) ?>
          </button>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>