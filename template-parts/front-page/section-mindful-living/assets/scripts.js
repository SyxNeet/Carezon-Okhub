export function sectionMindfulLiving() {
    // GSAP animation
    gsap.registerPlugin(ScrollTrigger);

    const breankpoint = 639.98;

    const mm = gsap.matchMedia();

    mm.add(
        {
            isMobile: `(max-width: ${breankpoint}px)`,
            isDesktop: `(min-width: ${breankpoint}px)`,
        },
        (context) => {
            let { isMobile, isDesktop } = context.conditions;
				
            const start = isMobile ? "top 60%" : "top 20%";

            gsap.from(".mindful-living__content", {
                opacity: 0,
                duration: 1.2,
                delay: 0.05,
                ease: "power1.easeOut",
                scrollTrigger: {
                    trigger: ".mindful-living",
                    start,
                },
            });

            const tl = gsap.timeline({
                delay: 0.05,
                defaults: { duration: 1.2, ease: "power1.easeOut" },
                scrollTrigger: {
                    trigger: ".mindful-living",
                    start,
                },
            });

            tl.to(
                isMobile
                    ? ".mindful-living__image-mobile"
                    : ".mindful-living__image",
                {
                    scale: 1.5,
                }
            ).to(
                isMobile
                    ? ".mindful-living__image-mobile"
                    : ".mindful-living__image",
                {
                    scale: 1,
                }
            );

            ScrollTrigger.create({
                trigger: ".footer__leaf",
                start: "top bottom",
                end: "bottom bottom",
                scrub: true,
                onUpdate: (self) => {
                    gsap.to(".footer__leaf", { y: self.progress * 100 });
                },
            });

            gsap.from(".mindful-living__link", {
                y: isMobile ? 100 : 50,
                delay: 1.2,
                duration: 1.2,
                autoAlpha: 0,
                ease: "power1.easeOut",
                scrollTrigger: {
                    trigger: ".mindful-living",
                    start,
                },
            });
        }
    );
}
