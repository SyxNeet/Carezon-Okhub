<h1 class="visually-hidden">
    CareZone
</h1>

<?php
get_template_part('template-parts/front-page/section-banner/index');
get_template_part('template-parts/front-page/section-experience/index');
wp_is_mobile() ? get_template_part('template-parts/front-page/discount-section/index-mobile') : get_template_part('template-parts/front-page/discount-section/index');
get_template_part('template-parts/front-page/section-about-us/index');
get_template_part('template-parts/front-page/section-mindful-living/index');
get_template_part('template-parts/front-page/section-feedback-v2/index');