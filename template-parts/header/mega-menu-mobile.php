<?php
// Get header menu level 1 from ACF
$header_menu_lv1 = get_field('header_menu_lv1', 'option');
$header_contact = get_field('header_contact', 'option');
$contact = $header_contact['contact'];
$socials = $header_contact['socials'];
?>

<nav class="mega-menu mega-menu--mobile">
    <?= wp_get_attachment_image(50, 'full', false, array('class' => 'mega-menu__mobile-background')) ?>
    <div class="mega-menu__container">
        <!-- Mobile: Stack layout vertically -->
        <div class="mega-menu__mobile-header">
            <div class="mega-menu__mobile-logo">
                <?php
                $header = get_field('header', 'option');
                $header_logo = isset($header['logo']) ? $header['logo'] : null;
                if ($header_logo) :
                ?>
                <?= wp_get_attachment_image($header_logo, 'medium', false, array('class' => 'mega-menu__logo-img', 'data-no-lazy' => '1')) ?>
                <?php endif; ?>
            </div>
            <button class="mega-menu__close-btn">
                <?= wp_get_attachment_image(44, 'thumbnail', false, array('class' => 'mega-menu__close-icon')) ?>
            </button>
        </div>

        <div class="mega-menu__mobile-content">
            <!-- Mobile: Main menu items -->
            <div class="mega-menu__mobile-main">
                <ul class="mega-menu__mobile-list">
                    <?php if ($header_menu_lv1 && is_array($header_menu_lv1)) : ?>
                    <?php foreach ($header_menu_lv1 as $key => $header_menu_lv1_item) :
                            $item = $header_menu_lv1_item['link'];
                            $has_sub_menu = $header_menu_lv1_item['submenu'];
                            $item_url = '';
                            $item_title = '';
                            $item_target = '';
                            if ($item) :
                                $item_url = isset($item['url']) ? esc_url($item['url']) : '#';
                                $item_title = isset($item['title']) ? esc_html($item['title']) : '';
                                $item_target = isset($item['target']) ? esc_attr($item['target']) : '_self';
                            endif;
                        ?>
                    <li data-key="<?= $key ?>" data-has-sub-menu="<?= $has_sub_menu ?>" class="mega-menu__mobile-item">
                        <a class="mega-menu__mobile-link" href="<?= $item_url ?>" target="<?= $item_target ?>">
                            <?= $item_title ?>
                            <?php if ($has_sub_menu) : ?>
                            <?= wp_get_attachment_image(51, 'thumbnail', false, array('class' => 'mega-menu__mobile-arrow')) ?>
                            <?php endif; ?>
                        </a>

                        <!-- Mobile: Submenu dropdown -->
                        <?php if ($has_sub_menu) :
                                    $menu_lv2 = $header_menu_lv1_item['menu_lv2'];
                                ?>
                        <ul class="mega-menu__mobile-submenu">
                            <?php foreach ($menu_lv2 as $menu_lv2_item) :
                                            $item = $menu_lv2_item['link'];
                                            $item_url = '';
                                            $item_title = '';
                                            $item_target = '';
                                            if ($item) :
                                                $item_url = isset($item['url']) ? esc_url($item['url']) : '#';
                                                $item_title = isset($item['title']) ? esc_html($item['title']) : '';
                                                $item_target = isset($item['target']) ? esc_attr($item['target']) : '_self';
                                            endif;
                                        ?>
                            <li class="mega-menu__mobile-subitem">
                                <a class="mega-menu__mobile-sublink" href="<?= $item_url ?>"
                                    target="<?= $item_target ?>">
                                    <?= $item_title ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Mobile: Contact & Social -->
            <div class="mega-menu__mobile-footer">
                <div class="mega-menu__mobile-contact">
                    <?php foreach ($contact as $contact_item) :
                        $link_contact = $contact_item['link'];
                        $contact_label = $contact_item['label'];
                        $contact_icon = $contact_item['icon'];
                        if ($link_contact) :
                            $contact_title = isset($link_contact['title']) ? esc_html($link_contact['title']) : '';
                            $contact_url = isset($link_contact['url']) ? esc_url($link_contact['url']) : '#';
                            $contact_target = isset($link_contact['target']) ? esc_attr($link_contact['target']) : '_self';
                        endif;
                    ?>
                    <a class="mega-menu__mobile-contact-link" href="<?= $contact_url ?>"
                        target="<?= $contact_target ?>">
                        <span>
                            <?= wp_get_attachment_image($contact_icon, 'thumbnail', false, array('class' => 'mega-menu__mobile-contact-icon')) ?>
                            <?= $contact_label ?>
                        </span>
                        <?= $contact_title ?>
                    </a>
                    <?php endforeach; ?>
                </div>

                <div class="mega-menu__mobile-socials">
                    <span class="mega-menu__mobile-socials-text">Bản quyền thuộc về Khanh Duy Tan</span>
                    <div class="mega-menu__mobile-social-links">
                        <?php foreach ($socials as $social) :
                            $link = $social['link'];
                            $social_icon = $social['icon'];
                            if ($link) :
                                $link_title = isset($link['title']) ? esc_html($link['title']) : '';
                                $link_url = isset($link['url']) ? esc_url($link['url']) : '#';
                                $link_target = isset($link['target']) ? esc_attr($link['target']) : '_self';
                            endif;
                        ?>
                        <a class="mega-menu__mobile-social-link" href="<?= $link_url ?>" target="<?= $link_target ?>">
                            <?= wp_get_attachment_image($social_icon, 'thumbnail', false, array('class' => 'mega-menu__mobile-social-icon')) ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>