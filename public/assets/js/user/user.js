/**
 * User Workspace JavaScript
 * ALL User UI Interactions in one file
 * - HTML5 Drag & Drop Card Physics across Kanban Lists
 * - Interactive Card Detail Modal & Checklist Toggles
 * - Star Board Toggle & Dropdowns
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('User Workspace JS initialized');

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

        // Update card counts dynamically on list headers
        updateListCardCounts();
      });
    });
  }

  // Calculate position relative to other cards in column
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

  // =========================================================
  // 2. Card Detail Modal Triggers
  // =========================================================
  const cardElements = document.querySelectorAll('.kanban-card');
  const cardModal = document.getElementById('card-detail-modal');
  const modalCloseBtn = document.getElementById('modal-close-btn');

  cardElements.forEach(card => {
    card.addEventListener('click', (e) => {
      // Avoid opening modal if dragging or clicking specific action icons
      if (card.classList.contains('dragging')) return;
      if (e.target.closest('.card-action-btn')) return;

      // Populate card modal fields from card dataset or inner text
      const title = card.querySelector('.card-title')?.textContent || 'Card Details';
      const cardModalTitle = document.getElementById('modal-card-title');
      if (cardModalTitle) {
        cardModalTitle.textContent = title;
      }

      // Populate Cover Banner Image
      const coverUrl = card.getAttribute('data-cover') || card.querySelector('.card-cover-img-box img')?.src;
      const modalCoverImg = document.getElementById('modal-cover-img');
      const modalCoverBanner = document.getElementById('modal-cover-banner');

      if (modalCoverBanner && modalCoverImg) {
        if (coverUrl && coverUrl.trim() !== '') {
          modalCoverImg.src = coverUrl;
        }
        modalCoverBanner.style.display = 'block';
      }

      if (cardModal) {
        cardModal.classList.add('active');
      }
    });
  });

  if (modalCloseBtn && cardModal) {
    modalCloseBtn.addEventListener('click', () => {
      cardModal.classList.remove('active');
    });
  }

  if (cardModal) {
    cardModal.addEventListener('click', (e) => {
      if (e.target === cardModal) {
        cardModal.classList.remove('active');
      }
    });
  }

  // =========================================================
  // 3. Card Modal Checklist Progress & Checklist Toggles
  // =========================================================
  const checklistItems = document.querySelectorAll('.checklist-checkbox');
  checklistItems.forEach(item => {
    item.addEventListener('change', () => {
      const total = document.querySelectorAll('.checklist-checkbox').length;
      const checked = document.querySelectorAll('.checklist-checkbox:checked').length;
      const percent = total > 0 ? Math.round((checked / total) * 100) : 0;

      const progressBar = document.getElementById('checklist-progress-bar');
      const progressText = document.getElementById('checklist-progress-text');

      if (progressBar) progressBar.style.width = percent + '%';
      if (progressText) progressText.textContent = percent + '%';

      const label = item.nextElementSibling;
      if (label) {
        if (item.checked) {
          label.style.textDecoration = 'line-through';
          label.style.color = 'var(--text-muted)';
        } else {
          label.style.textDecoration = 'none';
          label.style.color = 'var(--text-main)';
        }
      }
    });
  });

  // =========================================================
  // 4. Interactive Comment Add UI (Static UI preview)
  // =========================================================
  const commentSubmitBtn = document.getElementById('add-comment-btn');
  const commentInput = document.getElementById('comment-input');
  const commentsFeed = document.getElementById('comments-feed');

  if (commentSubmitBtn && commentInput && commentsFeed) {
    commentSubmitBtn.addEventListener('click', () => {
      const text = commentInput.value.trim();
      if (text === '') return;

      const newComment = document.createElement('div');
      newComment.className = 'comment-item';
      newComment.style.cssText = 'display: flex; gap: 12px; margin-bottom: 16px; font-size: 13px;';
      newComment.innerHTML = `
        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" class="avatar" alt="User">
        <div style="flex: 1; background: var(--bg-main); padding: 10px 14px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
          <div style="display: flex; justify-content: space-between; font-weight: 600; margin-bottom: 4px;">
            <span>Mahad Bukhari</span>
            <span style="font-weight: 400; color: var(--text-muted); font-size: 11px;">Just now</span>
          </div>
          <p>${escapeHtml(text)}</p>
        </div>
      `;

      commentsFeed.prepend(newComment);
      commentInput.value = '';
    });
  }

  // =========================================================
  // 5. Star Toggle Button
  // =========================================================
  const starBtn = document.querySelector('.star-btn');
  if (starBtn) {
    starBtn.addEventListener('click', () => {
      starBtn.classList.toggle('starred');
      if (starBtn.classList.contains('starred')) {
        starBtn.innerHTML = '★';
        starBtn.style.color = 'var(--warning)';
      } else {
        starBtn.innerHTML = '☆';
        starBtn.style.color = 'var(--text-muted)';
      }
    });
  }

  // =========================================================
  // 6. Sidebar Boards Accordion Toggle
  // =========================================================
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

  // View Switcher Tabs (Board, Table, Calendar, Timeline)
  const viewTabBtns = document.querySelectorAll('[data-view-target]');
  viewTabBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const targetId = btn.getAttribute('data-view-target');

      // Reset all view tabs styling
      viewTabBtns.forEach(b => {
        b.classList.remove('active-view-tab');
        b.style.background = 'transparent';
        b.style.color = 'var(--text-muted)';
        b.style.boxShadow = 'none';
        b.style.fontWeight = '500';
      });

      // Highlight clicked view tab
      btn.classList.add('active-view-tab');
      btn.style.background = 'white';
      btn.style.color = 'var(--text-main)';
      btn.style.boxShadow = 'var(--shadow-xs)';
      btn.style.fontWeight = '600';

      // Hide all view containers
      document.querySelectorAll('.view-container').forEach(container => {
        container.style.display = 'none';
      });

      // Show selected target container
      const targetContainer = document.getElementById(targetId);
      if (targetContainer) {
        targetContainer.style.display = 'block';
      }
    });
  });

  // Table Status Filter Tabs Handler
  const tableFilterBtns = document.querySelectorAll('[data-table-filter]');
  tableFilterBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const filter = btn.getAttribute('data-table-filter').toLowerCase().trim();

      // Reset active tab styling
      tableFilterBtns.forEach(b => {
        b.classList.remove('active-table-filter');
        b.style.background = 'transparent';
        b.style.color = 'var(--text-muted)';
        b.style.boxShadow = 'none';
        b.style.fontWeight = '500';
      });

      // Set clicked tab active
      btn.classList.add('active-table-filter');
      btn.style.background = 'white';
      btn.style.color = 'var(--text-main)';
      btn.style.boxShadow = 'var(--shadow-xs)';
      btn.style.fontWeight = '700';

      // Filter table rows
      const tableRows = document.querySelectorAll('#table-view-container tbody tr');
      tableRows.forEach(row => {
        const rowStatus = (row.getAttribute('data-status') || '').toLowerCase().trim();
        if (filter === 'all' || rowStatus === filter) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  });

  // Table Search Input Handler
  const tableSearchInput = document.getElementById('table-search-input');
  if (tableSearchInput) {
    tableSearchInput.addEventListener('input', (e) => {
      const q = e.target.value.toLowerCase().trim();
      const tableRows = document.querySelectorAll('#table-view-container tbody tr');
      tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(q)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  }

  // Notification Center Filter Tabs Handler
  const notifTabBtns = document.querySelectorAll('[data-notif-filter]');
  notifTabBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const filter = btn.getAttribute('data-notif-filter').toLowerCase().trim();

      notifTabBtns.forEach(b => {
        b.classList.remove('active-notification-tab');
        b.style.background = 'transparent';
        b.style.color = 'var(--text-muted)';
        b.style.fontWeight = '500';
      });

      btn.classList.add('active-notification-tab');
      btn.style.background = 'var(--bg-main)';
      btn.style.color = 'var(--text-main)';
      btn.style.fontWeight = '700';

      const notifItems = document.querySelectorAll('.notification-item-card');
      notifItems.forEach(item => {
        const type = (item.getAttribute('data-type') || '').toLowerCase();
        const isUnread = item.getAttribute('data-unread') === '1';

        if (filter === 'all') {
          item.style.display = 'flex';
        } else if (filter === 'unread') {
          item.style.display = isUnread ? 'flex' : 'none';
        } else if (filter === 'mentions') {
          item.style.display = type === 'mention' ? 'flex' : 'none';
        } else if (filter === 'assigned') {
          item.style.display = type === 'assigned' ? 'flex' : 'none';
        }
      });
    });
  });

  // Mark All As Read Action
  const markAllReadBtn = document.getElementById('mark-all-read-btn');
  if (markAllReadBtn) {
    markAllReadBtn.addEventListener('click', () => {
      const unreadItems = document.querySelectorAll('.notification-item-card.unread-item');
      unreadItems.forEach(item => {
        item.classList.remove('unread-item');
        item.setAttribute('data-unread', '0');
        item.style.background = 'white';
        item.style.borderColor = 'var(--border-color)';
        item.style.boxShadow = 'none';

        const dot = item.querySelector('.unread-dot-indicator');
        if (dot) dot.remove();

        const toggleBtn = item.querySelector('.toggle-read-btn');
        if (toggleBtn) toggleBtn.remove();
      });

      const badge = document.getElementById('unread-count-badge');
      if (badge) {
        badge.textContent = '0 Unread';
        badge.className = 'badge badge-success';
      }

      // Hide top header notification red dot
      const notifDot = document.querySelector('.notification-dot');
      if (notifDot) notifDot.style.display = 'none';
    });
  }

  // View Switcher Tabs Handler (Board View vs Calendar View)
  document.addEventListener('click', (e) => {
    const viewTabBtn = e.target.closest('[data-view-target]');
    if (viewTabBtn) {
      e.preventDefault();
      const targetId = viewTabBtn.getAttribute('data-view-target');
      if (!targetId) return;

      // Reset styles for all view tab buttons
      document.querySelectorAll('[data-view-target]').forEach(btn => {
        btn.classList.remove('active-view-tab', 'btn-view-tab-active');
        btn.classList.add('btn-view-tab');
      });

      // Highlight clicked view tab
      viewTabBtn.classList.add('active-view-tab', 'btn-view-tab-active');
      viewTabBtn.classList.remove('btn-view-tab');

      // Hide all view containers
      document.querySelectorAll('.view-container').forEach(container => {
        container.style.display = 'none';
        container.classList.add('display-none');
      });

      // Display target view container
      const targetContainer = document.getElementById(targetId);
      if (targetContainer) {
        targetContainer.style.display = 'block';
        targetContainer.classList.remove('display-none');
      }
    }
  });

  // Individual Toggle Read Button
  document.addEventListener('click', (e) => {
    const toggleBtn = e.target.closest('.toggle-read-btn');
    if (toggleBtn) {
      e.preventDefault();
      const item = toggleBtn.closest('.notification-item-card');
      if (item) {
        item.classList.remove('unread-item');
        item.setAttribute('data-unread', '0');
        item.style.background = 'white';
        item.style.borderColor = 'var(--border-color)';
        item.style.boxShadow = 'none';

        const dot = item.querySelector('.unread-dot-indicator');
        if (dot) dot.remove();

        toggleBtn.remove();

        // Recalculate unread badge
        const unreadCount = document.querySelectorAll('.notification-item-card.unread-item').length;
        const badge = document.getElementById('unread-count-badge');
        if (badge) {
          badge.textContent = `${unreadCount} Unread`;
          if (unreadCount === 0) {
            badge.className = 'badge badge-success';
            const notifDot = document.querySelector('.notification-dot');
            if (notifDot) notifDot.style.display = 'none';
          }
        }
      }
    }
  });

  // Helper escape HTML
  function escapeHtml(str) {
    return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  }

  // =========================================================
  // 8. Dynamic Calendar Generation & Navigation (Next/Prev/Today)
  // =========================================================
  const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  let currentMonthIdx = 6; // July (0-indexed: 6 = July)
  let currentYear = 2026;

  const calMonthText = document.getElementById('cal-month-text');
  const calPrevBtn = document.getElementById('cal-prev-btn');
  const calNextBtn = document.getElementById('cal-next-btn');
  const calTodayBtn = document.getElementById('cal-today-btn');

  const sampleTasksByMonth = {
    // July 2026 (Month index 6)
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
    // Default tasks fallback for any other month
    default: {
      3: [{ text: 'Sprint Kickoff & Planning', cls: 'cal-pill-purple', icon: 'fa-layer-group' }],
      5: [{ text: 'API Endpoint Refactoring', cls: 'cal-pill-blue', icon: 'fa-rotate' }],
      8: [{ text: 'Database Schema Migration', cls: 'cal-pill-mint', icon: 'fa-asterisk' }],
      12: [
        { text: 'Design System Tokens', cls: 'cal-pill-peach cal-span-bar' },
        { text: 'Bug Triage & QA Check', cls: 'cal-pill-rose' }
      ],
      13: [{ text: 'Design System Tokens', cls: 'cal-pill-peach cal-span-bar-end' }],
      18: [{ text: 'Unit Test Suite Run', cls: 'cal-pill-lavender', icon: 'fa-link' }],
      21: [{ text: 'Security Audit Scan', cls: 'cal-pill-mint', icon: 'fa-asterisk' }],
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

    const firstDay = new Date(year, monthIdx, 1).getDay(); // 0 = Sun, 1 = Mon, ..., 6 = Sat
    const totalDaysInMonth = new Date(year, monthIdx + 1, 0).getDate();
    const prevMonthDays = new Date(year, monthIdx, 0).getDate();
    const tasksMap = sampleTasksByMonth[monthIdx] || sampleTasksByMonth.default;

    if (currentCalMode === 'day') {
      if (calHeaderRow) calHeaderRow.style.display = 'none';
      calGrid.style.gridTemplateColumns = '1fr';
      
      const cellEl = document.createElement('div');
      cellEl.className = 'cal-day-cell cal-day-cell-active-day';
      cellEl.style.minHeight = '340px';
      cellEl.style.padding = '24px';

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

    if (calHeaderRow) calHeaderRow.style.display = 'grid';
    calGrid.style.gridTemplateColumns = 'repeat(7, 1fr)';

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
          cellEl.style.opacity = '0.4';
        } else if (dayCount <= totalDaysInMonth) {
          dayNumber = dayCount;
          isCurrentMonth = true;
          dayCount++;
        } else {
          dayNumber = nextMonthDay;
          nextMonthDay++;
          cellEl.style.opacity = '0.4';
        }
      }

      let innerHtml = `<div class="cal-day-num">${dayNumber}</div>`;

      // Show task pills only on weekdays of current month and NOT on Sunday/Saturday
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
      if (currentMonthIdx < 0) {
        currentMonthIdx = 11;
        currentYear--;
      }
      updateCalendarHeader();
    });
  }

  if (calNextBtn) {
    calNextBtn.addEventListener('click', () => {
      currentMonthIdx++;
      if (currentMonthIdx > 11) {
        currentMonthIdx = 0;
        currentYear++;
      }
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

  // Month / Week / Day Mode Switcher
  calModeBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const mode = btn.getAttribute('data-cal-mode');

      calModeBtns.forEach(b => {
        b.classList.remove('active-cal-mode');
        b.style.background = 'transparent';
        b.style.color = 'var(--text-muted)';
        b.style.boxShadow = 'none';
        b.style.fontWeight = '500';
      });

      btn.classList.add('active-cal-mode');
      btn.style.background = 'white';
      btn.style.color = 'var(--text-main)';
      btn.style.boxShadow = 'var(--shadow-xs)';
      btn.style.fontWeight = '700';

      const calGrid = document.querySelector('.cal-month-grid');
      if (calGrid) {
        if (mode === 'week') {
          const cells = calGrid.querySelectorAll('.cal-day-cell');
          cells.forEach((cell, idx) => {
            cell.style.display = idx < 7 ? 'flex' : 'none';
          });
        } else if (mode === 'day') {
          const cells = calGrid.querySelectorAll('.cal-day-cell');
          cells.forEach((cell, idx) => {
            cell.style.display = idx === 1 ? 'flex' : 'none';
          });
        } else {
          const cells = calGrid.querySelectorAll('.cal-day-cell');
          cells.forEach(cell => {
            cell.style.display = 'flex';
          });
        }
      }
    });
  });
});

// Helper: Escape HTML
function escapeHtml(str) {
  if (!str) return '';
  return String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

// Active references for modal actions
let activeEditTitleEl = null;
let activeDeleteListEl = null;
let activeTargetListForAddCard = null;

// Global List Action Handlers
window.editListTitle = function(btn) {
  const kanbanList = btn.closest('.kanban-list');
  const titleEl = kanbanList ? kanbanList.querySelector('.list-title-text span:not(.list-card-count-badge)') : null;
  if (titleEl) {
    activeEditTitleEl = titleEl;
    const currentTitle = titleEl.textContent.trim();
    const editInput = document.getElementById('edit-list-title-input');
    const editModal = document.getElementById('edit-list-modal');
    if (editInput) editInput.value = currentTitle;
    if (editModal) editModal.classList.add('active');
  }
};

window.deleteList = function(btn) {
  const kanbanList = btn.closest('.kanban-list');
  if (kanbanList) {
    activeDeleteListEl = kanbanList;
    const titleEl = kanbanList.querySelector('.list-title-text span:not(.list-card-count-badge)');
    const listTitle = titleEl ? titleEl.textContent.trim() : 'this list';
    const deleteModal = document.getElementById('delete-list-modal');
    const deleteNameEl = document.getElementById('delete-list-name');
    if (deleteNameEl) deleteNameEl.textContent = `"${listTitle}"`;
    if (deleteModal) deleteModal.classList.add('active');
  }
};

window.copyList = function(btn) {
  const kanbanList = btn.closest('.kanban-list');
  if (kanbanList) {
    const clone = kanbanList.cloneNode(true);
    const cloneTitle = clone.querySelector('.list-title-text span:not(.list-card-count-badge)');
    if (cloneTitle) cloneTitle.textContent += ' (Copy)';
    kanbanList.parentNode.insertBefore(clone, kanbanList.nextSibling);
    initDragAndDrop();
  }
};

window.sortListCards = function(btn) {
  const kanbanList = btn.closest('.kanban-list');
  const cardsContainer = kanbanList ? kanbanList.querySelector('.list-cards') : null;
  if (cardsContainer) {
    const cards = Array.from(cardsContainer.querySelectorAll('.kanban-card'));
    cards.sort((a, b) => {
      const titleA = a.querySelector('.card-title-text')?.textContent.toLowerCase() || '';
      const titleB = b.querySelector('.card-title-text')?.textContent.toLowerCase() || '';
      return titleA.localeCompare(titleB);
    });
    cards.forEach(card => cardsContainer.appendChild(card));
  }
};

// Global Modal Control Functions
window.openModal = function(modalId, triggerEl) {
  const modal = document.getElementById(modalId);
  if (!modal) return;

  // Close open dropdown menus first
  try {
    document.querySelectorAll('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
  } catch (err) {}

  // Open modal BEFORE any optional helper logic so popup ALWAYS renders visually!
  modal.classList.add('active');
  modal.classList.add('show');
  modal.style.display = 'flex';

  // Track target column for Add Card & populate select
  if (modalId === 'add-card-modal') {
    try {
      if (triggerEl) {
        activeTargetListForAddCard = triggerEl.closest('.kanban-list');
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
          if (activeTargetListForAddCard && list === activeTargetListForAddCard) {
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

// Universal Delegated Click Handler for Modals, Dropdowns, Cards, and Actions
document.addEventListener('click', (e) => {
  // 1. Trigger Modal Open via data-modal-target (Priority 1)
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

  // 5. Click on Kanban Card opens Card Detail Modal
  const cardTile = e.target.closest('.kanban-card');
  if (cardTile && !cardTile.classList.contains('dragging') && !e.target.closest('.dropdown-toggle') && !e.target.closest('.dropdown-menu')) {
    const cardTitle = cardTile.querySelector('.card-title-text')?.textContent || 'Card Details';
    const cardModalTitle = document.getElementById('modal-card-title');
    if (cardModalTitle) cardModalTitle.textContent = cardTitle;

    const coverUrl = cardTile.getAttribute('data-cover') || cardTile.querySelector('.card-cover-img-box img')?.src;
    const modalCoverImg = document.getElementById('modal-cover-img');
    const modalCoverBanner = document.getElementById('modal-cover-banner');

    if (modalCoverBanner && modalCoverImg) {
      if (coverUrl && coverUrl.trim() !== '') {
        modalCoverImg.src = coverUrl;
      }
      modalCoverBanner.style.display = 'block';
    }

    window.openModal('card-detail-modal', cardTile);
  }
});

// DOM Form Submission Handlers
document.addEventListener('DOMContentLoaded', () => {
  // Edit List Title Form Handler
  const editListForm = document.getElementById('edit-list-form');
  if (editListForm) {
    editListForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const editInput = document.getElementById('edit-list-title-input');
      const editModal = document.getElementById('edit-list-modal');
      if (activeEditTitleEl && editInput) {
        activeEditTitleEl.textContent = editInput.value.trim();
      }
      if (editModal) editModal.classList.remove('active');
    });
  }

  // Delete List Confirm Handler
  const confirmDeleteBtn = document.getElementById('confirm-delete-list-btn');
  if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener('click', () => {
      const deleteModal = document.getElementById('delete-list-modal');
      if (activeDeleteListEl) {
        activeDeleteListEl.style.transition = "all 0.3s ease";
        activeDeleteListEl.style.opacity = "0";
        activeDeleteListEl.style.transform = "scale(0.9)";
        setTimeout(() => {
          activeDeleteListEl.remove();
          updateListCardCounts();
        }, 300);
      }
      if (deleteModal) deleteModal.classList.remove('active');
    });
  }

  // Add Card Form Submit Handler
  const addCardForm = document.getElementById('add-card-form');
  if (addCardForm) {
    addCardForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const titleInput = document.getElementById('add-card-title-input');
      const descInput = document.getElementById('add-card-desc-input');
      const selectEl = document.getElementById('add-card-list-select');

      const title = titleInput ? titleInput.value.trim() : '';
      const desc = descInput ? descInput.value.trim() : '';
      const selectedColumnTitle = selectEl ? selectEl.value.trim() : '';

      if (!title) return;

      let targetCardsStack = null;
      if (selectedColumnTitle) {
        document.querySelectorAll('.kanban-list').forEach(list => {
          const colTitle = list.querySelector('.list-title-text span:not(.list-card-count-badge)')?.textContent.trim();
          if (colTitle === selectedColumnTitle) {
            targetCardsStack = list.querySelector('.list-cards');
          }
        });
      }

      if (!targetCardsStack && activeTargetListForAddCard) {
        targetCardsStack = activeTargetListForAddCard.querySelector('.list-cards');
      }

      if (!targetCardsStack) {
        targetCardsStack = document.querySelector('.list-cards');
      }

      if (targetCardsStack) {
        const cardId = 'card-' + Date.now();
        const newCardHtml = `
          <div class="kanban-card" data-card-id="${cardId}" data-modal-target="card-detail-modal">
            <div class="card-title-text">${escapeHtml(title)}</div>
            ${desc ? `<div class="card-subtitle-text">${escapeHtml(desc)}</div>` : ''}
          </div>
        `;
        targetCardsStack.insertAdjacentHTML('beforeend', newCardHtml);
        updateListCardCounts();
        initDragAndDrop();
      }

      if (titleInput) titleInput.value = '';
      if (descInput) descInput.value = '';

      const modal = document.getElementById('add-card-modal');
      if (modal) modal.classList.remove('active');
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

      const kanbanCanvas = document.querySelector('.kanban-canvas');
      const addListBox = document.querySelector('.add-list-box');

      if (kanbanCanvas && addListBox) {
        const listId = 'list-' + Date.now();
        const colors = ['#8B5CF6', '#EC4899', '#06B6D4', '#F59E0B', '#10B981', '#6366F1'];
        const randomColor = colors[Math.floor(Math.random() * colors.length)];

        const newListHtml = `
          <div class="kanban-list" data-list-id="${listId}">
            <div class="list-header-bar">
              <div class="list-title-text">
                <div class="list-status-pill-line" style="background: ${randomColor};"></div>
                <span contenteditable="false">${escapeHtml(title)}</span>
                <span class="list-card-count-badge">0</span>
              </div>
              <div class="list-header-actions">
                <button class="list-action-icon-btn" title="Add Card" data-modal-target="add-card-modal">
                  <i class="fa-solid fa-plus"></i>
                </button>
                <div class="dropdown-wrapper">
                  <button class="list-action-icon-btn dropdown-toggle" title="List Options">
                    <i class="fa-solid fa-ellipsis"></i>
                  </button>
                  <div class="dropdown-menu list-options-menu" style="right: 0; left: auto; width: 190px;">
                    <div class="dropdown-section-header">List Actions</div>
                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); editListTitle(this);">
                      <i class="fa-solid fa-pen" style="font-size: 12px; color: var(--primary);"></i>
                      <span>Edit Title</span>
                    </a>
                    <a href="#" class="dropdown-item" data-modal-target="add-card-modal">
                      <i class="fa-solid fa-plus" style="font-size: 12px; color: var(--success);"></i>
                      <span>Add Card</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item" style="color: var(--danger); font-weight: 600;" onclick="event.preventDefault(); deleteList(this);">
                      <i class="fa-regular fa-trash-can" style="font-size: 12px; color: var(--danger);"></i>
                      <span>Delete List</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="list-cards list-cards-stack"></div>
            <button class="add-card-btn" data-modal-target="add-card-modal">
              <i class="fa-solid fa-plus mr-6"></i> Add a card
            </button>
          </div>
        `;

        addListBox.insertAdjacentHTML('beforebegin', newListHtml);
        initDragAndDrop();

        kanbanCanvas.scrollTo({
          left: kanbanCanvas.scrollWidth,
          behavior: 'smooth'
        });
      }

      input.value = '';
      const modal = document.getElementById('add-list-modal');
      if (modal) modal.classList.remove('active');
    });
  }
});

// Global Header Search Listener
window.handleGlobalHeaderSearch = function(inputEl, isAdmin = false) {
  const query = inputEl.value.toLowerCase().trim();
  const dropdown = document.getElementById('global-search-dropdown');
  if (!dropdown) return;

  if (!query) {
    dropdown.style.display = 'none';
    dropdown.innerHTML = '';
    return;
  }

  const mockBoards = [
    { title: 'Sprint 24 Architecture', url: 'board-detail' },
    { title: 'Bug Triage & Hotfixes', url: 'board-detail' },
    { title: 'API v3 Migration', url: 'board-detail' },
    { title: 'Design System 2.0', url: 'board-detail' }
  ].filter(b => b.title.toLowerCase().includes(query));

  const mockCards = [
    { title: 'HTML5 Drag & Drop Physics', list: 'In Progress' },
    { title: 'MySQL PDO Prepared Statements', list: 'To-Do' },
    { title: 'Color Palette & Typography', list: 'Review' }
  ].filter(c => c.title.toLowerCase().includes(query) || c.list.toLowerCase().includes(query));

  let html = '';

  if (mockBoards.length > 0) {
    html += `<div class="search-section-header"><i class="fa-solid fa-table-columns"></i> Boards (${mockBoards.length})</div>`;
    mockBoards.forEach(b => {
      html += `<a href="${b.url}" class="search-result-item"><i class="fa-solid fa-square text-primary"></i> <span>${b.title}</span></a>`;
    });
  }

  if (mockCards.length > 0) {
    html += `<div class="search-section-header"><i class="fa-solid fa-credit-card"></i> Cards (${mockCards.length})</div>`;
    mockCards.forEach(c => {
      html += `<div class="search-result-item" onclick="document.getElementById('global-search-dropdown').style.display='none'; window.openModal('card-detail-modal');"><i class="fa-solid fa-list-ul text-warning"></i> <div><strong>${c.title}</strong> <span class="text-muted font-size-11">in ${c.list}</span></div></div>`;
    });
  }

  if (!html) {
    html = `<div class="p-12 text-center text-muted font-size-13">No matching boards or cards found for "${query}"</div>`;
  }

  dropdown.innerHTML = html;
  dropdown.style.display = 'block';
};

document.addEventListener('click', (e) => {
  if (!e.target.closest('.search-input-group')) {
    const dropdown = document.getElementById('global-search-dropdown');
    if (dropdown) dropdown.style.display = 'none';
  }
});

// Nested Subtasks & Checklist Progress Engine
window.addNestedSubtask = function(btn) {
  const title = prompt("Enter sub-task title:");
  if (!title || !title.trim()) return;

  const parentWrapper = btn.closest('.checklist-parent-wrapper');
  if (parentWrapper) {
    const subtaskHtml = `
      <div class="checklist-subitem-row" style="display: flex; align-items: center; justify-content: space-between; margin-left: 28px; margin-top: 4px; padding-left: 8px; border-left: 2px solid var(--primary-glow);">
        <span style="display: flex; align-items: center; gap: 8px;">
          <input type="checkbox" class="checklist-checkbox" onchange="recalculateChecklistProgress();">
          <span style="font-size: 12px;">${title.trim()}</span>
        </span>
      </div>
    `;
    parentWrapper.insertAdjacentHTML('beforeend', subtaskHtml);
    window.recalculateChecklistProgress();
  }
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
        textSpan.style.textDecoration = 'line-through';
        textSpan.style.color = 'var(--text-muted)';
      }
    } else {
      if (textSpan) {
        textSpan.style.textDecoration = 'none';
        textSpan.style.color = 'var(--text-main)';
      }
    }
  });

  const percentage = Math.round((checkedCount / checkboxes.length) * 100);
  const progressBar = document.getElementById('checklist-progress-bar');
  const progressText = document.getElementById('checklist-progress-text');

  if (progressBar) progressBar.style.width = percentage + '%';
  if (progressText) progressText.textContent = percentage + '%';
};
