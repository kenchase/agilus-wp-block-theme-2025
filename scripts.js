agMakeSearchToggle();
agSetSelectionPage();
agGetSelectionPage();

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

function agSetSelectionPage() {
  const homeLinks = document.querySelectorAll('.home .ag-section-link a');
  homeLinks.forEach((link) => {
    link.addEventListener('click', (e) => {
      const selectedSection = e.target.getAttribute('href');
      localStorage.setItem('agSelectedSection', selectedSection);
    });
  });
}

function agGetSelectionPage() {
  // Check if the user is on the home page and redirect to the selected section (stored in localStorage)
  if (!document.querySelector('.home')) {
    return;
  }
  const selectedSection = localStorage.getItem('agSelectedSection');
  if (selectedSection) {
    window.location.replace(selectedSection);
  }
}
