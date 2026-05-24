function remToPixels(rem) {
  const rootFontSize = parseFloat(
    getComputedStyle(document.documentElement).fontSize
  );
  return rem * rootFontSize;
}

export function sectionRestaurant() {
  const SELECTORS = {
    SWIPER: '.pricing__restaurant-swiper',
    PREV: '.pricing__restaurant-prev',
    NEXT: '.pricing__restaurant-next',
    PLAY: '.pricing__restaurant-play',
    PAGINATION: '.pricing__restaurant-pagination',
  };

  let swiper = null;

  function initSwiper() {
    const swiperEl = document.querySelector(SELECTORS.SWIPER);
    if (!swiperEl || typeof Swiper === "undefined") return;

    swiper = new Swiper(SELECTORS.SWIPER, {
      slidesPerView: 1,
      spaceBetween: remToPixels(1.5),
      grabCursor: true,
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      navigation: {
        prevEl: SELECTORS.PREV,
        nextEl: SELECTORS.NEXT,
        disabledClass: 'is-disabled',
      },
      pagination: {
        el: SELECTORS.PAGINATION,
        clickable: true,
      },
    });
  }

  function handleAutoplayToggle() {
    const playBtn = document.querySelector(SELECTORS.PLAY);
    if (!playBtn || !swiper) return;

    let isPlaying = true;

    playBtn.addEventListener('click', () => {
      if (isPlaying) {
        swiper.autoplay.stop();
        playBtn.classList.add('is-paused');
      } else {
        swiper.autoplay.start();
        playBtn.classList.remove('is-paused');
      }

      isPlaying = !isPlaying;
    });
  }

  initSwiper();
  handleAutoplayToggle();
}
