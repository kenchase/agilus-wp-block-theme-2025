const search_toggle_btn = document.querySelector('.top-nav-search-btn a');
const search_bar = document.querySelector('.top-nav-search-bar');

search_toggle_btn.addEventListener('click', () => {
  search_bar.style.display = search_bar.style.display === 'block' ? 'none' : 'block';
});
