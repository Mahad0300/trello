/**
 * User All Boards Hub JavaScript
 * Board search filter, workspace accordion, star toggle
 */

document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('all-boards-search-input') || document.getElementById('board-search-input');
  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      const term = e.target.value.toLowerCase().trim();
      document.querySelectorAll('.trello-board-tile.board-card-link').forEach((link) => {
        const title = link.getAttribute('data-board-title') || link.textContent.toLowerCase();
        const visible = !term || title.includes(term);
        link.classList.toggle('is-search-hidden', !visible);
      });
    });
  }

  document.querySelectorAll('.workspace-section-header').forEach((header) => {
    header.addEventListener('click', (e) => {
      if (e.target.closest('button') || e.target.closest('a')) return;

      const section = header.closest('.workspace-section');
      const grid = section ? section.querySelector('.boards-grid') : null;
      const icon = header.querySelector('.collapse-icon');
      if (!grid) return;

      const collapsed = grid.classList.toggle('is-collapsed');
      if (icon) icon.classList.toggle('is-collapsed', collapsed);
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
