export function sectionTestimonial() {
    const swiperElement = document.querySelector('.onsen-testimonial__swiper');
    if (!swiperElement) return;

    const authorElement = document.querySelector('.onsen-testimonial__name');

    const updateAuthor = (swiper) => {
        const activeSlide = swiper.slides[swiper.activeIndex];
        const author = activeSlide.dataset.author || '';
        authorElement.textContent = author;
    };

    const swiper = new Swiper(swiperElement, {
        direction: 'vertical',
        autoHeight: true,
        loop: true,
        spaceBetween: 8,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        allowTouchMove: false,
        on: {
            init(swiperInstance) {
                updateAuthor(swiperInstance);
            },
            slideChange(swiperInstance) {
                updateAuthor(swiperInstance);
            },
        },
    });

    // Video functionality (upload + youtube)
    document.querySelectorAll('.onsen-testimonial__video').forEach(wrapper => {
        const btn = wrapper.querySelector('.onsen-testimonial__video-play');
        const img = wrapper.querySelector('.onsen-testimonial__video-image');
        const video = wrapper.querySelector('video');
        const iframe = wrapper.querySelector('.js-youtube');

        // Upload video
        if (video && btn) {
            btn.addEventListener('click', () => {
                img?.classList.add('is-hidden');
                btn.classList.add('is-hidden');

                video.style.display = 'block';
                video.play();
            });

            video.addEventListener('ended', () => {
                video.style.display = 'none';
                img?.classList.remove('is-hidden');
                btn.classList.remove('is-hidden');
            });
        }

        // YouTube 
        if (iframe) {
            // autoplay khi click vào thumbnail/play (nếu có)
            if (btn) {
                btn.addEventListener('click', () => {
                    img?.classList.add('is-hidden');
                    btn.classList.add('is-hidden');

                    const src = iframe.dataset.src;
                    if (!iframe.src && src) {
                        iframe.src = src + '&autoplay=1';
                    }
                });
            }

            // fallback: nếu không có play button → load luôn
            if (!btn) {
                const src = iframe.dataset.src;
                if (src) {
                    iframe.src = src;
                }
            }
        }
    });

    // Media swiper for slides
    const mediaSwiperEl = document.querySelector('.onsen-testimonial__media-swiper');

    if (mediaSwiperEl) {
        new Swiper(mediaSwiperEl, {
            slidesPerView: 1, 
            grabCursor: true,
            loop: true,
            autoplay: {
                delay: 3000,
            },
        });
    }

    return swiper;
}