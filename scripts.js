document.addEventListener('DOMContentLoaded', (event) => {
  agMakeForContractorsLink();
  agHandleSelectionPage();
});

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

function agMakeForContractorsLink() {
  const icon = '<i class="fa-solid fa-user"></i>';
  const el = document.querySelector('[aria-label="For Contractors submenu"] .wp-block-navigation-item__label');
  if (!el) {
    return;
  }
  el.innerHTML = icon;
}
