/**
 * Admin Dashboard Page JavaScript
 * Initializes Chart.js Wavy Curves, Cutout Donut Ring, Speedometer Gauge & Interactive Time Pills
 */

document.addEventListener('DOMContentLoaded', () => {
  initWavyLineChart();
  initDonutChart();
  initGaugeChart();
  initTimePillsToggle();
});

// Global reference for Wavy Chart
let wavyChartInstance = null;

/**
 * 1. Dual Wavy Line Chart (Task Velocity & Workload)
 * Inspired by Reference Image 1 & Image 2
 */
function initWavyLineChart() {
  const canvas = document.getElementById('adminWavyLineChart');
  if (!canvas || typeof Chart === 'undefined') return;

  const ctx = canvas.getContext('2d');

  // Gradient Fills
  const gradientGreen = ctx.createLinearGradient(0, 0, 0, 250);
  gradientGreen.addColorStop(0, 'rgba(16, 185, 129, 0.25)');
  gradientGreen.addColorStop(1, 'rgba(16, 185, 129, 0.00)');

  const gradientBlue = ctx.createLinearGradient(0, 0, 0, 250);
  gradientBlue.addColorStop(0, 'rgba(79, 70, 229, 0.20)');
  gradientBlue.addColorStop(1, 'rgba(79, 70, 229, 0.00)');

  const monthlyData = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
    datasets: [
      {
        label: 'Cards Completed',
        data: [35, 41, 38, 30, 38, 48, 55],
        borderColor: '#10B981',
        backgroundColor: gradientGreen,
        borderWidth: 3.5,
        tension: 0.45,
        fill: true,
        pointBackgroundColor: '#10B981',
        pointBorderColor: '#FFFFFF',
        pointBorderWidth: 2,
        pointRadius: 5,
        pointHoverRadius: 7
      },
      {
        label: 'Cards Created',
        data: [20, 25, 35, 25, 22, 34, 42],
        borderColor: '#4F46E5',
        backgroundColor: gradientBlue,
        borderWidth: 3.5,
        tension: 0.45,
        fill: true,
        pointBackgroundColor: '#4F46E5',
        pointBorderColor: '#FFFFFF',
        pointBorderWidth: 2,
        pointRadius: 5,
        pointHoverRadius: 7
      }
    ]
  };

  wavyChartInstance = new Chart(ctx, {
    type: 'line',
    data: monthlyData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      interaction: {
        mode: 'index',
        intersect: false
      },
      plugins: {
        legend: {
          display: true,
          position: 'top',
          align: 'end',
          labels: {
            usePointStyle: true,
            boxWidth: 8,
            font: { family: 'DM Sans', size: 12.5, weight: '600' }
          }
        },
        tooltip: {
          backgroundColor: '#0F172A',
          titleFont: { family: 'Syne', size: 13, weight: '700' },
          bodyFont: { family: 'DM Sans', size: 12 },
          padding: 12,
          cornerRadius: 10
        }
      },
      layout: {
        padding: {
          bottom: 12,
          top: 4
        }
      },
      scales: {
        x: {
          grid: { display: false },
          ticks: { font: { family: 'DM Sans', size: 12 }, color: '#94A3B8' }
        },
        y: {
          grid: {
            color: 'rgba(226, 232, 240, 0.6)',
            borderDash: [5, 5]
          },
          ticks: { font: { family: 'DM Sans', size: 12 }, color: '#94A3B8' }
        }
      }
    }
  });
}

/**
 * 2. Cutout Donut Ring Chart (Platform Workload Completion)
 * Inspired by Reference Image 1 Right
 */
function initDonutChart() {
  const canvas = document.getElementById('adminDonutChart');
  if (!canvas || typeof Chart === 'undefined') return;

  const ctx = canvas.getContext('2d');

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Engineering', 'Marketing', 'Design System', 'Operations'],
      datasets: [{
        data: [42, 28, 18, 12],
        backgroundColor: ['#10B981', '#0D9488', '#9333EA', '#CBD5E1'],
        borderWidth: 0,
        hoverOffset: 6
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '78%',
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: '#0F172A',
          titleFont: { family: 'Syne', size: 13, weight: '700' },
          bodyFont: { family: 'DM Sans', size: 12 },
          padding: 10,
          cornerRadius: 8,
          callbacks: {
            label: function(context) {
              return ' ' + context.label + ': ' + context.parsed + '% Workload';
            }
          }
        }
      }
    }
  });
}

/**
 * 3. Semi-Circle Gauge Speedometer Chart
 * Inspired by Reference Image 4
 */
function initGaugeChart() {
  const canvas = document.getElementById('adminGaugeChart');
  if (!canvas || typeof Chart === 'undefined') return;

  const ctx = canvas.getContext('2d');

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['High Speed Velocity', 'Remaining Buffer'],
      datasets: [{
        data: [98, 2],
        backgroundColor: ['#4F46E5', '#E2E8F0'],
        borderWidth: 0,
        borderRadius: 4
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      circumference: 180,
      rotation: -90,
      cutout: '80%',
      plugins: {
        legend: { display: false },
        tooltip: { enabled: false }
      }
    }
  });
}

/**
 * 4. Time Pills Filter Toggle Interactivity (Daily, Weekly, Monthly)
 */
function initTimePillsToggle() {
  const timePills = document.querySelectorAll('#chart-time-toggle .time-pill-btn');
  if (!timePills || !wavyChartInstance) return;

  const datasetsByPeriod = {
    daily: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      completed: [12, 19, 15, 22, 18, 25, 28],
      created: [8, 14, 10, 15, 12, 18, 20]
    },
    weekly: {
      labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
      completed: [120, 145, 160, 190],
      created: [90, 110, 125, 140]
    },
    monthly: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
      completed: [35, 41, 38, 30, 38, 48, 55],
      created: [20, 25, 35, 25, 22, 34, 42]
    }
  };

  timePills.forEach(pill => {
    pill.addEventListener('click', () => {
      timePills.forEach(p => p.classList.remove('active'));
      pill.classList.add('active');

      const period = pill.getAttribute('data-period') || 'monthly';
      const dataSet = datasetsByPeriod[period] || datasetsByPeriod['monthly'];

      wavyChartInstance.data.labels = dataSet.labels;
      wavyChartInstance.data.datasets[0].data = dataSet.completed;
      wavyChartInstance.data.datasets[1].data = dataSet.created;
      wavyChartInstance.update();
    });
  });
}
