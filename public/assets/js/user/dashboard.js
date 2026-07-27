/**
 * User Dashboard Page JavaScript
 * Specific to User Dashboard View (views/user/dashboard.php)
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('User Dashboard JS Loaded');

  // Star Toggle Button
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

  // Dashboard Activity Tab Filters (if present)
  const dashTabBtns = document.querySelectorAll('[data-dash-filter]');
  dashTabBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const filter = btn.getAttribute('data-dash-filter');
      
      dashTabBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const items = document.querySelectorAll('.dash-activity-item');
      items.forEach(item => {
        if (filter === 'all' || item.getAttribute('data-type') === filter) {
          item.style.display = 'flex';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });
});
