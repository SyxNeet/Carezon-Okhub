<?php
$icon_email_id = 383;
$icon_phone_id = 384;
$icon_address_id = 382;
$icon_close_id = 782;
$icon_logo_id = 779;
$icon_bg_overlay_id = 881;

$contact_page_id = 365;

$contact_email = get_field('contact_email', $contact_page_id) ?: 'example@gmail.com';
$contact_phone = get_field('contact_phone', $contact_page_id) ?: '(+84) 971 519 xxx';
$contact_address = get_field('contact_address', $contact_page_id) ?: '29/40 Ngô Gia Tự, Phường Thủ Dầu Một, Thành phố Hồ Chí Minh';
$contact_maps_link = get_field('contact_maps_link', $contact_page_id) ?: '#';

$main_menu = get_field('main_menu', 'option');
$menu = $main_menu['menu'] ?? [];

$services = $main_menu['services'] ?? [];
$services_title = $services['title'] ?? '';
$services_links = $services['links'] ?? [];

$background_desktop = $main_menu['background_desktop'] ?? 913;
$background_mobile = $main_menu['background_mobile'] ?? 912;
$background_id = IS_MOBILE ? $background_mobile : $background_desktop; ?>

<div class="main-menu">
  <div class="mega-menu__overlay"></div>
  <div class="mega-menu__container">

    <!-- Background -->
    <div class="mega-menu__background">
      <?= wp_get_attachment_image($background_id, 'full', false, array('class' => 'mega-menu__background-img')) ?>
    </div>

    <!-- Left -->
    <div class="mega-menu__left">
      <a href="/">
        <?= wp_get_attachment_image($icon_logo_id, 'full', false, array('class' => 'mega-menu__left-brand')) ?>
      </a>
      <button class="mega-menu__close mega-menu__close--mobile">
        <?= wp_get_attachment_image($icon_close_id, 'full', false, array('class' => 'mega-menu__close-icon')) ?>
      </button>
    </div>

    <!-- Right -->
    <div class="mega-menu__right">
      <?= wp_get_attachment_image($icon_bg_overlay_id, 'full', false, array('class' => 'mega-menu__right-background')) ?>
      <button class="mega-menu__close mega-menu__close--desktop">
        <?= wp_get_attachment_image($icon_close_id, 'full', false, array('class' => 'mega-menu__close-icon')) ?>
      </button>

      <div class="mega-menu__inner">
        <div class="mega-menu__content">
          <!-- Menu chính -->
          <nav class="mega-menu__nav">
            <ul>
              <?php if (!empty($menu) && is_array($menu)): ?>
                <?php foreach ($menu as $index => $item):
                  $link = $item['link'] ?? [];
                  $url = $link['url'] ?? '#';
                  $title = $link['title'] ?? '';
                  $target = $link['target'] ?? '';
                ?>
                  <li>
                    <a href="<?= esc_url($url) ?>" <?= $target ? 'target="' . esc_attr($target) . '"' : '' ?>>
                      <span>0<?= esc_html($index + 1) ?></span>
                      <?= esc_html($title) ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </nav>

          <!-- Sub menu -->
          <div class="mega-menu__services">
            <h3><?= esc_html($services_title) ?></h3>
            <ul>
              <?php if (!empty($services_links) && is_array($services_links)): ?>
                <?php foreach ($services_links as $item):
                  $link = $item['link'] ?? [];
                  $url = $link['url'] ?? '#';
                  $title = $link['title'] ?? '';
                ?>
                  <li><a href="<?= esc_url($url) ?>"><?= esc_html($title) ?></a></li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>

        <!-- Footer contact -->
        <div class="mega-menu__footer">
          <ul>
            <li>
              <?= wp_get_attachment_image($icon_email_id, 'full', false, ['class' => 'mega-menu__footer-icon']) ?>
              Email: <?= esc_html($contact_email) ?>
            </li>
            <li>
              <?= wp_get_attachment_image($icon_phone_id, 'full', false, ['class' => 'mega-menu__footer-icon']) ?>
              Số điện thoại: <?= esc_html($contact_phone) ?>
            </li>
            <li>
              <?= wp_get_attachment_image($icon_address_id, 'full', false, ['class' => 'mega-menu__footer-icon']) ?>
              <div class="mega-menu__footer-address">
                <p>
                  Địa chỉ: <?= wp_kses_post($contact_address) ?>
                </p>
                <a href="<?= esc_url($contact_maps_link) ?>" target="_blank" rel="noopener">
                  Xem địa chỉ trên Google Maps
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</div>