<?php
$bg_id = 954;
$bg_mobile_id = 939;
$scenery_id = 955;
$scenery_mobile_id = 940;
$tower_id = 958;
$cherry_blossom_left_id = 956;
$cherry_blossom_right_id = 957;
$water_basin_id = 946;
$store_id = 947;
$flower_id = 945;
$fern_id = 944;
$bg_process_item_id = 941;

$processes = get_field('processes') ?: [];
?>

<section class="onsen-process">

    <?= wp_get_attachment_image($scenery_id, 'full', false, array('class' => 'onsen-process__scenery')) ?>
    <?= wp_get_attachment_image($scenery_mobile_id, 'full', false, array('class' => 'onsen-process__scenery--mobile')) ?>
    <?= wp_get_attachment_image($bg_id, 'full', false, array('class' => 'onsen-process__bg')) ?>
    <?= wp_get_attachment_image($bg_mobile_id, 'full', false, array('class' => 'onsen-process__bg--mobile')) ?>
    <?= wp_get_attachment_image($tower_id, 'full', false, array('class' => 'onsen-process__tower')) ?>
    <?= wp_get_attachment_image($cherry_blossom_left_id, 'full', false, array('class' => 'onsen-process__cherry-blossom--left')) ?>
    <?= wp_get_attachment_image($cherry_blossom_right_id, 'full', false, array('class' => 'onsen-process__cherry-blossom--right')) ?>
    <?= wp_get_attachment_image($water_basin_id, 'full', false, array('class' => 'onsen-process__water-basin')) ?>
    <?= wp_get_attachment_image($store_id, 'full', false, array('class' => 'onsen-process__store')) ?>
    <?= wp_get_attachment_image($flower_id, 'full', false, array('class' => 'onsen-process__flower')) ?>
    <?= wp_get_attachment_image($fern_id, 'full', false, array('class' => 'onsen-process__fern')) ?>
    <div class="onsen-process__overlay"></div>

    <div class="onsen-process__container">
        <div class="onsen-process__head">
            <h2 class="onsen-process__title">
                Quy trình trải nghiệm tắm Onsen
            </h2>
            <p class="onsen-process__description">
                Phương pháp thư giãn và chăm sóc sức khoẻ Nhật Bản
            </p>
        </div>
        <div class="onsen-process__list">
            <?php foreach ($processes as $index => $process): ?>
                <div class="onsen-process__item">
                    <?= wp_get_attachment_image($bg_process_item_id, 'full', false, array('class' => 'onsen-process__item__bg')) ?>
                    <div class="onsen-process__item__number">
                        <?= $index + 1 ?>
                    </div>
                    <div class="onsen-process__item__content">
                        <p class="onsen-process__item__content__step">Bước <?= $index + 1 ?></p>
                        <div class="onsen-process__item__content__title"><?= $process['title'] ?></div>
                        <p class="onsen-process__item__content__description">
                            <?= esc_html($process['description']) ?>
                        </p>
                    </div>
                    <div class="onsen-process__item__bottom">
                        <?= wp_get_attachment_image($process['image'], 'full', false, array('class' => 'onsen-process__item__bottom__image')) ?>
                        <div class="onsen-process__item__bottom__content"><?= esc_html($process['step_title']) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>