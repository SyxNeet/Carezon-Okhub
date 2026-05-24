export const sectionGalleryScript = () => {
  const querySelectors = {
    swiper: ".gallery__swiper.swiper",
  };

  const convertRem = (rem) => {
    const rootFontSize =
      parseFloat(getComputedStyle(document.documentElement).fontSize) || 16;
    return rem * rootFontSize;
  };

  const swiperEl = document.querySelector(querySelectors.swiper);
  let gallerySwiper = null;
  const galleryMobileMql = window.matchMedia("(max-width: 639.98px)");

  // Mobile: không khởi tạo Swiper; scroll ngang do CSS (.feedback__swiper trong @media).
  if (swiperEl) {
    const wrapper = swiperEl.querySelector(".swiper-wrapper");
    const originals = wrapper
      ? Array.from(wrapper.querySelectorAll(".swiper-slide"))
      : [];
    const slideCount = originals.length;

    const LOOP_SNAP_CLASS = "gallery__swiper--loop-snap";

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

    gallerySwiper = new Swiper(swiperEl, {
      initialSlide: slideCount > 0 ? slideCount : 0,
      slidesPerView: "auto",
      centeredSlides: true,
      spaceBetween: convertRem(1.25),
      speed: 800,
      grabCursor: true,
      // autoplay:
      //   slideCount > 1
      //     ? {
      //       delay: 3000,
      //       disableOnInteraction: false,
      //     }
      //     : false,
      navigation:
        slideCount > 0
          ? {
            nextEl: ".gallery__swiper-button-next",
            prevEl: ".gallery__swiper-button-prev",
          }
          : undefined,
      on: {
        slideChange(swiper) {
          if (swiper.el.classList.contains(LOOP_SNAP_CLASS)) return;
        },
        slideChangeTransitionEnd(swiper) {
          if (slideCount === 0) return;
          if (swiper.__galleryFakeLoopJump) {
            swiper.__galleryFakeLoopJump = false;
            return;
          }
          const i = swiper.activeIndex;
          if (i >= 2 * slideCount) {
            swiper.__galleryFakeLoopJump = true;
            snapLoopInstant(swiper, i - slideCount);
          } else if (i < slideCount) {
            swiper.__galleryFakeLoopJump = true;
            snapLoopInstant(swiper, i + slideCount);
          }
        },
      },
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

};
