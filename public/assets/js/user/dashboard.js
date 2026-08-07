/**
 * User Dashboard Page JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  const starBtn = document.querySelector('.star-btn');
  if (starBtn) {
    starBtn.addEventListener('click', () => {
      const starred = starBtn.classList.toggle('starred');
      starBtn.textContent = starred ? '★' : '☆';
    });
  }

  const dashTabBtns = document.querySelectorAll('[data-dash-filter]');
  dashTabBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const filter = btn.getAttribute('data-dash-filter');

      dashTabBtns.forEach((b) => b.classList.remove('active'));
      btn.classList.add('active');

      document.querySelectorAll('.dash-activity-item').forEach((item) => {
        const visible = filter === 'all' || item.getAttribute('data-type') === filter;
        item.classList.toggle('is-search-hidden', !visible);
      });
    });
  });
});
