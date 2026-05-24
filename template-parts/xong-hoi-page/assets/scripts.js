import { sectionBannerScript } from "../section-banner/assets/scripts.js";
import { sectionStoryScript } from "../section-story/assets/scripts.js";
import { sectionServicesScript } from "../section-services/assets/scripts.js";
import { specialOfferScript } from "../../components/special-offers/assets/scripts.js";

document.addEventListener("DOMContentLoaded", () => {
  sectionBannerScript();
  sectionStoryScript();
  sectionServicesScript();
  specialOfferScript();
});