/**
 * Section Story — unified slider (text + image + tabs)
 */

export function sectionStoryScript() {
  document.querySelectorAll('#section-about').forEach((section) => {
    const slider = section.querySelector('.section-about__slider');
    if (!slider || typeof Swiper === 'undefined') return;

    const slides = slider.querySelectorAll('.section-about__slide');
    const tabs = section.querySelectorAll('.section-about__tab');
    if (slides.length <= 1) return;

    const updateTabs = (activeIndex) => {
      tabs.forEach((tab, index) => {
        const isActive = index === activeIndex;
        tab.classList.toggle('is-active', isActive);
        tab.setAttribute('aria-current', isActive ? 'true' : 'false');
      });
    };

    const storySwiper = new Swiper(slider, {
      slidesPerView: 1,
      spaceBetween: 0,
      loop: true,
      speed: 600,
      grabCursor: true,
      effect: 'fade',
      fadeEffect: {
        crossFade: true,
      },
      navigation: {
        prevEl: section.querySelector('.section-about__nav-btn--prev'),
        nextEl: section.querySelector('.section-about__nav-btn--next'),
      },
      keyboard: {
        enabled: true,
        onlyInViewport: true,
      },
      on: {
        init(swiper) {
          updateTabs(swiper.realIndex);
        },
        slideChange(swiper) {
          updateTabs(swiper.realIndex);
        },
      },
    });

    tabs.forEach((tab) => {
      tab.addEventListener('click', () => {
        const index = Number(tab.dataset.slideIndex);
        if (Number.isNaN(index)) return;
        storySwiper.slideToLoop(index);
      });
    });
  });
}
