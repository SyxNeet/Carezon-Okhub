export function sectionPricing() {
  document.addEventListener("DOMContentLoaded", () => {
    const sidebarItems = document.querySelectorAll(".pricing__sidebar-item");
    const popup = document.getElementById("pricingPopup");
    const popupTitleEl = document.getElementById("pricingPopupTitle");
    const popupClose = popup?.querySelector(".pricing__popup-close");

    if (!sidebarItems.length || !popup) return;

    const isMobile = () => window.innerWidth <= 639.98;

    // ========================================
    // DESKTOP: NESTED SWIPER IMPLEMENTATION
    // ========================================
    let parentSwiper = null;
    let childSwipers = [];

    function initDesktopNestedSwiper() {
      if (isMobile()) return;

      const parentSliderEl = document.querySelector(
        ".pricing__plans-slider:not(.pricing__popup .pricing__plans-slider)"
      );
      if (!parentSliderEl) return;

      // Destroy existing instances
      if (parentSwiper) {
        parentSwiper.destroy(true, true);
        parentSwiper = null;
      }
      childSwipers.forEach((swiper) => swiper.destroy(true, true));
      childSwipers = [];

      // Initialize CHILD SWIPERS first (vertical image scrolling)
      const childSliderEls = document.querySelectorAll(
        ".pricing__child-slider:not(.pricing__popup .pricing__child-slider)"
      );

      childSliderEls.forEach((childEl, index) => {
        const childSwiper = new Swiper(childEl, {
          direction: "vertical",
          slidesPerView: 1,
          speed: 500,
          nested: true, // CRITICAL: Enable nested mode
          mousewheel: {
            releaseOnEdges: true, // Allow parent to scroll when reaching top/bottom
            sensitivity: 1,
          },
          freeMode: {
            enabled: true,
            sticky: true,
          },
          pagination: {
            el: childEl.querySelector(".pricing__child-pagination"), // Chỉ định phần tử pagination
            clickable: true,
          },
          // Optional: Sync sidebar on child scroll
          on: {
            slideChange(swiper) {
              const parentIndex = parseInt(
                swiper.el.closest(".pricing__parent-slide").dataset.parentIndex
              );
              updateSidebar(parentIndex);
            },
          },
        });

        childSwipers.push(childSwiper);
      });

      // Initialize PARENT SWIPER (horizontal service navigation)
      parentSwiper = new Swiper(parentSliderEl, {
        direction: "vertical", // Changed to vertical for desktop
        slidesPerView: 1,
        speed: 800,
        allowTouchMove: true,
        mousewheel: {
          releaseOnEdges: true,
          sensitivity: 1,
        },
        pagination: {
          el: ".pricing__plans-pagination:not(.pricing__popup .pricing__plans-pagination)",
          clickable: true,
        },
        on: {
          slideChange(swiper) {
            updateSidebar(swiper.activeIndex);
          },
        },
      });

      // Sync sidebar with initial slide
      updateSidebar(0);
    }

    function updateSidebar(activeIndex) {
      sidebarItems.forEach((item, index) => {
        item.classList.toggle("active", index === activeIndex);
      });
    }

    // Initialize desktop nested swiper
    if (!isMobile()) {
      initDesktopNestedSwiper();
    }

    // ========================================
    // SIDEBAR CLICK HANDLER
    // ========================================
    sidebarItems.forEach((item, index) => {
      item.addEventListener("click", (e) => {
        e.preventDefault();

        if (isMobile()) {
          // Mobile: Open popup (unchanged)
          popup.style.display = "block";
          document.body.classList.add("popup-open");
          popup.offsetHeight;
          requestAnimationFrame(() => popup.classList.add("show"));
          initPopupSwiper(index);
        } else {
          // Desktop: Navigate to parent slide
          if (parentSwiper) {
            parentSwiper.slideTo(index);
          }
        }
      });
    });

    // ========================================
    // MOBILE POPUP SWIPER (unchanged logic)
    // ========================================
    let popupSwiper;

    function initPopupSwiper(itemIndex = 0) {
      if (!popup || !window.pricingData) return;

      const item = window.pricingData[itemIndex];
      if (!item) return;

      const popupSliderEl = popup.querySelector(".pricing__plans-slider");
      if (!popupSliderEl) return;

      // Clear and load slides
      const wrapperEl = popupSliderEl.querySelector(".swiper-wrapper");
      if (wrapperEl) {
        wrapperEl.innerHTML = item.images
          .map(
            (url, i) => `
          <div class="pricing__plans-slide swiper-slide">
            <img src="${url}" alt="${item.title}" 
                 class="pricing__plans-image" 
                 loading="${i === 0 ? "eager" : "lazy"}" />
          </div>
        `
          )
          .join("");
      }

      // Destroy and recreate swiper
      if (popupSwiper) {
        popupSwiper.destroy(true, true);
      }

      popupSwiper = new Swiper(popupSliderEl, {
        direction: "vertical",
        slidesPerView: 1.3,
        spaceBetween: 16,
        speed: 500,
        mousewheel: { releaseOnEdges: true },
        freeMode: { enabled: true, sticky: true },
        pagination: {
          el: popup.querySelector(".pricing__popup-pagination"),
          clickable: true,
        },
      });

      // Update popup title
      if (popupTitleEl && item.title) {
        popupTitleEl.textContent = item.title;
      }

      updateSidebar(itemIndex);
    }

    // ========================================
    // POPUP CONTROLS (unchanged)
    // ========================================
    if (popupClose) {
      popupClose.addEventListener("click", () => {
        popup.classList.remove("show");
        setTimeout(() => {
          popup.style.display = "none";
          document.body.classList.remove("popup-open");
        }, 400);
      });
    }

    popup.addEventListener("click", (e) => {
      if (e.target === popup) {
        popup.classList.remove("show");
        setTimeout(() => {
          popup.style.display = "none";
          document.body.classList.remove("popup-open");
        }, 400);
      }
    });

    // ========================================
    // BOTTOM SHEET (unchanged)
    // ========================================
    const moreButton = document.querySelector(".pricing__popup-more");
    const bottomSheet = document.getElementById("pricingBottomSheet");
    const bottomSheetClose = bottomSheet?.querySelector(
      ".pricing__bottom-sheet-close"
    );

    if (moreButton && bottomSheet) {
      moreButton.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        bottomSheet.style.display = "block";
        bottomSheet.offsetHeight;
        requestAnimationFrame(() => bottomSheet.classList.add("show"));
      });
    }

    if (bottomSheetClose) {
      bottomSheetClose.addEventListener("click", () => {
        bottomSheet.classList.remove("show");
        setTimeout(() => (bottomSheet.style.display = "none"), 400);
      });
    }

    bottomSheet?.addEventListener("click", (e) => {
      if (e.target === bottomSheet) {
        bottomSheet.classList.remove("show");
        setTimeout(() => (bottomSheet.style.display = "none"), 400);
      }
    });

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && bottomSheet?.classList.contains("show")) {
        bottomSheet.classList.remove("show");
        setTimeout(() => (bottomSheet.style.display = "none"), 400);
      }
    });

    // Bottom sheet item clicks
    const bottomSheetItems = bottomSheet?.querySelectorAll(
      ".pricing__sidebar-item"
    );
    bottomSheetItems?.forEach((item, index) => {
      item.addEventListener("click", (e) => {
        e.preventDefault();
        bottomSheet.classList.remove("show");
        setTimeout(() => (bottomSheet.style.display = "none"), 400);
        initPopupSwiper(index);
      });
    });

    // ========================================
    // RESPONSIVE HANDLER
    // ========================================
    window.addEventListener("resize", () => {
      if (!isMobile() && !parentSwiper) {
        initDesktopNestedSwiper();
      } else if (isMobile() && parentSwiper) {
        parentSwiper.destroy(true, true);
        childSwipers.forEach((s) => s.destroy(true, true));
        parentSwiper = null;
        childSwipers = [];
      }
    });
  });
}
