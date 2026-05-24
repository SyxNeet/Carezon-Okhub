import { sectionBannerScript } from "../section-banner/assets/scripts.js";
import { sectionAboutUs } from "../section-about-us/assets/scripts.js";


import { sectionAspirationScripts } from "../section-aspiration/assets/scripts.js";
import { sectionCarezoneScripts } from "../section-carezone/assets/scripts.js";
import { secitonVisionScripts } from "../seciton-vision/assets/scripts.js";
import { sectionWhyChooseScripts } from "../section-why-choose/assets/scripts.js";
document.addEventListener("DOMContentLoaded", () => {
    sectionBannerScript();
    sectionAboutUs();
    
    sectionAspirationScripts();
    sectionCarezoneScripts();
    secitonVisionScripts();
    sectionWhyChooseScripts();
});