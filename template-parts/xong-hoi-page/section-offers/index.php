<?php
$section = get_field('offers') ?: [];
$section_title = $section['title'] ?? '';
$section_description = $section['description'] ?? '';
$offers = $section['offer_list'] ?? [];

$pause_icon = 829;
$play_icon = 840;
$prev_icon = 830;
?>

<section class="onsen-offers">
    <div class="onsen-offers__container">
        <div class="onsen-offers__header">
            <h2 class="onsen-offers__title"><?= esc_html($section_title); ?></h2>
            <p class="onsen-offers__description"><?= esc_html($section_description); ?></p>
        </div>

        <?php get_template_part('template-parts/components/special-offers/index', null, ['offers' => $offers]); ?>
    </div>
</section>