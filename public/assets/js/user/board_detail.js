/**
 * User Board Detail Page JavaScript
 * Drag & Drop, Kanban List Controls, View Switcher, Calendar, Card Modal
 */

document.addEventListener('DOMContentLoaded', () => {
  // =========================================================
  // 1. HTML5 Drag & Drop Implementation for Trello Cards
  // =========================================================
  let draggedCard = null;

  function initDragAndDrop() {
    const cards = document.querySelectorAll('.kanban-card');
    const listContainers = document.querySelectorAll('.list-cards');

    cards.forEach(card => {
      card.setAttribute('draggable', 'true');

      card.addEventListener('dragstart', (e) => {
        draggedCard = card;
        card.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', card.getAttribute('data-card-id') || '');
      });

      card.addEventListener('dragend', () => {
        card.classList.remove('dragging');
        draggedCard = null;
        listContainers.forEach(container => container.classList.remove('drag-over'));
      });
    });

    listContainers.forEach(container => {
      container.addEventListener('dragover', (e) => {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        container.classList.add('drag-over');

        const afterElement = getDragAfterElement(container, e.clientY);
        if (draggedCard) {
          if (afterElement == null) {
            container.appendChild(draggedCard);
          } else {
            container.insertBefore(draggedCard, afterElement);
          }
        }
      });

      container.addEventListener('dragleave', () => {
        container.classList.remove('drag-over');
      });

      container.addEventListener('drop', (e) => {
        e.preventDefault();
        container.classList.remove('drag-over');
        updateListCardCounts();
      });
    });
  }

  function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('.kanban-card:not(.dragging)')];

    return draggableElements.reduce((closest, child) => {
      const box = child.getBoundingClientRect();
      const offset = y - box.top - box.height / 2;
      if (offset < 0 && offset > closest.offset) {
        return { offset: offset, element: child };
      } else {
        return closest;
      }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
  }

  function updateListCardCounts() {
    document.querySelectorAll('.kanban-list').forEach(list => {
      const countBadge = list.querySelector('.list-card-count-badge') || list.querySelector('.card-count');
      const cardsInList = list.querySelectorAll('.kanban-card').length;
      if (countBadge) {
        countBadge.textContent = cardsInList;
      }
    });
  }

  initDragAndDrop();

  // Card Checklist Progress Bar Listener
  const checklistItems = document.querySelectorAll('.checklist-checkbox');
  checklistItems.forEach(item => {
    item.addEventListener('change', () => {
      const total = document.querySelectorAll('.checklist-checkbox').length;
      const checked = document.querySelectorAll('.checklist-checkbox:checked').length;
      const percent = total > 0 ? Math.round((checked / total) * 100) : 0;

      const progressBar = document.getElementById('checklist-progress-bar');
      const progressText = document.getElementById('checklist-progress-text');

      if (progressBar) {
        progressBar.style.width = percent + '%';
        progressBar.setAttribute('data-progress', String(percent));
      }
      if (progressText) progressText.textContent = percent + '%';

      const label = item.nextElementSibling;
      if (label) {
        label.classList.toggle('checklist-text-completed', item.checked);
      }
    });
  });

  // Comment Submit Button Handler
  const commentSubmitBtn = document.getElementById('add-comment-btn');
  const commentInput = document.getElementById('comment-input');
  const commentsFeed = document.getElementById('comments-feed');

  if (commentSubmitBtn && commentInput && commentsFeed) {
    commentSubmitBtn.addEventListener('click', () => {
      const text = commentInput.value.trim();
      if (text === '') return;

      const newComment = document.createElement('div');
      newComment.className = 'comment-feed-item';
      newComment.innerHTML = `
        <img src="${(window.BASE_URL || '')}/assets/images/avatars/default-image.jpg" class="avatar" alt="User">
        <div class="comment-bubble-box">
          <div class="comment-header-row">
            <span>Chris Parker</span>
            <span class="comment-time-text">Just now</span>
          </div>
          <p class="m-0 font-size-13">${window.escapeHtml ? window.escapeHtml(text) : text}</p>
        </div>
      `;

      commentsFeed.prepend(newComment);
      commentInput.value = '';
    });
  }

  // =========================================================
  // 2. View Switcher Tabs (Board View vs Calendar View)
  // =========================================================
  document.addEventListener('click', (e) => {
    const viewTabBtn = e.target.closest('[data-view-target]');
    if (viewTabBtn) {
      e.preventDefault();
      const targetId = viewTabBtn.getAttribute('data-view-target');
      if (!targetId) return;

      document.querySelectorAll('[data-view-target]').forEach(btn => {
        btn.classList.remove('active-view-tab', 'btn-view-tab-active');
        btn.classList.add('btn-view-tab');
      });

      viewTabBtn.classList.add('active-view-tab', 'btn-view-tab-active');
      viewTabBtn.classList.remove('btn-view-tab');

      document.querySelectorAll('.view-container').forEach(container => {
        container.classList.add('display-none');
        container.classList.remove('view-container-flex', 'view-container-block');
      });

      const targetContainer = document.getElementById(targetId);
      if (targetContainer) {
        targetContainer.classList.remove('display-none');
        targetContainer.classList.add(targetId === 'board-view-container' ? 'view-container-flex' : 'view-container-block');
      }
    }
  });

  // =========================================================
  // 3. Calendar Grid Generation & Month Navigation
  // =========================================================
  const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  let currentMonthIdx = 6; // July
  let currentYear = 2026;

  const calMonthText = document.getElementById('cal-month-text');
  const calPrevBtn = document.getElementById('cal-prev-btn');
  const calNextBtn = document.getElementById('cal-next-btn');
  const calTodayBtn = document.getElementById('cal-today-btn');

  const sampleTasksByMonth = {
    6: {
      21: [
        { text: 'Implement Core Feature', cls: 'cal-pill-purple cal-span-bar' },
        { text: 'Refactor Component Logic', cls: 'cal-pill-peach cal-span-bar' }
      ],
      22: [
        { text: 'Implement Core Feature', cls: 'cal-pill-purple cal-span-bar-continue', style: 'opacity: 0.85;' },
        { text: 'Refactor Component Logic', cls: 'cal-pill-peach cal-span-bar-continue', style: 'opacity: 0.85;' }
      ],
      23: [
        { text: 'TM-02 Build Auth Service', cls: 'cal-pill-purple', icon: 'fa-layer-group' },
        { text: 'TM-04 Improve App Perform...', cls: 'cal-pill-mint', icon: 'fa-asterisk' }
      ],
      24: [
        { text: 'TM-03 Update Database', cls: 'cal-pill-blue', icon: 'fa-rotate' }
      ],
      28: [
        { text: 'TM-08 Adjust Responsive Layout', cls: 'cal-pill-mint cal-span-bar', icon: 'fa-asterisk' }
      ],
      29: [
        { text: 'TM-08 Adjust Responsive Layout', cls: 'cal-pill-mint cal-span-bar-continue' }
      ],
      30: [
        { text: 'TM-06 Update API Integration', cls: 'cal-pill-blue', icon: 'fa-rotate' }
      ],
      4: [
        { text: 'TM-09 Enhance Error Handling', cls: 'cal-pill-lavender', icon: 'fa-link' },
        { text: 'TM-10 Review Code Quality', cls: 'cal-pill-peach', icon: 'fa-bolt' }
      ],
      5: [
        { text: 'TM-10 Deploy Staging Build', cls: 'cal-pill-rose', icon: 'fa-bookmark' }
      ],
      11: [
        { text: 'TM-12 Setup CI/CD Runner', cls: 'cal-pill-mint', icon: 'fa-asterisk' },
        { text: 'Update State Management', cls: 'cal-pill-blue cal-span-bar' }
      ],
      12: [
        { text: 'Update State Management', cls: 'cal-pill-blue cal-span-bar-continue' }
      ],
      13: [
        { text: 'TM-13 Container Optimization', cls: 'cal-pill-purple', icon: 'fa-layer-group' },
        { text: 'TM-15 Fix Navigation Issues', cls: 'cal-pill-lavender', icon: 'fa-link' }
      ],
      18: [
        { text: 'Valid Input Validation', cls: 'cal-pill-peach cal-span-bar' }
      ],
      19: [
        { text: 'Valid Input Validation', cls: 'cal-pill-peach cal-span-bar-end' },
        { text: 'TM-17 Microservices Mesh', cls: 'cal-pill-lavender', icon: 'fa-link' }
      ],
      20: [
        { text: 'TM-18 Load Balancer Sync', cls: 'cal-pill-peach', icon: 'fa-sliders' }
      ]
    },
    default: {
      3: [{ text: 'Sprint Kickoff & Planning', cls: 'cal-pill-purple', icon: 'fa-layer-group' }],
      5: [{ text: 'API Endpoint Refactoring', cls: 'cal-pill-blue', icon: 'fa-rotate' }],
      8: [{ text: 'Database Schema Migration', cls: 'cal-pill-mint', icon: 'fa-asterisk' }],
      18: [{ text: 'Unit Test Suite Run', cls: 'cal-pill-lavender', icon: 'fa-link' }],
      25: [{ text: 'Production Release Build', cls: 'cal-pill-purple', icon: 'fa-circle-check' }]
    }
  };

  let currentCalMode = 'month';

  const calModeBtns = document.querySelectorAll('.cal-mode-btn');
  calModeBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      calModeBtns.forEach(b => {
        b.classList.remove('active-cal-mode');
        b.classList.add('cal-mode-btn-inactive');
      });
      btn.classList.add('active-cal-mode');
      btn.classList.remove('cal-mode-btn-inactive');
      currentCalMode = btn.getAttribute('data-cal-mode') || 'month';
      updateCalendarHeader();
    });
  });

  function renderCalendarGrid(year, monthIdx) {
    const calGrid = document.querySelector('.cal-month-grid');
    const calHeaderRow = document.querySelector('.cal-header-row');
    if (!calGrid) return;

    calGrid.innerHTML = '';

    const firstDay = new Date(year, monthIdx, 1).getDay();
    const totalDaysInMonth = new Date(year, monthIdx + 1, 0).getDate();
    const prevMonthDays = new Date(year, monthIdx, 0).getDate();
    const tasksMap = sampleTasksByMonth[monthIdx] || sampleTasksByMonth.default;

    if (currentCalMode === 'day') {
      if (calHeaderRow) calHeaderRow.classList.add('is-mode-hidden');
      calGrid.classList.add('is-day-mode');
      calGrid.classList.remove('is-month-mode');
      
      const cellEl = document.createElement('div');
      cellEl.className = 'cal-day-cell cal-day-cell-active-day is-day-focus';

      let innerHtml = `<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
        <h4 style="margin:0; font-size:16px; font-weight:800; color:#0F172A;"><i class="fa-regular fa-calendar-day text-primary mr-6"></i> ${months[monthIdx]} 21, ${year} - Daily Agenda</h4>
        <span class="badge badge-info" style="font-weight:700;">2 Active Tasks</span>
      </div>`;

      const todayTasks = tasksMap[21] || [
        { text: 'Sprint Kickoff & Core Architecture Review', cls: 'cal-pill-purple', icon: 'fa-layer-group' },
        { text: 'API Endpoint Refactoring & Integration Tests', cls: 'cal-pill-blue', icon: 'fa-rotate' }
      ];

      todayTasks.forEach(t => {
        const iconHtml = t.icon ? `<span class="cal-icon-circle"><i class="fa-solid ${t.icon}"></i></span> ` : '';
        innerHtml += `<div class="cal-event-pill ${t.cls}" style="padding: 12px 16px; font-size: 13.5px; margin-bottom: 10px; border-radius: 10px;" data-modal-target="card-detail-modal">${iconHtml}<strong>${t.text}</strong></div>`;
      });

      cellEl.innerHTML = innerHtml;
      calGrid.appendChild(cellEl);
      return;
    }

    if (calHeaderRow) calHeaderRow.classList.remove('is-mode-hidden');
    calGrid.classList.remove('is-day-mode');
    calGrid.classList.add('is-month-mode');

    let cellCount = currentCalMode === 'week' ? 7 : 35;
    let dayCount = currentCalMode === 'week' ? 20 : 1;
    let nextMonthDay = 1;

    for (let i = 0; i < cellCount; i++) {
      const col = i % 7;
      const isWeekend = (col === 0 || col === 6);
      const cellEl = document.createElement('div');

      cellEl.className = 'cal-day-cell' + (isWeekend ? ' cal-day-cell-weekend' : '');

      let dayNumber = 0;
      let isCurrentMonth = false;

      if (currentCalMode === 'week') {
        dayNumber = 20 + i;
        isCurrentMonth = true;
      } else {
        if (i < firstDay) {
          dayNumber = prevMonthDays - firstDay + 1 + i;
          cellEl.classList.add('is-outside-month');
        } else if (dayCount <= totalDaysInMonth) {
          dayNumber = dayCount;
          isCurrentMonth = true;
          dayCount++;
        } else {
          dayNumber = nextMonthDay;
          nextMonthDay++;
          cellEl.classList.add('is-outside-month');
        }
      }

      let innerHtml = `<div class="cal-day-num">${dayNumber}</div>`;

      if (isCurrentMonth && (!isWeekend || currentCalMode === 'week') && tasksMap[dayNumber]) {
        tasksMap[dayNumber].forEach(t => {
          const iconHtml = t.icon ? `<span class="cal-icon-circle"><i class="fa-solid ${t.icon}"></i></span> ` : '';
          const styleAttr = t.style ? ` style="${t.style}"` : '';
          innerHtml += `<div class="cal-event-pill ${t.cls}"${styleAttr} data-modal-target="card-detail-modal">${iconHtml}${t.text}</div>`;
        });
      }

      cellEl.innerHTML = innerHtml;
      calGrid.appendChild(cellEl);
    }
  }

  function updateCalendarHeader() {
    if (calMonthText) {
      calMonthText.textContent = `${months[currentMonthIdx]} ${currentYear}`;
    }
    renderCalendarGrid(currentYear, currentMonthIdx);
  }

  if (calPrevBtn) {
    calPrevBtn.addEventListener('click', () => {
      currentMonthIdx--;
      if (currentMonthIdx < 0) { currentMonthIdx = 11; currentYear--; }
      updateCalendarHeader();
    });
  }

  if (calNextBtn) {
    calNextBtn.addEventListener('click', () => {
      currentMonthIdx++;
      if (currentMonthIdx > 11) { currentMonthIdx = 0; currentYear++; }
      updateCalendarHeader();
    });
  }

  if (calTodayBtn) {
    calTodayBtn.addEventListener('click', () => {
      currentMonthIdx = 6;
      currentYear = 2026;
      updateCalendarHeader();
    });
  }

  // Add Card & Add List Form Listeners
  const addCardForm = document.getElementById('add-card-form');
  if (addCardForm) {
    addCardForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const titleInput = document.getElementById('add-card-title-input');
      const descInput = document.getElementById('add-card-desc-input');
      const title = titleInput ? titleInput.value.trim() : '';
      if (!title) return;

      const targetCardsStack = document.querySelector('.list-cards');
      if (targetCardsStack) {
        const cardId = 'card-' + Date.now();
        const newCardHtml = `
          <div class="kanban-card" data-card-id="${cardId}" data-cover="${(window.BASE_URL || '')}/assets/images/card_cover_design.png" data-modal-target="card-detail-modal">
            <div class="card-title-text">${window.escapeHtml ? window.escapeHtml(title) : title}</div>
          </div>
        `;
        targetCardsStack.insertAdjacentHTML('beforeend', newCardHtml);
        updateListCardCounts();
        initDragAndDrop();
      }

      if (titleInput) titleInput.value = '';
      if (descInput) descInput.value = '';
      window.closeModal('add-card-modal');
    });
  }

  // Add List Form Submit Handler
  const addListForm = document.getElementById('add-list-form');
  if (addListForm) {
    addListForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const input = document.getElementById('new-list-title-input');
      const title = input ? input.value.trim() : '';
      if (!title) return;

      const kanbanCanvas = document.querySelector('.kanban-canvas') || document.querySelector('.board-canvas');
      const addListBox = document.querySelector('.add-list-box');

      if (addListBox) {
        const listId = 'list-' + Date.now();
        const colors = ['#8B5CF6', '#EC4899', '#06B6D4', '#F59E0B', '#10B981', '#6366F1'];
        const randomColor = colors[Math.floor(Math.random() * colors.length)];

        const newListHtml = `
          <div class="kanban-list" data-list-id="${listId}">
            <div class="list-header-bar">
              <div class="list-title-text">
                <div class="list-status-pill-line" style="background: ${randomColor};"></div>
                <span>${window.escapeHtml ? window.escapeHtml(title) : title}</span>
                <span class="list-card-count-badge">0</span>
              </div>
              <div class="list-header-actions">
                <button class="list-action-icon-btn" title="Add Card" data-modal-target="add-card-modal" onclick="openModal('add-card-modal', this);">
                  <i class="fa-solid fa-plus"></i>
                </button>
                <div class="dropdown-wrapper">
                  <button class="list-action-icon-btn dropdown-toggle" title="List Options">
                    <i class="fa-solid fa-ellipsis"></i>
                  </button>
                  <div class="dropdown-menu list-options-menu list-options-menu-pos">
                    <div class="dropdown-section-header">List Actions</div>
                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); editListTitle(this);">
                      <i class="fa-solid fa-pen icon-primary-xs"></i>
                      <span>Edit Title</span>
                    </a>
                    <a href="#" class="dropdown-item" data-modal-target="add-card-modal" onclick="event.preventDefault(); openModal('add-card-modal', this);">
                      <i class="fa-solid fa-plus icon-success-xs"></i>
                      <span>Add Card</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-item-danger" onclick="event.preventDefault(); deleteList(this);">
                      <i class="fa-regular fa-trash-can icon-danger-xs"></i>
                      <span>Delete List</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="list-cards list-cards-stack"></div>
            <button class="add-card-btn" data-modal-target="add-card-modal" onclick="openModal('add-card-modal', this);">
              <i class="fa-solid fa-plus mr-6"></i> Add a card
            </button>
          </div>
        `;

        addListBox.insertAdjacentHTML('beforebegin', newListHtml);
        initDragAndDrop();

        if (kanbanCanvas) {
          kanbanCanvas.scrollTo({
            left: kanbanCanvas.scrollWidth,
            behavior: 'smooth'
          });
        }
      }

      if (input) input.value = '';
      window.closeModal('add-list-modal');
    });
  }

  // Trello-Style Mouse Drag-to-Scroll Grip Physics for Kanban Canvas
  const kanbanCanvas = document.querySelector('.kanban-canvas');
  if (kanbanCanvas) {
    let isDown = false;
    let startX;
    let scrollLeft;

    kanbanCanvas.addEventListener('mousedown', (e) => {
      // Ignore canvas drag if clicking on interactive elements or cards
      if (
        e.target.closest('.kanban-card') ||
        e.target.closest('button') ||
        e.target.closest('a') ||
        e.target.closest('input') ||
        e.target.closest('.dropdown-menu')
      ) {
        return;
      }

      isDown = true;
      kanbanCanvas.classList.add('dragging-active');
      startX = e.pageX - kanbanCanvas.offsetLeft;
      scrollLeft = kanbanCanvas.scrollLeft;
    });

    kanbanCanvas.addEventListener('mouseleave', () => {
      isDown = false;
      kanbanCanvas.classList.remove('dragging-active');
    });

    kanbanCanvas.addEventListener('mouseup', () => {
      isDown = false;
      kanbanCanvas.classList.remove('dragging-active');
    });

    kanbanCanvas.addEventListener('mousemove', (e) => {
      if (!isDown) return;
      e.preventDefault();
      const x = e.pageX - kanbanCanvas.offsetLeft;
      const walk = (x - startX) * 1.8;
      kanbanCanvas.scrollLeft = scrollLeft - walk;
    });

    // Edge Auto-Scroll when Dragging Cards near Left/Right Canvas Edges
    kanbanCanvas.addEventListener('dragover', (e) => {
      e.preventDefault();
      if (!draggedCard) return;

      const rect = kanbanCanvas.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const threshold = 120;

      if (x > rect.width - threshold) {
        const speed = Math.min(24, Math.max(6, (x - (rect.width - threshold)) / 3));
        kanbanCanvas.scrollLeft += speed;
      } else if (x < threshold) {
        const speed = Math.min(24, Math.max(6, (threshold - x) / 3));
        kanbanCanvas.scrollLeft -= speed;
      }
    });
  }
});

