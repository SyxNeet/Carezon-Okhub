/**
 * Section About — Image Carousel (Swiper)
 * Restaurant Page
 * Swiper là global (enqueue từ CDN), không import module.
 * Self-execute vì orchestrator chỉ side-effect import (không gọi hàm).
 */

export function sectionStoryScript() {
    document.querySelectorAll('#section-about').forEach((section) => {
        const carousel = section.querySelector('.section-about__carousel');
        if (!carousel || typeof Swiper === 'undefined') return;

        const slides = carousel.querySelectorAll('.section-about__carousel-slide');
        if (slides.length <= 1) return; // 1 ảnh thì không cần khởi tạo

        new Swiper(carousel, {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            speed: 600,
            grabCursor: true,
            watchOverflow: true,

            navigation: {
                prevEl: section.querySelector('.section-about__nav-btn--prev'),
                nextEl: section.querySelector('.section-about__nav-btn--next'),
            },

            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
        });
    });
}

// NOTE: KHÔNG tự execute. Orchestrator restaurant-page/assets/scripts.js gọi.
