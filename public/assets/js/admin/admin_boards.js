/**
 * Admin Boards Management JavaScript
 * Board search filter, star toggle, archive helper
 */

document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('admin-board-search-input') || document.getElementById('board-filter-input');
  if (!searchInput) return;

  searchInput.addEventListener('input', (e) => {
    const q = e.target.value.toLowerCase().trim();
    document.querySelectorAll('.trello-board-tile.board-card-link').forEach((link) => {
      const title = link.getAttribute('data-board-title') || link.textContent.toLowerCase();
      const visible = !q || title.includes(q);
      link.classList.toggle('is-search-hidden', !visible);
    });
  });
});

window.toggleBoardStar = function(btn, event) {
  if (event) {
    event.preventDefault();
    event.stopPropagation();
  }
  if (!btn) return;

  btn.classList.toggle('active');
  const icon = btn.querySelector('i');
  const boardTile = btn.closest('.trello-board-tile');
  const titleEl = boardTile ? boardTile.querySelector('.tile-title') : null;
  const boardTitle = titleEl
    ? titleEl.textContent.trim().toLowerCase()
    : (boardTile ? (boardTile.getAttribute('data-board-title') || '') : '');
  const isStarredNow = btn.classList.contains('active');

  if (icon) {
    icon.className = isStarredNow ? 'fa-solid fa-star text-warning' : 'fa-regular fa-star';
  }
  btn.setAttribute('title', isStarredNow ? 'Unstar Board' : 'Star Board');

  if (boardTitle) {
    document.querySelectorAll('.trello-board-tile[data-board-title="' + boardTitle + '"] .star-board-btn').forEach((otherBtn) => {
      if (otherBtn === btn) return;
      otherBtn.classList.toggle('active', isStarredNow);
      const otherIcon = otherBtn.querySelector('i');
      if (otherIcon) {
        otherIcon.className = isStarredNow ? 'fa-solid fa-star text-warning' : 'fa-regular fa-star';
      }
      otherBtn.setAttribute('title', isStarredNow ? 'Unstar Board' : 'Star Board');
    });
  }

  const starredGrid = document.getElementById('starred-boards-grid');
  if (!starredGrid || !boardTile || !boardTitle) return;

  const existingStarredTile = starredGrid.querySelector('.trello-board-tile[data-board-title="' + boardTitle + '"]');

  if (isStarredNow && !existingStarredTile) {
    const clone = boardTile.cloneNode(true);
    const cloneStarBtn = clone.querySelector('.star-board-btn');
    if (cloneStarBtn) {
      cloneStarBtn.classList.add('active');
      const cloneIcon = cloneStarBtn.querySelector('i');
      if (cloneIcon) cloneIcon.className = 'fa-solid fa-star text-warning';
      cloneStarBtn.setAttribute('title', 'Unstar Board');
    }
    starredGrid.appendChild(clone);
  } else if (!isStarredNow && existingStarredTile) {
    existingStarredTile.remove();
  }
};

window.adminDeleteBoard = function(btn) {
  const row = btn ? (btn.closest('tr') || btn.closest('.trello-board-tile')) : null;
  if (!row) return;

  row.classList.add('row-fade-out');
  setTimeout(() => row.remove(), 300);
};
