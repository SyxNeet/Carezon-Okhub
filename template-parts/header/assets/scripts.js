class HandleHeaderToggleOnScroll {
  constructor() {
    this.header = document.querySelector(".header");
    this.lastScrollTop = 0;
    this.isScrolling = false;
    this.animationFrame = null;
    this.ticking = false;

    // Cache DOM elements and values
    this.headerHeight = 0;
    this.viewportHeight = 0;
    this.isSpecialPage = false;
    this.currentState = {
      transparent: false,
      color: false,
      hide: false,
      pinSpacerHighZIndex: false,
    };

    // CSS classes
    this.CLASSES = {
      TRANSPARENT: "header--transparent",
      COLOR: "header--color",
      HIDE: "hide",
      SMOOTH_TRANSITION: "header--smooth-transition",
    };

    // Page types that need special header behavior
    this.SPECIAL_PAGE_TYPES = [
      "single-tours",
      "single-products",
      "single-services",
      "archive-tours",
      "archive-products",
    ];

    // Performance optimization
    this.throttleDelay = 16; // ~60fps
    this.lastThrottleTime = 0;
  }

  init() {
    // Check if header element exists
    if (!this.header) {
      console.warn("Header element not found");
      return;
    }

    // Cache initial values
    this.cacheValues();
    this.setInitState();
    this.handleScroll();
  }

  cacheValues() {
    this.headerHeight = this.header.offsetHeight;
    this.viewportHeight = this.getViewportHeight();
    this.isSpecialPage = this.checkSpecialPage();
  }

  setInitState() {
    const scrollTop = this.getScrollTop();
    this.toggleTransparentClass(scrollTop <= 0);
  }

  getScrollTop() {
    return window.pageYOffset || document.documentElement.scrollTop;
  }

  getViewportHeight() {
    return Math.max(
      document.documentElement.clientHeight || 0,
      window.innerHeight || 0
    );
  }

  checkSpecialPage() {
    const currentPageType = this.header?.getAttribute("data-page-type") || "";
    return this.SPECIAL_PAGE_TYPES.includes(currentPageType);
  }

  toggleTransparentClass(isTransparent) {
    if (this.currentState.transparent === isTransparent) return;

    this.currentState.transparent = isTransparent;

    if (isTransparent) {
      this.header.classList.add(this.CLASSES.TRANSPARENT);
      this.header.classList.remove(this.CLASSES.COLOR);
      this.currentState.color = false;
    } else {
      this.header.classList.remove(this.CLASSES.TRANSPARENT);
    }
  }

  toggleColorClass(shouldAddColor) {
    if (this.currentState.color === shouldAddColor) return;

    this.currentState.color = shouldAddColor;

    if (shouldAddColor) {
      this.header.classList.add(this.CLASSES.COLOR);
      this.header.classList.remove(this.CLASSES.TRANSPARENT);
      this.currentState.transparent = false;
    } else {
      this.header.classList.remove(this.CLASSES.COLOR);
    }
  }

  toggleHideClass(shouldHide) {
    if (this.currentState.hide === shouldHide) return;

    this.currentState.hide = shouldHide;

    if (shouldHide) {
      this.header.classList.add(this.CLASSES.HIDE);
    } else {
      this.header.classList.remove(this.CLASSES.HIDE);
    }
  }

  toggleSmoothTransitionClass(shouldAddTransition) {
    if (this.currentState.pinSpacerHighZIndex === shouldAddTransition) return;

    this.currentState.pinSpacerHighZIndex = shouldAddTransition;

    if (shouldAddTransition) {
      this.header.classList.add(this.CLASSES.SMOOTH_TRANSITION);
    } else {
      this.header.classList.remove(this.CLASSES.SMOOTH_TRANSITION);
    }
  }

  handleColorLogic(scrollTop) {
    // Check if PHP already added header--color class (only for special pages)
    if (this.isSpecialPage) {
      // For special pages, PHP should handle it, but ensure it's there
      this.toggleColorClass(true);
      return;
    }

    // For normal pages: add color class when scroll reaches viewport bottom minus header height
    const threshold = this.viewportHeight - this.headerHeight;
    const shouldHaveColor = scrollTop >= threshold;
    this.toggleColorClass(shouldHaveColor);
  }

  handleHideLogic(scrollTop) {
    const isScrollingDown = scrollTop > this.lastScrollTop;
    const isNearTop = scrollTop < this.headerHeight;

    // Check if we're still in the loading section (pin-spacer)
    const pinSpacer = document.querySelector(".pin-spacer");
    const isInLoadingSection =
      pinSpacer && scrollTop < pinSpacer.offsetTop + pinSpacer.offsetHeight;

    // Check pin-spacer z-index to add smooth transition
    if (pinSpacer) {
      const computedStyle = window.getComputedStyle(pinSpacer);
      const zIndex = parseInt(computedStyle.zIndex);
      const shouldAddTransition = zIndex === 1000; // When pin-spacer has z-index 1000
      this.toggleSmoothTransitionClass(shouldAddTransition);
    }

    // Only hide header after scrolling past the loading section
    const shouldHide =
      isScrollingDown &&
      !isInLoadingSection &&
      scrollTop >= this.viewportHeight;

    if (shouldHide) {
      this.toggleHideClass(true);
    } else if (!isScrollingDown || isNearTop) {
      this.toggleHideClass(false);
      // When header shows again, re-evaluate color class
      this.handleColorLogic(scrollTop);
    }
  }

  onScroll() {
    if (this.ticking) return;

    this.ticking = true;

    this.animationFrame = requestAnimationFrame(() => {
      const scrollTop = this.getScrollTop();

      // Only process if scroll position changed significantly
      const scrollDelta = Math.abs(scrollTop - this.lastScrollTop);
      if (scrollDelta < 2) {
        this.ticking = false;
        return;
      }

      // Handle transparent state
      this.toggleTransparentClass(scrollTop <= 0);

      // Handle color state
      this.handleColorLogic(scrollTop);

      // Handle hide/show state
      this.handleHideLogic(scrollTop);

      this.lastScrollTop = scrollTop;
      this.ticking = false;
    });
  }

  handleScroll() {
    window.addEventListener("scroll", this.onScroll.bind(this), {
      passive: true,
    });
  }

  destroy() {
    window.removeEventListener("scroll", this.onScroll.bind(this));
    if (this.animationFrame) {
      cancelAnimationFrame(this.animationFrame);
    }
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const menuBtn = document.querySelector(".header__menu-btn");
  const closeBtns = document.querySelectorAll(".mega-menu__close");
  const overlay = document.querySelector(".mega-menu__overlay");
  const mainMenu = document.querySelector(".main-menu");
  const body = document.body;

  function openMenu() {
    mainMenu.classList.add("main-menu--open");
    body.classList.add("menu-open");
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    mainMenu.classList.remove("main-menu--open");
    body.classList.remove("menu-open");
    document.body.style.overflow = '';
  }

  menuBtn.addEventListener("click", openMenu);
  closeBtns.forEach(closeBtn => {
    closeBtn.addEventListener("click", closeMenu);
  });

  overlay.addEventListener("click", closeMenu);

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && mainMenu.classList.contains("main-menu--open")) {
      closeMenu();
    }
  });
});
