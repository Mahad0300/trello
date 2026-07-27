/**
 * Admin Dashboard Page JavaScript
 * Stats metrics and recent activities
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('Admin Dashboard JS Initialized');

  // Quick Stat Cards Hover & Refresh Effect
  const statCards = document.querySelectorAll('.stat-card');
  statCards.forEach(card => {
    card.addEventListener('mouseenter', () => {
      card.style.transform = 'translateY(-2px)';
      card.style.transition = 'all 0.2s ease';
    });
    card.addEventListener('mouseleave', () => {
      card.style.transform = 'translateY(0)';
    });
  });
});
