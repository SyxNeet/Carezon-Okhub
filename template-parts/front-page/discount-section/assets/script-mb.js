const discountMobile = {
    // Check if device is mobile
    // isMobile() {
    //     return window.innerWidth <= 639.98;
    // },
    // // Initialize Mobile Swiper only
    // initMobileSwiper() {
    //     const mobileOfferContainer = document.querySelector(
    //         ".mobile-offer__list .mobile-swiper"
    //     );
    //     if (mobileOfferContainer) {
    //         const mobileSwiper = new Swiper(
    //             ".mobile-offer__list .mobile-swiper",
    //             {
    //                 speed: 800,
    //                 grabCursor: true,
    //                 slidesPerView: 1.03,
    //                 spaceBetween: 18,
    //                 loop: true,
    //                 updateOnWindowResize: false,
    //                 // Không có animation phức tạp như PC
    //             }
    //         );
    //         return mobileSwiper;
    //     }
    //     return null;
    // },
    // // Initialize mobile swiper
    // init() {
    //     return this.initMobileSwiper();
    // },
    // // Handle window resize
    // handleResize() {
    //     if (this.isMobile()) {
    //         return this.initMobileSwiper();
    //     }
    //     return null;
    // },
};

// Auto initialize when DOM is ready

export default discountMobile;
