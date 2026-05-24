<?php
$VERSION = WP_DEBUG ? time() : wp_get_theme()->get('Version');;
define('THEME_VERSION', $VERSION);
// ============================== start wp_enqueue lib =====================//
// Add preconnect for Google Fonts
function my_add_preconnects($hints, $relation_type)
{
    if (is_singular() && 'preconnect' === $relation_type) {
        $hints[] = [
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => 'anonymous',
        ];
        $hints[] = [
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ];
    }
    return $hints;
}
add_filter('wp_resource_hints', 'my_add_preconnects', 10, 2);

function wp_enqueue_lib()
{

    wp_enqueue_style('font-quicksand', "https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap", [], THEME_VERSION);

    wp_enqueue_style('font-SVN-AmeyallindaSignature', get_theme_file_uri('/assets/fonts/SVN-AmeyallindaSignature/stylesheet.css'), [], THEME_VERSION);

    wp_enqueue_style('font-SVN-Optima
    ', get_theme_file_uri('/assets/fonts/SVN-Optima/stylesheet.css'), [], THEME_VERSION);

    wp_enqueue_style('font-SVN-Pleasent', get_theme_file_uri('/assets/fonts/SVN-Pleasent/stylesheet.css'), [], THEME_VERSION);

    wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], THEME_VERSION);
    wp_enqueue_script("swiper", 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], THEME_VERSION, true);
    // The core GSAP library
    wp_enqueue_script('gsap-js', 'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js', array(), false, true);
    // ScrollTrigger - with gsap.js passed as a dependency
    wp_enqueue_script('gsap-st', 'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js', array('gsap-js'), false, true);
    wp_enqueue_script('gsap-motion-path', 'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/MotionPathPlugin.min.js', array('gsap-js'), false, true);
    wp_enqueue_script('gsap-custom-ease', 'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/CustomEase.min.js', array('gsap-js'), false, true);
    wp_enqueue_script('ScrollToPlugin', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollToPlugin.min.js', array('gsap-js'), false, true);
}
add_action('wp_enqueue_scripts', 'wp_enqueue_lib', 20);


// ============================== end wp_enqueue lib =====================//