// Global List Action Handlers
window.editListTitle = function(btn) {
  const kanbanList = btn.closest('.kanban-list');
  const titleEl = kanbanList ? kanbanList.querySelector('.list-title-text span:not(.list-card-count-badge)') : null;
  if (titleEl) {
    window.activeEditTitleEl = titleEl;
    const currentTitle = titleEl.textContent.trim();
    const editInput = document.getElementById('edit-list-title-input');
    if (editInput) editInput.value = currentTitle;
    window.openModal('edit-list-modal', btn);
  }
};

window.deleteList = function(btn) {
  const kanbanList = btn.closest('.kanban-list');
  if (kanbanList) {
    window.activeDeleteListEl = kanbanList;
    const titleEl = kanbanList.querySelector('.list-title-text span:not(.list-card-count-badge)');
    const listTitle = titleEl ? titleEl.textContent.trim() : 'this list';
    const deleteNameEl = document.getElementById('archive-list-name-display');
    if (deleteNameEl) deleteNameEl.textContent = `"${listTitle}"`;
    window.openModal('archive-list-modal', btn);
  }
};

window.archiveList = window.deleteList;

window.confirmArchiveList = function() {
  const listEl = window.activeDeleteListEl;
  if (listEl) {
    const titleEl = listEl.querySelector('.list-title-text span:not(.list-card-count-badge)');
    const listTitle = titleEl ? titleEl.textContent.trim() : 'Archived List';
    listEl.classList.add('is-archived-hidden');

    const container = document.getElementById('archived-lists-list-container');
    if (container) {
      const safeTitle = window.escapeHtml ? window.escapeHtml(listTitle) : listTitle;
      const itemHtml = `
        <div class="archived-item-card" data-archived-list-title="${safeTitle}">
          <div class="archived-item-info">
            <div class="archived-item-title">${safeTitle}</div>
            <div class="archived-item-sub">Archived just now</div>
          </div>
          <button type="button" class="btn btn-sm btn-secondary" onclick="restoreList(this, this.closest('.archived-item-card').getAttribute('data-archived-list-title'));"><i class="fa-solid fa-rotate-left"></i> Restore</button>
        </div>
      `;
      container.insertAdjacentHTML('afterbegin', itemHtml);
    }
  }
  window.closeModal('archive-list-modal');
};

