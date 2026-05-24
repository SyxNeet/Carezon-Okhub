<?php
$bg_id = wp_is_mobile() ? 826 : 820;
$button_icon_id = 434;
$accordion_icon_id = 880;
$tab_icon_id = 838;
$poster_video_id = 825;

$services = get_field('services');
?>

<section class="service-pricing">

  <?= wp_get_attachment_image($bg_id, 'full', false, ['class' => 'service-pricing__background']); ?>

  <div class="service-pricing__container">

    <h2 class="service-pricing__title">
      Bảng giá dịch vụ
    </h2>

    <!-- Tabs -->
    <div class="service-pricing__tabs">
      <?php if (!empty($services) && is_array($services)) : ?>
        <?php foreach ($services as $service_index => $service) :
          $service_title = isset($service['title']) ? $service['title'] : '';
          $is_active = $service_index === 0;
          $service_panel_id = 'service-pricing-panel-' . $service_index;
          $service_tab_id = 'service-pricing-tab-' . $service_index;
        ?>
          <button class="service-pricing__tab<?= $is_active ? ' active' : '' ?>" type="button" data-tab="<?= esc_attr($service_panel_id) ?>" id="<?= esc_attr($service_tab_id) ?>">
            <?= wp_get_attachment_image($tab_icon_id, 'full', false, ['class' => 'service-pricing__tab-icon']); ?>
            <span class="service-pricing__tab-title"><?= esc_html($service_title) ?></span>
          </button>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- Content -->
    <div class="service-pricing__content">

      <?php if (!empty($services) && is_array($services)) : ?>
        <?php foreach ($services as $service_index => $service) :
          $service_title = isset($service['title']) ? $service['title'] : '';
          $times = isset($service['times']) && is_array($service['times']) ? $service['times'] : [];
          $videos = isset($service['videos']) && is_array($service['videos']) ? $service['videos'] : [];
          $video_type = isset($videos['video_type']) ? $videos['video_type'] : '';
          $video_tiktok = isset($videos['tiktok']) ? $videos['tiktok'] : '';
          $video_upload = isset($videos['upload']) ? $videos['upload'] : null;
          $is_service_active = $service_index === 0;
          $service_panel_id = 'service-pricing-panel-' . $service_index;
        ?>
          <div class="service-pricing__panel<?= $is_service_active ? ' active' : '' ?>" data-panel="<?= esc_attr($service_panel_id) ?>" id="<?= esc_attr($service_panel_id) ?>">
            <div class="service-pricing__video">
              <?php if ($video_type === 'upload' && !empty($video_upload) && is_array($video_upload) && !empty($video_upload['url'])) : ?>
                <video data-type="upload" data-src="<?= esc_url($video_upload['url']) ?>" poster="<?= wp_get_attachment_image_url($poster_video_id, 'full') ?>" class="service-pricing__video-media" autoplay muted loop playsinline controls>
                </video>
              <?php else : ?>
                <iframe data-type="tiktok" data-src="<?= esc_url($video_tiktok) ?>" class="service-pricing__video-media service-pricing__video-media--iframe" autoplay muted loop frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>
              <?php endif; ?>

            </div>

            <div class="service-pricing__info">

              <!-- Info Tabs -->
              <div class="service-pricing__info-tabs">

                <!-- Tabs list -->
                <div class="service-pricing__info-tabs-list">
                  <?php foreach ($times as $time_index => $time_item) :
                    $time_label = isset($time_item['time']) ? $time_item['time'] : '';
                    $is_time_active = $time_index === 0;
                    $time_panel_id = $service_panel_id . '-time-' . $time_index;
                    $time_tab_id = $service_panel_id . '-time-tab-' . $time_index;
                  ?>
                    <button class="service-pricing__info-tab<?= $is_time_active ? ' active' : '' ?>" type="button" data-tab="<?= esc_attr($time_panel_id) ?>" id="<?= esc_attr($time_tab_id) ?>">
                      <?= wp_get_attachment_image($tab_icon_id, 'full', false, ['class' => 'service-pricing__info-tab-icon']); ?>
                      <span class="service-pricing__info-tab-title"><?= esc_html($time_label) ?></span>
                    </button>
                  <?php endforeach; ?>
                </div>

                <!-- CTA -->
                <button class="service-pricing__button service-pricing__button--desktop" type="button">
                  <span class="service-pricing__button-text">Đăng ký</span>
                  <span class="service-pricing__button-icon">
                    <?= wp_get_attachment_image($button_icon_id, 'full', false, ['class' => 'service-pricing__button-icon-svg']); ?>
                  </span>
                </button>

              </div>

              <?php foreach ($times as $time_index => $time_item) :
                $time_label = isset($time_item['time']) ? $time_item['time'] : '';
                $time_pricing_raw = isset($time_item['pricing']) ? $time_item['pricing'] : '';
                $time_pricing = is_numeric($time_pricing_raw) ? number_format((float) $time_pricing_raw, 0, ',', '.') : $time_pricing_raw;
                $includes = isset($time_item['includes']) && is_array($time_item['includes']) ? $time_item['includes'] : [];
                $is_time_active = $time_index === 0;
                $time_panel_id = $service_panel_id . '-time-' . $time_index;
              ?>
                <div class="service-pricing__info-panel<?= $is_time_active ? ' active' : '' ?>" data-panel="<?= esc_attr($time_panel_id) ?>" id="<?= esc_attr($time_panel_id) ?>">
                  <div class="service-pricing__info-top">
                    <div class="service-pricing__info-header">
                      <h3 class="service-pricing__info-title"><?= esc_html($service_title) ?></h3>
                      <p class="service-pricing__info-price"><?= esc_html($time_pricing) ?> VNĐ</p>
                    </div>

                    <button class="service-pricing__button service-pricing__button--mobile" type="button">
                      <span class="service-pricing__button-text">Đăng ký</span>
                      <span class="service-pricing__button-icon">
                        <?= wp_get_attachment_image($button_icon_id, 'full', false, ['class' => 'service-pricing__button-icon-svg']); ?>
                      </span>
                    </button>
                  </div>

                  <!-- Include -->
                  <div class="service-pricing__include">
                    <p class="service-pricing__include-title">Dịch vụ bao gồm</p>

                    <div class="service-pricing__include-list">
                      <?php foreach ($includes as $include_index => $include_item) :
                        $include_title = isset($include_item['title']) ? $include_item['title'] : '';
                        $has_subitems = !empty($include_item['has_subitems']);
                        $subitems = isset($include_item['subitems']) && is_array($include_item['subitems']) ? $include_item['subitems'] : [];
                      ?>
                        <div class="service-pricing__include-item">
                          <div class="service-pricing__include-trigger">
                            <span class="service-pricing__include-index"><?= esc_html($include_index + 1) ?>.</span>
                            <span class="service-pricing__include-text"><?= esc_html($include_title) ?></span>
                            <span class="service-pricing__include-icon-wrap<?= $has_subitems ? '' : ' hidden' ?>">
                              <?= wp_get_attachment_image($accordion_icon_id, 'full', false, ['class' => 'service-pricing__include-icon']); ?>
                            </span>
                          </div>

                          <?php if ($has_subitems) : ?>
                            <div class="service-pricing__include-accordion">
                              <ul class="service-pricing__include-sublist">
                                <?php foreach ($subitems as $subitem) :
                                  $subitem_name = isset($subitem['subitem_name']) ? $subitem['subitem_name'] : '';
                                ?>
                                  <li class="service-pricing__include-subitem">
                                    <div class="service-pricing__include-subitem-icon"></div>
                                    <span class="service-pricing__include-subitem-text"><?= esc_html($subitem_name) ?></span>
                                  </li>
                                <?php endforeach; ?>
                              </ul>
                            </div>
                          <?php endif; ?>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>