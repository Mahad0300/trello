/**
 * Common / Global User Workspace JavaScript
 * Shared across all user pages (Modals, Dropdowns, Sidebar, Search)
 */

// Global References for Active Modals
window.activeEditTitleEl = null;
window.activeDeleteListEl = null;
window.activeTargetListForAddCard = null;

// Global Helper: Escape HTML
window.escapeHtml = function(str) {
  if (!str) return '';
  return String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
};

// Global Modal Control Functions
window.openModal = function(modalId, triggerEl) {
  const modal = document.getElementById(modalId);
  if (!modal) return;

  // Close open dropdown menus first
  try {
    document.querySelectorAll('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
  } catch (err) {}

  modal.classList.add('active');
  modal.classList.add('show');
  modal.style.display = 'flex';

  // Track target column for Add Card & populate select
  if (modalId === 'add-card-modal') {
    try {
      if (triggerEl) {
        window.activeTargetListForAddCard = triggerEl.closest('.kanban-list');
      }

      const selectEl = document.getElementById('add-card-list-select');
      if (selectEl) {
        selectEl.innerHTML = '';
        const allLists = document.querySelectorAll('.kanban-list');
        allLists.forEach(list => {
          const titleSpan = list.querySelector('.list-title-text span');
          const titleText = titleSpan ? titleSpan.textContent.trim() : 'Column';
          const option = document.createElement('option');
          option.value = titleText;
          option.textContent = titleText;
          if (window.activeTargetListForAddCard && list === window.activeTargetListForAddCard) {
            option.selected = true;
          }
          selectEl.appendChild(option);
        });
      }
    } catch (e) {
      console.error('List select population error:', e);
    }
  }
};

window.closeModal = function(modalId) {
  const modal = typeof modalId === 'string' ? document.getElementById(modalId) : modalId;
  if (modal) {
    modal.classList.remove('active');
    modal.classList.remove('show');
    modal.style.display = 'none';
  }
};

document.addEventListener('DOMContentLoaded', () => {
  console.log('User Workspace Common JS Loaded');

  // Sidebar Boards Accordion Toggle
  const sidebarDropdownBtn = document.querySelector('.sidebar-dropdown-btn');
  if (sidebarDropdownBtn) {
    sidebarDropdownBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const parent = sidebarDropdownBtn.closest('.sidebar-dropdown-wrapper');
      const submenu = parent ? parent.querySelector('.sidebar-submenu') : null;
      const arrow = sidebarDropdownBtn.querySelector('.dropdown-arrow');
      if (submenu) {
        if (submenu.style.display === 'none') {
          submenu.style.display = 'flex';
          if (arrow) arrow.style.transform = 'rotate(0deg)';
        } else {
          submenu.style.display = 'none';
          if (arrow) arrow.style.transform = 'rotate(-90deg)';
        }
      }
    });
  }

  // Live Board Search Filter
  const boardSearchInput = document.getElementById('board-search-input');
  if (boardSearchInput) {
    boardSearchInput.addEventListener('input', (e) => {
      const q = e.target.value.toLowerCase().trim();
      const allCards = document.querySelectorAll('.kanban-card');
      allCards.forEach(card => {
        const text = card.textContent.toLowerCase();
        if (text.includes(q)) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  }
});

// Universal Delegated Click Handler for Modals, Dropdowns, and Actions
document.addEventListener('click', (e) => {
  // 1. Trigger Modal Open via data-modal-target
  const triggerBtn = e.target.closest('[data-modal-target]');
  if (triggerBtn) {
    e.preventDefault();
    const targetModalId = triggerBtn.getAttribute('data-modal-target');
    window.openModal(targetModalId, triggerBtn);
    return;
  }

  // 2. Trigger Modal Close via data-modal-close
  const closeBtn = e.target.closest('[data-modal-close]');
  if (closeBtn) {
    e.preventDefault();
    const overlay = closeBtn.closest('.modal-overlay');
    if (overlay) window.closeModal(overlay);
    return;
  }

  // 3. Close modal on backdrop overlay click
  if (e.target.classList.contains('modal-overlay')) {
    window.closeModal(e.target);
    return;
  }

  // 4. Toggle 3-Dot Dropdown Menus
  const toggleBtn = e.target.closest('.dropdown-toggle');
  if (toggleBtn) {
    e.preventDefault();
    const parent = toggleBtn.closest('.dropdown-wrapper') || toggleBtn.parentElement;
    const menu = parent ? parent.querySelector('.dropdown-menu') : null;
    if (menu) {
      document.querySelectorAll('.dropdown-menu.show').forEach(m => {
        if (m !== menu) m.classList.remove('show');
      });
      menu.classList.toggle('show');
    }
    return;
  }

  // Close open dropdowns if clicking outside
  if (!e.target.closest('.dropdown-menu')) {
    document.querySelectorAll('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
  }
});