window.restoreList = function(btn, listTitle) {
  const cardItem = btn.closest('.archived-item-card');
  if (cardItem) cardItem.remove();

  document.querySelectorAll('.kanban-list').forEach((list) => {
    const titleEl = list.querySelector('.list-title-text span:not(.list-card-count-badge)');
    if (titleEl && titleEl.textContent.trim() === listTitle) {
      list.classList.remove('is-archived-hidden');
    }
  });
};

window.archiveCard = function(btn) {
  const cardEl = btn.closest('.kanban-card');
  if (cardEl) {
    window.activeArchiveCardEl = cardEl;
    const titleEl = cardEl.querySelector('.card-title-text');
    const cardTitle = titleEl ? titleEl.textContent.trim() : 'this card';
    const nameDisplay = document.getElementById('archive-card-name-display');
    if (nameDisplay) nameDisplay.textContent = `"${cardTitle}"`;
    window.openModal('archive-card-modal', btn);
  }
};

window.confirmArchiveCard = function() {
  const cardEl = window.activeArchiveCardEl || document.querySelector('.kanban-card');
  if (cardEl) {
    const titleEl = cardEl.querySelector('.card-title-text');
    const cardTitle = titleEl ? titleEl.textContent.trim() : 'Archived Card';
    cardEl.classList.add('is-archived-hidden');

    const container = document.getElementById('archived-cards-list-container');
    if (container) {
      const safeTitle = window.escapeHtml ? window.escapeHtml(cardTitle) : cardTitle;
      const itemHtml = `
        <div class="archived-item-card" data-archived-title="${safeTitle}">
          <div class="archived-item-info">
            <div class="archived-item-title">${safeTitle}</div>
            <div class="archived-item-sub">Archived just now</div>
          </div>
          <button type="button" class="btn btn-sm btn-secondary" onclick="restoreCard(this, this.closest('.archived-item-card').getAttribute('data-archived-title'));"><i class="fa-solid fa-rotate-left"></i> Restore</button>
        </div>
      `;
      container.insertAdjacentHTML('afterbegin', itemHtml);
    }
  }
  window.closeModal('archive-card-modal');
};

