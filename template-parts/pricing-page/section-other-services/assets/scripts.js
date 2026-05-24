export function sectionOtherServices() {
  const section = document.querySelector('.other-services');
  if (!section) return;

  // Cache DOM elements within section scope
  const tabs = section.querySelectorAll('.other-services__tab');
  const desktopImages = section.querySelectorAll('.other-services__img--desktop');
  const mobileImages = section.querySelectorAll('.other-services__img--mobile');
  const durationElement = section.querySelector('.other-services__duration');
  const listContents = section.querySelectorAll('.other-services__list-content');

  // Helper function to remove active class from multiple elements
  const removeActive = (elements) => elements.forEach(el => el.classList.remove('active'));
  const addActive = (elements, index) => {
    if (elements[index]) {
      elements[index].classList.add('active');
    }
  };

  // Event delegation for better performance
  section.querySelector('.other-services__tabs')?.addEventListener('click', (e) => {
    const tab = e.target.closest('.other-services__tab');
    if (!tab) return;

    // Get index from data attribute instead of CSS variable
    const tabIndex = parseInt(tab.dataset.index);
    if (isNaN(tabIndex)) return;

    // Remove active classes
    tabs.forEach((t) => t.classList.remove('other-services__tab--active'));
    removeActive(desktopImages);
    removeActive(mobileImages);
    removeActive(listContents);

    // Add active classes
    tab.classList.add('other-services__tab--active');
    addActive(desktopImages, tabIndex);
    addActive(mobileImages, tabIndex);
    addActive(listContents, tabIndex);

    // Update duration text
    const tabTitle = tab.querySelector('.other-services__tab-title')?.textContent;
    if (durationElement && tabTitle) {
      durationElement.textContent = `Thời gian: ${tabTitle}`;
    }
  });
}
