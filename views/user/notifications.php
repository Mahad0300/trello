<?php
$page_title = 'Notifications - Richmondtech';
require_once VIEWS_PATH . '/layouts/user/header.php';
?>

<div class="notif-page-bg">

  <!-- Main Notification Card Wrapper -->
  <div class="notif-ref-card">

    <!-- Page Header: title left · search + options right (single row) -->
    <div class="notif-header-toolbar notif-header-aligned">
      <div class="notif-header-left">
        <div class="notif-icon-badge notif-icon-badge-gradient">
          <i class="fa-solid fa-bell"></i>
        </div>
        <div>
          <h1 class="notif-main-title">List Notification</h1>
          <p class="notif-subtext">Manage, view, and stay updated with all your team notifications.</p>
          <p class="notif-summary-count notif-summary-inline">
            <span id="notif-total-count-text">188</span> Notification
          </p>
        </div>
      </div>

      <div class="notif-header-right">
        <div class="notif-search-box-pill">
          <i class="fa-solid fa-magnifying-glass search-icon"></i>
          <input type="text" id="notif-search-input" placeholder="Search notifications...">
        </div>
        <div class="dropdown-wrapper">
          <button class="dropdown-toggle btn btn-secondary btn-sm" title="Notification Options">
            <i class="fa-solid fa-ellipsis"></i> Options
          </button>
          <div class="dropdown-menu notif-dropdown-menu">
            <div class="dropdown-section-header">Notification Actions</div>
            <a href="#" class="dropdown-item" onclick="event.preventDefault(); markAllNotifsRead();">
              <i class="fa-solid fa-check-double notif-menu-icon-primary"></i>
              <span>Mark All as Read</span>
            </a>
            <a href="#" class="dropdown-item" onclick="event.preventDefault(); favoriteAllNotifs();">
              <i class="fa-solid fa-star notif-menu-icon-star"></i>
              <span>Mark All Favorite</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item notif-menu-item-danger" onclick="event.preventDefault(); clearAllNotifs();">
              <i class="fa-regular fa-trash-can notif-menu-icon-danger"></i>
              <span>Clear All Notifications</span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Filter Tabs Row -->
    <div class="notif-tabs-header-row">
      <button class="notif-tab-item active" data-tab="all">
        <span class="notif-tab-badge-active" id="count-badge-all">20</span> All
      </button>
      <button class="notif-tab-item" data-tab="favorite">
        <span class="notif-tab-badge-grey" id="count-badge-favorite">17</span> Favorite
      </button>
    </div>

    <!-- Empty state (shown when no notifications) -->
    <div class="notif-empty-state is-hidden" id="notif-empty-state" aria-live="polite">
      <div class="notif-empty-icon">
        <img src="<?= asset('images/notification.png') ?>" alt="No notifications" class="notif-empty-img">
      </div>
      <h3 class="notif-empty-title">No notifications yet</h3>
      <p class="notif-empty-subtext">When a new update arrives — board activity, mentions, or alerts — it will show up here.</p>
    </div>

    <!-- Notification Rows Stack -->
    <div class="notif-list-stack" id="notif-items-container">

      <!-- Item 1 (Unread, Non-starred) -->
      <div class="notif-row-tile unread-row" data-category="all" data-starred="0">
        <div class="notif-row-left-icons">
          <div class="notif-status-dot-green" title="Unread"></div>
          <button class="notif-star-btn" title="Toggle Favorite">
            <i class="fa-regular fa-star"></i>
          </button>
          <div class="notif-folder-icon-badge">
            <i class="fa-regular fa-folder-open"></i>
          </div>
        </div>

        <div class="notif-msg-text-content">
          <strong>We're pleased to inform you that a new customer has registered! Please follow up promptly by contacting.</strong>
        </div>

        <div class="notif-row-right-meta">
          <span class="notif-timestamp-text">Just Now</span>
          <button class="notif-delete-trash-btn" title="Delete Notification" onclick="deleteNotifRow(this);">
            <i class="fa-regular fa-trash-can"></i>
          </button>
        </div>
      </div>

      <!-- Item 2 (Read, Starred) -->
      <div class="notif-row-tile" data-category="favorite" data-starred="1">
        <div class="notif-row-left-icons">
          <div class="notif-status-dot-grey" title="Read"></div>
          <button class="notif-star-btn starred" title="Toggle Favorite">
            <i class="fa-solid fa-star"></i>
          </button>
          <div class="notif-folder-icon-badge">
            <i class="fa-regular fa-folder-open"></i>
          </div>
        </div>

        <div class="notif-msg-text-content">
          <strong>Hello Sales Marketing Team, We have a special offer for our customers! Enjoy a 20% discount on selected..</strong>
        </div>

        <div class="notif-row-right-meta">
          <span class="notif-timestamp-text">30 mins ago</span>
          <button class="notif-delete-trash-btn" title="Delete Notification" onclick="deleteNotifRow(this);">
            <i class="fa-regular fa-trash-can"></i>
          </button>
        </div>
      </div>

      <!-- Item 3 (Unread, Non-starred) -->
      <div class="notif-row-tile unread-row" data-category="all" data-starred="0">
        <div class="notif-row-left-icons">
          <div class="notif-status-dot-green" title="Unread"></div>
          <button class="notif-star-btn" title="Toggle Favorite">
            <i class="fa-regular fa-star"></i>
          </button>
          <div class="notif-folder-icon-badge">
            <i class="fa-regular fa-folder-open"></i>
          </div>
        </div>

        <div class="notif-msg-text-content">
          <strong>Hello Sales Marketing Team, This is a reminder to achieve this month's sales target. Currently, we've....</strong>
        </div>

        <div class="notif-row-right-meta">
          <span class="notif-timestamp-text">2 days ago</span>
          <button class="notif-delete-trash-btn" title="Delete Notification" onclick="deleteNotifRow(this);">
            <i class="fa-regular fa-trash-can"></i>
          </button>
        </div>
      </div>

      <!-- Item 4 (Read, Starred) -->
      <div class="notif-row-tile" data-category="favorite" data-starred="1">
        <div class="notif-row-left-icons">
          <div class="notif-status-dot-grey" title="Read"></div>
          <button class="notif-star-btn starred" title="Toggle Favorite">
            <i class="fa-solid fa-star"></i>
          </button>
          <div class="notif-folder-icon-badge">
            <i class="fa-regular fa-folder-open"></i>
          </div>
        </div>

        <div class="notif-msg-text-content">
          <strong>Hello Sales Marketing Team, We've received a product information request from a potential customer.</strong>
        </div>

        <div class="notif-row-right-meta">
          <span class="notif-timestamp-text">5 days ago</span>
          <button class="notif-delete-trash-btn" title="Delete Notification" onclick="deleteNotifRow(this);">
            <i class="fa-regular fa-trash-can"></i>
          </button>
        </div>
      </div>

      <!-- Item 5 (Read, Non-starred) -->
      <div class="notif-row-tile" data-category="all" data-starred="0">
        <div class="notif-row-left-icons">
          <div class="notif-status-dot-grey" title="Read"></div>
          <button class="notif-star-btn" title="Toggle Favorite">
            <i class="fa-regular fa-star"></i>
          </button>
          <div class="notif-folder-icon-badge">
            <i class="fa-regular fa-folder-open"></i>
          </div>
        </div>

        <div class="notif-msg-text-content">
          <strong>Hello Sales Marketing Team, We've received a product information request from a potential customer.</strong>
        </div>

        <div class="notif-row-right-meta">
          <span class="notif-timestamp-text">07 Feb, 2024</span>
          <button class="notif-delete-trash-btn" title="Delete Notification" onclick="deleteNotifRow(this);">
            <i class="fa-regular fa-trash-can"></i>
          </button>
        </div>
      </div>

      <!-- Item 6 (Unread, Non-starred) -->
      <div class="notif-row-tile unread-row" data-category="all" data-starred="0">
        <div class="notif-row-left-icons">
          <div class="notif-status-dot-green" title="Unread"></div>
          <button class="notif-star-btn" title="Toggle Favorite">
            <i class="fa-regular fa-star"></i>
          </button>
          <div class="notif-folder-icon-badge">
            <i class="fa-regular fa-folder-open"></i>
          </div>
        </div>

        <div class="notif-msg-text-content">
          <strong>Hello Sales Marketing Team, A meeting or presentation has been scheduled with a customer/prospect.</strong>
        </div>

        <div class="notif-row-right-meta">
          <span class="notif-timestamp-text">01 Feb, 2024</span>
          <button class="notif-delete-trash-btn" title="Delete Notification" onclick="deleteNotifRow(this);">
            <i class="fa-regular fa-trash-can"></i>
          </button>
        </div>
      </div>

      <!-- Item 7 (Read, Non-starred) -->
      <div class="notif-row-tile" data-category="all" data-starred="0">
        <div class="notif-row-left-icons">
          <div class="notif-status-dot-grey" title="Read"></div>
          <button class="notif-star-btn" title="Toggle Favorite">
            <i class="fa-regular fa-star"></i>
          </button>
          <div class="notif-folder-icon-badge">
            <i class="fa-regular fa-folder-open"></i>
          </div>
        </div>

        <div class="notif-msg-text-content">
          <strong>Hello Sales Marketing Team, This is a reminder to review the contract or proposal currently under....</strong>
        </div>

        <div class="notif-row-right-meta">
          <span class="notif-timestamp-text">28 Jan, 2024</span>
          <button class="notif-delete-trash-btn" title="Delete Notification" onclick="deleteNotifRow(this);">
            <i class="fa-regular fa-trash-can"></i>
          </button>
        </div>
      </div>

      <!-- Item 8 (Read, Non-starred, Archive) -->
      <div class="notif-row-tile" data-category="archive" data-starred="0">
        <div class="notif-row-left-icons">
          <div class="notif-status-dot-grey" title="Read"></div>
          <button class="notif-star-btn" title="Toggle Favorite">
            <i class="fa-regular fa-star"></i>
          </button>
          <div class="notif-folder-icon-badge">
            <i class="fa-regular fa-folder-open"></i>
          </div>
        </div>

        <div class="notif-msg-text-content">
          <strong>Hello Sales Marketing Team, It's time for a follow-up with a customer after their recent purchase/meeting.</strong>
        </div>

        <div class="notif-row-right-meta">
          <span class="notif-timestamp-text">27 Jan, 2024</span>
          <button class="notif-delete-trash-btn" title="Delete Notification" onclick="deleteNotifRow(this);">
            <i class="fa-regular fa-trash-can"></i>
          </button>
        </div>
      </div>

      <!-- Item 9 (Unread, Non-starred) -->
      <div class="notif-row-tile unread-row" data-category="all" data-starred="0">
        <div class="notif-row-left-icons">
          <div class="notif-status-dot-green" title="Unread"></div>
          <button class="notif-star-btn" title="Toggle Favorite">
            <i class="fa-regular fa-star"></i>
          </button>
          <div class="notif-folder-icon-badge">
            <i class="fa-regular fa-folder-open"></i>
          </div>
        </div>

        <div class="notif-msg-text-content">
          <strong>Hello Sales Marketing Team, We've received positive feedback/testimonial from a satisfied customer...</strong>
        </div>

        <div class="notif-row-right-meta">
          <span class="notif-timestamp-text">26 Jan, 2024</span>
          <button class="notif-delete-trash-btn" title="Delete Notification" onclick="deleteNotifRow(this);">
            <i class="fa-regular fa-trash-can"></i>
          </button>
        </div>
      </div>

      <!-- Item 10 (Read, Non-starred, Archive) -->
      <div class="notif-row-tile" data-category="archive" data-starred="0">
        <div class="notif-row-left-icons">
          <div class="notif-status-dot-grey" title="Read"></div>
          <button class="notif-star-btn" title="Toggle Favorite">
            <i class="fa-regular fa-star"></i>
          </button>
          <div class="notif-folder-icon-badge">
            <i class="fa-regular fa-folder-open"></i>
          </div>
        </div>

        <div class="notif-msg-text-content">
          <strong>Hello Sales Marketing Team, This is a reminder regarding an outstanding payment from a customer......</strong>
        </div>

        <div class="notif-row-right-meta">
          <span class="notif-timestamp-text">28 Jan, 2024</span>
          <button class="notif-delete-trash-btn" title="Delete Notification" onclick="deleteNotifRow(this);">
            <i class="fa-regular fa-trash-can"></i>
          </button>
        </div>
      </div>

    </div>

  </div>

