gsap.registerPlugin(ScrollTrigger);

export function sectionIntroScript() {
    const section = document.querySelector(".onsen-intro");
    const decorRight = section?.querySelector(".onsen-intro__decor-right");

    if (!section || !decorRight) return;

    const remToPx = (rem) =>
        rem *
        parseFloat(
            getComputedStyle(document.documentElement).fontSize
        );

    ScrollTrigger.create({
        trigger: section,
        start: `top top+=${remToPx(19.3)}`,
        end: "max",
        pin: decorRight,
        pinSpacing: false,
    });
}
