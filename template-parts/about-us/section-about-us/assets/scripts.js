gsap.registerPlugin(ScrollTrigger);

const mm = gsap.matchMedia();

const DURATION = 1.4;
const EASE = "cubic-bezier(0.75, 0, 0.52, 1)";

let ROOT_FONT_SIZE = getRootFontSize();

function getRootFontSize() {
    return parseFloat(
        getComputedStyle(document.documentElement).fontSize
    );
}

function rem(value) {
    return value * ROOT_FONT_SIZE;
}

window.addEventListener("resize", () => {
    ROOT_FONT_SIZE = getRootFontSize();
});

function addAnimation(tl, section, selector, from, to = {}) {
    const element = section.querySelector(selector);

    if (!element) return;

    tl.fromTo(
        element,
        from,
        {
            duration: DURATION,
            ease: EASE,
            ...to,
        },
        0 // all animations start together
    );
}

export function sectionAboutUs() {
    const section = document.querySelector(".section-about-us");

    if (!section) return;

    // SINGLE ScrollTrigger
    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: section,
            start: "top 20%",
            toggleActions: "play none none none",
        },
    });

    // Shared
    addAnimation(
        tl,
        section,
        ".section-about-us__anim-flower-top",
        {
            x: rem(-7.6389),
            y: rem(6.6875),
            opacity: 0,
        },
        {
            x: 0,
            y: 0,
            opacity: 1,
        }
    );

    addAnimation(
        tl,
        section,
        ".section-about-us__anim-flower-bottom",
        {
            opacity: 0,
            scale: 0.314,
        },
        {
            opacity: 1,
            scale: 1,
        }
    );

    addAnimation(
        tl,
        section,
        ".section-about-us__anim-pattern",
        {
            opacity: 0,
            scale: 0.531,
            x: rem(-20.2957),
            y: rem(16.5417),
        },
        {
            opacity: 1,
            scale: 1,
            x: 0,
            y: 0,
        }
    );

    addAnimation(
        tl,
        section,
        ".section-about-us__anim-outer",
        {
            opacity: 0,
            x: rem(9.4375),
            y: rem(10.62644),
        },
        {
            opacity: 1,
            x: 0,
            y: 0,
        }
    );

    addAnimation(
        tl,
        section,
        ".section-about-us__anim-inner",
        {
            scale: 2.5,
            top: rem(-16),
            left: rem(2.5),
        },
        {
            scale: 1,
            top: rem(-1.75),
            left: rem(0.5),
        }
    );

    // MOBILE
    mm.add("(max-width: 640px)", () => {
        addAnimation(
            tl,
            section,
            ".section-about-us__circle-wrapper",
            {
                height: rem(35.92194),
            },
            {
                height: rem(21.90531),
            }
        );

        // Circle
        addAnimation(
            tl,
            section,
            ".about-us__right-circle-2",
            {
                top: rem(10.31),
                left: "50%",
                xPercent: -50,
            },
            {
                top: rem(8.23),
                left: "0%",
                xPercent: 0,
            }
        );

        addAnimation(
            tl,
            section,
            ".about-us__right-circle-3",
            {
                top: rem(21.52),
                right: "50%",
                xPercent: 50,
            },
            {
                top: rem(8.23),
                right: "0",
                xPercent: 0,
            }
        );

        // Dots
        [
            [
                ".about-us__right-circle-2 .section-about-us__circle-dot--1",
                { top: rem(1.51), left: rem(2.15) },
                { top: rem(0.39), left: rem(3.98) },
            ],
            [
                ".about-us__right-circle-2 .section-about-us__circle-dot--2",
                { top: rem(-0.11), left: rem(6.73) },
                { top: rem(0.4), left: rem(17.01) },
            ],
            [
                ".about-us__right-circle-2 .section-about-us__circle-dot--3",
                { top: rem(1.44), left: rem(11.09) },
                { top: rem(4.7), left: rem(13.19) },
            ],
            [
                ".about-us__right-circle-2 .section-about-us__circle-dot--4",
                { top: rem(12.29), left: rem(10.06) },
                { top: rem(12.34), left: rem(10.52) },
            ],
            [
                ".about-us__right-circle-3 .section-about-us__circle-dot--1",
                { top: rem(1.13), left: rem(2.75) },
                { top: rem(4.64), left: rem(0.13) },
            ],
            [
                ".about-us__right-circle-3 .section-about-us__circle-dot--2",
                { top: rem(-0.18), left: rem(6.62) },
                { top: rem(1.01), left: rem(2.83) },
            ],
        ].forEach(([selector, from, to]) => {
            addAnimation(tl, section, selector, from, to);
        });

        // Text
        addAnimation(
            tl,
            section,
            ".section-about-us__circle-text--1",
            {
                top: rem(5.72),
            },
            {
                top: rem(5.15),
            }
        );

        addAnimation(
            tl,
            section,
            ".section-about-us__circle-text--2",
            {
                top: rem(16.25),
                left: "50%",
                xPercent: -50,
            },
            {
                top: rem(17.24),
                left: rem(2.83),
                xPercent: 0,
            }
        );

        addAnimation(
            tl,
            section,
            ".section-about-us__circle-text--3",
            {
                top: rem(27.82),
                right: "50%",
                xPercent: 50,
            },
            {
                top: rem(17.08),
                right: rem(3.38),
                xPercent: 0,
            }
        );

        // Images
        [
            [
                ".section-about-us__circle-image--1",
                {
                    top: rem(1.87),
                    left: "50%",
                    opacity: 0,
                    xPercent: -50,
                },
                {
                    top: rem(1.29),
                    left: "50%",
                    opacity: 1,
                    xPercent: -50,
                },
            ],
            [
                ".section-about-us__circle-image--2",
                {
                    top: rem(13.81),
                    left: rem(2.61),
                    opacity: 0,
                },
                {
                    top: rem(13.15),
                    left: rem(2.61),
                    opacity: 1,
                },
            ],
            [
                ".section-about-us__circle-image--3",
                {
                    top: rem(13.24),
                    right: rem(2.55),
                    opacity: 0,
                },
                {
                    top: rem(13.24),
                    right: rem(2.53),
                    opacity: 1,
                },
            ],
        ].forEach(([selector, from, to]) => {
            addAnimation(tl, section, selector, from, to);
        });
    });
}