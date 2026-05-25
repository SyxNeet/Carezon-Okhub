export function sectionServicesScript() {
  const section = document.querySelector('.onsen-services');
  if (!section) return;

  const removeActive = (elements) => elements.forEach((el) => el.classList.remove('active'));
  const addActive = (elements, index) => {
    if (elements[index]) {
      elements[index].classList.add('active');
    }
  };

  const activateSubTab = (panel, tabIndex) => {
    const tabs = panel.querySelectorAll('.onsen-services__tab');
    const contents = panel.querySelectorAll('.onsen-services__content');
    const desktopImages = panel.querySelectorAll('.onsen-services__image-img--pc');
    const mobileImages = panel.querySelectorAll('.onsen-services__image-img--mobile');

    removeActive(tabs);
    removeActive(contents);
    removeActive(desktopImages);
    removeActive(mobileImages);

    addActive(tabs, tabIndex);
    addActive(contents, tabIndex);
    addActive(desktopImages, tabIndex);
    addActive(mobileImages, tabIndex);
  };

  const activateCategory = (categoryIndex) => {
    const primaryTabs = section.querySelectorAll('.onsen-services__primary-tab');
    const panels = section.querySelectorAll('.onsen-services__panel');

    primaryTabs.forEach((tab, index) => {
      const isActive = index === categoryIndex;
      tab.classList.toggle('active', isActive);
      tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
    });

    panels.forEach((panel, index) => {
      const isActive = index === categoryIndex;
      panel.classList.toggle('active', isActive);
      if (isActive) {
        panel.removeAttribute('hidden');
        const activeSub = panel.querySelector('.onsen-services__tab.active');
        const subIndex = activeSub
          ? Array.from(panel.querySelectorAll('.onsen-services__tab')).indexOf(activeSub)
          : 0;
        activateSubTab(panel, subIndex >= 0 ? subIndex : 0);
      } else {
        panel.setAttribute('hidden', '');
      }
    });
  };

  section.querySelector('.onsen-services__primary-tabs')?.addEventListener('click', (e) => {
    const primaryTab = e.target.closest('.onsen-services__primary-tab');
    if (!primaryTab) return;

    const categoryIndex = Number(primaryTab.dataset.categoryIndex);
    if (Number.isNaN(categoryIndex)) return;

    activateCategory(categoryIndex);
  });

  section.querySelectorAll('.onsen-services__panel').forEach((panel) => {
    panel.querySelector('.onsen-services__tabs')?.addEventListener('click', (e) => {
      const tab = e.target.closest('.onsen-services__tab');
      if (!tab || !panel.classList.contains('active')) return;

      const tabIndex = Array.from(panel.querySelectorAll('.onsen-services__tab')).indexOf(tab);
      if (tabIndex === -1) return;

      activateSubTab(panel, tabIndex);
    });
  });
}
