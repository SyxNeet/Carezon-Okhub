export function sectionServicesScript() {
    const section = document.querySelector('.onsen-services');
    if (!section) return;

    // Cache DOM elements within section scope
    const tabs = section.querySelectorAll('.onsen-services__tab');
    const desktopImages = section.querySelectorAll('.onsen-services__image-img--pc');
    const mobileImages = section.querySelectorAll('.onsen-services__image-img--mobile');
    const contents = section.querySelectorAll('.onsen-services__content');

    // Helper function to remove active class from multiple elements
    const removeActive = (elements) => elements.forEach(el => el.classList.remove('active'));
    const addActive = (elements, index) => {
        if (elements[index]) {
            elements[index].classList.add('active');
        }
    };

    // Event delegation for better performance
    section.querySelector('.onsen-services__tabs')?.addEventListener('click', (e) => {
        const tab = e.target.closest('.onsen-services__tab');
        if (!tab) return;

        // Get index from tab position
        const tabIndex = Array.from(tabs).indexOf(tab);
        if (tabIndex === -1) return;

        // Remove active classes
        removeActive(tabs);
        removeActive(desktopImages);
        removeActive(mobileImages);
        removeActive(contents);

        // Add active classes
        tab.classList.add('active');
        addActive(desktopImages, tabIndex);
        addActive(mobileImages, tabIndex);
        addActive(contents, tabIndex);
    });
}