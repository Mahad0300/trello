/**
 * Admin Panel JavaScript
 * ALL Admin UI Interactions in one file (Modals, Dropdowns, Tab Switching, Table Search)
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('Admin JS initialized');

  // Sidebar Toggle
  const sidebarToggle = document.getElementById('sidebar-toggle');
  const adminSidebar = document.querySelector('.admin-sidebar');
  if (sidebarToggle && adminSidebar) {
    sidebarToggle.addEventListener('click', () => {
      adminSidebar.classList.toggle('collapsed');
    });
  }

  // Generic Modal Trigger Setup
  const modalOpenBtns = document.querySelectorAll('[data-modal-target]');
  const modalCloseBtns = document.querySelectorAll('[data-modal-close]');
  const modalOverlays = document.querySelectorAll('.modal-overlay');

  modalOpenBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const targetId = btn.getAttribute('data-modal-target');
      const targetModal = document.getElementById(targetId);
      if (targetModal) {
        targetModal.classList.add('active');
      }
    });
  });

  modalCloseBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const modal = btn.closest('.modal-overlay');
      if (modal) {
        modal.classList.remove('active');
      }
    });
  });

  modalOverlays.forEach(overlay => {
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) {
        overlay.classList.remove('active');
      }
    });
  });

  // Admin Tab Switcher (e.g. Settings Tabs)
  const tabBtns = document.querySelectorAll('.tab-btn');
  const tabContents = document.querySelectorAll('.tab-content');

  tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const tabTarget = btn.getAttribute('data-tab');

      tabBtns.forEach(b => b.classList.remove('active'));
      tabContents.forEach(c => c.style.display = 'none');

      btn.classList.add('active');
      const activeContent = document.getElementById(tabTarget);
      if (activeContent) {
        activeContent.style.display = 'block';
      }
    });
  });

  // Table Search Filter
  const tableSearchInput = document.getElementById('table-search-input');
  if (tableSearchInput) {
    tableSearchInput.addEventListener('keyup', (e) => {
      const term = e.target.value.toLowerCase();
      const rows = document.querySelectorAll('table.data-table tbody tr');

      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(term) ? '' : 'none';
      });
    });
  }

  // Dropdown Menu Toggles
  const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
  dropdownToggles.forEach(toggle => {
    toggle.addEventListener('click', (e) => {
      e.stopPropagation();
      const menu = toggle.nextElementSibling;
      if (menu && menu.classList.contains('dropdown-menu')) {
        menu.classList.toggle('show');
      }
    });
  });

  document.addEventListener('click', () => {
    document.querySelectorAll('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
  });
});