</div>

<!-- Interactive JS Logic -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  // 1. Star Toggle Handler
  document.querySelectorAll('.notif-star-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      btn.classList.toggle('starred');
      const icon = btn.querySelector('i');
      if (btn.classList.contains('starred')) {
        icon.className = 'fa-solid fa-star';
        btn.closest('.notif-row-tile').setAttribute('data-starred', '1');
      } else {
        icon.className = 'fa-regular fa-star';
        btn.closest('.notif-row-tile').setAttribute('data-starred', '0');
      }
    });
  });

  // 2. Tab Filter Handler
  const tabs = document.querySelectorAll('.notif-tab-item');
  const rows = document.querySelectorAll('.notif-row-tile');

  // User side: no Archive tab — hide archived-only rows by default
  rows.forEach(row => {
    if (row.getAttribute('data-category') === 'archive') {
      row.style.display = 'none';
    }
  });

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => {
        t.classList.remove('active');
        const badge = t.querySelector('span');
        if (badge) {
          badge.className = 'notif-tab-badge-grey';
        }
      });

      tab.classList.add('active');
      const activeBadge = tab.querySelector('span');
      if (activeBadge) {
        activeBadge.className = 'notif-tab-badge-active';
      }

      const targetCategory = tab.getAttribute('data-tab');
      rows.forEach(row => {
        if (targetCategory === 'all') {
          // Hide archived-only demo rows from main All feed
          row.style.display = row.getAttribute('data-category') === 'archive' ? 'none' : 'flex';
        } else if (targetCategory === 'favorite') {
          row.style.display = row.getAttribute('data-starred') === '1' ? 'flex' : 'none';
        }
      });
      refreshNotifEmptyState();
    });
  });

  refreshNotifEmptyState();

  // 3. Search Filter Handler
  const searchInput = document.getElementById('notif-search-input');
  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      const term = e.target.value.toLowerCase().trim();
      rows.forEach(row => {
        const text = row.querySelector('.notif-msg-text-content').textContent.toLowerCase();
        if (text.includes(term)) {
          row.style.display = 'flex';
        } else {
          row.style.display = 'none';
        }
      });
      refreshNotifEmptyState();
    });
  }
});

