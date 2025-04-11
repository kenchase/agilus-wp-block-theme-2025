document.addEventListener('DOMContentLoaded', (event) => {
  agMakeSearchToggle();
  agHandleSelectionPage();
});

function agMakeSearchToggle() {
  const search_toggle_btn = document.querySelector('.search-toggle');
  const search_bar = document.querySelector('.top-nav-search-bar');
  if (!search_toggle_btn || !search_bar) {
    return;
  }
  search_toggle_btn.setAttribute('aria-expanded', 'false');
  search_toggle_btn.addEventListener('click', (e) => {
    e.preventDefault();
    const isExpanded = search_bar.classList.toggle('visible');
    search_toggle_btn.setAttribute('aria-expanded', isExpanded);
  });
}

function agHandleSelectionPage() {
  // Bail if the current page is not using the selection page template
  if (!document.querySelector('.page-template-wp-custom-template-selection-page')) {
    return;
  }

  const selectedSection = localStorage.getItem('agSelectedSection');

  // Check if the selected section is already stored in localStorage abd redirect to it
  if (selectedSection !== null) {
    window.location.replace(selectedSection);
  }

  // If local storage is not set, set the default section to the first one that clicked
  if (selectedSection === null) {
    const homeLinks = document.querySelectorAll('.home .ag-section-link a');
    homeLinks.forEach((link) => {
      link.addEventListener('click', (e) => {
        const selectedSection = e.target.getAttribute('href');
        localStorage.setItem('agSelectedSection', selectedSection);
      });
    });
  }
}
