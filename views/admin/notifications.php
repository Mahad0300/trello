<?php
$page_js = 'admin_notifications.js';
require_once VIEWS_PATH . '/layouts/admin/header.php';
?>

<div class="notif-page-bg">

  <!-- Main Notification Card Wrapper -->
  <div class="notif-ref-card">

    <!-- Page Header Toolbar (Consistent with User Panel) -->
    <div class="notif-header-toolbar mb-24">
      <div class="notif-header-left">
        <div class="notif-icon-badge notif-icon-badge-gradient">
          <i class="fa-solid fa-bell icon-primary"></i>
        </div>
        <div>
          <h1 class="notif-main-title">System Audit & Notifications</h1>
          <p class="notif-subtext">Monitor administrative events, security policy updates, and user activity alerts.</p>
        </div>
      </div>

      <!-- Working Options Dropdown Menu -->
      <div class="notif-header-right">
        <div class="dropdown-wrapper">
          <button class="dropdown-toggle btn btn-secondary btn-sm" title="Notification Options">
            <i class="fa-solid fa-ellipsis"></i> Options
          </button>
          <div class="dropdown-menu notif-dropdown-menu">
            <div class="dropdown-section-header">Admin Actions</div>
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

    <!-- Sub Toolbar Row -->
    <div class="notif-sub-toolbar-row">
      <div class="notif-summary-count">
        <span id="notif-total-count-text"><?= count($notifications) ?></span> System Notifications
      </div>
      <div class="notif-search-box-pill">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <input type="text" id="notif-search-input" placeholder="Search system notifications...">
      </div>
    </div>

    <!-- Filter Tabs Row -->
    <div class="notif-tabs-header-row">
      <button class="notif-tab-item active" data-tab="all">
        <span class="notif-tab-badge-pink" id="count-badge-all"><?= count($notifications) ?></span> All
      </button>
      <button class="notif-tab-item" data-tab="favorite">
        <span class="notif-tab-badge-grey" id="count-badge-favorite">2</span> Favorite
      </button>
    </div>

    <!-- Notification Rows Stack -->
    <div class="notif-list-stack" id="notif-items-container">
      <?php foreach ($notifications as $n): ?>
        <div class="notif-row-tile <?= $n['unread'] ? 'unread-row' : '' ?>" data-category="all" data-starred="<?= $n['starred'] ? '1' : '0' ?>">
          <div class="notif-row-left-icons">
            <div class="notif-status-dot-<?= $n['unread'] ? 'green' : 'grey' ?>" title="<?= $n['unread'] ? 'Unread' : 'Read' ?>"></div>
            <button class="notif-star-btn <?= $n['starred'] ? 'starred' : '' ?>" title="Toggle Favorite">
              <i class="<?= $n['starred'] ? 'fa-solid' : 'fa-regular' ?> fa-star"></i>
            </button>
            <div class="notif-folder-icon-badge">
              <i class="fa-solid <?= $n['type'] === 'security' ? 'fa-shield-halved' : ($n['type'] === 'user' ? 'fa-user-plus' : 'fa-server') ?>"></i>
            </div>
          </div>

          <div class="notif-msg-text-content">
            <strong><?= sanitize($n['title']) ?>:</strong> <?= sanitize($n['message']) ?>
          </div>

          <div class="notif-row-right-meta">
            <span class="notif-timestamp-text"><?= $n['time'] ?></span>
            <button class="notif-delete-trash-btn" title="Delete Notification" onclick="deleteNotifRow(this);">
              <i class="fa-regular fa-trash-can"></i>
            </button>
          </div>
        </div>
      <?php endforeach; ?>
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

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => {
        t.classList.remove('active');
        const badge = t.querySelector('span');
        if (badge) badge.className = 'notif-tab-badge-grey';
      });

      tab.classList.add('active');
      const activeBadge = tab.querySelector('span');
      if (activeBadge) activeBadge.className = 'notif-tab-badge-pink';

      const targetCategory = tab.getAttribute('data-tab');
      rows.forEach(row => {
        if (targetCategory === 'all') {
          row.style.display = 'flex';
        } else if (targetCategory === 'favorite') {
          row.style.display = row.getAttribute('data-starred') === '1' ? 'flex' : 'none';
        }
      });
    });
  });

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
    });
  }
});

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

function clearAllNotifs() {
  const container = document.getElementById('notif-items-container');
  if (container) {
    container.innerHTML = '<div class="notif-empty-state" style="padding: 24px; text-align: center; color: var(--text-muted);">No system notifications available.</div>';
    updateTotalCount();
  }
}

function deleteNotifRow(btn) {
  const row = btn.closest('.notif-row-tile');
  if (row) {
    row.style.transition = 'all 0.25s ease';
    row.style.opacity = '0';
    row.style.transform = 'translateX(20px)';
    setTimeout(() => {
      row.remove();
      updateTotalCount();
    }, 250);
  }
}

function updateTotalCount() {
  const remaining = document.querySelectorAll('.notif-row-tile').length;
  const countText = document.getElementById('notif-total-count-text');
  if (countText) countText.textContent = remaining;
}
</script>

<?php require_once VIEWS_PATH . '/layouts/admin/footer.php'; ?>