// ============================== wp_enqueue lib =====================//
function wp_enqueue_local()
{
    $wp_enqueue_mapping = [
        [
            'type' => 'style',
            'handle' => '_reset',
            'src' => get_theme_file_uri('/assets/css/_reset.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => true
        ],
        [
            'type' => 'style',
            'handle' => '_variables',
            'src' => get_theme_file_uri('/assets/css/_variables.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => true
        ],
        [
            'type' => 'style',
            'handle' => 'global',
            'src' => get_theme_file_uri('/assets/css/global.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => true
        ],
        [
            'type' => 'script',
            'handle' => '_utils',
            'src' => get_theme_file_uri('/assets/js/utils.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => true
        ],
        [
            'type' => 'script',
            'handle' => '_custom_option',
            'src' => get_theme_file_uri('/assets/js/custom-option.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => true
        ],
        // [
        //     'type' => 'style',
        //     'handle' => 'loading',
        //     'src' => get_theme_file_uri('/template-parts/components/loading/assets/styles.css'),
        //     'deps' => [],
        //     'ver' => THEME_VERSION,
        //     'in_footer' => false,
        //     'condition' => true
        // ],
        // [
        //     'type' => 'script',
        //     'handle' => 'loading',
        //     'src' => get_theme_file_uri('/template-parts/components/loading/assets/scripts.js'),
        //     'deps' => [],
        //     'ver' => THEME_VERSION,
        //     'in_footer' => true,
        //     'condition' => true
        // ],
        [
            'type' => 'style',
            'handle' => 'header',
            'src' => get_theme_file_uri('/template-parts/header/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => true
        ],
        [
            'type' => 'script',
            'handle' => 'header',
            'src' => get_theme_file_uri('/template-parts/header/assets/scripts.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => true
        ],
        [
            'type' => 'style',
            'handle' => 'footer',
            'src' => get_theme_file_uri('/template-parts/footer/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => true
        ],
        [
            'type' => 'script',
            'handle' => 'footer',
            'src' => get_theme_file_uri('/template-parts/footer/assets/scripts.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => true
        ],
        [
            'type' => 'style',
            'handle' => 'front-page',
            'src' => get_theme_file_uri('/template-parts/front-page/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => is_front_page()
        ],
        [
            'type' => 'script',
            'handle' => 'front-page',
            'src' => get_theme_file_uri('/template-parts/front-page/assets/scripts.js'),
            'deps' => ['swiper'],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => is_front_page()
        ],
        [
            'type' => 'style',
            'handle' => 'pricing-page',
            'src' => get_theme_file_uri('/template-parts/pricing-page/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => true
        ],
        [
            'type' => 'script',
            'handle' => 'pricing-page',
            'src' => get_theme_file_uri('/template-parts/pricing-page/assets/scripts.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => true
        ],
        [
            'type' => 'style',
            'handle' => 'contact-page',
            'src' => get_theme_file_uri('/template-parts/contact-page/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => is_page_template('contact-page.php')
        ],
        [
            'type' => 'script',
            'handle' => 'contact-page',
            'src' => get_theme_file_uri('/template-parts/contact-page/assets/scripts.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => is_page_template('contact-page.php')
        ],
        [
            'type' => 'style',
            'handle' => 'blog-item',
            'src' => get_theme_file_uri('/template-parts/components/blog-item/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => is_singular('post')
        ],
        [
            'type' => 'style',
            'handle' => 'about-us',
            'src' => get_theme_file_uri('/template-parts/about-us/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => is_page_template('about-us-page.php') || is_page('about-us') || is_page('ve-chung-toi')
        ],
        [
            'type' => 'script',
            'handle' => 'about-us',
            'src' => get_theme_file_uri('/template-parts/about-us/assets/scripts.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => is_page_template('about-us-page.php') || is_page('about-us') || is_page('ve-chung-toi')
        ],
        [
            'type' => 'style',
            'handle' => 'blog-detail-page',
            'src' => get_theme_file_uri('/template-parts/blog-detail-page/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => is_singular('post')
        ],
        [
            'type' => 'script',
            'handle' => 'blog-detail-page',
            'src' => get_theme_file_uri('/template-parts/blog-detail-page/assets/scripts.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => is_singular('post')
        ],
        [
            'type' => 'style',
            'handle' => 'blog-list-page',
            'src' => get_theme_file_uri('/template-parts/blog-list-page/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => is_page_template('blog-list-page.php')
        ],
        [
            'type' => 'script',
            'handle' => 'blog-list-page',
            'src' => get_theme_file_uri('/template-parts/blog-list-page/assets/scripts.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => is_page_template('blog-list-page.php')
        ],
        [
            'type' => 'style',
            'handle' => 'blog-item-skeleton',
            'src' => get_theme_file_uri('/template-parts/components/blog-item-skeleton/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => is_page_template('blog-list-page.php')
        ],
        [
            'type' => 'style',
            'handle' => 'onsen-page',
            'src' => get_theme_file_uri('/template-parts/onsen-page/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => is_page_template('onsen-page.php')
        ],
        [
            'type' => 'script',
            'handle' => 'onsen-page',
            'src' => get_theme_file_uri('/template-parts/onsen-page/assets/scripts.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => is_page_template('onsen-page.php')
        ],
        [
            'type' => 'style',
            'handle' => 'careers-page',
            'src' => get_theme_file_uri('/template-parts/careers-page/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => is_page_template('careers-page.php')
        ],
        [
            'type' => 'script',
            'handle' => 'careers-page',
            'src' => get_theme_file_uri('/template-parts/careers-page/assets/scripts.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => is_page_template('careers-page.php')
        ],
        [
            'type' => 'style',
            'handle' => 'career-detail-page',
            'src' => get_theme_file_uri('/template-parts/career-detail-page/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => is_singular('career')
        ],
        [
            'type' => 'script',
            'handle' => 'career-detail-page',
            'src' => get_theme_file_uri('/template-parts/career-detail-page/assets/scripts.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => is_singular('career')
        ],
        [
            'type' => 'style',
            'handle' => 'vip-area-page',
            'src' => get_theme_file_uri('/template-parts/vip-area-page/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => is_page_template('vip-area-page.php')
        ],
        [
            'type' => 'script',
            'handle' => 'vip-area-page',
            'src' => get_theme_file_uri('/template-parts/vip-area-page/assets/scripts.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => is_page_template('vip-area-page.php')
        ],
        [
            'type' => 'style',
            'handle' => 'promotion-page',
            'src' => get_theme_file_uri('/template-parts/promotion-page/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => is_page_template('promotion-page.php')
        ],
        [
            'type' => 'script',
            'handle' => 'promotion-page',
            'src' => get_theme_file_uri('/template-parts/promotion-page/assets/scripts.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => is_page_template('promotion-page.php')
        ],
        // ===== Restaurant Page =====
        [
            'type' => 'style',
            'handle' => 'restaurant-page',
            'src' => get_theme_file_uri('/template-parts/restaurant-page/assets/styles.css'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => false,
            'condition' => is_page_template('page-restaurant.php')
        ],
        [
            'type' => 'script',
            'handle' => 'restaurant-page',
            'src' => get_theme_file_uri('/template-parts/restaurant-page/assets/scripts.js'),
            'deps' => [],
            'ver' => THEME_VERSION,
            'in_footer' => true,
            'condition' => is_page_template('page-restaurant.php')
        ],
    ];

    foreach ($wp_enqueue_mapping as $wp_enqueue) {
        if (!$wp_enqueue['condition']) {
            continue;
        }
        if ($wp_enqueue['type'] == 'style') {
            wp_enqueue_style($wp_enqueue['handle'], $wp_enqueue['src'], $wp_enqueue['deps'], $wp_enqueue['ver']);
        } else {
            wp_enqueue_script($wp_enqueue['handle'], $wp_enqueue['src'], $wp_enqueue['deps'], $wp_enqueue['ver'], $wp_enqueue['in_footer']);
        }
    }
}

add_action('wp_enqueue_scripts', 'wp_enqueue_local', 1001);

add_filter('script_loader_tag', 'add_type_attribute', 10, 3);

function add_type_attribute($tag, $handle, $src)
{
    // if not your script, do nothing and return original $tag
    // if ('front-page' !== $handle && 'offcanvas' !== $handle) {
    $module_handles = ['front-page', "pricing-page", "contact-page", "blog-detail-page", "blog-list-page", "about-us", "onsen-page", "careers-page", "career-detail-page", "vip-area-page", "promotion-page", "restaurant-page"];
    if (!in_array($handle, $module_handles, true)) {
        return $tag;
    }

    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    return $tag;
}

// ============================== wp_enqueue lib =====================//