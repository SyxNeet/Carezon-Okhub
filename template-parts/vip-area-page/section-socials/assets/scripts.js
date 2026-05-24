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

let socialsSwiper = null;

export const sectionSocialsScripts = () => {
    const root = document.querySelector(".section-socials");

    if (!root || typeof Swiper === "undefined") return;

    const swiperEl = root.querySelector(".section-socials__slider");

    if (!swiperEl) return;

    const initSwiper = () => {
        updateRootFontSize();

        const isDesktop = window.matchMedia("(min-width: 640px)").matches;

        // Mobile -> destroy swiper
        if (!isDesktop) {
            if (socialsSwiper) {
                socialsSwiper.destroy(true, true);
                socialsSwiper = null;
            }
            return;
        }

        // Already initialized
        if (socialsSwiper) {
            socialsSwiper.params.spaceBetween = remToPixels(1);
            socialsSwiper.update();
            return;
        }

        socialsSwiper = new Swiper(swiperEl, {
            slidesPerView: "auto",
            spaceBetween: remToPixels(1),
            loop: true,
            grabCursor: true,
            watchOverflow: true,
        });
    };

    initSwiper();

    window.addEventListener("resize", initSwiper);
};