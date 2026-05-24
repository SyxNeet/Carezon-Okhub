<?php
$post_id = $args['post_id'] ?? get_the_ID();
if (!$post_id)
    return;

$title = get_the_title($post_id);
$quantity = get_field('quantity', $post_id);
$location = get_field('location', $post_id);
$experience = get_field('experience', $post_id);
$job_type = get_field('job_type', $post_id);

$deadline = get_field('deadline', $post_id);
$remaining_days = '';
if ($deadline) {

    $today = new DateTime(current_time('Y-m-d'));
    $end = new DateTime($deadline);

    if ($end >= $today) {
        $diff = $today->diff($end);
        $remaining_days = $diff->days;
    }

}

$salary_type = get_field('salary_type', $post_id);
$salary_min = get_field('salary_min', $post_id);
$salary_max = get_field('salary_max', $post_id);
$salary_fixed = get_field('salary_fixed', $post_id);
$salary_negotiable = get_field('salary_negotiable', $post_id);

$salary_display = '';

switch ($salary_type) {

    case 'range':
        if ($salary_min !== null && $salary_max !== null && $salary_min !== '' && $salary_max !== '') {
            $salary_display =
                number_format((int) $salary_min, 0, ',', '.') . ' - ' .
                number_format((int) $salary_max, 0, ',', '.');
        }
        break;

    case 'fixed':
        $salary_display = $salary_fixed !== null ? number_format((int) $salary_fixed, 0, ',', '.') : '';
        break;

    case 'negotiable':
        $salary_display = $salary_negotiable ?: 'Thỏa thuận';
        break;

}

$icon_location_id = 1100;
$icon_income_id = 1099;
$icon_experience_id = 1105;
$icon_quantity_id = 1098;
$icon_type_id = 1097;
?>

<article class="career-card">

    <a href="<?= esc_url(get_permalink($post_id)) ?>" class="career-card__link"></a>

    <div class="career-card__header">
        <h3 class="career-card__title"><?= esc_html($title) ?></h3>
        <div class="career-card__type">
            <?= wp_get_attachment_image($icon_type_id, 'full', false, array('class' => 'career-card__type-icon')) ?>
            <span class="career-card__type-text"><?= esc_html($job_type['label'] ?? '') ?></span>
        </div>
    </div>

    <div class="career-card__info">
        <div class="career-card__info-item">
            <?= wp_get_attachment_image($icon_location_id, 'full', false, array('class' => 'career-card__info-icon')) ?>
            <p class="career-card__info-text">
                Địa điểm: <strong><?= esc_html($location) ?></strong>
            </p>
        </div>
        <div class="career-card__info-item">
            <?= wp_get_attachment_image($icon_income_id, 'full', false, array('class' => 'career-card__info-icon')) ?>
            <p class="career-card__info-text">
                Thu nhập: <strong><?= esc_html($salary_display) ?></strong>
            </p>
        </div>
        <div class="career-card__info-item">
            <?= wp_get_attachment_image($icon_experience_id, 'full', false, array('class' => 'career-card__info-icon')) ?>
            <p class="career-card__info-text">
                Kinh nghiệm: <strong><?= esc_html($experience) ?></strong>
            </p>
        </div>
        <div class="career-card__info-item">
            <?= wp_get_attachment_image($icon_quantity_id, 'full', false, array('class' => 'career-card__info-icon')) ?>
            <p class="career-card__info-text">
                Số lượng: <strong><?= esc_html($quantity) ?> người</strong>
            </p>
        </div>
    </div>

    <div class="career-card__footer">
        <span class="career-card__deadline" <?= $remaining_days === '' ? ' style="display:none"' : '' ?>><?= $remaining_days !== '' ? 'Còn lại ' . esc_html($remaining_days) . ' ngày' : '' ?></span>
        <span class="career-card__cta">
            Xem chi tiết →
        </span>
    </div>
</article>