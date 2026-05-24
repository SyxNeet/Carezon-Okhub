import { sectionBannerScript } from "../section-banner/assets/scripts.js";
import { sectionExpServicesScripts } from "../section-exp-services/assets/scripts.js";
import { sectionForm } from "../section-form/assets/scripts.js";
import { sectionSocialsScripts } from "../section-socials/assets/scripts.js";

document.addEventListener("DOMContentLoaded", () => {
    sectionBannerScript();
    sectionExpServicesScripts();
    sectionForm();
    sectionSocialsScripts();
});