export const goldSwiper = () => {
    return new Swiper('.gold-swiper', {
        slidesPerView: 1.2,
        centeredSlides: false,

        breakpoints: {
            640: {
                slidesPerView: 2.3,
            }
        }
    });
};

export const countDownPromotion = () => {
    const countdownElements = document.querySelectorAll('.gold-hour .countdown');
    countdownElements.forEach(el => {
        const rawDate = el.dataset.end;
        const [day, month, year] = rawDate.split('/');
        const endDate = new Date(
            `${year}-${month}-${day}T23:59:59`
        ).getTime();
        function updateCountdown() {
            const now = Date.now();
            const distance = endDate - now;

            if (distance <= 0) {
                el.innerText = 'Hết hạn';
                return;
            }
            const hours = Math.floor(
                (distance % (1000 * 60 * 60 * 24)) /
                (1000 * 60 * 60)
            );
            const minutes = Math.floor(
                (distance % (1000 * 60 * 60)) /
                (1000 * 60)
            );
            const seconds = Math.floor(
                (distance % (1000 * 60)) / 1000
            );
            const days = Math.floor(
                distance / (1000 * 60 * 60 * 24)
            );
            el.innerText =
                `${String(Number(days * 24) + Number(hours)).padStart(2, '0')}:` +
                `${String(minutes).padStart(2, '0')}:` +
                `${String(seconds).padStart(2, '0')}`;
        }
        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
}