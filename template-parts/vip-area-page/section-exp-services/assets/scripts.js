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

let servicesSwiper = null;

export const sectionExpServicesScripts = () => {
    const root = document.querySelector(".section-services");

    if (!root || typeof Swiper === "undefined") return;

    const swiperEl = root.querySelector(".section-services__list");

    if (!swiperEl) return;

    const initSwiper = () => {
        updateRootFontSize();

        const isDesktop = window.matchMedia("(min-width: 640px)").matches;

        // Mobile -> destroy swiper
        if (!isDesktop) {
            if (servicesSwiper) {
                servicesSwiper.destroy(true, true);
                servicesSwiper = null;
            }
            return;
        }

        // Already initialized
        if (servicesSwiper) {
            servicesSwiper.params.spaceBetween = remToPixels(1.16);
            servicesSwiper.update();
            return;
        }

        servicesSwiper = new Swiper(swiperEl, {
            slidesPerView: "auto",
            spaceBetween: remToPixels(1.16),
            loop: true,
            grabCursor: true,
            watchOverflow: true,
            navigation: {
                nextEl: root.querySelector(".section-services__navigation-next"),
                prevEl: root.querySelector(".section-services__navigation-prev"),
            },
        });
    };

    initSwiper();

    window.addEventListener("resize", initSwiper);
};