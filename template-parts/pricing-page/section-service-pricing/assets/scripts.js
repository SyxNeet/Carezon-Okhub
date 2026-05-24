export function sectionServicePricing() {
  const sections = document.querySelectorAll(".service-pricing");
  if (!sections.length) return;

  const getTikTokId = (url) => {
    const match = url ? url.match(/video\/(\d+)/) : null;
    return match ? match[1] : null;
  };

  const renderVideos = (scopeEl) => {
    if (!scopeEl) return;

    const iframeEmbed = "https://www.tiktok.com/embed/v3";
    const videos = scopeEl.querySelectorAll(".service-pricing__video-media");

    videos.forEach((video) => {
      const type = video.dataset.type;
      const dataSrc = video.dataset.src;
      if (!dataSrc) return;

      let src = dataSrc;
      if (type === "tiktok") {
        const id = getTikTokId(dataSrc);
        if (!id) return;
        src = `${iframeEmbed}/${id}?autoplay=1&mute=1&loop=1`;
      }

      if (video.getAttribute("src") !== src) {
        video.setAttribute("src", src);
      }
    });
  };

  const activatePanel = (tabs, panels, activeTab) => {
    if (!activeTab) return;
    const key = activeTab.dataset.tab;
    if (!key) return;

    tabs.forEach((t) => t.classList.remove("active"));
    activeTab.classList.add("active");

    panels.forEach((p) => {
      const isActive = p.dataset.panel === key;
      p.classList.toggle("active", isActive);
    });
  };

  const activateFirstInfoTabInPanel = (servicePanelEl) => {
    if (!servicePanelEl) return;
    const infoTabs = servicePanelEl.querySelectorAll(
      ".service-pricing__info-tab",
    );
    const infoPanels = servicePanelEl.querySelectorAll(
      ".service-pricing__info-panel",
    );
    const activeInfoTab =
      servicePanelEl.querySelector(".service-pricing__info-tab.active") ||
      infoTabs[0];
    if (!activeInfoTab) return;
    activatePanel(infoTabs, infoPanels, activeInfoTab);
  };

  // Popup booking logic (mirrored from footer)
  const initPopupBooking = () => {
    const popupBooking = document.querySelector(".popup__booking");
    const closeBtn = document.querySelector(".popup__close-btn");
    if (!popupBooking || !closeBtn) return;

    const openPopup = () => {
      popupBooking.classList.add("active");
      document.documentElement.style.overflow = "hidden";
    };

    const closePopup = () => {
      popupBooking.classList.remove("active");
      document.documentElement.style.overflow = "";
    };

    // Close handlers (only bind once globally)
    if (!popupBooking.dataset.popupInited) {
      closeBtn.addEventListener("click", closePopup);
      popupBooking.addEventListener("click", (e) => {
        if (e.target === popupBooking) closePopup();
      });
      popupBooking.dataset.popupInited = "1";
    }

    // Bind open handlers for all service-pricing buttons
    sections.forEach((sectionEl) => {
      const serviceButtons = sectionEl.querySelectorAll(
        ".service-pricing__button",
      );
      serviceButtons.forEach((btn) => {
        btn.addEventListener("click", openPopup);
      });
    });
  };

  initPopupBooking();

  sections.forEach((sectionEl) => {
    const tabs = sectionEl.querySelectorAll(".service-pricing__tab");
    const panels = sectionEl.querySelectorAll(".service-pricing__panel");
    if (!tabs.length || !panels.length) return;

    const defaultTab =
      sectionEl.querySelector(".service-pricing__tab.active") || tabs[0];
    activatePanel(tabs, panels, defaultTab);
    const defaultPanel = sectionEl.querySelector(
      ".service-pricing__panel.active",
    );
    activateFirstInfoTabInPanel(defaultPanel);
    renderVideos(defaultPanel);

    tabs.forEach((tab) => {
      tab.addEventListener("click", () => {
        activatePanel(tabs, panels, tab);
        const activePanel = sectionEl.querySelector(
          ".service-pricing__panel.active",
        );
        activateFirstInfoTabInPanel(activePanel);
        renderVideos(activePanel);
      });
    });

    const infoTabs = sectionEl.querySelectorAll(".service-pricing__info-tab");
    infoTabs.forEach((tab) => {
      tab.addEventListener("click", () => {
        const servicePanelEl = tab.closest(".service-pricing__panel");
        if (!servicePanelEl) return;

        const currentInfoTabs = servicePanelEl.querySelectorAll(
          ".service-pricing__info-tab",
        );
        const currentInfoPanels = servicePanelEl.querySelectorAll(
          ".service-pricing__info-panel",
        );
        activatePanel(currentInfoTabs, currentInfoPanels, tab);
      });
    });

    const items = sectionEl.querySelectorAll(".service-pricing__include-item");
    const panelAnimatingMap = new WeakMap();

    items.forEach((item) => {
      const trigger = item.querySelector(".service-pricing__include-trigger");
      const content = item.querySelector(".service-pricing__include-accordion");
      if (!trigger || !content) return;

      content.style.height = "0px";

      trigger.addEventListener("click", () => {
        const panelScope =
          item.closest(".service-pricing__info-panel") ||
          item.closest(".service-pricing__panel") ||
          sectionEl;

        if (panelAnimatingMap.get(panelScope)) return;
        panelAnimatingMap.set(panelScope, true);

        const scopeItems = panelScope.querySelectorAll(
          ".service-pricing__include-item",
        );

        const isOpen = item.classList.contains("is-open");

        // Close others
        scopeItems.forEach((otherItem) => {
          if (otherItem !== item) {
            const otherContent = otherItem.querySelector(
              ".service-pricing__include-accordion",
            );

            otherItem.classList.remove("is-open");

            if (otherContent) {
              otherContent.style.height = otherContent.scrollHeight + "px";

              requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                  otherContent.style.height = "0px";
                });
              });
            }
          }
        });

        if (isOpen) {
          content.style.height = content.scrollHeight + "px";

          requestAnimationFrame(() => {
            content.style.height = "0px";
          });

          item.classList.remove("is-open");

          content.addEventListener(
            "transitionend",
            () => {
              panelAnimatingMap.set(panelScope, false);
            },
            { once: true },
          );

          return;
        }

        content.style.height = content.scrollHeight + "px";

        content.addEventListener(
          "transitionend",
          () => {
            content.style.height = "auto";
            panelAnimatingMap.set(panelScope, false);
          },
          { once: true },
        );

        item.classList.add("is-open");
      });
    });
  });
}
