import { sectionBannerScript } from "../section-banner/assets/scripts.js";
import { sectionIntroScript } from "../section-intro/assets/scripts.js";
import { sectionServicesScript } from "../section-services/assets/scripts.js";
import { specialOfferScript } from "../../components/special-offers/assets/scripts.js";
import { sectionTestimonial } from "../section-testimonial/assets/scripts.js";

document.addEventListener("DOMContentLoaded", () => {
    sectionBannerScript();
    sectionIntroScript();
    sectionServicesScript();
    specialOfferScript();
    sectionTestimonial();
});