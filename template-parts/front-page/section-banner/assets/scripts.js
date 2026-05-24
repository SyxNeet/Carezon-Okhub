export function sectionBanner() {
    const pagination = document.querySelector(".section-banner .custom-pagination");
    const dotsContainer = document.querySelector(".section-banner .custom-pagination .dots");
    const btnPrev = document.querySelector(".section-banner .custom-pagination .prev");
    const btnNext = document.querySelector(".section-banner .custom-pagination .next");
    const toggle = document.querySelector(".section-banner .custom-pagination .toggle");
    const youtube = document.querySelector(".section-banner .banner-youtube");
    
    const youtubeUrl = youtube.dataset.src;
    const youtubeId = youtubeUrl.split("v=")[1];
    const iframeSrc = `https://www.youtube.com/embed/${youtubeId}?autoplay=1&mute=1&enablejsapi=1&loop=1&playlist=${youtubeId}&controls=0&rel=0&modestbranding=1&showinfo=0`;
    youtube.setAttribute("src", iframeSrc);
    
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
    
    
    
    let isPlaying = true;
    
    const swiper = new Swiper(".section-banner .swiper", {
        loop: true,
        speed: 1000,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        effect: "fade",
        fadeEffect: {
            crossFade: true,
        },
        grabCursor: true,
        on: {
          init: function () {
            pagination.classList.remove("hidden");
            renderDots(this);
          },
          slideChange: function () {
            updateDots(this);
          },
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