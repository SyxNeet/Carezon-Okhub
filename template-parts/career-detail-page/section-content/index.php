<?php
$icon_salary = 1109;
$icon_location = 1126;
$icon_experience = 1125;
$icon_level = 1118;
$icon_gender = 1117;
$icon_type = 1116;
$icon_quantity = 1115;
$icon_button = 59;

$post_id = get_the_ID();

$title = get_the_title($post_id);

$location = get_field('location', $post_id);
$experience = get_field('experience', $post_id);
$job_type = get_field('job_type', $post_id);
$quantity = get_field('quantity', $post_id);
$gender = get_field('gender', $post_id);
$level = get_field('level', $post_id);

$job_description = get_field('job_description', $post_id);
$benefits = get_field('benefits', $post_id);
$requirements = get_field('requirements', $post_id);

$salary_type = get_field('salary_type', $post_id);
$salary_min = get_field('salary_min', $post_id);
$salary_max = get_field('salary_max', $post_id);
$salary_fixed = get_field('salary_fixed', $post_id);
$salary_negotiable = get_field('salary_negotiable', $post_id);

$salary_display = '';

switch ($salary_type) {

    case 'range':
        if ($salary_min !== '' && $salary_max !== '') {
            $salary_display =
                number_format((int) $salary_min, 0, ',', '.') .
                ' - ' .
                number_format((int) $salary_max, 0, ',', '.');
        }
        break;

    case 'fixed':
        if ($salary_fixed !== '') {
            $salary_display = number_format((int) $salary_fixed, 0, ',', '.');
        }
        break;

    case 'negotiable':
        $salary_display = $salary_negotiable ?: 'Thỏa thuận';
        break;
}
?>

<section class="career-detail-content">
    <div class="career-detail-content__container">
        <h1 class="career-detail-content__title"> <?= esc_html($title) ?></h1>
        <div class="career-detail-content__wrapper">

            <div class="career-detail-content__detail">
                <div class="career-detail-content__top">
                    <div class="career-detail-content__meta">

                        <!-- Thu nhập -->
                        <div class="career-detail-content__meta-item">
                            <div class="career-detail-content__meta-icon">
                                <?= wp_get_attachment_image($icon_salary, 'full', false, array('class' => 'career-detail-content__meta-icon-img')) ?>
                            </div>
                            <div class="career-detail-content__meta-content">
                                <p class="career-detail-content__meta-label">Thu nhập</p>
                                <p class="career-detail-content__meta-value"><?= esc_html($salary_display) ?></p>
                            </div>
                        </div>

                        <!-- Địa điểm -->
                        <div class="career-detail-content__meta-item">
                            <div class="career-detail-content__meta-icon">
                                <?= wp_get_attachment_image($icon_location, 'full', false, array('class' => 'career-detail-content__meta-icon-img')) ?>
                            </div>
                            <div class="career-detail-content__meta-content">
                                <p class="career-detail-content__meta-label"> Địa điểm làm việc</p>
                                <p class="career-detail-content__meta-value"><?= esc_html($location) ?></p>
                            </div>
                        </div>

                        <!-- Kinh nghiệm -->
                        <div class="career-detail-content__meta-item">
                            <div class="career-detail-content__meta-icon">
                                <?= wp_get_attachment_image($icon_experience, 'full', false, array('class' => 'career-detail-content__meta-icon-img')) ?>
                            </div>
                            <div class="career-detail-content__meta-content">
                                <p class="career-detail-content__meta-label">Kinh nghiệm</p>
                                <p class="career-detail-content__meta-value"><?= esc_html($experience) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Nút ứng tuyển -->
                    <button class="career-detail-content__apply-button">
                        <span class="career-detail-content__apply-button-text">Ứng tuyển ngay</span>
                        <span class="career-detail-content__apply-button-icon">
                            <?= wp_get_attachment_image($icon_button, 'icon', false, array('data-no-lazy' => '1')) ?>
                        </span>
                    </button>
                </div>

                <div class="career-detail-content__sections">

                    <!-- Mô tả công việc -->
                    <div class="career-detail-content__section">
                        <p class="career-detail-content__section-title"> Mô tả công việc</p>
                        <div class="career-detail-content__section-content">
                            <?= wp_kses_post($job_description) ?>
                        </div>
                    </div>

                    <!-- Quyền lợi -->
                    <div class="career-detail-content__section">
                        <p class="career-detail-content__section-title">Quyền lợi</p>
                        <div class="career-detail-content__section-content">
                            <?= wp_kses_post($benefits) ?>
                        </div>
                    </div>

                    <!-- Yêu cầu ứng viên -->
                    <div class="career-detail-content__section">
                        <p class="career-detail-content__section-title">Yêu cầu ứng viên</p>
                        <div class="career-detail-content__section-content">
                            <?= wp_kses_post($requirements) ?>
                        </div>
                    </div>
                </div>

            </div>

            <aside class="career-detail-content__overview">
                <div class="career-detail-content__overview-inner">
                    <p class="career-detail-content__overview-title">Thông tin chung</p>
                    <div class="career-detail-content__overview-info">

                        <!-- Cấp bậc -->
                        <div class="career-detail-content__overview-info-item">
                            <div class="career-detail-content__overview-info-item-icon">
                                <?= wp_get_attachment_image($icon_level, 'full', false, array('class' => 'career-detail-content__overview-info-item-icon-img')) ?>
                            </div>
                            <div class="career-detail-content__overview-info-item-content">
                                <span class="career-detail-content__overview-info-item-label">
                                    Cấp bậc
                                </span>
                                <span class="career-detail-content__overview-info-item-value">
                                    <?= esc_html($level) ?>
                                </span>
                            </div>
                        </div>

                        <!-- Giới tính -->
                        <div class="career-detail-content__overview-info-item">
                            <div class="career-detail-content__overview-info-item-icon">
                                <?= wp_get_attachment_image($icon_gender, 'full', false, array('class' => 'career-detail-content__overview-info-item-icon-img')) ?>
                            </div>
                            <div class="career-detail-content__overview-info-item-content">
                                <span class="career-detail-content__overview-info-item-label">
                                    Giới tính
                                </span>
                                <span class="career-detail-content__overview-info-item-value">
                                    <?= esc_html($gender['label']) ?>
                                </span>
                            </div>
                        </div>

                        <!-- Hình thức làm việc -->
                        <div class="career-detail-content__overview-info-item">
                            <div class="career-detail-content__overview-info-item-icon">
                                <?= wp_get_attachment_image($icon_type, 'full', false, array('class' => 'career-detail-content__overview-info-item-icon-img')) ?>
                            </div>
                            <div class="career-detail-content__overview-info-item-content">
                                <span class="career-detail-content__overview-info-item-label">
                                    Hình thức làm việc
                                </span>
                                <span class="career-detail-content__overview-info-item-value">
                                    <?= esc_html($job_type['label'] ?? '') ?>
                                </span>
                            </div>
                        </div>

                        <!-- Số lượng -->
                        <div class="career-detail-content__overview-info-item">
                            <div class="career-detail-content__overview-info-item-icon">
                                <?= wp_get_attachment_image($icon_quantity, 'full', false, array('class' => 'career-detail-content__overview-info-item-icon-img')) ?>
                            </div>
                            <div class="career-detail-content__overview-info-item-content">
                                <span class="career-detail-content__overview-info-item-label">
                                    Số lượng
                                </span>
                                <span class="career-detail-content__overview-info-item-value">
                                    <?= esc_html($quantity) ?> Người
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>