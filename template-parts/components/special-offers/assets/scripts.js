
export function specialOfferScript() {
    const pagination = document.querySelector("#special-offer .custom-pagination");
    const dotsContainer = document.querySelector("#special-offer .custom-pagination .dots");
    const btnPrev = document.querySelector("#special-offer .custom-pagination .prev");
    const btnNext = document.querySelector("#special-offer .custom-pagination .next");
    const toggle = document.querySelector("#special-offer .custom-pagination .toggle");

    let isPlaying = true;

    gsap.registerPlugin(ScrollTrigger);

    const convertRem = (rem) => {
        const rootFontSize = parseFloat(getComputedStyle(document.documentElement).fontSize) || 16;
        return rem * rootFontSize;
    }


    const animation = (swiper, activeIndex) => {
        if (!swiper || !swiper.slides) return;
        const isMobile = window.matchMedia("(max-width: 640px)").matches;
        const slides = Array.from(swiper.slides);

        const cardContainers = slides.flatMap((slide) =>
            Array.from(slide.querySelectorAll(".special-offer__list-container"))
        );
        const cardContents = slides.flatMap((slide) =>
            Array.from(
                slide.querySelectorAll(".special-offer__list-container-content")
            )
        );

        const imgContainerSelector = isMobile
            ? ".special-offer__list-container-content-image--mobile"
            : ".special-offer__list-container-content-image--pc";

        const imgContainers = slides
            .map((slide) => slide.querySelector(imgContainerSelector))
            .filter(Boolean);

        const imgOverlays = imgContainers
            .map((container) =>
                container.querySelector(
                    ".special-offer__list-container-content-image-overlay"
                )
            )
            .filter(Boolean);

        const imgTextContents = imgContainers
            .map((container) =>
                container.querySelector(
                    ".special-offer__list-container-content-image-content"
                )
            )
            .filter(Boolean);
        gsap
            .timeline({})
            .to(swiper.slides, {
                width: function (index, target, targets) {
                    if (isMobile) {
                        return activeIndex === index
                            ? convertRem(20.9375)
                            : convertRem(15.625);
                    }

                    return activeIndex === index ? convertRem(43) : convertRem(19.75)
                },
                background: function (index, target, targets) {
                    return activeIndex === index ? '#fff' : 'transparent'
                },
                duration: isMobile ? 1 : 1.5,
                ease: "power3.out",
            })
            .to(
                cardContainers,
                {
                    paddingTop: function (index, target, targets) {
                        if (isMobile) {
                            return activeIndex === index ? convertRem(0.75) : 0;
                        }

                        return activeIndex === index ? convertRem(1.1875) : 0
                    },
                    paddingBottom: function (index, target, targets) {
                        if (isMobile) {
                            return activeIndex === index ? convertRem(0.75) : 0;
                        }

                        return activeIndex === index ? convertRem(1.1875) : 0
                    },
                    paddingRight: function (index, target, targets) {
                        if (isMobile) {
                            return activeIndex === index ? convertRem(0.75) : 0;
                        }

                        return activeIndex === index ? convertRem(1.1875) : 0
                    },
                    paddingLeft: function (index, target, targets) {
                        if (isMobile) {
                            return activeIndex === index ? convertRem(0.75) : 0;
                        }

                        return activeIndex === index ? convertRem(1.1875) : 0
                    },
                    duration: isMobile ? 0.4 : 0.6,
                    ease: "power4.out",
                },
                '<',
            )
            .to(
                cardContents,
                {
                    autoAlpha: function (index, target, targets) {
                        return activeIndex === index ? 1 : 0
                    },
                    duration: isMobile ? 0.2 : 0.3,
                    ease: "power2.out",
                },
                '<',
            )
            .to(
                cardContents,
                {
                    autoAlpha: function (index) {
                        return activeIndex === index ? 1 : 0;
                    },
                    duration: 0.3,
                    ease: "power2.out",
                },
                "<"
            )
            .to(
                imgOverlays,
                {
                    autoAlpha: function (index) {
                        return activeIndex === index ? 0 : 1;
                    },
                    duration: 0.3,
                    ease: "power2.out",
                },
                "<"
            )
            .to(
                imgContainers,
                {
                    width: function (index, target, targets) {
                        if (isMobile) {
                            return activeIndex === index ? convertRem(7.875) : convertRem(15.625);
                        }
                        return activeIndex === index ? convertRem(14.9375) : convertRem(19.75)
                    },
                    borderRadius: (index) => activeIndex === index ? convertRem(0.75) : convertRem(1.5),
                    duration: isMobile ? 0.5 : 0.8,
                    ease: "power3.out",
                },
                '<',
            ).to(
                imgTextContents,
                {
                    autoAlpha: function (index) {
                        return activeIndex === index ? 0 : 1;
                    },
                    duration: isMobile ? 0.3 : 0.5,
                    ease: "power2.out",
                },
                "<"
            );
    }

    const swiper = new Swiper(".special-offer__list .swiper", {
        speed: 800,
        grabCursor: true,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        slidesOffsetBefore: convertRem(0.75 / 2),
        slidesOffsetAfter: convertRem(0.75 / 2),
        // navigation: {
        //   nextEl: ".swiper-button-next",
        //   prevEl: ".swiper-button-prev",
        // },
        // pagination: {
        //   el: ".special-offer-pagination",
        //   clickable: true,
        // },
        breakpoints: {
            0: {
                slidesPerView: 1.48,
                spaceBetween: convertRem(0.75),
            },
            768: {
                slidesPerView: 4.25,
                spaceBetween: convertRem(1.25),
            },
        },
        updateOnWindowResize: true,
        on: {
            init: function (swiper) {
                pagination.classList.remove("hidden");
                renderDots(swiper);
            },
            slideChange: (swiper) => {
                animation(swiper, swiper.activeIndex);
                updateDots(swiper);
            }
        }
    });

    btnPrev.addEventListener("click", () => {
        swiper.slidePrev();
    });

    btnNext.addEventListener("click", () => {
        swiper.slideNext();
    });

    function renderDots(swiper) {
        const total = swiper.slides.length;

        dotsContainer.innerHTML = "";
        for (let i = 0; i < total; i++) {
            const dot = document.createElement("span");
            dot.className = "dot";
            dot.addEventListener("click", () => swiper.slideToLoop(i));
            dotsContainer.appendChild(dot);
        }

        updateDots(swiper);
    }

    function updateDots(swiper) {
        const dots = dotsContainer.querySelectorAll("span");
        dots.forEach(dot => dot.classList.remove("active"));

        dots[swiper.realIndex]?.classList.add("active");
    }

    // pause/play
    toggle.addEventListener("click", () => {
        if (isPlaying) {
            swiper.autoplay.stop();
            toggle.querySelector(".icon-play").style.display = "block";
            toggle.querySelector(".icon-pause").style.display = "none";
        } else {
            swiper.autoplay.start();
            toggle.querySelector(".icon-play").style.display = "none";
            toggle.querySelector(".icon-pause").style.display = "block";
        }
        isPlaying = !isPlaying;
    });
}
