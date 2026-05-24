export function sectionAboutUs() {
    // Register ScrollTrigger plugin
    gsap.registerPlugin(ScrollTrigger);

    const contentItems = document.querySelectorAll(
        ".about-us__left__content__item"
    );
    const circles = document.querySelectorAll(".about-us__right-circle");
    const aboutUsSection = document.querySelector(".about-us");
    const header = document.querySelector(".header");

    // Early return if elements not found
    if (!aboutUsSection || contentItems.length === 0 || circles.length === 0) {
        console.warn("About Us section elements not found");
        return;
    }
    

    // Initial animation trigger
    // let hasAnimated = false;

    // const handleScroll = () => {
    //     if (hasAnimated) return;

    //     const rect = aboutUsSection.getBoundingClientRect();
    //     const windowHeight = window.innerHeight;

    //     // Trigger when section is 80% visible from bottom
    //     const cordination =
    //         window.innerWidth > 640
    //             ? rect.top <= windowHeight * 0.2
    //             : rect.top <= windowHeight * 0.3;
    //     if (cordination) {
    //         contentItems[0]?.classList.add("active");
    //         aboutUsSection.classList.add("animate");
    //         hasAnimated = true;
    //         window.removeEventListener("scroll", handleScroll);
    //     }
    // };

    // window.addEventListener("scroll", handleScroll);

    // Keep circles in final overlapped state immediately (no initial vertical animation)
    aboutUsSection.classList.add("animate");
    contentItems[0]?.classList.add("active");

    // GSAP ScrollTrigger with pin spacer for interactive animation
    ScrollTrigger.create({
        trigger: aboutUsSection,
        start: "top top",
        end: "+=250%", // 3x viewport height for smooth transitions
        pin: true,
        pinSpacing: true,
        scrub: 1, // Smooth scrubbing
        onUpdate: (self) => {
            const progress = self.progress;

            // Remove all active states first
            contentItems.forEach((item) => item.classList.remove("active"));
            circles.forEach((circle) => circle.classList.remove("active"));

            // Determine which state to activate based on scroll progress
            if (progress < 0.33) {
                // First state: Show first content item
                contentItems[1]?.classList.add("active");
                circles[0]?.classList.add("active");
            } else if (progress < 0.66) {
                // Second state: Show second content item
                contentItems[2]?.classList.add("active");
                circles[1]?.classList.add("active");
            } else {
                // Third state: Show third content item
                contentItems[3]?.classList.add("active");
                circles[2]?.classList.add("active");
            }
        },
        onEnter: () => {
            // Hide header on mobile when section is pinned
            if (window.innerWidth <= 639.98 && header) {
                header.classList.add("hide");
            }
        },
        onLeave: () => {
            // Show header when leaving pinned section
            if (window.innerWidth <= 639.98 && header) {
                header.classList.remove("hide");
            }
            contentItems[0]?.classList.add("active");
            contentItems[3]?.classList.remove("active");
            circles[2]?.classList.remove("active");
        },
        onEnterBack: () => {
            // Hide header when scrolling back into pinned section
            if (window.innerWidth <= 639.98 && header) {
                header.classList.add("hide");
            }
        },
        onLeaveBack: () => {
            // Show header when scrolling back out of pinned section
            if (window.innerWidth <= 639.98 && header) {
                header.classList.remove("hide");
            }
            contentItems[0]?.classList.add("active");
            contentItems[1]?.classList.remove("active");
            circles[0]?.classList.remove("active");
        },
        // Performance optimization
        invalidateOnRefresh: true,
        fastScrollEnd: true,
    });

    // Keep click events as fallback for mobile/touch devices
    circles.forEach((circle, index) => {
        circle.addEventListener("click", () => {
            const isActive = circle.classList.contains("active");

            // Remove active from all elements
            contentItems.forEach((item) => item.classList.remove("active"));
            circles.forEach((c) => c.classList.remove("active"));

            // Add active only if circle wasn't already active
            if (!isActive) {
                circle.classList.add("active");
                if (contentItems[index + 1]) {
                    contentItems[index + 1].classList.add("active");
                }
            } else {
                contentItems[1].classList.add("active");
            }
        });
    });

    // Cleanup function for better memory management
    return () => {
        ScrollTrigger.getAll().forEach((trigger) => {
            if (trigger.trigger === aboutUsSection) {
                trigger.kill();
            }
        });
    };
}
