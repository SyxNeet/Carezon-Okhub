import { sectionBanner } from "../section-banner/assets/scripts.js";
import { sectionAboutUs } from "../section-about-us/assets/scripts.js";
import { sectionExperience } from "../section-experience/assets/scripts.js";
import { sectionFeedback } from "../section-feedback-v2/assets/scripts.js";
import { sectionMindfulLiving } from "../section-mindful-living/assets/scripts.js";
// pcSwiper is auto-initialized in its own file via IIFE
// import pcSwiper from "../discount-section/assets/script.js";
import { discountSectionScript } from "../discount-section/assets/script.js";
import discountMobile from "../discount-section/assets/script-mb.js";


// pcSwiper()
document.addEventListener("DOMContentLoaded", function () {
    sectionBanner();
    sectionExperience();
    sectionMindfulLiving();
    sectionAboutUs();
    sectionFeedback();
    if (typeof discountMobile.init === "function") {
        discountMobile.init();
    }
    discountSectionScript();
});

// Handle window resize
window.addEventListener("resize", function () {
    if (typeof discountMobile.initMobileSwiper === "function") {
        discountMobile.initMobileSwiper();
    }
});
// pcSwiper.init();
