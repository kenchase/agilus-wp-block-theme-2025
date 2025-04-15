document.addEventListener('DOMContentLoaded', (event) => {
  const blocks = document.querySelectorAll('.ag-content-index');
  setupBlocks(blocks);
  setupNav(blocks);
});

function setupBlocks(blocks) {
  blocks.forEach((block) => {
    block.classList.add('ag-content-index--active');
    const contentBlocks = block.querySelectorAll('.ag-content-index__content > .wp-block-group:not(:first-child)');
    contentBlocks.forEach((contentBlock) => {
      contentBlock.classList.add('visually-hidden');
    });
  });
}

function setupNav(blocks) {
  blocks.forEach((block) => {
    const contentLinks = block.querySelectorAll('.ag-content-index__menu a');
    // Set the first link as the current one
    contentLinks[0].classList.add('is-current');
    // Loop through each link
    contentLinks.forEach((link) => {
      // Add an event listener to the link
      link.addEventListener('click', (event) => {
        event.preventDefault();
        // Remove 'is-current' class from all links in this block
        contentLinks.forEach((item) => {
          item.classList.remove('is-current');
        });
        // Add 'is-current' class to the clicked element (which is 'link')
        event.currentTarget.classList.add('is-current');
        const targetId = link.getAttribute('href').substring(1);
        const targetBlock = block.querySelector(`.ag-content-index__content > .wp-block-group[id="${targetId}"]`);
        if (targetBlock) {
          const contentBlocks = block.querySelectorAll('.ag-content-index__content > .wp-block-group');
          contentBlocks.forEach((contentBlock) => {
            contentBlock.classList.add('visually-hidden');
          });
          targetBlock.classList.remove('visually-hidden');
        }
      });
    });
  });
}
