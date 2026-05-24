export function innitSwiperHero() {
    const isMobile = window.innerWidth <= 639;

    function setupPlayPause(swiperInstance, selector) {
        const btn = document.querySelector(selector);
        if (!btn) return;
        btn.addEventListener('click', function () {
            if (swiperInstance.autoplay.running) {
                swiperInstance.autoplay.stop();
                this.querySelector(".icon-play").style.display = "block";
                this.querySelector(".icon-pause").style.display = "none";
            } else {
                swiperInstance.autoplay.start();
                this.querySelector(".icon-play").style.display = "none";
                this.querySelector(".icon-pause").style.display = "block";
            }
        });
    }

    if (!isMobile) {
        const swiperPc = new Swiper('.hero-swiper-pc', {
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: "fade",
            fadeEffect: {
                crossFade: true,
            },
            grabCursor: true,
            pagination: { el: '.swiper-pagination-pc', clickable: true },
            navigation: { nextEl: '.hero-next-pc', prevEl: '.hero-prev-pc' },
        });

        setupPlayPause(swiperPc, '.hero-play-pause-pc.toggle');
    }

    if (isMobile) {
        const swiperMb = new Swiper('.hero-swiper-mb', {
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: "fade",
            fadeEffect: {
                crossFade: true,
            },
            pagination: { el: '.swiper-pagination-mb', clickable: true },
            navigation: { nextEl: '.hero-next-mb', prevEl: '.hero-prev-mb' },
        });

        setupPlayPause(swiperMb, '.hero-play-pause-mb.toggle');
    }
}