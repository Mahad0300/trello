/**
 * User All Boards Hub JavaScript
 * Board Filter Search, Workspace Accordion, Interactive Star Toggle
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('User All Boards JS Loaded');

  // Search Filter Handler
  const searchInput = document.getElementById('all-boards-search-input') || document.getElementById('board-search-input');
  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      const term = e.target.value.toLowerCase().trim();
      const boardLinks = document.querySelectorAll('.trello-board-tile.board-card-link');

      boardLinks.forEach(link => {
        const title = link.getAttribute('data-board-title') || link.textContent.toLowerCase();
        if (!term || title.includes(term)) {
          link.style.display = 'flex';
        } else {
          link.style.display = 'none';
        }
      });
    });
  }

  // Workspace Section Collapse Handler
  const workspaceHeaders = document.querySelectorAll('.workspace-section-header');
  workspaceHeaders.forEach(header => {
    header.addEventListener('click', (e) => {
      if (e.target.closest('button') || e.target.closest('a')) return;

      const section = header.closest('.workspace-section');
      const grid = section ? section.querySelector('.boards-grid') : null;
      const icon = header.querySelector('.collapse-icon');

      if (grid) {
        if (grid.style.display === 'none') {
          grid.style.display = 'grid';
          if (icon) icon.style.transform = 'rotate(0deg)';
        } else {
          grid.style.display = 'none';
          if (icon) icon.style.transform = 'rotate(-90deg)';
        }
      }
    });
  });
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
