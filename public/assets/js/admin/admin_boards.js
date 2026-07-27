/**
 * Admin Boards Management JavaScript
 * Filter workspace boards, Create Board, Interactive Board Star Toggle
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('Admin Boards JS Initialized');

  const searchInput = document.getElementById('admin-board-search-input') || document.getElementById('board-filter-input');
  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      const q = e.target.value.toLowerCase().trim();
      const boardLinks = document.querySelectorAll('.trello-board-tile.board-card-link');

      boardLinks.forEach(link => {
        const title = link.getAttribute('data-board-title') || link.textContent.toLowerCase();
        if (!q || title.includes(q)) {
          link.style.display = 'flex';
        } else {
          link.style.display = 'none';
        }
      });
    });
  }
});

// Global Interactive Board Star Toggle Function
window.toggleBoardStar = function(btn, event) {
  if (event) {
    event.preventDefault();
    event.stopPropagation();
  }

  btn.classList.toggle('active');
  const icon = btn.querySelector('i');
  const boardTile = btn.closest('.trello-board-tile');
  const titleEl = boardTile ? boardTile.querySelector('.tile-title') : null;
  const boardTitle = titleEl ? titleEl.textContent.trim().toLowerCase() : (boardTile ? boardTile.getAttribute('data-board-title') : '');

  const isStarredNow = btn.classList.contains('active');

  if (icon) {
    if (isStarredNow) {
      icon.className = 'fa-solid fa-star text-warning';
      btn.setAttribute('title', 'Unstar Board');
    } else {
      icon.className = 'fa-regular fa-star';
      btn.setAttribute('title', 'Star Board');
    }
  }

  // Sync matching board tiles on the page
  if (boardTitle) {
    document.querySelectorAll(`.trello-board-tile[data-board-title="${boardTitle}"] .star-board-btn`).forEach(otherBtn => {
      if (otherBtn !== btn) {
        if (isStarredNow) {
          otherBtn.classList.add('active');
          const otherIcon = otherBtn.querySelector('i');
          if (otherIcon) otherIcon.className = 'fa-solid fa-star text-warning';
          otherBtn.setAttribute('title', 'Unstar Board');
        } else {
          otherBtn.classList.remove('active');
          const otherIcon = otherBtn.querySelector('i');
          if (otherIcon) otherIcon.className = 'fa-regular fa-star';
          otherBtn.setAttribute('title', 'Star Board');
        }
      }
    });
  }

  // Dynamic Starred Boards Container update
  const starredGrid = document.getElementById('starred-boards-grid');
  if (starredGrid && boardTile) {
    const existingStarredTile = starredGrid.querySelector(`.trello-board-tile[data-board-title="${boardTitle}"]`);

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
  }
};

window.adminDeleteBoard = function(btn) {
  const row = btn.closest('tr') || btn.closest('.trello-board-tile');
  const titleEl = row ? (row.querySelector('span[style*="font-weight: 700"]') || row.querySelector('.tile-title')) : null;
  const boardTitle = titleEl ? titleEl.textContent.trim() : 'this board';

  if (confirm(`Are you sure you want to archive workspace board "${boardTitle}"?`)) {
    if (row) {
      row.style.transition = 'all 0.3s ease';
      row.style.opacity = '0';
      setTimeout(() => row.remove(), 300);
    }
  }
};
