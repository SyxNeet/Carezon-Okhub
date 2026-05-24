document.addEventListener("DOMContentLoaded", function () {
    // This script only runs on mobile devices (IS_MOBILE is true)
    // Desktop will use the original scripts.js file
    // EXACT copy of desktop script logic

    const pageLoading = document.querySelector(".page-loading");
    const header = document.querySelector(".header");
    const ellipseContainer = document.querySelector(
        ".loading-ellipse-container"
    );

    if (ellipseContainer) {
        ellipseContainer.classList.add("animate");
    }

    if (!pageLoading) {
        console.error("Page loading element not found");
        return;
    }

    // Hide header initially
    if (header) {
        header.style.opacity = "0";
        header.style.visibility = "hidden";
    }

    // Track if animation has been triggered to prevent multiple triggers
    let animationTriggered = false;

    // Function to trigger loading animation
    const triggerLoadingAnimation = () => {
        if (animationTriggered) return;

        animationTriggered = true;
        pageLoading.classList.add("animate");

        // Show header after animation completes
        setTimeout(() => {
            if (header) {
                header.style.opacity = "1";
                header.style.visibility = "visible";
            }
        }, 1800); // Match CSS animation duration
    };

    // Trigger animation only on scroll
    document.addEventListener("scroll", triggerLoadingAnimation, {
        once: true,
        passive: true,
    });
});
