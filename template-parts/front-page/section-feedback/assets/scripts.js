export const sectionFeedback = () => {
  gsap.registerPlugin(ScrollTrigger);

  // Initialize Swiper
  const heroLeftSwiper = new Swiper(".hero__left-swiper", {
    loop: true,
    autoplay: {
      delay: 3000,
    },
    speed: 800,
    pagination: {
      el: ".hero__left-pagination",
      clickable: true,
    },
  });

  const heroRightSwiper = new Swiper(".hero__right-swiper", {
    loop: true,
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },
    speed: 800,
    allowTouchMove: false,
    touchStartPreventDefault: false,
    touchMoveStopPropagation: true,
    simulateTouch: false,
    touchRatio: 0,
  });

  // Sync swipers using events instead of controller
  heroLeftSwiper.on("slideChange", function () {
    heroRightSwiper.slideToLoop(this.realIndex, 800, false);
  });

  // ------------------------------------------------------------
  // PC Special Offer Swiper - COMMENTED OUT: Mobile version doesn't need PC-specific animations
  /*
  function convertRem(rem) {
      var rootFontSize =
          parseFloat(getComputedStyle(document.documentElement).fontSize) ||
          16;
      return rem * rootFontSize;
  }

  function animation(swiper, activeIndex) {
      if (!swiper || !swiper.slides) return;

      var slides = Array.from(swiper.slides);

      // Map selectors to existing structure
      var cardContainers = slides.map(function (slide) {
          return slide.querySelectorAll(".special-offer__list-container");
      });
      var cardContents = slides.map(function (slide) {
          return slide.querySelectorAll(
              ".special-offer__list-container-content"
          );
      });
      var imgContainers = slides.map(function (slide) {
          return slide.querySelectorAll(
              ".special-offer__list-container-content-image"
          );
      });
      var imgOverlays = slides.map(function (slide) {
          return slide.querySelectorAll(
              ".special-offer__list-container-content-image-overlay"
          );
      });
      var imgTextContents = slides.map(function (slide) {
          return slide.querySelectorAll(
              ".special-offer__list-container-content-image-content"
          );
      });

      gsap.timeline({})
          .to(slides, {
              width: function (index) {
                  return activeIndex === index ? "51.67%" : "22.665%";
              },
              background: function (index) {
                  return activeIndex === index ? "#fff" : "transparent";
              },
              duration: 0.4,
              ease: "power2.out",
          })
          .to(
              cardContainers,
              {
                  paddingTop: function (index) {
                      return activeIndex === index
                          ? convertRem(1.1875) + "px"
                          : 0;
                  },
                  paddingBottom: function (index) {
                      return activeIndex === index
                          ? convertRem(1.1875) + "px"
                          : 0;
                  },
                  paddingRight: function (index) {
                      return activeIndex === index
                          ? convertRem(1.1875) + "px"
                          : 0;
                  },
                  paddingLeft: function (index) {
                      return activeIndex === index
                          ? convertRem(1.5) + "px"
                          : 0;
                  },
                  duration: 0.4,
                  ease: "power2.out",
              },
              "<"
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
              imgContainers,
              {
                  width: function (index) {
                      return activeIndex === index ? "39%" : "100%";
                  },
                  borderRadius: function (index) {
                      return activeIndex === index
                          ? convertRem(0.75) + "px"
                          : convertRem(1.5) + "px";
                  },
                  duration: 0.4,
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
              imgTextContents,
              {
                  autoAlpha: function (index) {
                      return activeIndex === index ? 0 : 1;
                  },
                  duration: 0.3,
                  ease: "power2.out",
              },
              "<"
          );
  }
  */

  // Generate Special Offer slides from data - COMMENTED OUT: PC version only, mobile uses PHP data
  /*
  function generateSpecialOfferSlides() {
      var wrapper = document.querySelector(
          ".special-offer__list .swiper-wrapper"
      );
      if (!wrapper) return;

      var specialOffers = [
          {
              day: "10",
              month: "Tháng 10",
              title: "Tháng 9 thu sang nhận ngay deal hời từ Carezone - Liệu trình Spa",
              hours: "9:00 - 22:00",
              desc: "Join us for an enchanting evening of violin music and captivating performances!",
              deadline: "HẾT HẠN NGÀY 31/12/2025",
              price: "500.000 đ",
              remain: "Còn 12/30 suất",
              img: "carezone/offer/special-offer-1.webp",
          },
          {
              day: "10",
              month: "Tháng 10",
              title: "Tháng 9 thu sang nhận ngay deal hời từ Carezone - Liệu trình Spa",
              hours: "9:00 - 22:00",
              desc: "Join us for an enchanting evening of violin music and captivating performances!",
              deadline: "HẾT HẠN NGÀY 31/12/2025",
              price: "500.000 đ",
              remain: "Còn 12/30 suất",
              img: "carezone/offer/special-offer-2.webp",
          },
          {
              day: "10",
              month: "Tháng 10",
              title: "Tháng 9 thu sang nhận ngay deal hời từ Carezone - Liệu trình Spa",
              hours: "9:00 - 22:00",
              desc: "Join us for an enchanting evening of violin music and captivating performances!",
              deadline: "HẾT HẠN NGÀY 31/12/2025",
              price: "500.000 đ",
              remain: "Còn 12/30 suất",
              img: "carezone/offer/special-offer-3.webp",
          },
          {
              day: "10",
              month: "Tháng 10",
              title: "Tháng 9 thu sang nhận ngay deal hời từ Carezone - Liệu trình Spa",
              hours: "9:00 - 22:00",
              desc: "Join us for an enchanting evening of violin music and captivating performances!",
              deadline: "HẾT HẠN NGÀY 31/12/2025",
              price: "500.000 đ",
              remain: "Còn 12/30 suất",
              img: "carezone/offer/special-offer-1.webp",
          },
          {
              day: "10",
              month: "Tháng 10",
              title: "Tháng 9 thu sang nhận ngay deal hời từ Carezone - Liệu trình Spa",
              hours: "9:00 - 22:00",
              desc: "Join us for an enchanting evening of violin music and captivating performances!",
              deadline: "HẾT HẠN NGÀY 31/12/2025",
              price: "500.000 đ",
              remain: "Còn 12/30 suất",
              img: "carezone/offer/special-offer-2.webp",
          },
          {
              day: "10",
              month: "Tháng 10",
              title: "Tháng 9 thu sang nhận ngay deal hời từ Carezone - Liệu trình Spa",
              hours: "9:00 - 22:00",
              desc: "Join us for an enchanting evening of violin music and captivating performances!",
              deadline: "HẾT HẠN NGÀY 31/12/2025",
              price: "500.000 đ",
              remain: "Còn 12/30 suất",
              img: "carezone/offer/special-offer-3.webp",
          },
      ];

      var slidesHtml = specialOffers
          .map(function (o) {
              return (
                  '<div class="swiper-slide">' +
                  '  <div class="special-offer__list-container">' +
                  '    <div class="special-offer__list-container-content card-content">' +
                  '      <div class="special-offer__list-container-content-top">' +
                  '        <div class="special-offer__list-container-content-top-head">' +
                  '          <div class="special-offer__list-container-content-top-head-calendar">' +
                  '            <p class="special-offer__list-container-content-top-head-calendar-day">' +
                  o.day +
                  "</p>" +
                  '            <p class="special-offer__list-container-content-top-head-calendar-month">' +
                  o.month +
                  "</p>" +
                  "          </div>" +
                  '          <p class="special-offer__list-container-content-top-head-title">' +
                  o.title +
                  "</p>" +
                  "        </div>" +
                  '        <div class="special-offer__list-container-content-top-body">' +
                  '          <div class="special-offer__list-container-content-top-body-row">' +
                  '            <p class="special-offer__list-container-content-top-body-row-text">Giờ mở cửa:</p>' +
                  '            <p class="special-offer__list-container-content-top-body-row-time">' +
                  o.hours +
                  "</p>" +
                  "          </div>" +
                  '          <p class="special-offer__list-container-content-top-body-text">' +
                  o.desc +
                  "</p>" +
                  "        </div>" +
                  "      </div>" +
                  '      <div class="special-offer__list-container-content-bottom">' +
                  '        <div class="special-offer__list-container-content-bottom-head">' +
                  '          <div class="special-offer__list-container-content-bottom-head-bg"></div>' +
                  '          <div class="special-offer__list-container-content-bottom-head-progress"></div>' +
                  '          <p class="special-offer__list-container-content-bottom-head-text">' +
                  o.deadline +
                  "</p>" +
                  "        </div>" +
                  '        <div class="special-offer__list-container-content-bottom-body">' +
                  '          <div class="special-offer__list-container-content-bottom-body-service">' +
                  '            <div class="special-offer__list-container-content-bottom-body-service-row">' +
                  '              <p class="special-offer__list-container-content-bottom-body-service-row-text">Giá dịch vụ :</p>' +
                  '              <p class="special-offer__list-container-content-bottom-body-service-row-price">' +
                  o.price +
                  "</p>" +
                  "            </div>" +
                  '            <p class="special-offer__list-container-content-bottom-body-service-row-text">' +
                  o.remain +
                  "</p>" +
                  "          </div>" +
                  '          <div class="special-offer__list-container-content-bottom-body-button">' +
                  '            <button class="booking__form-option-button" type="submit">' +
                  '              <p class="booking__form-option-button-text">Đặt chỗ ngay</p>' +
                  '              <img data-no-lazy="1" class="booking__form-option-button-icon" src="carezone/icon-button.webp" alt="Icon Button">' +
                  "            </button>" +
                  "          </div>" +
                  "        </div>" +
                  "      </div>" +
                  "    </div>" +
                  '    <div class="special-offer__list-container-content-image img-container">' +
                  '      <img src="' +
                  o.img +
                  '" alt="Special Offer Right">' +
                  '      <div class="special-offer__list-container-content-image-overlay"></div>' +
                  '      <div class="special-offer__list-container-content-image-content">' +
                  '        <p class="special-offer__list-container-content-image-content-title">' +
                  o.title +
                  "</p>" +
                  '        <div class="special-offer__list-container-content-image-content-progress">' +
                  '          <div class="special-offer__list-container-content-image-content-progress-bg"></div>' +
                  '          <div class="special-offer__list-container-content-image-content-progress-progress"></div>' +
                  '          <p class="special-offer__list-container-content-image-content-progress-text">' +
                  o.deadline +
                  "</p>" +
                  "        </div>" +
                  "      </div>" +
                  "    </div>" +
                  "  </div>" +
                  "</div>"
              );
          })
          .join("");

      // Replace any existing static slides
      wrapper.innerHTML = slidesHtml;
  }
  */

  var specialOfferContainer = document.querySelector(
    ".special-offer__list .swiper"
  );
  // PC Swiper initialization - COMMENTED OUT: Mobile version doesn't need PC-specific Swiper
  /*
  if (specialOfferContainer) {
      // Generate slides before initializing swiper
      generateSpecialOfferSlides();

      var specialOfferSwiper = new Swiper(".special-offer__list .swiper", {
          speed: 800,
          grabCursor: true,
          slidesPerView: "4.3",
          spaceBetween: 20,
          loop: true,
          updateOnWindowResize: false,
          on: {
              init: function () {
                  animation(this, this.activeIndex);
              },
              slideChange: function () {
                  animation(this, this.activeIndex);
              },
          },
      });
  }
  */

  // ------------------------------------------------------------
  // Achievement: counter

  const numbers = document.querySelectorAll(
    ".achievement__item-content-number"
  );

  // Khởi tạo ban đầu: ẩn và set về 0+
  numbers.forEach((num, idx) => {
    num.textContent = "0+";
    gsap.set(num, { opacity: 0, y: 20, filter: "blur(4px)" });
  });

  // ✅ Tạo trigger sau khi trang (ảnh) load xong để tránh auto-trigger khi F5
  window.addEventListener("load", function () {
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
  gsap.set(".intro", { opacity: 0, y: 30, filter: "blur(10px)" });
  window.addEventListener("load", function () {
    ScrollTrigger.refresh();
    ScrollTrigger.create({
      trigger: ".intro",
      start: "top 85%",
      once: true,
      onEnter: () => {
        gsap.to(".intro", {
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
  window.addEventListener("load", function () {
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
