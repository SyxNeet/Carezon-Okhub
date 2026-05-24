import { sectionForm } from "../section-form/assets/scripts.js";
import { sectionOtherScripts } from "../section-other/assets/scripts.js";

document.addEventListener("DOMContentLoaded", () => {
    sectionForm();
    sectionOtherScripts();

    // SCROLL TO FORM
    const applyButtons = document.querySelectorAll(
        ".career-detail-content__apply-button, .cta-career__button"
    );
    const formSection = document.querySelector("#careerFormSection");

    applyButtons.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            if (formSection) {
                const header = document.querySelector("header");
                const headerOffset = header?.offsetHeight || 0;
                const extraOffset = window.innerWidth < 768 ? 0 : 24;
                const elementPosition = formSection.getBoundingClientRect().top;
                const offsetPosition =
                    elementPosition + window.pageYOffset - headerOffset - extraOffset;

                window.scrollTo({ top: Math.max(0, offsetPosition), behavior: "smooth" });
            }
        });
    });

    // CTA CAREER SHOW / HIDE
    const ctaCareer =
        document.querySelector(".cta-career");

    const heroSection = document.querySelector(
        ".career-detail-banner"
    );

    if (ctaCareer) {
        let isVisible = false;

        const handleCareerCTA = () => {
            let shouldShow = false;

            // show when hero/banner out of viewport
            if (heroSection) {
                shouldShow =
                    heroSection.getBoundingClientRect()
                        .bottom < 0;
            } else {
                // fallback
                shouldShow =
                    window.pageYOffset >
                    window.innerHeight;
            }

            if (shouldShow && !isVisible) {
                ctaCareer.classList.add("show");
                isVisible = true;
            } else if (
                !shouldShow &&
                isVisible
            ) {
                ctaCareer.classList.remove("show");
                isVisible = false;
            }
        };

        // initial check
        handleCareerCTA();

        // optimized scroll listener
        let ticking = false;

        window.addEventListener("scroll", () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    handleCareerCTA();
                    ticking = false;
                });

                ticking = true;
            }
        });

        // resize support
        window.addEventListener("resize", () => {
            handleCareerCTA();
        });
    }
});

