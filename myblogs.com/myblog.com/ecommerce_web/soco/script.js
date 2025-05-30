// script.js

document.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.card');

  cards.forEach(card => {
    card.addEventListener('click', () => {
      alert(`Kamu memilih: ${card.textContent.trim()}`);
    });
  });
});
