/**
 * Blog List Page Handler
 * Handle filter, search, pagination with AJAX
 */

export function blogList() {
    const filterBar = document.querySelector('.blog-list__filter-bar');
    const contentContainer = document.getElementById('blog-list-content');
    const paginationContainer = document.getElementById('blog-list-pagination');
    const categoryItems = document.querySelectorAll(".blog-list__tab");
    const categoryList = document.querySelector(".blog-list__tabs");
    
    if (!filterBar || !contentContainer) return;

    let searchTimeout;

    /**
     * Get posts limit based on screen size
     */
    function getLimit() {
        return window.innerWidth < 768 ? 6 : 9;
    }

    /**
     * Get skeleton HTML
     */
    function getSkeletonHTML() {
        const skeletonItem = `
            <article class="blog-item blog-item--skeleton">
                <div class="blog-item__category blog-item__category--skeleton">
                    <span class="blog-item__category-text--skeleton"></span>
                </div>
                <div class="blog-item__thumbnail blog-item__thumbnail--skeleton"></div>
                <div class="blog-item__publish blog-item__publish--skeleton">
                    <span class="blog-item__publish-text--skeleton"></span>
                </div>
                <div class="blog-item__title blog-item__title--skeleton">
                    <span class="blog-item__title-line--skeleton"></span>
                    <span class="blog-item__title-line--skeleton"></span>
                </div>
            </article>
        `;
        
        return `<div class="blog-list__grid">${skeletonItem.repeat(getLimit())}</div>`;
    }

    /**
     * Get current filter values
     */
    function getFilterValues() {
        const categoryFilter = document.getElementById('category-filter');
        const orderbyFilter = document.getElementById('orderby-filter');
        const searchInput = document.getElementById('search-input');

        return {
            category: categoryList?.dataset?.value || '', // Now returns slug instead of ID
            orderby: orderbyFilter?.value || 'newest',
            search: searchInput?.value || '',
        };
    }

    /**
     * Update URL with current params
     */
    function updateURL(page = 1) {
        const params = getFilterValues();
        const searchParams = new URLSearchParams();

        if (params.category) searchParams.set('category', params.category);
        if (params.orderby !== 'newest') searchParams.set('orderby', params.orderby);
        if (params.search) searchParams.set('search', params.search);
        if (page > 1) searchParams.set('paged', page);
        if (getLimit() !== 9) searchParams.set('limit', getLimit());

        const newURL = window.location.pathname + (searchParams.toString() ? '?' + searchParams.toString() : '');
        window.history.pushState({ path: newURL }, '', newURL);
    }

    /**
     * Load blog posts via AJAX
     */
    function loadBlogs(page = 1) {
        const params = getFilterValues();

        // Show skeleton
        contentContainer.innerHTML = getSkeletonHTML();

        // Hide pagination temporarily
        if (paginationContainer) {
            paginationContainer.style.display = 'none';
        }

        // Fetch data from REST API
        const url = new URL(`${window.location.origin}/wp-json/blog-list/v1/posts`);
        url.searchParams.append('paged', page);
        url.searchParams.append('limit', getLimit());
        if (params.category) url.searchParams.append('category', params.category);
        if (params.orderby) url.searchParams.append('orderby', params.orderby);
        if (params.search) url.searchParams.append('search', params.search);

        fetch(url.toString(), {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                // Update content
                contentContainer.innerHTML = data.html;

                // Update pagination
                if (paginationContainer) {
                    if (data.has_pagination) {
                        paginationContainer.innerHTML = data.pagination;
                        paginationContainer.style.display = 'flex';
                        attachPaginationListeners();
                    } else {
                        paginationContainer.style.display = 'none';
                    }
                }

                // Update URL
                updateURL(page);

                // Scroll to container
                const blogListContainer = document.querySelector('.blog-list__container');
                if (blogListContainer) {
                    const containerRect = blogListContainer.getBoundingClientRect();
                    const containerTop = containerRect.top + window.pageYOffset;
                    console.log(containerTop);
                    window.scrollTo({
                        top: containerTop - 100,
                        behavior: 'smooth'
                    });
                }
            }
        })
        .catch(error => {
            console.error('Error loading blog list:', error);
        });
    }

    /**
     * Attach pagination event listeners
     */
    function attachPaginationListeners() {
        const paginationBtns = document.querySelectorAll('.blog-list__pagination-btn');
        
        paginationBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const page = btn.dataset.page;
                if (page) {
                    loadBlogs(parseInt(page));
                }
            });
        });
    }

    /**
     * Initialize custom dropdowns
     */
    function initCustomDropdowns() {
        const dropdowns = document.querySelectorAll('.custom-dropdown');

        dropdowns.forEach(dropdown => {
            const button = dropdown.querySelector('.custom-dropdown__button');
            const menu = dropdown.querySelector('.custom-dropdown__menu');
            const items = dropdown.querySelectorAll('.custom-dropdown__item');
            const select = dropdown.querySelector('.custom-dropdown__select');
            const textSpan = dropdown.querySelector('.custom-dropdown__text');

            // Toggle dropdown on button click
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const isOpen = dropdown.classList.contains('custom-dropdown--open');
                
                // Close all dropdowns first
                dropdowns.forEach(d => d.classList.remove('custom-dropdown--open'));
                
                // Toggle current dropdown
                if (!isOpen) {
                    dropdown.classList.add('custom-dropdown--open');
                }
            });

            // Handle item selection
            items.forEach(item => {
                item.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const value = item.dataset.value;
                    const itemText = item.querySelector('span').textContent;

                    // Update select value
                    select.value = value;

                    // Update button text
                    textSpan.textContent = itemText;

                    // Update active state - remove active from all items
                    items.forEach(i => i.classList.remove('custom-dropdown__item--active'));
                    // Add active to clicked item
                    item.classList.add('custom-dropdown__item--active');

                    // Close dropdown
                    dropdown.classList.remove('custom-dropdown--open');

                    // Trigger change event
                    select.dispatchEvent(new Event('change'));
                });
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.custom-dropdown')) {
                dropdowns.forEach(d => d.classList.remove('custom-dropdown--open'));
            }
        });
    }

    /**
     * Initialize event listeners
     */
    function initEventListeners() {
        // Initialize custom dropdowns
        initCustomDropdowns();
        
        const colorClasses = ['green', "brown1", "brown2", "brown3", "green", "brown4", "light-yellow"];
        
        const total = categoryItems.length;
        
        categoryItems.forEach((tab, i) => {
            if (tab.classList.contains(colorClasses[i])) return;
            
            tab.classList.add(colorClasses[i]);
            
            // tab.style.zIndex = categoryItems.length - i; // trái cao, phải thấp

            
            tab.addEventListener("click", () => {
                const prevTab = categoryItems[i - 1];
                const nextTab = categoryItems[i + 1];
                
                const dataValue = tab.dataset.value;
                categoryItems.forEach((t, index) => {
                    t.classList.remove("active");
        
                    // set lại z-index theo thứ tự ban đầu
                    // t.style.zIndex = total - index;
                });
                tab.classList.add("active");
                
                // tab.style.zIndex = total + 10;
                
                categoryList.setAttribute("data-value", dataValue);
                loadBlogs(1);
            })
        })

        // Category filter change
        const categoryFilter = document.getElementById('category-filter');
        if (categoryFilter) {
            categoryFilter.addEventListener('change', () => {
                loadBlogs(1);
            });
        }

        // Orderby filter change
        const orderbyFilter = document.getElementById('orderby-filter');
        if (orderbyFilter) {
            orderbyFilter.addEventListener('change', () => {
                loadBlogs(1);
            });
        }

        // Search input with debounce
        const searchInput = document.getElementById('search-input');
        if (searchInput) {
            // Debounced input
            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    loadBlogs(1);
                }, 500);
            });

            // Enter key to search immediately
            searchInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    clearTimeout(searchTimeout);
                    loadBlogs(1);
                }
            });
        }

        // Pagination listeners (initial)
        attachPaginationListeners();
    }

    /**
     * Initialize mobile filter popup
     */
    function initMobileFilterPopup() {
        const mobileFilterBtn = document.getElementById('mobile-filter-btn');
        const mobileFilterPopup = document.getElementById('mobile-filter-popup');
        const mobileFilterClose = document.getElementById('mobile-filter-close');
        const mobileFilterOverlay = document.querySelector('.blog-list__mobile-filter-overlay');
        const mobileFilterApplyBtn = document.getElementById('mobile-filter-apply-btn');

        if (!mobileFilterBtn || !mobileFilterPopup) return;

        // Open popup
        mobileFilterBtn.addEventListener('click', () => {
            mobileFilterPopup.classList.add('mobile-filter-popup--open');
            document.body.style.overflow = 'hidden'; // Prevent body scroll
        });

        // Close popup
        const closePopup = () => {
            mobileFilterPopup.classList.remove('mobile-filter-popup--open');
            document.body.style.overflow = ''; // Restore body scroll
        };

        if (mobileFilterClose) {
            mobileFilterClose.addEventListener('click', closePopup);
        }

        if (mobileFilterOverlay) {
            mobileFilterOverlay.addEventListener('click', closePopup);
        }

        // Apply filter
        if (mobileFilterApplyBtn) {
            mobileFilterApplyBtn.addEventListener('click', () => {
                const categoryRadio = document.querySelector('input[name="mobile-category-filter"]:checked');
                const orderbyRadio = document.querySelector('input[name="mobile-orderby-filter"]:checked');

                // Update main filter inputs
                const categoryFilter = document.getElementById('category-filter');
                const orderbyFilter = document.getElementById('orderby-filter');

                if (categoryRadio && categoryFilter) {
                    categoryFilter.value = categoryRadio.value;
                }

                if (orderbyRadio && orderbyFilter) {
                    orderbyFilter.value = orderbyRadio.value;
                }

                // Close popup
                closePopup();

                // Trigger filter change - check both filters
                if (categoryFilter && categoryFilter.value !== (categoryRadio ? categoryRadio.value : '')) {
                    categoryFilter.dispatchEvent(new Event('change'));
                } else if (orderbyFilter && orderbyFilter.value !== (orderbyRadio ? orderbyRadio.value : '')) {
                    orderbyFilter.dispatchEvent(new Event('change'));
                } else {
                    // Both filters remain the same, so we still need to reload
                    loadBlogs(1);
                }
            });
        }
    }

    // Initialize
    initEventListeners();
    initMobileFilterPopup();
}
