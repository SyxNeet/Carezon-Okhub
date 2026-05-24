document.addEventListener("DOMContentLoaded", function () {
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

                document
                    .querySelectorAll(
                        ".loading-ellipse-container-background-video"
                    )
                    .forEach((video) => {
                        video.setAttribute("src", video.dataset.src);
                        video.setAttribute("loop", "true");
                        video.setAttribute("muted", "true");
                        video.setAttribute("autoplay", "true");

                        // Ensure video loops continuously
                        video.addEventListener("ended", () => {
                            video.currentTime = 0;
                            video.play();
                        });

                        video.play().catch((error) => {
                            console.warn("Video autoplay failed:", error);
                        });
                    });
                document
                    .querySelectorAll(
                        ".loading-ellipse-container-background-youtube"
                    )
                    .forEach((youtube) => {
                        const youtubeUrl = youtube.dataset.src;
                        const youtubeId = youtubeUrl.split("v=")[1];
                        // Add autoplay, mute and enablejsapi parameters for proper autoplay and loop
                        const iframeSrc = `https://www.youtube.com/embed/${youtubeId}?autoplay=1&mute=1&enablejsapi=1&loop=1&playlist=${youtubeId}&controls=0&rel=0&modestbranding=1&showinfo=0`;
                        youtube.setAttribute("src", iframeSrc);

                        // Wait for iframe to load then try to play
                        youtube.addEventListener("load", () => {
                            setTimeout(() => {
                                try {
                                    // Send play command
                                    youtube.contentWindow.postMessage(
                                        '{"event":"command","func":"playVideo","args":""}',
                                        "*"
                                    );

                                    // Listen for YouTube player events to ensure loop
                                    window.addEventListener(
                                        "message",
                                        (event) => {
                                            if (
                                                event.origin !==
                                                "https://www.youtube.com"
                                            )
                                                return;

                                            const data = JSON.parse(event.data);
                                            if (
                                                data.event === "video-progress"
                                            ) {
                                                // Video is playing, ensure it continues
                                                youtube.contentWindow.postMessage(
                                                    '{"event":"command","func":"playVideo","args":""}',
                                                    "*"
                                                );
                                            }
                                        }
                                    );
                                } catch (error) {
                                    console.warn(
                                        "YouTube autoplay failed:",
                                        error
                                    );
                                }
                            }, 1000);
                        });
                    });

                new Swiper(".loading-ellipse-swiper", {
                    // loop: true,
                    speed: 1000,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                    },
                    effect: "fade",
                    fadeEffect: {
                        crossFade: true,
                    },
                });
            }
        }, 1800); // Match CSS animation duration
    };

    // Trigger animation only on scroll
    document.addEventListener("scroll", triggerLoadingAnimation, {
        once: true,
        passive: true,
    });
});
