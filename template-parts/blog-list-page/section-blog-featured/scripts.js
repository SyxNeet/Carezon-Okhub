export const blogFeatured = () => {
    if (typeof Swiper === "undefined") return;
    const btnLinkBlogEl = document.getElementById("blog-featured-btn-detail");

    // Swiper Thumbnail
    const swiperThumbnail = new Swiper(".blog-featured__swiper-thumbnail", {
        effect: "fade",
        fadeEffect: { crossFade: true },
        speed: 500,
        loop: true,
        grabCursor: true,
        pagination: {
            el: ".blog-featured__swiper-thumbnail-pagination",
            type: "progressbar",
        },
        navigation: {
            nextEl: ".blog-featured__swiper-nav-btn--next",
            prevEl: ".blog-featured__swiper-nav-btn--prev",
        },
    });

    // Swiper Content
    const swiperContent = new Swiper(".blog-featured__swiper-content", {
        effect: "fade",
        fadeEffect: { crossFade: true },
        speed: 500,
        simulateTouch: false,
        allowTouchMove: false,
        loop: true,
        autoplay: {
            delay: 4000, // 4 giây chuyển slide
            disableOnInteraction: false, // user swipe vẫn tiếp tục autoplay
        },
    });

    // Controller liên kết 2 Swiper với nhau
    swiperThumbnail.controller.control = swiperContent;
    swiperContent.controller.control = swiperThumbnail;

    swiperContent.on("slideChange", (swiper) => {
        handleUpdateLinkBlog(swiper);
    });
    const handleUpdateLinkBlog = (swiper) => {
        if (!btnLinkBlogEl) return;
        const currentIndex = swiper.realIndex;
        const activeSlide = swiper.slides[currentIndex];
        btnLinkBlogEl.href = activeSlide?.dataset?.link;
    };
    handleUpdateLinkBlog(swiperContent);
};
