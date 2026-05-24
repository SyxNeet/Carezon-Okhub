<?php
$fallback_desktop = 823;
$fallback_mobile = 822;

$other_services = get_field('other_services');

// Early return if no data
if (!$other_services)
  return;
?>

<section class="other-services">
  <div class="other-services__container">

    <!-- Tabs -->
    <div class="other-services__tabs">
      <?php foreach ($other_services as $index => $group): ?>
        <div class="other-services__tab <?= $index == 0 ? 'other-services__tab--active' : '' ?>" style="--i:<?= $index ?>"
          data-index="<?= $index ?>">
          <span class="other-services__tab-title">
            <?= esc_html($group['time']) ?>
          </span>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Content -->
    <div class="other-services__content">

      <!-- Left -->
      <div class="other-services__main">

        <!-- Head -->
        <div class="other-services__head">
          <span class="other-services__heading">Dịch vụ khác</span>
          <span class="other-services__duration">Thời gian:
            <?= esc_html($other_services[0]['time'] ?? '') ?>
          </span>
        </div>

        <!-- Body -->
        <div class="other-services__list">
          <?php foreach ($other_services as $index => $group): ?>
            <div class="other-services__list-content <?= $index == 0 ? 'active' : '' ?>" data-index="<?= $index ?>">
              <?php if (isset($group['services']) && is_array($group['services'])): ?>
                <?php foreach ($group['services'] as $item): ?>
                  <?php
                  $price = isset($item['price']) ? (int) $item['price'] : 0;
                  $thumb = $item['thumbnail'] ?? null;
                  $serviceName = $item['service_name'] ?? '';
                  ?>
                  <div class="other-services__item">
                    <div class="other-services__item-info">
                      <?php if ($thumb): ?>
                        <?= wp_get_attachment_image($thumb, 'full', false, array('class' => 'other-services__item-image')); ?>
                      <?php endif; ?>
                      <h3 class="other-services__item-title"><?= esc_html($serviceName) ?></h3>
                    </div>

                    <span class="other-services__price">
                      <?= number_format($price, 0, ',', '.') ?> Vnđ
                    </span>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Right -->
      <div class="other-services__image">
        <?php foreach ($other_services as $index => $group): ?>
          <?php
          $desktop = $group['image_desktop'] ?? $fallback_desktop;
          $mobile = $group['image_mobile'] ?? $fallback_mobile;
          ?>
          <?= wp_get_attachment_image($desktop, 'full', false, array('class' => 'other-services__img other-services__img--desktop ' . ($index == 0 ? 'active' : ''))); ?>
          <?= wp_get_attachment_image($mobile, 'full', false, array('class' => 'other-services__img other-services__img--mobile ' . ($index == 0 ? 'active' : ''))); ?>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>