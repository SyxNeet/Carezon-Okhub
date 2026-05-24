export function sectionBannerScript() {
    document.querySelectorAll('.vip-area-banner').forEach((banner) => {
        const contentItems = Array.from(
            banner.querySelectorAll(".vip-area-banner__content-item")
        );

        const setActiveContent = (activeIndex) => {
            contentItems.forEach((item) => {
                const indexAttr = item.getAttribute("data-banner-index");
                const index = indexAttr == null ? NaN : Number(indexAttr);
                const isActive = index === activeIndex;

                item.classList.toggle("is-active", isActive);
            });
        };

        const swiper = new Swiper(
            banner.querySelector('.vip-area-banner__swiper'),
            {
                loop: true,
                speed: 1200,
                parallax: true,
                watchOverflow: true,

                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },

                pagination: {
                    el: banner.querySelector('.vip-area-banner__pagination'),
                    clickable: true,
                },

                navigation: {
                    prevEl: banner.querySelector('.vip-area-banner__prev'),
                    nextEl: banner.querySelector('.vip-area-banner__next'),
                },

                on: {
                    init(swiper) {
                        setActiveContent(swiper.realIndex);
                        queueMicrotask(() => {
                            if (swiper?.autoplay?.running === false) swiper.autoplay.start();
                        });
                    },
                    slideChange(swiper) {
                        setActiveContent(swiper.realIndex);
                    },
                },
            }
        )

        const playButton = banner.querySelector('.vip-area-banner__play')

        playButton?.addEventListener('click', () => {
            const isPaused = playButton.classList.toggle('is-paused')

            if (isPaused) {
                swiper.autoplay.stop()
            } else {
                swiper.autoplay.start()
            }
        })
    })
}