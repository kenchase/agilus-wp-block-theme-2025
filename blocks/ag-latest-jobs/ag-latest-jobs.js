document.addEventListener('DOMContentLoaded', (event) => {
  agClickableCard('.ag-clickable-card');
});

/****
 *
 * acClickableCard - Custom function
 *
 ****/

// Make the entire surface of a card clickable while using semantic HTML.
function agClickableCard(cardCssClass) {
  // A short click opens the link. A longer period (>200ms) between mousedown and mouseup does not und thus let's the user select text.
  const cards = document.querySelectorAll(cardCssClass);
  const timeToWait = 200; // ms
  Array.prototype.forEach.call(cards, (card) => {
    let down;
    let up;
    let link = card.querySelector('a'); // Find the link
    if (!link) {
      return;
    } // If no link is found, return
    card.style.cursor = 'pointer';
    card.addEventListener('mouseover', function () {
      link.classList.add('hover'); // add hover class to cta when card is hovered over
    });
    card.addEventListener('mouseout', function () {
      link.classList.remove('hover'); // remove hover class to cta when card is hovered over
    });
    card.addEventListener('mousedown', function () {
      down = +new Date(); // get timestamp on mousedown
    });
    card.addEventListener('mouseup', function () {
      up = +new Date();
      if (up - down < timeToWait) {
        link.click(); // Follow link on quick click
      }
    });
  });
}
