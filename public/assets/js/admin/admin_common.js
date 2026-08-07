/**
 * Admin Common Shared JavaScript
 * Global Modals, Dropdowns, Sidebar Accordion, Search Filters
 */

window.syncCustomSelect = function(select) {
  const wrap = select.closest('.custom-select');
  if (!wrap) return;

  const menu = wrap.querySelector('.custom-select-menu');
  const triggerLabel = wrap.querySelector('.custom-select-label');
  if (!menu || !triggerLabel) return;

  menu.innerHTML = '';
  Array.from(select.options).forEach((opt) => {
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'custom-select-option' + (opt.selected ? ' is-selected' : '');
    btn.textContent = opt.textContent;
    btn.dataset.value = opt.value;
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      select.value = opt.value;
      Array.from(select.options).forEach((o) => {
        o.selected = o === opt;
      });
      select.dispatchEvent(new Event('change', { bubbles: true }));
      triggerLabel.textContent = opt.textContent;
      menu.querySelectorAll('.custom-select-option').forEach((o) => o.classList.remove('is-selected'));
      btn.classList.add('is-selected');
      wrap.classList.remove('is-open');
    });
    menu.appendChild(btn);
  });

  const selected = select.options[select.selectedIndex];
  triggerLabel.textContent = selected ? selected.textContent : 'Select...';
};

window.upgradeModalSelects = function(root) {
  const scope = root || document;
  scope.querySelectorAll('.modal-overlay select.form-control').forEach((select) => {
    if (select.dataset.customized === '1') {
      window.syncCustomSelect(select);
      return;
    }

    const wrap = document.createElement('div');
    wrap.className = 'custom-select';
    select.parentNode.insertBefore(wrap, select);
    wrap.appendChild(select);
    select.classList.add('custom-select-native');
    select.dataset.customized = '1';

    const trigger = document.createElement('button');
    trigger.type = 'button';
    trigger.className = 'custom-select-trigger';
    trigger.innerHTML = '<span class="custom-select-label"></span><i class="fa-solid fa-chevron-down custom-select-caret"></i>';

    const menu = document.createElement('div');
    menu.className = 'custom-select-menu';

    wrap.appendChild(trigger);
    wrap.appendChild(menu);

    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      document.querySelectorAll('.custom-select.is-open').forEach((w) => {
        if (w !== wrap) {
          w.classList.remove('is-open');
          w.classList.remove('is-open-up');
        }
      });
      const willOpen = !wrap.classList.contains('is-open');
      wrap.classList.toggle('is-open', willOpen);
      if (willOpen) {
        const rect = wrap.getBoundingClientRect();
        const spaceBelow = window.innerHeight - rect.bottom;
        wrap.classList.toggle('is-open-up', spaceBelow < 200);
      } else {
        wrap.classList.remove('is-open-up');
      }
    });

    window.syncCustomSelect(select);
  });
};

