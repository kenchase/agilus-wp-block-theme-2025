document.addEventListener('DOMContentLoaded', (event) => {
  // Create a closure to manage event listeners
  const eventManager = (function () {
    let activeEventListeners = [];

    return {
      add: function (element, type, handler) {
        activeEventListeners.push({ element, type, handler });
        element.addEventListener(type, handler);
      },
      removeAll: function () {
        activeEventListeners.forEach(({ element, type, handler }) => {
          element.removeEventListener(type, handler);
        });
        activeEventListeners = [];
      },
    };
  })();

  // Pass the event manager to our responsive listener
  setupResponsiveListener(
    // Mobile callback
    () => resetBlocks(eventManager),
    // Desktop callback
    () => setupBlocks(eventManager)
  );
});

function setupResponsiveListener(mobileCallback, desktopCallback, breakpoint = 782) {
  function checkWidth() {
    const windowWidth = window.innerWidth;
    if (windowWidth < breakpoint) {
      mobileCallback();
    } else {
      desktopCallback();
    }
  }

  // Set up resize listener with debounce for performance
  let resizeTimer;
  window.addEventListener('resize', function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(checkWidth, 250);
  });

  // Run immediately
  checkWidth();
}

function resetBlocks(eventManager) {
  // Remove all event listeners
  eventManager.removeAll();

  const blocks = document.querySelectorAll('.ag-content-index');
  blocks.forEach((block) => {
    // Remove 'ag-content-index--active' class from each block
    block.classList.remove('ag-content-index--active');
    // Remove 'is-current' class from each link in this block
    const contentLinks = block.querySelectorAll('.ag-content-index__menu a');
    contentLinks.forEach((link) => {
      link.classList.remove('is-current');
    });
    // Remove 'visually-hidden' class from each content block in this block
    const contentBlocks = block.querySelectorAll('.ag-content-index__content > .wp-block-group');
    contentBlocks.forEach((contentBlock) => {
      contentBlock.classList.remove('visually-hidden');
    });
  });
}

function setupBlocks(eventManager) {
  // Clear any existing event listeners
  eventManager.removeAll();

  const blocks = document.querySelectorAll('.ag-content-index');

  blocks.forEach((block) => {
    // Add 'ag-content-index--active' class
    block.classList.add('ag-content-index--active');

    // Hide all content blocks except the first one
    const contentBlocks = block.querySelectorAll('.ag-content-index__content > .wp-block-group');
    contentBlocks.forEach((contentBlock, index) => {
      if (index > 0) contentBlock.classList.add('visually-hidden');
    });

    // Set up the links and events
    const contentLinks = block.querySelectorAll('.ag-content-index__menu a');
    if (contentLinks.length > 0) {
      // Set the first link as current
      contentLinks[0].classList.add('is-current');

      // Add click handlers
      contentLinks.forEach((link) => {
        const clickHandler = (event) => {
          event.preventDefault();

          // Update active link
          contentLinks.forEach((item) => item.classList.remove('is-current'));
          event.currentTarget.classList.add('is-current');

          // Show targeted content
          const targetId = link.getAttribute('href').substring(1);
          const targetBlock = block.querySelector(`.ag-content-index__content > .wp-block-group[id="${targetId}"]`);

          if (targetBlock) {
            contentBlocks.forEach((cb) => cb.classList.add('visually-hidden'));
            targetBlock.classList.remove('visually-hidden');
          }
        };

        // Register the event listener with our manager
        eventManager.add(link, 'click', clickHandler);
      });
    }
  });
}
