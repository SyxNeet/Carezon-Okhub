<?php
$icon_phone_id = 780;
$icon_address_id = 781;

$branches = get_field("contact_branch") ?? [];
?>

<section class="branch">
  <div class="branch__container">
    <h2 class="branch__title">Hệ thống chi nhánh</h2>

    <div class="branch__list">
      <?php if (!empty($branches)): ?>
        <?php foreach ($branches as $index => $branch):
          $title = $branch['title'] ?? '';
          $phone = $branch['phone'] ?? '';
          $address = $branch['address'] ?? '';
          $map_url = $branch['map_link'] ?? '';
          ?>
          <div class="branch-card">

            <h3 class="branch-card__title">
              <?= esc_html($title) ?>
            </h3>

            <?php if ($phone): ?>
              <div class="branch-card__phone">
                <?= wp_get_attachment_image($icon_phone_id, 'full', false, ['class' => 'branch-card__icon']) ?>
                <span class="branch-card__text">
                  Số điện thoại: <?= esc_html($phone) ?>
                </span>
              </div>
            <?php endif; ?>

            <?php if ($address): ?>
              <div class="branch-card__location">
                <?= wp_get_attachment_image($icon_address_id, 'full', false, ['class' => 'branch-card__icon']) ?>

                <div class="branch-card__address">
                  <p class="branch-card__text">
                    Địa chỉ: <?= esc_html($address) ?>
                  </p>

                  <?php if ($map_url): ?>
                    <a class="branch-card__link" href="<?= esc_url($map_url) ?>" target="_blank" rel="noopener">
                      Xem địa chỉ trên Google Maps
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>

          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>