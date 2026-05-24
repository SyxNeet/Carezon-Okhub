export const sectionListScripts = () => {
  const root = document.querySelector('.career-list');
  if (!root) return;

  const listEl = root.querySelector('.career-list__items');
  const paginationEl = root.querySelector('.career-list__pagination');
  if (!listEl || !paginationEl) return;

  const LIMIT = 9;

  function getLimit() {
    return LIMIT;
  }

  function getSkeletonHTML() {
    const skeletonItem = `
      <article class="career-card career-card--skeleton">
        <div class="career-card__header">
          <div class="career-card__title career-card__title--skeleton"></div>
          <div class="career-card__type career-card__type--skeleton"></div>
        </div>
        <div class="career-card__info">
          <div class="career-card__info-row career-card__info-row--skeleton"></div>
          <div class="career-card__info-row career-card__info-row--skeleton"></div>
          <div class="career-card__info-row career-card__info-row--skeleton"></div>
          <div class="career-card__info-row career-card__info-row--skeleton"></div>
        </div>
        <div class="career-card__footer">
          <div class="career-card__deadline career-card__deadline--skeleton"></div>
          <div class="career-card__cta career-card__cta--skeleton"></div>
        </div>
      </article>
    `;

    return skeletonItem.repeat(getLimit());
  }

  function updateURL(page = 1) {
    const searchParams = new URLSearchParams(window.location.search);
    if (page > 1) searchParams.set('paged', page);
    else searchParams.delete('paged');

    const newURL = window.location.pathname + (searchParams.toString() ? '?' + searchParams.toString() : '');
    window.history.pushState({ path: newURL }, '', newURL);
  }

  function attachPaginationListeners() {
    const btns = paginationEl.querySelectorAll('.career-list__pagination-btn');
    btns.forEach((btn) => {
      btn.addEventListener('click', () => {
        const page = btn.dataset.page;
        if (!page) return;
        loadCareers(parseInt(page, 10));
      });
    });
  }

  function loadCareers(page = 1) {
    paginationEl.style.display = 'none';

    listEl.innerHTML = getSkeletonHTML();

    const url = new URL(`${window.location.origin}/wp-json/career-list/v1/posts`);
    url.searchParams.append('paged', String(page));
    url.searchParams.append('limit', String(getLimit()));

    fetch(url.toString(), {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    })
      .then((response) => response.json())
      .then((data) => {
        if (!data) return;

        listEl.innerHTML = data.html;

        if (data.has_pagination) {
          paginationEl.innerHTML = data.pagination;
          paginationEl.style.display = 'flex';
          attachPaginationListeners();
        } else {
          paginationEl.style.display = 'none';
        }

        updateURL(page);

        const container = root.querySelector('.career-list__container');
        if (container) {
          const top = container.getBoundingClientRect().top + window.pageYOffset;
          window.scrollTo({
            top: top - 100,
            behavior: 'smooth',
          });
        }
      })
      .catch((error) => {
        console.error('Error loading careers list:', error);
      });
  }

  attachPaginationListeners();

  const params = new URLSearchParams(window.location.search);
  const initialPage = parseInt(params.get('paged') || '1', 10);
  const hasAjaxParams = params.has('paged');
  if (hasAjaxParams && Number.isFinite(initialPage) && initialPage > 0) {
    loadCareers(initialPage);
  }
}