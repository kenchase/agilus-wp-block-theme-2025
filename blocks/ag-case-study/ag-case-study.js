document.addEventListener('DOMContentLoaded', (event) => {
  // Create modal elements
  createModalElements();

  // Initialize the modal functionality
  makeModal();
});

function createModalElements() {
  // Create modal overlay
  const modalOverlay = document.createElement('div');
  modalOverlay.className = 'modal-overlay';
  modalOverlay.id = 'modal-overlay';

  // Create modal container
  const modalContainer = document.createElement('div');
  modalContainer.className = 'modal-container';

  // Create close button
  const closeButton = document.createElement('button');
  closeButton.className = 'modal-close';
  closeButton.innerHTML = '&times;';
  closeButton.addEventListener('click', closeModal);

  // Create content container
  const modalContent = document.createElement('div');
  modalContent.className = 'modal-content';
  modalContent.id = 'modal-content';

  // Assemble modal structure
  modalContainer.appendChild(closeButton);
  modalContainer.appendChild(modalContent);
  modalOverlay.appendChild(modalContainer);

  // Add modal to document
  document.body.appendChild(modalOverlay);

  // Add click event to close modal when clicking overlay
  modalOverlay.addEventListener('click', function (event) {
    if (event.target === modalOverlay) {
      closeModal();
    }
  });

  // Add keyboard event to close modal on ESC key
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      closeModal();
    }
  });
}

function makeModal() {
  const links = document.querySelectorAll('.ag-case-study .ag-case-study__card a');
  links.forEach((link) => {
    link.addEventListener('click', function (event) {
      event.preventDefault(); // Prevent the default action of the link
      const content_id = link.getAttribute('href'); // Get the Content ID from the link
      if (content_id !== null) {
        const targetElement = document.getElementById(content_id.slice(1));
        if (targetElement) {
          const content = targetElement.innerHTML; // Get the content
          openModal(content);
        } else {
          console.error(`Element with ID "${content_id.slice(1)}" not found`);
        }
      }
    });
  });
}

function openModal(content) {
  // Set the content in the modal
  const modalContent = document.getElementById('modal-content');
  modalContent.innerHTML = content;

  // Show the modal
  const modalOverlay = document.getElementById('modal-overlay');
  modalOverlay.classList.add('active');

  // Prevent body scrolling when modal is open
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  // Hide the modal
  const modalOverlay = document.getElementById('modal-overlay');
  modalOverlay.classList.remove('active');

  // Re-enable body scrolling
  document.body.style.overflow = '';

  // Clear the content (optional)
  setTimeout(() => {
    document.getElementById('modal-content').innerHTML = '';
  }, 300); // Wait for the closing animation
}
