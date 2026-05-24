/**
 * Restaurant Page — JS orchestrator.
 * Theo convention của front-page: import named function từ mỗi section
 * rồi gọi trong 1 DOMContentLoaded handler duy nhất.
 * Mỗi section CHỈ export function — KHÔNG tự execute (tránh chạy đôi).
 */
import { sectionBannerScript }      from "../section-banner/assets/scripts.js";
import { sectionMenuScripts }       from "../section-menu/assets/scripts.js";
import { sectionAboutScripts }      from "../section-about/assets/scripts.js";
import { sectionPhilosophyScripts } from "../section-philosophy/assets/scripts.js";
import { sectionOffersScripts }     from "../section-offers/assets/scripts.js";

document.addEventListener("DOMContentLoaded", function () {
    sectionBannerScript();
    sectionMenuScripts();
    sectionAboutScripts();
    sectionPhilosophyScripts();
    sectionOffersScripts();
});
