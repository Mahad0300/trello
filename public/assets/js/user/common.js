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

  // Reuse existing star toggle against a virtual/legacy btn on the tile
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
  // Nested modal must always beat #card-detail-modal (999999)
  modal.style.setProperty('z-index', String(1000000 + openCount + 50), 'important');
};

// Global Modal Control Functions
window.openModal = function(modalId, triggerEl) {
  const modal = document.getElementById(modalId);
  if (!modal) return;

  // Close open dropdown menus first
  try {
    document.querySelectorAll('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
    document.querySelectorAll('.custom-select.is-open').forEach(w => w.classList.remove('is-open'));
  } catch (err) {}

  modal.classList.add('active');
  modal.classList.add('show');
  modal.style.display = 'flex';

  // Remount last on <body> + force z-index above any already-open modal (e.g. card detail)
  window.stackModalOnTop(modal);

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

  if (modalId === 'edit-board-modal') {
    try {
      window.populateEditBoardModal(triggerEl);
    } catch (e) {
      console.error('Edit board populate error:', e);
    }
  }

  window.upgradeModalSelects(modal);

  try {
    if (window.getSelection) window.getSelection().removeAllRanges();
  } catch (err) {}
};

window.closeModal = function(modalId) {
  const modal = typeof modalId === 'string' ? document.getElementById(modalId) : modalId;
  if (modal) {
    modal.classList.remove('active');
    modal.classList.remove('show');
    modal.style.display = 'none';
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

  const mockBoards = [
    { title: 'Sprint 24 Architecture', url: 'board-detail' },
    { title: 'Bug Triage & Hotfixes', url: 'board-detail' },
    { title: 'API v3 Migration', url: 'board-detail' },
    { title: 'Design System 2.0', url: 'board-detail' }
  ].filter((b) => b.title.toLowerCase().includes(query));

  const mockCards = [
    { title: 'HTML5 Drag & Drop Physics', list: 'In Progress' },
    { title: 'MySQL PDO Prepared Statements', list: 'To-Do' },
    { title: 'Color Palette & Typography', list: 'Review' }
  ].filter((c) => c.title.toLowerCase().includes(query) || c.list.toLowerCase().includes(query));

  let html = '';

  if (mockBoards.length > 0) {
    html += '<div class="search-section-header"><i class="fa-solid fa-table-columns"></i> Boards (' + mockBoards.length + ')</div>';
    mockBoards.forEach((b) => {
      html += '<a href="' + b.url + '" class="search-result-item"><i class="fa-solid fa-square text-primary"></i> <span>' + b.title + '</span></a>';
    });
  }

  if (mockCards.length > 0) {
    html += '<div class="search-section-header"><i class="fa-solid fa-credit-card"></i> Cards (' + mockCards.length + ')</div>';
    mockCards.forEach((c) => {
      html += '<button type="button" class="search-result-item" data-search-open-card><i class="fa-solid fa-list-ul text-warning"></i> <div><strong>' + c.title + '</strong> <span class="text-muted font-size-11">in ' + c.list + '</span></div></button>';
    });
  }

  if (!html) {
    html = '<div class="p-12 text-center text-muted font-size-13">No matching boards or cards found for "' + query.replace(/"/g, '&quot;') + '"</div>';
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

  // Sidebar Boards Accordion Toggle
  const sidebarDropdownBtn = document.querySelector('.sidebar-dropdown-btn');
  if (sidebarDropdownBtn) {
    sidebarDropdownBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const parent = sidebarDropdownBtn.closest('.sidebar-dropdown-wrapper');
      const submenu = parent ? parent.querySelector('.sidebar-submenu') : null;
      const arrow = sidebarDropdownBtn.querySelector('.dropdown-arrow');
      if (submenu) {
        const collapsed = submenu.classList.toggle('is-collapsed');
        if (arrow) arrow.classList.toggle('is-collapsed', collapsed);
      }
    });
  }

  // Live Board Search Filter
  const boardSearchInput = document.getElementById('board-search-input');
  if (boardSearchInput) {
    boardSearchInput.addEventListener('input', (e) => {
      const q = e.target.value.toLowerCase().trim();
      document.querySelectorAll('.kanban-card').forEach((card) => {
        const text = card.textContent.toLowerCase();
        card.classList.toggle('is-search-hidden', !(!q || text.includes(q)));
      });
    });
  }
});

// Universal Delegated Click Handler for Modals, Dropdowns, and Actions
document.addEventListener('click', (e) => {
  if (!e.target.closest('.search-input-group')) {
    const dropdown = document.getElementById('global-search-dropdown');
    if (dropdown) {
      dropdown.classList.add('display-none');
      dropdown.classList.remove('is-open');
    }
  }

  const searchCard = e.target.closest('[data-search-open-card]');
  if (searchCard) {
    e.preventDefault();
    const dropdown = document.getElementById('global-search-dropdown');
    if (dropdown) {
      dropdown.classList.add('display-none');
      dropdown.classList.remove('is-open');
    }
    if (typeof window.openModal === 'function') window.openModal('card-detail-modal');
    return;
  }

  if (!e.target.closest('.custom-select')) {
    document.querySelectorAll('.custom-select.is-open').forEach(w => {
      w.classList.remove('is-open');
      w.classList.remove('is-open-up');
    });
  }

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
  if (!e.target.closest('.dropdown-menu') && !e.target.closest('.board-tile-menu-btn')) {
    document.querySelectorAll('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
    document.querySelectorAll('.trello-board-tile.menu-open').forEach(t => t.classList.remove('menu-open'));
  }
});

window.updateAttachmentCount = function() {};

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
    toolbar.classList.toggle('display-none', showUpload);
  }
  if (grid) {
    grid.hidden = showUpload;
    grid.classList.toggle('display-none', showUpload);
  }
  if (upload) {
    upload.hidden = !showUpload;
    upload.classList.toggle('display-none', !showUpload);
  }

  if (!showUpload && grid) {
    grid.querySelectorAll('.attach-grid-card').forEach((card) => {
      const type = card.getAttribute('data-type') || '';
      card.classList.toggle('is-search-hidden', !(tab === 'all' || type === tab));
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
  grid.querySelectorAll('.attach-grid-card').forEach((card) => {
    const name = (card.getAttribute('data-name') || card.textContent || '').toLowerCase();
    card.classList.toggle('is-search-hidden', !(!query || name.includes(query)));
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
