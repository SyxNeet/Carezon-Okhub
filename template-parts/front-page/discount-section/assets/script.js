
export function discountSectionScript() {
    const pagination = document.querySelector(".special-offer .custom-pagination");
    const dotsContainer = document.querySelector(".special-offer .custom-pagination .dots");
    const btnPrev = document.querySelector(".special-offer .custom-pagination .prev");
    const btnNext = document.querySelector(".special-offer .custom-pagination .next");
    const toggle = document.querySelector(".special-offer .custom-pagination .toggle");
    
    let isPlaying = true;
    
    gsap.registerPlugin(ScrollTrigger);

    const convertRem = (rem) => {
        const rootFontSize =parseFloat(getComputedStyle(document.documentElement).fontSize) || 16;
        return rem * rootFontSize;
    }


    const animation = (swiper, activeIndex) => {
        if (!swiper || !swiper.slides) return;
        const slides = Array.from(swiper.slides);
        
        const cardContainers = slides.flatMap((slide) =>
          Array.from(slide.querySelectorAll(".special-offer__list-container"))
        );  
        const cardContents = slides.flatMap((slide) =>
          Array.from(
            slide.querySelectorAll(".special-offer__list-container-content")
          )
        );
        const imgContainers = slides.flatMap((slide) =>
          Array.from(
            slide.querySelectorAll(
              ".special-offer__list-container-content-image"
            )
          )
        );
        const imgOverlays = slides.flatMap((slide) =>
          Array.from(
            slide.querySelectorAll(
              ".special-offer__list-container-content-image-overlay"
            )
          )
        );
        const imgTextContents = slides.flatMap((slide) =>
          Array.from(
            slide.querySelectorAll(
              ".special-offer__list-container-content-image-content"
            )
          )
        );
        gsap
          .timeline({})
          .to(swiper.slides, {
            width: function (index, target, targets) {
              return activeIndex === index ? convertRem(49.64519) : convertRem(21.0625)
            },
            background: function (index, target, targets) {
              return activeIndex === index ? '#fff' : 'transparent'
            },
            duration: 1.5,
            ease: "power3.out",
          })
          .to(
            cardContainers,
            {
              paddingTop: function (index, target, targets) {
                return activeIndex === index ? convertRem(1.1875) : 0
              },
              paddingBottom: function (index, target, targets) {
                return activeIndex === index ? convertRem(1.1875) : 0
              },
              paddingRight: function (index, target, targets) {
                return activeIndex === index ? convertRem(1.1875) : 0
              },
              paddingLeft: function (index, target, targets) {
                return activeIndex === index ? convertRem(1.1875) : 0
              },
              duration: 0.6,
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
              duration: 0.3,
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
                return activeIndex === index ? convertRem(19.375) : convertRem(21.0625)
              },
              borderRadius: (index) => activeIndex === index ? convertRem(0.75) : convertRem(1.5),
              duration: 0.8,
              ease: "power3.out",
            },
            '<',
          ).to(
            imgTextContents,
            {
              autoAlpha: function (index) {
                return activeIndex === index ? 0 : 1;
              },
              duration: 0.5,
              ease: "power2.out",
            },
            "<"
          );
    }

    const swiper = new Swiper(".special-offer__list .swiper",{
        speed: 800,
        grabCursor: true,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        slidesOffsetBefore: convertRem(1.25 / 2),
        slidesOffsetAfter: convertRem(1.25 / 2),
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
            slidesPerView: 1.2,
            spaceBetween: 20,
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
