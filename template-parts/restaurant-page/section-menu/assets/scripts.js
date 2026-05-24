/**
 * Section Menu — Swiper carousel.
 * Mỗi slide là 1 ảnh thực đơn. Tabs + prev/next/play điều khiển Swiper.
 * Swiper được load global (handle "swiper" qua import-css-js.php).
 */

const AUTOPLAY_DELAY = 5000; // ms

export function sectionMenuScripts() {
    document.querySelectorAll('#section-menu').forEach((section) => {
        const swiperEl = section.querySelector('.js-menu-swiper');
        if (!swiperEl || typeof Swiper === 'undefined') return;
        if (swiperEl.dataset.menuSwiper === '1') return; // idempotent
        swiperEl.dataset.menuSwiper = '1';

        const tabs         = Array.from(section.querySelectorAll('.section-menu__tab'));
        const prevBtn      = section.querySelector('.section-menu__prev');
        const nextBtn      = section.querySelector('.section-menu__next');
        const playBtn      = section.querySelector('.section-menu__play');
        const paginationEl = section.querySelector('.section-menu__pagination');
        const slideCount   = swiperEl.querySelectorAll('.swiper-slide').length;
        const loop         = slideCount > 1;

        const swiper = new Swiper(swiperEl, {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: loop,
            speed: 600,
            grabCursor: true,
            autoplay: loop ? { delay: AUTOPLAY_DELAY, disableOnInteraction: false } : false,
            pagination: paginationEl ? {
                el: paginationEl,
                clickable: true,
                bulletClass: 'section-menu__bullet',
                bulletActiveClass: 'is-active',
            } : false,
            navigation: (prevBtn && nextBtn) ? {
                prevEl: prevBtn,
                nextEl: nextBtn,
            } : false,
            a11y: {
                prevSlideMessage: 'Tab trước',
                nextSlideMessage: 'Tab sau',
            },
            on: {
                slideChange() {
                    updateTabs(this.realIndex);
                },
            },
        });

        // --- Đồng bộ trạng thái active của tab ---
        function updateTabs(index) {
            tabs.forEach((tab, i) => {
                const active = i === index;
                tab.classList.toggle('is-active', active);
                tab.setAttribute('aria-selected', active ? 'true' : 'false');
            });
        }

        // --- Click tab → chuyển slide ---
        tabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                const index = parseInt(tab.dataset.tabIndex, 10) || 0;
                if (loop) {
                    swiper.slideToLoop(index);
                } else {
                    swiper.slideTo(index);
                }
            });
        });

        // --- Play / pause autoplay ---
        if (playBtn && swiper.autoplay) {
            playBtn.addEventListener('click', () => {
                if (swiper.autoplay.running) {
                    swiper.autoplay.stop();
                    playBtn.classList.add('is-paused');
                } else {
                    swiper.autoplay.start();
                    playBtn.classList.remove('is-paused');
                }
            });
        }

        updateTabs(0);
    });
}

// NOTE: KHÔNG tự execute. Orchestrator restaurant-page/assets/scripts.js gọi.
