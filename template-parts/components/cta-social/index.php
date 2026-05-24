<?php
$footer = get_field('footer', 'option');
$cta = isset($footer['cta']) ? $footer['cta'] : '';
?>
<div class="cta show">
    <div class="cta__socials">
        <?php if (isset($cta['phone']) && $cta['phone']): ?>
            <a href="<?= isset($cta['phone']['url']) ? $cta['phone']['url'] : ''; ?>" class="cta__btn cta__btn-call"
                title="Gọi ngay">
                <?= wp_get_attachment_image(282, 'full', false, array('class' => 'cta__icon')) ?>
            </a>
        <?php endif; ?>
        <?php if (isset($cta['zalo']) && $cta['zalo']): ?>
            <a style="--icon: url(<?= wp_get_attachment_image_url(280, 'full'); ?>);"
                href="<?= isset($cta['zalo']['url']) ? $cta['zalo']['url'] : ''; ?>" target="_blank"
                class="cta__btn cta__btn-zalo" title="Zalo">
                <?= wp_get_attachment_image(283, 'full', false, array('class' => 'cta__icon')) ?>
                <div class="cta__notification"></div>
            </a>
        <?php endif; ?>
        <?php if (isset($cta['messenger']) && $cta['messenger']): ?>
            <a href="<?= isset($cta['messenger']['url']) ? $cta['messenger']['url'] : ''; ?>" target="_blank"
                class="cta__btn cta__btn-messenger" title="Messenger">
                <?= wp_get_attachment_image(281, 'full', false, array('class' => 'cta__icon')) ?>
            </a>
        <?php endif; ?>
    </div>
</div>