/**
 * User Notifications Page JavaScript
 * Specific to Notifications View (views/user/notifications.php)
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('User Notifications JS Loaded');

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

      const notifDot = document.querySelector('.notification-dot');
      if (notifDot) notifDot.style.display = 'none';
    });
  }

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

        const dot = item.querySelector('.unread-dot-indicator');
        if (dot) dot.remove();

        toggleBtn.remove();

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
});