// Dropdown Action Functions
function markAllNotifsRead() {
  document.querySelectorAll('.notif-row-tile').forEach(row => {
    row.classList.remove('unread-row');
    const dot = row.querySelector('.notif-status-dot-green');
    if (dot) dot.className = 'notif-status-dot-grey';
  });
}

function favoriteAllNotifs() {
  document.querySelectorAll('.notif-star-btn').forEach(btn => {
    btn.classList.add('starred');
    const icon = btn.querySelector('i');
    if (icon) icon.className = 'fa-solid fa-star';
    const row = btn.closest('.notif-row-tile');
    if (row) row.setAttribute('data-starred', '1');
  });
}

function getVisibleNotifRows() {
  return Array.from(document.querySelectorAll('#notif-items-container .notif-row-tile')).filter((row) => {
    return row.style.display !== 'none';
  });
}

function refreshNotifEmptyState() {
  const emptyState = document.getElementById('notif-empty-state');
  const list = document.getElementById('notif-items-container');
  const visible = getVisibleNotifRows();
  const hasVisible = visible.length > 0;

  if (emptyState) {
    emptyState.classList.toggle('is-hidden', hasVisible);
    const title = emptyState.querySelector('.notif-empty-title');
    const sub = emptyState.querySelector('.notif-empty-subtext');
    const activeTab = document.querySelector('.notif-tab-item.active');
    const tab = activeTab ? activeTab.getAttribute('data-tab') : 'all';

    if (title && sub) {
      if (tab === 'favorite') {
        title.textContent = 'No favorite notifications';
        sub.textContent = 'Star a notification and it will appear in your Favorite list here.';
      } else {
        title.textContent = 'No notifications yet';
        sub.textContent = 'When a new update arrives — board activity, mentions, or alerts — it will show up here.';
      }
    }
  }

  if (list) {
    list.style.display = hasVisible ? 'flex' : 'none';
  }

  updateTotalCount();
}

function clearAllNotifs() {
  const container = document.getElementById('notif-items-container');
  if (container) {
    container.innerHTML = '';
    refreshNotifEmptyState();
  }
}

// Delete Notification Row Function
function deleteNotifRow(btn) {
  const row = btn.closest('.notif-row-tile');
  if (row) {
    row.style.transition = 'all 0.25s ease';
    row.style.opacity = '0';
    row.style.transform = 'translateX(20px)';
    setTimeout(() => {
      row.remove();
      refreshNotifEmptyState();
    }, 250);
  }
}

function updateTotalCount() {
  const remaining = getVisibleNotifRows().length;
  const countText = document.getElementById('notif-total-count-text');
  if (countText) countText.textContent = remaining;

  const allBadge = document.getElementById('count-badge-all');
  const favBadge = document.getElementById('count-badge-favorite');
  if (allBadge) {
    allBadge.textContent = document.querySelectorAll('#notif-items-container .notif-row-tile:not([data-category="archive"])').length;
  }
  if (favBadge) {
    favBadge.textContent = document.querySelectorAll('#notif-items-container .notif-row-tile[data-starred="1"]').length;
  }
}
</script>

<?php require_once VIEWS_PATH . '/layouts/user/footer.php'; ?>
