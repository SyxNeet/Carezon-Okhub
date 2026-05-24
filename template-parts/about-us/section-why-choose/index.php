<?php
$overlay = 1397;
$background_why_choose = 1398;
$background_why_choose_mb = 1399;

$background_dom = 1400;
$hoa_sticky = 1401;
$bui_chuoi = 1402;
$overlay_item = 1403;
$hoa_bg = 1404;

$deco_why_choose = 1452;

$section_why_choose_acf = get_field('section-why-choose');

$why_choose_title       = $section_why_choose_acf['title'] ?? '';
$why_choose_description = $section_why_choose_acf['description'] ?? '';
$why_choose_flowers     = $section_why_choose_acf['flower'] ?? [];
$why_choose_services    = $section_why_choose_acf['sevices'] ?? [];
?>
<section class="section-why-choose">
    <div class="hoa-sticky">
        <?php echo wp_get_attachment_image($hoa_sticky, 'full', false, array('class' => '')) ?>
    </div>

    <div class="bui-chuoi">
        <?php echo wp_get_attachment_image($bui_chuoi, 'full', false, array('class' => '')) ?>
    </div>

    <div class="section-why-choose__wrapper">
        <div class="overlay_blur is_pc"></div>

        <?php echo wp_get_attachment_image($deco_why_choose, 'full', false, array('class' => 'deco-why-choose is_pc')) ?>
        <?php echo wp_get_attachment_image($background_why_choose, 'full', false, array('class' => 'background-why-choose is_pc')) ?>
        <?php echo wp_get_attachment_image($background_dom, 'full', false, array('class' => 'background-why-choose dom is_pc')) ?>
        <?php echo wp_get_attachment_image($background_why_choose_mb, 'full', false, array('class' => 'background-why-choose-mb is_mb')) ?>

        <div class="why-choose__heading">
            <?php if ($why_choose_title) : ?>
            <div class="why-choose__heading--title">
                <?= esc_html($why_choose_title); ?>
            </div>
            <?php endif; ?>

            <?php if ($why_choose_description) : ?>
            <div class="why-choose__heading--desc">
                <?= nl2br(esc_html($why_choose_description)); ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="why-choose__overlay">
            <?php echo wp_get_attachment_image($overlay, 'full', false, array('class' => '')) ?>
        </div>

        <div class="why-choose__content-hoa">
            <?php echo wp_get_attachment_image($hoa_bg, 'full', false, array('class' => 'why-choose__content-hoa--image')) ?>

            <?php if (!empty($why_choose_flowers)) : ?>
            <?php foreach ($why_choose_flowers as $index => $flower) :
                    $text = $flower['text'] ?? '';
                ?>
            <?php if ($text) : ?>
            <div class="content-hoa__item content-hoa__item-<?= esc_attr($index + 1); ?>">
                <?= esc_html($text); ?>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="why-choose__content">
            <div class="why-choose__content--title">
                Tổ hợp chăm sóc sức khỏe toàn diện:
            </div>

            <?php if (!empty($why_choose_services)) : ?>
            <div class="swiper why-choose__swiper">
                <div class="why-choose__content-wrapper swiper-wrapper">
                    <?php foreach ($why_choose_services as $service) :
                            $link  = $service['link'] ?? [];
                            $image = $service['image'] ?? '';

                            $link_title  = $link['title'] ?? '';
                            $link_url    = $link['url'] ?? '#';
                            $link_target = $link['target'] ?? '_self';
                        ?>
                    <a class="why-choose__content-item swiper-slide" href="<?= esc_url($link_url); ?>"
                        target="<?= esc_attr($link_target); ?>">

                        <?php if ($image) : ?>
                        <?php echo wp_get_attachment_image($image, 'full', false, array(
                                        'class' => 'why-choose__content-item-image',
                                        'loading' => 'lazy',
                                    )); ?>
                        <?php endif; ?>

                        <?php echo wp_get_attachment_image($overlay_item, 'full', false, array(
                                    'class' => 'why-choose__content-item--overlay',
                                )); ?>

                        <?php if ($link_title) : ?>
                        <div class="why-choose__content-item--title">
                            <?= esc_html($link_title); ?>
                        </div>
                        <?php endif; ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>