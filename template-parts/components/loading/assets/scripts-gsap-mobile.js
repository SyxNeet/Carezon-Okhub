document.addEventListener("DOMContentLoaded", function () {
    // This script only runs on mobile devices (IS_MOBILE is true)
    // Desktop will use the original scripts.js file

    const pageLoading = document.querySelector(".page-loading");
    const header = document.querySelector(".header");
    const ellipseContainer = document.querySelector(
        ".loading-ellipse-container"
    );

    if (!pageLoading) {
        console.error("Page loading element not found");
        return;
    }

    // Hide header initially
    if (header) {
        header.style.opacity = "0";
        header.style.visibility = "hidden";
    }

    // Track if animation has been triggered
    let animationTriggered = false;

    // GSAP Timeline for mobile optimization - matching original CSS animations
    const createMobileTimeline = () => {
        const tl = gsap.timeline({
            paused: true,
            onComplete: () => {
                // Show header after animation completes
                if (header) {
                    gsap.to(header, {
                        opacity: 1,
                        visibility: "visible",
                        duration: 0.3,
                        ease: "power2.out",
                    });
                }
            },
        });

        // Set initial states to match original CSS
        gsap.set(
            [
                ".loading__content-line-1",
                ".loading__content-line-2",
                ".loading-leaf--1",
                ".loading-leaf--2",
                ".loading-leaf--3",
                ".loading-leaf--4",
                ".loading-leaf--5",
                ".loading-leaf--6",
                ".loading-leaf--7",
                ".loading-logo",
            ],
            {
                force3D: true,
                willChange: "transform, opacity",
            }
        );

        // Phase 1: Text animations (matching original CSS keyframes)
        // Original: loading__content-line-1 animation runs for 2s
        tl.fromTo(
            ".loading__content-line-1",
            {
                opacity: 0,
                x: "-80%",
                force3D: true,
            },
            {
                opacity: 1,
                x: "0%",
                duration: 2.0, // Match original 2s duration
                ease: "power2.out",
            }
        )
            // Original: loading__content-line-2 animation runs for 2s
            .fromTo(
                ".loading__content-line-2",
                {
                    opacity: 0,
                    x: "100%",
                    force3D: true,
                },
                {
                    opacity: 1,
                    x: "0%",
                    duration: 2.0, // Match original 2s duration
                    ease: "power2.out",
                },
                "-=1.5" // Start slightly after line-1
            );

        // Phase 2: Logo animation (matching original CSS)
        // Original: .page-loading.animate .loading-logo { top: 22.87rem; }
        tl.to(
            ".loading-logo",
            {
                y: "13.18rem", // 22.87rem - 9.69rem = 13.18rem
                duration: 1.8, // Match original transition duration
                ease: "power2.out",
            },
            "-=1.0"
        );

        // Phase 3: Ellipse container animation (matching original CSS)
        // Original: .page-loading.animate .loading-ellipse-container
        tl.to(
            ".loading-ellipse-container",
            {
                width: "54.92594rem",
                height: "89.57719rem",
                bottom: "-34.42rem",
                borderRadius: "30.10063rem",
                outline: "38.338px solid #cde3ce",
                boxShadow: "0 -8.847px 5.898px 0 rgba(45, 102, 53, 0.88) inset",
                duration: 1.8, // Match original transition duration
                ease: "power2.out",
            },
            "-=1.2"
        );

        // Phase 4: Ellipse container background animation
        // Original: .page-loading.animate .loading-ellipse-container-background
        tl.to(
            ".loading-ellipse-container-background",
            {
                bottom: "34.42rem",
                duration: 1.8,
                ease: "power2.out",
            },
            "-=1.8"
        );

        // Phase 5: Content line-2 font size change
        // Original: .page-loading.animate .loading__content-line-2 { font-size: 1.5rem; }
        tl.to(
            ".loading__content-line-2",
            {
                fontSize: "1.5rem",
                duration: 0.3,
                ease: "power2.out",
            },
            "-=0.5"
        );

        return tl;
    };

    // Function to trigger loading animation
    const triggerLoadingAnimation = () => {
        if (animationTriggered) return;

        animationTriggered = true;

        // Create and play timeline
        const mobileTimeline = createMobileTimeline();
        mobileTimeline.play();
    };

    // Trigger animation on scroll
    document.addEventListener("scroll", triggerLoadingAnimation, {
        once: true,
        passive: true,
    });

    // Fallback: trigger after 3 seconds if no scroll
    setTimeout(() => {
        if (!animationTriggered) {
            triggerLoadingAnimation();
        }
    }, 3000);
});
