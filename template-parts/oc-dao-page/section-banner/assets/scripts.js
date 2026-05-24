// Section Banner — Nhà hàng chay (restaurant-page)
// Cloned from onsen-banner: Swiper parallax + controls + play/pause.
// Swiper là global (enqueue từ CDN), không import module.

export function sectionBannerScript() {
    document.querySelectorAll('.section-banner').forEach((banner) => {
        const swiperEl = banner.querySelector('.section-banner__swiper');
        if (!swiperEl || typeof Swiper === 'undefined') return;

        const contentItems = Array.from(
            banner.querySelectorAll('.section-banner__content-item')
        );

        const setActiveContent = (activeIndex) => {
            contentItems.forEach((item) => {
                const indexAttr = item.getAttribute('data-banner-index');
                const index = indexAttr == null ? NaN : Number(indexAttr);
                item.classList.toggle('is-active', index === activeIndex);
            });
        };

        const swiper = new Swiper(swiperEl, {
            loop: true,
            speed: 1200,
            parallax: true,
            watchOverflow: true,

            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },

            pagination: {
                el: banner.querySelector('.section-banner__pagination'),
                clickable: true,
            },

            navigation: {
                prevEl: banner.querySelector('.section-banner__prev'),
                nextEl: banner.querySelector('.section-banner__next'),
            },

            on: {
                init(sw) {
                    setActiveContent(sw.realIndex);
                    queueMicrotask(() => {
                        if (sw?.autoplay?.running === false) sw.autoplay.start();
                    });
                },
                slideChange(sw) {
                    setActiveContent(sw.realIndex);
                },
            },
        });

        const playButton = banner.querySelector('.section-banner__play');

        playButton?.addEventListener('click', () => {
            const isPaused = playButton.classList.toggle('is-paused');
            if (isPaused) {
                swiper.autoplay.stop();
            } else {
                swiper.autoplay.start();
            }
        });
    });
}

// NOTE: KHÔNG tự execute. Orchestrator restaurant-page/assets/scripts.js
// sẽ import sectionBannerScript và gọi trong DOMContentLoaded handler.
