<?php
// Get header menu level 1 from ACF
$header_menu_lv1 = get_field('header_menu_lv1', 'option');
$header_contact = get_field('header_contact', 'option');
$contact = $header_contact['contact'];
$socials = $header_contact['socials'];
?>

<nav class="mega-menu">
    <div class="mega-menu__container">
        <div class="mega-menu__right">
            <div class="mega-menu__right-background">
                <?= wp_get_attachment_image(41, 'full', false, array('class' => 'mega-menu__right-background-img')) ?>
                <?= wp_get_attachment_image(42, 'full', false, array('class' => 'mega-menu__right-background-img')) ?>
            </div>
            <ul class="mega-menu__right-list">
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
                <li data-key="<?= $key ?>" data-has-sub-menu="<?= $has_sub_menu ?>" class="mega-menu__item">
                    <a class="WEB/H2/R font-lexend" href="<?= $item_url ?>"
                        target="<?= $item_target ?>"><?= $item_title ?></a>
                </li>
                <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
        <div class="mega-menu__left">
            <div class="mega-menu__left-background">
                <?= wp_get_attachment_image(43, 'full', false, array('class' => 'mega-menu__left-background-img')) ?>
            </div>
            <div class="mega-menu__left-content">
                <?php foreach ($header_menu_lv1 as $key => $header_menu_lv1_item) :
                    $menu_lv2 = $header_menu_lv1_item['menu_lv2'];
                    $has_sub_menu = $header_menu_lv1_item['submenu'];
                    if ($has_sub_menu) :
                ?>
                <ul data-key="<?= $key ?>" data-has-sub-menu="<?= $has_sub_menu ?>"
                    class="mega-menu__left-content-list">
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
                    <li class="mega-menu__left-content-item">
                        <a class="font-lexend" href="<?= $item_url ?>"
                            target="<?= $item_target ?>"><?= $item_title ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="mega-menu__left-bottom">
                <div class="mega-menu__left-socials">
                    <?php foreach ($socials as $social) :
                        $link = $social['link'];
                        if ($link) :
                            $link_title = isset($link['title']) ? esc_html($link['title']) : '';
                            $link_url = isset($link['url']) ? esc_url($link['url']) : '#';
                            $link_target = isset($link['target']) ? esc_attr($link['target']) : '_self';
                        endif;
                    ?>
                    <a href="<?= $link_url ?>" target="<?= $link_target ?>">
                        <?= $link_title ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <div class="mega-menu__left-contact">
                    <?php foreach ($contact as $contact) :
                        $link_contact = $contact['link'];
                        if ($link_contact) :
                            $contact_title = isset($link_contact['title']) ? esc_html($link_contact['title']) : '';
                            $contact_url = isset($link_contact['url']) ? esc_url($link_contact['url']) : '#';
                            $contact_target = isset($link_contact['target']) ? esc_attr($link_contact['target']) : '_self';
                        endif;
                    ?>
                    <a href="<?= $contact_url ?>" target="<?= $contact_target ?>">
                        <?= $contact_title ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <button class="mega-menu__close-btn">
        <?= wp_get_attachment_image(44, 'thumbnail', false, array('class' => 'mega-menu__close-icon')) ?>
    </button>
</nav>