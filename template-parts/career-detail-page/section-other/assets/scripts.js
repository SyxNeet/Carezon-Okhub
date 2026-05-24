let ROOT_FONT_SIZE = parseFloat(
    getComputedStyle(document.documentElement).fontSize
);

function updateRootFontSize() {
    ROOT_FONT_SIZE = parseFloat(
        getComputedStyle(document.documentElement).fontSize
    );
}

function remToPixels(rem) {
    return rem * ROOT_FONT_SIZE;
}

let careerOtherSwiper = null;

export const sectionOtherScripts = () => {
    const root = document.querySelector(".career-other");

    if (!root || typeof Swiper === "undefined") return;

    const swiperEl = root.querySelector(".career-other__swiper");

    if (!swiperEl) return;

    const initSwiper = () => {
        updateRootFontSize();

        const isDesktop = window.matchMedia("(min-width: 640px)").matches;

        // Mobile -> destroy swiper
        if (!isDesktop) {
            if (careerOtherSwiper) {
                careerOtherSwiper.destroy(true, true);
                careerOtherSwiper = null;
            }

            return;
        }

        // Already initialized
        if (careerOtherSwiper) {
            careerOtherSwiper.params.spaceBetween = remToPixels(1.875);
            careerOtherSwiper.update();
            return;
        }

        careerOtherSwiper = new Swiper(swiperEl, {
            slidesPerView: 3,
            spaceBetween: remToPixels(1.875),
            loop: true,
            grabCursor: true,
            watchOverflow: true,

            navigation: {
                nextEl: root.querySelector(".career-other__next"),
                prevEl: root.querySelector(".career-other__prev"),
            },

            pagination: {
                el: root.querySelector(".career-other__pagination"),
                clickable: true,
            },
        });
    };

    initSwiper();

    window.addEventListener("resize", initSwiper);
};