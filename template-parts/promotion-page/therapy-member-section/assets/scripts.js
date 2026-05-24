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

export const memberSwiper = () => {
    const root = document.querySelector(".member-wrapper");

    if (!root || typeof Swiper === "undefined") return;

    const swiperEl = root.querySelector(".member-swiper");

    if (!swiperEl) return;

    const initSwiper = () => {
        updateRootFontSize();

        const isDesktop = window.matchMedia("(min-width: 640px)").matches;

        // mobile destroy
        if (!isDesktop) {
            if (servicesSwiper) {
                servicesSwiper.destroy(true, true);
                servicesSwiper = null;
            }
            return;
        }

        // already init
        if (servicesSwiper) {
            servicesSwiper.params.spaceBetween = remToPixels(1.16);
            servicesSwiper.update();
            return;
        }

        servicesSwiper = new Swiper(swiperEl, {
            slidesPerView: "auto",
            spaceBetween: remToPixels(1.5),
            loop: true,
            grabCursor: true,
            watchOverflow: true,
            navigation: {
                nextEl: root.querySelector(".member-next"),
                prevEl: root.querySelector(".member-prev"),
            },
        });
    };

    initSwiper();

    window.addEventListener("resize", initSwiper);
};