window.restoreCard = function(btn, cardTitle) {
  const cardItem = btn.closest('.archived-item-card');
  if (cardItem) cardItem.remove();

  document.querySelectorAll('.kanban-card').forEach((card) => {
    const titleEl = card.querySelector('.card-title-text');
    if (titleEl && titleEl.textContent.trim() === cardTitle) {
      card.classList.remove('is-archived-hidden');
    }
  });
};

window.toggleArchivedDrawer = function() {
  const drawer = document.getElementById('archived-items-drawer');
  if (drawer) drawer.classList.toggle('display-none');
};

window.switchArchivedTab = function(tab) {
  const cardsContent = document.getElementById('archived-cards-tab-content');
  const listsContent = document.getElementById('archived-lists-tab-content');
  const cardsBtn = document.getElementById('arch-cards-tab-btn');
  const listsBtn = document.getElementById('arch-lists-tab-btn');
  const showCards = tab === 'cards';

  if (cardsContent) cardsContent.classList.toggle('display-none', !showCards);
  if (listsContent) listsContent.classList.toggle('display-none', showCards);
  if (cardsBtn) cardsBtn.className = showCards ? 'btn btn-sm btn-view-tab-active active-arch-tab' : 'btn btn-sm btn-view-tab';
  if (listsBtn) listsBtn.className = showCards ? 'btn btn-sm btn-view-tab' : 'btn btn-sm btn-view-tab-active active-arch-tab';
};
