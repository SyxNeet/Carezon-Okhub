(function () {
  gsap.registerPlugin(ScrollTrigger);

  // DOM Ready
  document.addEventListener("DOMContentLoaded", () => {
		


    // Popup Booking
    const btnPopupBooking = document.querySelector(".cta__btn-booking");
    const popupBooking = document.querySelector(".popup__booking");
    const closeBtn = document.querySelector(".popup__close-btn");

    if (btnPopupBooking && popupBooking && closeBtn) {
      // Function to open popup
      function openPopup() {
        popupBooking.classList.add("active");
        document.documentElement.style.overflow = "hidden";
      }

      // Function to close popup
      function closePopup() {
        popupBooking.classList.remove("active");
        document.documentElement.style.overflow = "";
      }

      // Open popup when clicking the booking button
      btnPopupBooking.addEventListener("click", openPopup);

      // Close popup when clicking the close button
      closeBtn.addEventListener("click", closePopup);

      // Close popup when clicking outside the popup content
      popupBooking.addEventListener("click", (e) => {
        if (e.target === popupBooking) {
          closePopup();
        }
      });
    }

    // CTA viewport detection
    class CTAViewportHandler {
      constructor() {
        this.cta = document.querySelector(".cta");
        this.viewportHeight = window.innerHeight;
        this.isVisible = false;

        if (!this.cta) {
          console.warn("CTA element not found");
          return;
        }

        this.init();
      }

      init() {
        // Check initial scroll position
        this.handleScroll();

        // Add scroll listener with throttling
        let ticking = false;
        window.addEventListener("scroll", () => {
          if (!ticking) {
            requestAnimationFrame(() => {
              this.handleScroll();
              ticking = false;
            });
            ticking = true;
          }
        });

        // Handle window resize
        window.addEventListener("resize", () => {
          this.viewportHeight = window.innerHeight;
        });
      }

      handleScroll() {
        const scrollTop =
          window.pageYOffset || document.documentElement.scrollTop;
        const shouldShow = scrollTop > this.viewportHeight;

        if (shouldShow && !this.isVisible) {
          this.showCTA();
        } else if (!shouldShow && this.isVisible) {
          this.hideCTA();
        }
      }

      showCTA() {
        this.cta.classList.add("show");
        this.isVisible = true;
      }

      hideCTA() {
        this.cta.classList.remove("show");
        this.isVisible = false;
      }
    }

    new CTAViewportHandler();

    // --- Move to Top Button ---
    const moveToTopBtn = document.querySelector(".move-to-top");
    if (moveToTopBtn) {
      moveToTopBtn.addEventListener("click", (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: "smooth" });
      });
    }
  });
})();
