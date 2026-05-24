<?php
$gallery = get_field('gallery', 1056);
?>

<section class="career-gallery">
    <div class="career-gallery__container">
        <div class="career-gallery__list">
            <?php if ($gallery): ?>
                <?php foreach ($gallery as $item): ?>
                    <?= wp_get_attachment_image($item, 'full', false, array('class' => 'career-gallery__item')); ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>