window.populateAddCardListSelect = function(triggerEl) {
  const selectEl = document.getElementById('add-card-list-select');
  if (!selectEl) return;

  if (triggerEl) {
    window.activeTargetListForAddCard = triggerEl.closest('.kanban-list');
  }

  const allLists = document.querySelectorAll('.kanban-list');
  if (!allLists.length) return;

  selectEl.innerHTML = '';
  allLists.forEach((list) => {
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
};

window.activeEditBoardTile = null;
window.activeDeleteBoardTile = null;

window.openBoardTile = function(tile, event) {
  if (!tile) return;
  if (event && event.target && event.target.closest('.tile-top-actions, .board-tile-menu, .star-board-btn, .board-tile-menu-btn, .board-tile-dropdown, button')) {
    return;
  }
  const href = tile.getAttribute('data-board-href');
  if (href) window.location.href = href;
};

window.toggleBoardStarFromMenu = function(el, event) {
  if (event) {
    event.preventDefault();
    event.stopPropagation();
  }
  const tile = el.closest('.trello-board-tile');
  if (!tile || typeof window.toggleBoardStar !== 'function') return;

  let starBtn = tile.querySelector('.star-board-btn');
  if (!starBtn) {
    starBtn = document.createElement('span');
    starBtn.className = 'star-board-btn';
    starBtn.style.display = 'none';
    if (tile.classList.contains('is-starred') || tile.querySelector('.tile-star-badge')) {
      starBtn.classList.add('active');
    }
    tile.appendChild(starBtn);
  }

  window.toggleBoardStar(starBtn, event);
  window.syncBoardTileStarUI(tile, starBtn.classList.contains('active'));

  document.querySelectorAll('.board-tile-dropdown.show, .dropdown-menu.show').forEach((m) => m.classList.remove('show'));
  document.querySelectorAll('.trello-board-tile.menu-open').forEach((t) => t.classList.remove('menu-open'));
};

window.syncBoardTileStarUI = function(tile, isStarred) {
  if (!tile) return;

  const key = tile.getAttribute('data-board-title') || '';
  const tiles = key
    ? document.querySelectorAll('.trello-board-tile[data-board-title="' + key + '"]')
    : [tile];

  tiles.forEach((t) => {
    t.classList.toggle('is-starred', !!isStarred);
    t.querySelectorAll('.tile-star-badge').forEach((el) => el.remove());

    const item = t.querySelector('.board-tile-star-item');
    if (item) {
      item.innerHTML = isStarred
        ? '<i class="fa-solid fa-star text-warning"></i><span>Unstar Board</span>'
        : '<i class="fa-regular fa-star"></i><span>Star Board</span>';
    }
  });
};

window.toggleBoardTileMenu = function(btn, event) {
  if (event) {
    event.preventDefault();
    event.stopPropagation();
  }
  const wrap = btn.closest('.board-tile-menu') || btn.closest('.dropdown-wrapper');
  const menu = wrap ? wrap.querySelector('.dropdown-menu') : null;
  if (!menu) return;

  document.querySelectorAll('.board-tile-dropdown.show, .dropdown-menu.show').forEach((m) => {
    if (m !== menu) m.classList.remove('show');
  });
  document.querySelectorAll('.trello-board-tile.menu-open').forEach((t) => {
    if (!wrap || !t.contains(wrap)) t.classList.remove('menu-open');
  });

  menu.classList.toggle('show');
  const tile = btn.closest('.trello-board-tile');
  if (tile) tile.classList.toggle('menu-open', menu.classList.contains('show'));
};

window.openBoardEditFromTile = function(el, event) {
  if (event) {
    event.preventDefault();
    event.stopPropagation();
  }
  const tile = el.closest('.trello-board-tile');
  window.activeEditBoardTile = tile || null;
  document.querySelectorAll('.board-tile-dropdown.show, .dropdown-menu.show').forEach((m) => m.classList.remove('show'));
  document.querySelectorAll('.trello-board-tile.menu-open').forEach((t) => t.classList.remove('menu-open'));
  if (typeof window.openModal === 'function') {
    window.openModal('edit-board-modal', tile || el);
  }
};

window.openBoardDeleteFromTile = function(el, event) {
  if (event) {
    event.preventDefault();
    event.stopPropagation();
  }
  const tile = el.closest('.trello-board-tile');
  window.activeDeleteBoardTile = tile || null;
  const name = tile
    ? (tile.getAttribute('data-board-name') || (tile.querySelector('.tile-title') ? tile.querySelector('.tile-title').textContent.trim() : 'Board'))
    : 'Board';
  const nameEl = document.getElementById('delete-board-name-display');
  if (nameEl) nameEl.textContent = '"' + name + '"';
  document.querySelectorAll('.board-tile-dropdown.show, .dropdown-menu.show').forEach((m) => m.classList.remove('show'));
  document.querySelectorAll('.trello-board-tile.menu-open').forEach((t) => t.classList.remove('menu-open'));
  if (typeof window.openModal === 'function') {
    window.openModal('delete-board-modal', tile || el);
  }
};

window.confirmDeleteBoard = function() {
  const tile = window.activeDeleteBoardTile;
  if (tile) {
    const boardTitle = (tile.getAttribute('data-board-title') || '').trim();
    tile.remove();
    if (boardTitle) {
      document.querySelectorAll('.trello-board-tile[data-board-title="' + boardTitle + '"]').forEach((t) => t.remove());
    }
  }
  window.activeDeleteBoardTile = null;
  const modal = document.getElementById('delete-board-modal');
  if (modal && typeof window.closeModal === 'function') window.closeModal(modal);
};

window.populateEditBoardModal = function(triggerEl) {
  const nameInput = document.getElementById('edit-board-name');
  const descInput = document.getElementById('edit-board-description');
  if (!nameInput || !descInput) return;

  const tile = (triggerEl && triggerEl.closest)
    ? (triggerEl.closest('.trello-board-tile') || window.activeEditBoardTile)
    : window.activeEditBoardTile;
  const titleEl = document.getElementById('board-title-text') || document.querySelector('.board-title');

  const nameFromTile = tile ? (tile.getAttribute('data-board-name') || '').trim() : '';
  const descFromTile = tile ? (tile.getAttribute('data-board-description') || '') : null;
  const nameFromTrigger = triggerEl ? (triggerEl.getAttribute('data-board-name') || '').trim() : '';
  const descFromTrigger = triggerEl ? triggerEl.getAttribute('data-board-description') : null;

  const name = nameFromTile || nameFromTrigger || (titleEl ? titleEl.textContent.trim() : '') || nameInput.value;
  const description = descFromTile !== null
    ? descFromTile
    : (descFromTrigger !== null ? descFromTrigger : (descInput.value || ''));

  if (name) nameInput.value = name;
  descInput.value = description || '';
};

window.submitEditBoardForm = function(form) {
  const nameInput = document.getElementById('edit-board-name');
  const descInput = document.getElementById('edit-board-description');
  const name = nameInput ? nameInput.value.trim() : '';
  const description = descInput ? descInput.value.trim() : '';
  if (!name) return;

  const titleEl = document.getElementById('board-title-text') || document.querySelector('.board-title');
  if (titleEl) titleEl.textContent = name;

  document.querySelectorAll('.board-edit-btn').forEach((btn) => {
    btn.setAttribute('data-board-name', name);
    btn.setAttribute('data-board-description', description);
  });

  const tile = window.activeEditBoardTile;
  if (tile) {
    const oldKey = tile.getAttribute('data-board-title') || '';
    tile.setAttribute('data-board-name', name);
    tile.setAttribute('data-board-description', description);
    tile.setAttribute('data-board-title', name.toLowerCase());
    const tileTitle = tile.querySelector('.tile-title');
    if (tileTitle) tileTitle.textContent = name;
    if (oldKey) {
      document.querySelectorAll('.trello-board-tile[data-board-title="' + oldKey + '"]').forEach((t) => {
        if (t === tile) return;
        t.setAttribute('data-board-name', name);
        t.setAttribute('data-board-description', description);
        t.setAttribute('data-board-title', name.toLowerCase());
        const tTitle = t.querySelector('.tile-title');
        if (tTitle) tTitle.textContent = name;
      });
    }
  }

  window.activeEditBoardTile = null;
  const overlay = form.closest('.modal-overlay');
  if (overlay) window.closeModal(overlay);
};

window.stackModalOnTop = function(modal) {
  if (!modal) return;
  document.body.appendChild(modal);
  const openCount = document.querySelectorAll('.modal-overlay.show, .modal-overlay.active').length;
  modal.style.setProperty('z-index', String(1000000 + openCount + 50), 'important');
};

// Global Window Modal Helpers
window.openModal = function(modalId, btn) {
  const modal = document.getElementById(modalId);
  if (!modal) return;

  try {
    document.querySelectorAll('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
    document.querySelectorAll('.custom-select.is-open').forEach(w => w.classList.remove('is-open'));
  } catch (err) {}

  // CSS uses .modal-overlay.show for visibility (display/opacity/pointer-events)
  modal.classList.add('active');
  modal.classList.add('show');
  modal.style.display = 'flex';

  // Remount last on <body> + force z-index above any already-open modal (e.g. card detail)
  window.stackModalOnTop(modal);

  if (modalId === 'add-card-modal') {
    try {
      window.populateAddCardListSelect(btn);
    } catch (e) {
      console.error('List select population error:', e);
    }
  }

  if (modalId === 'edit-board-modal') {
    try {
      window.populateEditBoardModal(btn);
    } catch (e) {
      console.error('Edit board populate error:', e);
    }
  }

  window.upgradeModalSelects(modal);

  // Don't auto-focus checkboxes/radios (card detail was selecting title + focusing purple checks)
  try {
    if (window.getSelection) window.getSelection().removeAllRanges();
  } catch (err) {}

  if (modalId === 'card-detail-modal') {
    return;
  }

  const input = modal.querySelector(
    'input:not([type="hidden"]):not([type="checkbox"]):not([type="radio"]):not(.custom-select-native), textarea'
  );
  if (input) setTimeout(() => input.focus(), 100);
};

window.closeModal = function(modalId) {
  const modal = typeof modalId === 'string' ? document.getElementById(modalId) : modalId;
  if (modal) {
    modal.classList.remove('active');
    modal.classList.remove('show');
    modal.style.display = '';
    modal.querySelectorAll('.custom-select.is-open').forEach(w => w.classList.remove('is-open'));
  }
};

/** Apply CSS vars from data-* attrs so views stay free of inline style= */
window.applyDynamicThemeAttrs = function(root) {
  const scope = root && root.querySelectorAll ? root : document;

  scope.querySelectorAll('[data-cover]').forEach((el) => {
    const cover = el.getAttribute('data-cover');
    if (cover) el.style.setProperty('--tile-cover', 'url("' + cover.replace(/\\/g, '\\\\').replace(/"/g, '\\"') + '")');
  });

  scope.querySelectorAll('[data-bg]').forEach((el) => {
    const bg = el.getAttribute('data-bg');
    if (bg) el.style.setProperty('--dyn-bg', bg);
  });

  scope.querySelectorAll('[data-fg]').forEach((el) => {
    const fg = el.getAttribute('data-fg');
    if (fg) el.style.setProperty('--dyn-fg', fg);
  });

  scope.querySelectorAll('[data-progress]').forEach((el) => {
    const n = parseInt(el.getAttribute('data-progress'), 10);
    el.style.setProperty('--dyn-progress', (Number.isFinite(n) ? n : 0) + '%');
  });
};

window.handleGlobalHeaderSearch = function(inputEl) {
  const query = (inputEl.value || '').toLowerCase().trim();
  const dropdown = document.getElementById('global-search-dropdown');
  if (!dropdown) return;

  if (!query) {
    dropdown.classList.add('display-none');
    dropdown.classList.remove('is-open');
    dropdown.innerHTML = '';
    return;
  }

  const mockUsers = [
    { title: 'Chris Parker', meta: 'chris@richmondtech.com' },
    { title: 'Sarah Connor', meta: 'sarah@richmondtech.com' },
    { title: 'Alex Turner', meta: 'alex@richmondtech.com' }
  ].filter((u) => u.title.toLowerCase().includes(query) || u.meta.toLowerCase().includes(query));

  const mockBoards = [
    { title: 'Sprint 24 Architecture', url: 'board-detail' },
    { title: 'Bug Triage & Hotfixes', url: 'board-detail' },
    { title: 'API v3 Migration', url: 'board-detail' },
    { title: 'Design System 2.0', url: 'board-detail' }
  ].filter((b) => b.title.toLowerCase().includes(query));

  const mockWorkspaces = [
    { title: 'Engineering Team', meta: '8 boards' },
    { title: 'Product Design', meta: '4 boards' }
  ].filter((w) => w.title.toLowerCase().includes(query));

  let html = '';

  if (mockUsers.length > 0) {
    html += '<div class="search-section-header"><i class="fa-solid fa-users"></i> Users (' + mockUsers.length + ')</div>';
    mockUsers.forEach((u) => {
      html += '<a href="users" class="search-result-item"><i class="fa-solid fa-user text-primary"></i> <div><strong>' + u.title + '</strong> <span class="text-muted font-size-11">' + u.meta + '</span></div></a>';
    });
  }

  if (mockBoards.length > 0) {
    html += '<div class="search-section-header"><i class="fa-solid fa-table-columns"></i> Boards (' + mockBoards.length + ')</div>';
    mockBoards.forEach((b) => {
      html += '<a href="' + b.url + '" class="search-result-item"><i class="fa-solid fa-square text-primary"></i> <span>' + b.title + '</span></a>';
    });
  }

  if (mockWorkspaces.length > 0) {
    html += '<div class="search-section-header"><i class="fa-solid fa-briefcase"></i> Workspaces (' + mockWorkspaces.length + ')</div>';
    mockWorkspaces.forEach((w) => {
      html += '<a href="workspaces" class="search-result-item"><i class="fa-solid fa-briefcase text-warning"></i> <div><strong>' + w.title + '</strong> <span class="text-muted font-size-11">' + w.meta + '</span></div></a>';
    });
  }

  if (!html) {
    html = '<div class="p-12 text-center text-muted font-size-13">No matching users, boards, or workspaces for "' + query.replace(/"/g, '&quot;') + '"</div>';
  }

  dropdown.innerHTML = html;
  dropdown.classList.remove('display-none');
  dropdown.classList.add('is-open');
};

document.addEventListener('DOMContentLoaded', () => {
  window.applyDynamicThemeAttrs(document);
  window.upgradeModalSelects(document);

  const globalSearchInput = document.querySelector('[data-global-search]');
  if (globalSearchInput) {
    globalSearchInput.addEventListener('input', () => window.handleGlobalHeaderSearch(globalSearchInput));
  }

  // Event Delegated Click Handlers
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.search-input-group')) {
      const dropdown = document.getElementById('global-search-dropdown');
      if (dropdown) {
        dropdown.classList.add('display-none');
        dropdown.classList.remove('is-open');
      }
    }

    // Close custom selects when clicking outside
    if (!e.target.closest('.custom-select')) {
      document.querySelectorAll('.custom-select.is-open').forEach(w => {
        w.classList.remove('is-open');
        w.classList.remove('is-open-up');
      });
    }

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
      if (overlay) window.closeModal(overlay);
      return;
    }

    // Backdrop Overlay Click Close
    if (e.target.classList.contains('modal-overlay')) {
      window.closeModal(e.target);
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
    if (!e.target.closest('.dropdown-menu') && !e.target.closest('.board-tile-menu-btn')) {
      document.querySelectorAll('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
      document.querySelectorAll('.trello-board-tile.menu-open').forEach(t => t.classList.remove('menu-open'));
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

window.submitCreateWorkspace = function() {
  const form = document.getElementById('create-workspace-form');
  const nameInput = form ? form.querySelector('input[type="text"]') : null;
  const name = nameInput ? nameInput.value.trim() : '';

  if (!name) {
    if (nameInput) nameInput.focus();
    return;
  }

  window.closeModal('create-workspace-modal');
  if (form) form.reset();
};

window.addNestedSubtask = function(btn) {
  const parentWrapper = btn.closest('.checklist-parent-wrapper');
  if (!parentWrapper) return;

  const title = 'New sub-task';
  parentWrapper.insertAdjacentHTML('beforeend', `
    <div class="checklist-subitem-row">
      <span class="checklist-item-main">
        <input type="checkbox" class="checklist-checkbox" onchange="recalculateChecklistProgress();">
        <span class="checklist-subitem-text">${window.escapeHtml(title)}</span>
      </span>
    </div>
  `);
  window.recalculateChecklistProgress();
};

window.recalculateChecklistProgress = function() {
  const checkboxes = document.querySelectorAll('#card-detail-modal .checklist-checkbox');
  if (checkboxes.length === 0) return;

  let checkedCount = 0;
  checkboxes.forEach(cb => {
    const textSpan = cb.nextElementSibling;
    if (cb.checked) {
      checkedCount++;
      if (textSpan) {
        textSpan.classList.add('checklist-text-completed');
        textSpan.style.textDecoration = '';
        textSpan.style.color = '';
      }
    } else if (textSpan) {
      textSpan.classList.remove('checklist-text-completed');
      textSpan.style.textDecoration = '';
      textSpan.style.color = '';
    }
  });

  const percentage = Math.round((checkedCount / checkboxes.length) * 100);
  const progressBar = document.getElementById('checklist-progress-bar');
  const progressText = document.getElementById('checklist-progress-text');
  if (progressBar) progressBar.style.width = percentage + '%';
  if (progressText) progressText.textContent = percentage + '%';
};

window.updateAttachmentCount = function() {
  /* count badge removed in picker layout; keep for compatibility */
};

window.removeCardAttachment = function(btn) {
  const item = btn.closest('.attach-grid-card, .attach-item');
  if (item) item.remove();

  const list = document.getElementById('card-attachments-list');
  if (list && list.querySelectorAll('.attach-grid-card').length === 0) {
    list.innerHTML = '<div class="attach-empty">No attachments yet. Use Upload to add files or links.</div>';
  }
};

window.switchAttachTab = function(btn, tab) {
  document.querySelectorAll('#card-attachment-modal .attach-side-item').forEach(el => {
    el.classList.toggle('is-active', el === btn);
  });

  const toolbar = document.getElementById('attach-picker-toolbar');
  const grid = document.getElementById('card-attachments-list');
  const upload = document.getElementById('attach-upload-panel');
  const showUpload = tab === 'upload';

  if (toolbar) {
    toolbar.hidden = showUpload;
    toolbar.style.display = showUpload ? 'none' : '';
  }
  if (grid) {
    grid.hidden = showUpload;
    grid.style.display = showUpload ? 'none' : '';
  }
  if (upload) {
    upload.hidden = !showUpload;
    upload.style.display = showUpload ? 'flex' : 'none';
  }

  if (!showUpload && grid) {
    grid.style.display = 'grid';
    grid.querySelectorAll('.attach-grid-card').forEach(card => {
      const type = card.getAttribute('data-type') || '';
      card.style.display = (tab === 'all' || type === tab) ? '' : 'none';
    });
  }
};

window.onAttachFilePicked = function(input) {
  const nameEl = document.getElementById('attach-file-name');
  if (!nameEl) return;
  const file = input && input.files && input.files[0] ? input.files[0] : null;
  if (file) {
    nameEl.textContent = file.name;
    nameEl.classList.add('has-file');
  } else {
    nameEl.textContent = 'No file selected';
    nameEl.classList.remove('has-file');
  }
};

window.filterAttachKeyword = function() {};

window.filterAttachGrid = function(q) {
  const query = (q || '').toLowerCase().trim();
  const grid = document.getElementById('card-attachments-list');
  if (!grid) return;
  grid.querySelectorAll('.attach-grid-card').forEach(card => {
    const name = (card.getAttribute('data-name') || card.textContent || '').toLowerCase();
    card.style.display = !query || name.includes(query) ? '' : 'none';
  });
};

window.addCardAttachment = function() {
  const fileInput = document.getElementById('card-attachment-file');
  const list = document.getElementById('card-attachments-list');
  if (!list) return;

  const file = fileInput && fileInput.files && fileInput.files[0] ? fileInput.files[0] : null;
  if (!file) {
    const uploadBtn = document.querySelector('#card-attachment-modal .attach-side-item[data-attach-tab="upload"]');
    if (uploadBtn) window.switchAttachTab(uploadBtn, 'upload');
    if (fileInput) fileInput.click();
    return;
  }

  const empty = list.querySelector('.attach-empty');
  if (empty) empty.remove();

  const name = file.name;
  let type = 'files';
  let thumbHtml = `<div class="attach-grid-thumb attach-grid-thumb-file"><i class="fa-solid fa-file"></i></div>`;

  if (/\.(png|jpe?g|gif|webp|svg)$/i.test(name)) {
    type = 'images';
    thumbHtml = `<div class="attach-grid-thumb"><img src="${URL.createObjectURL(file)}" alt=""></div>`;
  } else if (/\.pdf$/i.test(name)) {
    thumbHtml = `<div class="attach-grid-thumb attach-grid-thumb-pdf"><i class="fa-solid fa-file-pdf"></i></div>`;
  }

  list.insertAdjacentHTML('afterbegin', `
    <button type="button" class="attach-grid-card is-selected" data-type="${type}" data-name="${window.escapeHtml(name)}" title="${window.escapeHtml(name)}">
      ${thumbHtml}
      <span class="attach-grid-remove" title="Remove" onclick="event.stopPropagation(); removeCardAttachment(this);"><i class="fa-solid fa-xmark"></i></span>
    </button>
  `);

  if (fileInput) fileInput.value = '';
  window.onAttachFilePicked(fileInput);
  const allBtn = document.querySelector('#card-attachment-modal .attach-side-item[data-attach-tab="all"]');
  if (allBtn) window.switchAttachTab(allBtn, 'all');
};
