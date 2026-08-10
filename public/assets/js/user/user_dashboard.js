/**
 * Richmondtech Trello Clone - User Dashboard Charts & Scripts
 * Interactive Chart.js Initializations for User Dashboard Metrics
 */

document.addEventListener('DOMContentLoaded', function () {
  if (typeof Chart === 'undefined') {
    console.warn('Chart.js is not loaded.');
    return;
  }

  // Common Chart Defaults
  Chart.defaults.font.family = "'DM Sans', -apple-system, sans-serif";
  Chart.defaults.color = '#64748B';

  // ==========================================
  // 1. Weekly Sprint Productivity (Bar Chart)
  // ==========================================
  const sprintCtx = document.getElementById('userSprintChart');
  if (sprintCtx) {
    const ctx = sprintCtx.getContext('2d');
    
    // Gradient for Completed Tasks
    const emeraldGradient = ctx.createLinearGradient(0, 0, 0, 300);
    emeraldGradient.addColorStop(0, 'rgba(16, 185, 129, 0.9)');
    emeraldGradient.addColorStop(1, 'rgba(16, 185, 129, 0.25)');

    // Gradient for Assigned Tasks
    const indigoGradient = ctx.createLinearGradient(0, 0, 0, 300);
    indigoGradient.addColorStop(0, 'rgba(99, 102, 241, 0.85)');
    indigoGradient.addColorStop(1, 'rgba(99, 102, 241, 0.2)');

    new Chart(sprintCtx, {
      type: 'bar',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [
          {
            label: 'Completed Tasks',
            data: [4, 6, 8, 5, 9, 3, 3],
            backgroundColor: emeraldGradient,
            borderRadius: 8,
            borderSkipped: false,
            barPercentage: 0.5,
            categoryPercentage: 0.6
          },
          {
            label: 'Assigned Focus',
            data: [6, 7, 9, 7, 10, 4, 3],
            backgroundColor: indigoGradient,
            borderRadius: 8,
            borderSkipped: false,
            barPercentage: 0.5,
            categoryPercentage: 0.6
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'top',
            align: 'end',
            labels: {
              usePointStyle: true,
              boxWidth: 8,
              font: { size: 12, weight: '600' }
            }
          },
          tooltip: {
            backgroundColor: '#0F172A',
            titleFont: { size: 13, weight: '700' },
            bodyFont: { size: 12 },
            padding: 10,
            cornerRadius: 8
          }
        },
        scales: {
          x: {
            grid: { display: false },
            ticks: { font: { size: 12, weight: '600' } }
          },
          y: {
            grid: { color: '#F1F5F9' },
            border: { dash: [4, 4] },
            ticks: { stepSize: 2 }
          }
        }
      }
    });
  }

  // ==========================================
  // 2. Task Priority Allocation (Polar Area Chart)
  // ==========================================
  const polarCtx = document.getElementById('userPriorityPolarChart');
  if (polarCtx) {
    new Chart(polarCtx, {
      type: 'polarArea',
      data: {
        labels: ['High Priority', 'Medium Focus', 'Low Priority', 'In Review'],
        datasets: [{
          data: [5, 4, 3, 2],
          backgroundColor: [
            'rgba(239, 68, 68, 0.8)',   // High (Red)
            'rgba(245, 158, 11, 0.8)',  // Medium (Amber)
            'rgba(16, 185, 129, 0.8)',  // Low (Green)
            'rgba(2, 132, 199, 0.8)'    // Review (Blue)
          ],
          borderWidth: 2,
          borderColor: '#ffffff'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              usePointStyle: true,
              boxWidth: 8,
              font: { size: 11, weight: '600' }
            }
          }
        },
        scales: {
          r: {
            grid: { color: '#F1F5F9' },
            ticks: { display: false }
          }
        }
      }
    });
  }

  // ==========================================
  // 3. Board Workload Distribution (Horizontal Bar)
  // ==========================================
  const workloadCtx = document.getElementById('userWorkloadBarChart');
  if (workloadCtx) {
    new Chart(workloadCtx, {
      type: 'bar',
      data: {
        labels: ['Sprint 24', 'Design System 2.0', 'Q4 Marketing', 'Bug Triage'],
        datasets: [{
          label: 'Progress',
          data: [85, 92, 60, 45],
          backgroundColor: [
            '#4F46E5', // Indigo
            '#059669', // Emerald
            '#7C3AED', // Purple
            '#0284C7'  // Sky Blue
          ],
          borderRadius: 10,
          borderSkipped: false,
          barThickness: 14
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: {
            callbacks: {
              label: function (context) {
                return context.raw + '% Completed';
              }
            }
          }
        },
        scales: {
          x: {
            max: 100,
            grid: { color: '#F1F5F9' },
            ticks: {
              callback: function (val) { return val + '%'; }
            }
          },
          y: {
            grid: { display: false },
            ticks: { font: { size: 12, weight: '600' } }
          }
        }
      }
    });
  }
});
