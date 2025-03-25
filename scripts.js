const search_toggle_btn = document.querySelector('.search-toggle');
const search_bar_class = search_toggle_btn.getAttribute('data-controls');
const search_bar = document.querySelector('.' + search_bar_class);
if (search_toggle_btn && search_bar) {
  search_toggle_btn.setAttribute('aria-expanded', 'false');
  search_toggle_btn.addEventListener('click', (e) => {
    e.preventDefault();
    const isExpanded = search_bar.classList.toggle('visible');
    search_toggle_btn.setAttribute('aria-expanded', isExpanded);
  });
}
