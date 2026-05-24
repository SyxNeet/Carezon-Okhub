/**
 * Section Offers — scripts.js
 * Offer Cards Swiper (desktop) + booking form (booking-container, tái dùng từ
 * pricing-page/section-booking — multi-form safe: validation, custom-select,
 * quantity +/-, CF7 submit).
 *
 * KHÔNG tự execute. Orchestrator restaurant-page/assets/scripts.js sẽ gọi
 * sectionOffersScripts() trong DOMContentLoaded handler.
 */

import { sectionBooking } from '../../../pricing-page/section-booking/assets/scripts.js';

// -------------------------------------------------------------------------
// Offer Cards Swiper — DESKTOP ONLY.
// Mobile bỏ Swiper, dùng overflow-x scroll native (mượt + nhẹ hơn) qua CSS.
// -------------------------------------------------------------------------
function initOffersSwiper() {
    const swiperEl = document.querySelector('.js-offers-swiper');
    if (!swiperEl) return;
    if (typeof Swiper === 'undefined') return;

    const mql = window.matchMedia('(min-width: 640px)');
    let instance = null;

    function mount() {
        if (instance) return;
        instance = new Swiper(swiperEl, {
            slidesPerView: 'auto',
            spaceBetween: 16,
            centeredSlides: false,
            loop: false,
            grabCursor: true,
            watchOverflow: true, // tự disable nếu mọi slide đã vừa khung
            a11y: {
                prevSlideMessage: 'Slide trước',
                nextSlideMessage: 'Slide tiếp theo',
            },
        });
    }

    function destroy() {
        if (!instance) return;
        instance.destroy(true, true); // gỡ inline transform/style → trả về flex thường cho mobile
        instance = null;
    }

    function apply(e) {
        if (e.matches) {
            mount();
        } else {
            destroy();
        }
    }

    apply(mql); // trạng thái ban đầu
    if (mql.addEventListener) {
        mql.addEventListener('change', apply);
    } else {
        mql.addListener(apply); // fallback trình duyệt cũ
    }
}

// -------------------------------------------------------------------------
// Export — orchestrator gọi
// -------------------------------------------------------------------------
export function sectionOffersScripts() {
    initOffersSwiper();
    // Booking form (booking-container) — validation + custom-select + quantity + submit
    if (typeof sectionBooking === 'function') {
        sectionBooking();
    }
}
