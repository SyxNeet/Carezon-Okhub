export const SectionBlogDetail = () => {
    class BlogDetail {
        constructor() {
            this.blogDetailContentEl = document.getElementById("blog-detail-content");
            this.shareCopyBtnEl = document.getElementById("blog-detail-share-copy");
            this.tocContentEl = document.getElementById("table-of-contents");
            this.toggleTocBtnEl = document.querySelector(".blog-detail__toc-btn-toggle");
            this.drawerTocMobileEl = document.getElementById("blog-detail-drawer");
            this.triggerTocMobileBtnEl = document.getElementById("blog-toc-btn-trigger");
            this.closeBtnDrawerTocMobileEl = document.querySelectorAll(".blog-toc__drawer-close-btn");
            this.overlayDrawerTocMobileEl = document.querySelector(".blog-toc__drawer-overlay");
            this.blogContentMainEl = document.getElementById("blog-detail-content");
            this.ctaEl = document.querySelector(".cta.show");
            this.init();
            this.events();
            this.observeContentBoundary();
        }
        init() {
            setTimeout(() => {
                this.handleWrapperAllTableEls();
                this.handleSetTargetBlankAllLinkEls();
            }, 0);
        }

        observeContentBoundary() {
            if (!this.triggerTocMobileBtnEl || !this.blogContentMainEl) return;

            const sentinel = document.createElement("div");
            sentinel.style.height = "2rem";
            this.blogContentMainEl.appendChild(sentinel);

            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        const contentRect = this.blogContentMainEl.getBoundingClientRect();
                        const windowHeight = window.innerHeight;

                        const isNearBottom = contentRect.bottom <= windowHeight + 32;

                        if (isNearBottom || entry.isIntersecting) {
                            this.hideTocButton();
                        } else {
                            this.showTocButton();
                        }
                    });
                }, {
                    root: null,
                    threshold: 0
                }
            );

            observer.observe(sentinel);

            window.addEventListener("scroll", () => this.checkTocButtonState());
            window.addEventListener("resize", () => this.checkTocButtonState());
        }

        checkTocButtonState() {
            if (!this.triggerTocMobileBtnEl || !this.blogContentMainEl) return;
            const contentRect = this.blogContentMainEl.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            const isNearBottom = contentRect.bottom <= windowHeight + 32;

            if (isNearBottom) {
                this.hideTocButton();
            } else {
                this.showTocButton();
            }
        }

        hideTocButton() {
            if (!this.triggerTocMobileBtnEl) return;
            if (!this.triggerTocMobileBtnEl.classList.contains("visible")) return;

            this.triggerTocMobileBtnEl.classList.remove("visible");
            this.showCTA();
        }

        showTocButton() {
            if (!this.triggerTocMobileBtnEl) return;
            if (this.triggerTocMobileBtnEl.classList.contains("visible")) return;

            this.triggerTocMobileBtnEl.classList.add("visible");
            this.hideCTA();
        }

        showCTA() {
            const cta = document.querySelector(".cta.show");
            if (!cta) return;

            if (cta.classList.contains("visible")) return;

            cta.classList.add("visible");
            cta.style.pointerEvents = "";
        }

        hideCTA() {
            const cta = document.querySelector(".cta.show");
            if (!cta) return;

            if (!cta.classList.contains("visible")) return;

            cta.classList.remove("visible");
            cta.style.pointerEvents = "none";
        }

        handleClickShareCopyBtn() {
            if (this.shareCopyBtnEl) {
                this.shareCopyBtnEl.addEventListener("click", async (e) => {
                    e.preventDefault();
                    try {
                        await navigator.share({
                            url: window.location.href,
                            title: document.title,
                        });
                    } catch (err) {
                        // handle copy to clipboard and show tooltip
                        const text = window.location.href;
                        const el = document.createElement("textarea");
                        el.value = text;
                        document.body.appendChild(el);
                        el.select();
                        document.execCommand("copy");
                        document.body.removeChild(el);
                        const tooltip = document.createElement("div");
                        tooltip.innerText = "Link copied to clipboard";
                        tooltip.style.position = "fixed";
                        tooltip.style.bottom = "1.25rem";
                        tooltip.style.right = "1.25rem";
                        tooltip.style.backgroundColor = "#333";
                        tooltip.style.color = "#fff";
                        tooltip.style.padding = "0.625rem 0.75rem";
                        tooltip.style.borderRadius = "0.3125rem";
                        tooltip.style.zIndex = "9999";
                        document.body.appendChild(tooltip);
                        setTimeout(() => {
                            document.body.removeChild(tooltip);
                        }, 2000);
                    }
                });
            }
        }
        handleClickToggleButtonEl() {
            if (!this.toggleTocBtnEl || !this.tocContentEl) return;
            this.toggleTocBtnEl.addEventListener("click", () => {
                this.tocContentEl.classList.toggle("expanded");
                const textEl = this.toggleTocBtnEl.querySelector(".blog-detail__toc-btn-toggle__content");
                textEl.textContent = this.tocContentEl.classList.contains("expanded") ? "Thu gọn" : "Xem thêm";
            });
        }
        handleToggleDrawerTocMobile({
            open = false
        }) {
            if (!this.drawerTocMobileEl) return;
            if (open) {
                this.drawerTocMobileEl.classList.add("active");
                document.body.style.overflow = "hidden";
                document.documentElement.style.overflow = "hidden";
            } else {
                this.drawerTocMobileEl.classList.remove("active");
                document.body.style.overflow = "";
                document.documentElement.style.overflow = "";
            }
        }
        handleClickCloseDrawerTocBtnEl() {
            if (!this.closeBtnDrawerTocMobileEl?.length) return;
            this.closeBtnDrawerTocMobileEl.forEach((btn) => {
                btn.addEventListener("click", () => {
                    this.handleToggleDrawerTocMobile({
                        open: false
                    });
                });
            });
        }
        handleClickOverlayDrawerTocMobileEl() {
            if (!this.overlayDrawerTocMobileEl) return;
            this.overlayDrawerTocMobileEl.addEventListener("click", () => {
                this.handleToggleDrawerTocMobile({
                    open: false
                });
            });
        }
        handleClickTriggerOpenBtnDrawerTocEl() {
            if (!this.triggerTocMobileBtnEl || !this.drawerTocMobileEl) return;
            this.triggerTocMobileBtnEl.addEventListener("click", () => {
                this.handleToggleDrawerTocMobile({
                    open: true
                });
            });
        }
        handleClickTocItemEl() {
            if (!this.tocContentEl) return;
            const tocItems = this.tocContentEl.querySelectorAll(".toc-item");
            const _this = this;
            // Xử lý click scroll
            tocItems.forEach((item) => {
                item.addEventListener("click", function() {
                    const targetAnchor = this.getAttribute("data-target");
                    const targetHeading = document.querySelector(`[data-toc-target="${targetAnchor}"]`);

                    if (targetHeading) {
                        // Smooth scroll tới heading
                        const offsetTop = targetHeading.offsetTop;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: "smooth",
                        });
                    }
                    // Ẩn drawer toc dưới mobile sau khi click
                    if (_this.drawerTocMobileEl) {
                        _this.handleToggleDrawerTocMobile({
                            open: false
                        });
                    }
                });
            });
        }
        handleWrapperAllTableEls() {
            if (!this.blogDetailContentEl) return;
            this.blogDetailContentEl.querySelectorAll("table").forEach((table) => {
                const wrapper = document.createElement("div");
                wrapper.classList.add("table-responsive");
                table.parentNode.insertBefore(wrapper, table);
                wrapper.appendChild(table);
            });
        }
        handleSetTargetBlankAllLinkEls() {
            if (!this.blogDetailContentEl) return;
            this.blogDetailContentEl.querySelectorAll("a").forEach((linkEl) => {
                linkEl.target = "_blank";
            });
        }
        events() {
            this.handleClickShareCopyBtn();
            this.handleClickTocItemEl();
            this.handleClickToggleButtonEl();

            this.handleClickCloseDrawerTocBtnEl();
            this.handleClickOverlayDrawerTocMobileEl();
            this.handleClickTriggerOpenBtnDrawerTocEl();
        }
    }
    new BlogDetail();
};