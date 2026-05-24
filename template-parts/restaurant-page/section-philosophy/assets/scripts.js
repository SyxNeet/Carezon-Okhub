/**
 * Section: Philosophy
 * Reveal card 02 & 03 khi cuộn tới (IntersectionObserver + class .is-animated).
 * CSS đã định nghĩa trạng thái ẩn (opacity:0) và .is-animated (opacity:1).
 * Không phụ thuộc GSAP. Self-execute vì orchestrator chỉ side-effect import
 * (export thôi thì hàm không bao giờ chạy → card 02/03 kẹt ở opacity:0).
 */

export function sectionPhilosophyScripts() {
    document.querySelectorAll('#section-philosophy').forEach((section) => {
        const cards = section.querySelectorAll(
            '.section-philosophy__card--2, .section-philosophy__card--3'
        );
        if (!cards.length) return;

        const reveal = (el) => el.classList.add('is-animated');

        // Fallback: trình duyệt không hỗ trợ IntersectionObserver → hiện ngay
        if (!('IntersectionObserver' in window)) {
            cards.forEach(reveal);
            return;
        }

        const io = new IntersectionObserver(
            (entries, obs) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        reveal(entry.target);
                        obs.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15, rootMargin: '0px 0px -10% 0px' }
        );

        cards.forEach((card) => io.observe(card));
    });
}

// NOTE: KHÔNG tự execute. Orchestrator restaurant-page/assets/scripts.js gọi.
