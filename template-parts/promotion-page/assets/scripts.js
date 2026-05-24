import { countDownPromotion, goldSwiper } from "../gold-time-section/assets/scripts.js";
import { innitSwiperHero } from "../hero-section/assets/scripts.js";
import { memberSwiper } from "../therapy-member-section/assets/scripts.js";

document.addEventListener('DOMContentLoaded', function () {
      innitSwiperHero();
      memberSwiper();
      goldSwiper();
      countDownPromotion();
});