/**
 * Admin Common Shared JavaScript
 * Global Modals, Dropdowns, Sidebar Accordion, Search Filters
 */

// Global Window Modal Helpers
window.openModal = function(modalId, btn) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('active');
    const input = modal.querySelector('input:not([type="hidden"])');
    if (input) setTimeout(() => input.focus(), 100);
  }
};

window.closeModal = function(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove('active');
  }
};

document.addEventListener('DOMContentLoaded', () => {
  console.log('Admin Common JS Initialized');

  // Event Delegated Click Handlers
  document.addEventListener('click', (e) => {
    // 1. Sidebar Accordion Toggle
    const sidebarDropdownBtn = e.target.closest('.sidebar-dropdown-btn');
    if (sidebarDropdownBtn) {
      e.preventDefault();
      const parent = sidebarDropdownBtn.closest('.sidebar-dropdown-wrapper');
      const submenu = parent ? parent.querySelector('.sidebar-submenu') : null;
      const arrow = sidebarDropdownBtn.querySelector('.dropdown-arrow');
      if (submenu) {
        const isHidden = window.getComputedStyle(submenu).display === 'none';
        if (isHidden) {
          submenu.style.display = 'flex';
          if (arrow) arrow.style.transform = 'rotate(0deg)';
        } else {
          submenu.style.display = 'none';
          if (arrow) arrow.style.transform = 'rotate(-90deg)';
        }
      }
      return;
    }

    // 2. Open Modal Trigger
    const triggerBtn = e.target.closest('[data-modal-target]');
    if (triggerBtn) {
      e.preventDefault();
      const targetModalId = triggerBtn.getAttribute('data-modal-target');
      window.openModal(targetModalId, triggerBtn);
      return;
    }

    // Close Modal Trigger
    const closeBtn = e.target.closest('[data-modal-close]');
    if (closeBtn) {
      e.preventDefault();
      const overlay = closeBtn.closest('.modal-overlay');
      if (overlay) overlay.classList.remove('active');
      return;
    }

    // Backdrop Overlay Click Close
    if (e.target.classList.contains('modal-overlay')) {
      e.target.classList.remove('active');
      return;
    }

    // 3. Dropdown Menu Toggle
    const toggleBtn = e.target.closest('.dropdown-toggle');
    if (toggleBtn) {
      e.preventDefault();
      e.stopPropagation();
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

    // Close open dropdowns on outside click
    if (!e.target.closest('.dropdown-menu')) {
      document.querySelectorAll('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
    }
  });
});

// Helper Function: Escaping HTML Text
window.escapeHtml = function(text) {
  if (!text) return '';
  return text.toString()
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
};
