export const sectionFeedback = () => {
  const querySelectors = {
    playBtn: ".feedback__play",
    swiper: ".feedback__swiper.swiper",
    pagination: ".feedback__pagination",
  };

  const convertRem = (rem) => {
    const rootFontSize =
      parseFloat(getComputedStyle(document.documentElement).fontSize) || 16;
    return rem * rootFontSize;
  };

  const swiperEl = document.querySelector(querySelectors.swiper);
  let feedbackSwiper = null;
  const feedbackMobileMql = window.matchMedia("(max-width: 639.98px)");

  // Mobile: không khởi tạo Swiper; scroll ngang do CSS (.feedback__swiper trong @media).
  if (swiperEl && !feedbackMobileMql.matches) {
    const wrapper = swiperEl.querySelector(".swiper-wrapper");
    const originals = wrapper
      ? Array.from(wrapper.querySelectorAll(".swiper-slide"))
      : [];
    const slideCount = originals.length;

    const paginationEl = document.querySelector(querySelectors.pagination);
    const LOOP_SNAP_CLASS = "feedback__swiper--loop-snap";

    const mapActiveToRealIndex = (activeIdx) => {
      if (slideCount === 0) return 0;
      if (activeIdx < slideCount) return activeIdx;
      if (activeIdx < 2 * slideCount) return activeIdx - slideCount;
      return activeIdx - 2 * slideCount;
    };

    const updatePaginationBullets = (swiper) => {
      if (!paginationEl || slideCount === 0) return;
      const realIdx = mapActiveToRealIndex(swiper.activeIndex);
      paginationEl
        .querySelectorAll(".swiper-pagination-bullet")
        .forEach((b, i) => {
          b.classList.toggle(
            "swiper-pagination-bullet-active",
            i === realIdx,
          );
        });
    };

    if (wrapper && slideCount > 0) {
      const fragBefore = document.createDocumentFragment();
      const fragAfter = document.createDocumentFragment();
      originals.forEach((slide) => {
        const stripIds = (root) => {
          root
            .querySelectorAll("[id]")
            .forEach((el) => el.removeAttribute("id"));
        };
        const before = slide.cloneNode(true);
        stripIds(before);
        fragBefore.appendChild(before);
        const after = slide.cloneNode(true);
        stripIds(after);
        fragAfter.appendChild(after);
      });
      wrapper.insertBefore(fragBefore, wrapper.firstChild);
      wrapper.appendChild(fragAfter);
    }

    if (paginationEl && slideCount > 0) {
      paginationEl.innerHTML = "";
      for (let i = 0; i < slideCount; i++) {
        const bullet = document.createElement("span");
        bullet.className = "swiper-pagination-bullet";
        bullet.addEventListener("click", () => {
          if (!feedbackSwiper || slideCount === 0) return;
          feedbackSwiper.slideTo(slideCount + i);
        });
        paginationEl.appendChild(bullet);
      }
    }

    const snapLoopInstant = (swiper, targetIndex) => {
      swiper.el.classList.add(LOOP_SNAP_CLASS);
      void swiper.wrapperEl.offsetHeight;
      swiper.slideTo(targetIndex, 0);
      requestAnimationFrame(() => {
        requestAnimationFrame(() => {
          swiper.el.classList.remove(LOOP_SNAP_CLASS);
          
          // FIX autoplay bị đứng
          if (swiper.autoplay && swiper.autoplay.running) {
            swiper.autoplay.start();
          }
        });
      });
    };

    feedbackSwiper = new Swiper(swiperEl, {
      initialSlide: slideCount > 0 ? slideCount : 0,
      slidesPerView: "auto",
      centeredSlides: true,
      spaceBetween: convertRem(1.5),
      speed: 800,
      grabCursor: true,
      autoplay:
        slideCount > 1
          ? {
            delay: 3000,
            disableOnInteraction: false,
          }
          : false,
      navigation:
        slideCount > 0
          ? {
            nextEl: ".feedback__next",
            prevEl: ".feedback__prev",
          }
          : undefined,
      on: {
        slideChange(swiper) {
          if (swiper.el.classList.contains(LOOP_SNAP_CLASS)) return;
          updatePaginationBullets(swiper);
        },
        slideChangeTransitionEnd(swiper) {
          if (slideCount === 0) return;
          if (swiper.__feedbackFakeLoopJump) {
            swiper.__feedbackFakeLoopJump = false;
            updatePaginationBullets(swiper);
            return;
          }
          const i = swiper.activeIndex;
          if (i >= 2 * slideCount) {
            swiper.__feedbackFakeLoopJump = true;
            snapLoopInstant(swiper, i - slideCount);
          } else if (i < slideCount) {
            swiper.__feedbackFakeLoopJump = true;
            snapLoopInstant(swiper, i + slideCount);
          }
          updatePaginationBullets(swiper);
        },
      },
    });

    updatePaginationBullets(feedbackSwiper);
    handleAutoplayToggle(feedbackSwiper);
  }

  function handleAutoplayToggle(swiper) {
    const playBtn = document.querySelector(querySelectors.playBtn);
    if (!playBtn || !swiper || !swiper.autoplay) return;

    let isPlaying = true;

    playBtn.addEventListener("click", () => {
      if (isPlaying) {
        swiper.autoplay.stop();
        playBtn.classList.add("is-paused");
      } else {
        swiper.autoplay.start();
        playBtn.classList.remove("is-paused");
      }

      isPlaying = !isPlaying;
    });
  }

  // ------------------------------------------------------------
  // Achievement: counter
  const numbers = document.querySelectorAll(
    ".achievement__item-content-number",
  );

  // Khởi tạo ban đầu: ẩn và set về 0+
  numbers.forEach((num, idx) => {
    num.textContent = "0+";
    gsap.set(num, { opacity: 0, y: 20, filter: "blur(4px)" });
  });

  // Tạo trigger sau khi trang (ảnh) load xong để tránh auto-trigger khi F5
  window.addEventListener("load", () => {
    ScrollTrigger.refresh();
    ScrollTrigger.create({
      trigger: "#achievement",
      start: "top 85%",
      markers: false,
      once: true,
      onEnter: () => {
        numbers.forEach((num, index) => {
          const target = numbers[index].dataset.value;
          const label = "+";
          const obj = { value: 0 };

          gsap.to(num, {
            opacity: 1,
            y: 0,
            filter: "blur(0px)",
            duration: 0.6,
            ease: "power2.out",
          });

          gsap.to(obj, {
            value: target,
            duration: 2.25,
            ease: "power1.out",
            onUpdate: () => {
              num.textContent = Math.floor(obj.value) + label;
            },
          });
        });
      },
    });
  });

  // ------------------------------------------------------------
  // Intro: tránh auto-trigger khi F5
  gsap.set(".values__intro", { opacity: 0, y: 30, filter: "blur(10px)" });
  window.addEventListener("load", () => {
    ScrollTrigger.refresh();
    ScrollTrigger.create({
      trigger: ".values__intro",
      start: "top 85%",
      once: true,
      onEnter: () => {
        gsap.to(".values__intro", {
          opacity: 1,
          y: 0,
          filter: "blur(0px)",
          duration: 1.5,
          ease: "power3.out",
        });
      },
    });
  });

  // ------------------------------------------------------------
  // Special Offer Text: hiệu ứng tương tự intro
  gsap.set(".special-offer__text", {
    opacity: 0,
    y: 30,
    filter: "blur(10px)",
  });
  window.addEventListener("load", () => {
    ScrollTrigger.refresh();
    ScrollTrigger.create({
      trigger: ".special-offer__text",
      start: "top 85%",
      once: true,
      onEnter: () => {
        gsap.to(".special-offer__text", {
          opacity: 1,
          y: 0,
          filter: "blur(0px)",
          duration: 1.5,
          ease: "power3.out",
        });
      },
    });
  });
};
