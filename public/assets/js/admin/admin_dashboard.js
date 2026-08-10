/**
 * Admin Dashboard Page JavaScript
 * (Matching Reference Design Screenshots)
 */

document.addEventListener('DOMContentLoaded', () => {
  if (typeof Chart === 'undefined') return;

  // 1. Dual Wavy Line Chart (Matching Reference Screenshot 1 & 2)
  const wavyCtx = document.getElementById('wavyLineChart');
  let wavyChart = null;

  if (wavyCtx) {
    wavyChart = new Chart(wavyCtx, {
      type: 'line',
      data: {
        labels: ['1', '2', '3', '4', '5'],
        datasets: [
          {
            label: 'Primary Activity',
            data: [35, 41, 40, 30, 38],
            borderColor: '#10B981',
            borderWidth: 4,
            tension: 0.45,
            fill: false,
            pointRadius: 0,
            pointHoverRadius: 6,
            pointHoverBackgroundColor: '#10B981',
            pointHoverBorderColor: '#FFFFFF',
            pointHoverBorderWidth: 3
          },
          {
            label: 'Secondary Task Stream',
            data: [20, 25, 35, 25, 22],
            borderColor: '#6366F1',
            borderWidth: 4,
            tension: 0.45,
            fill: false,
            pointRadius: 0,
            pointHoverRadius: 6,
            pointHoverBackgroundColor: '#6366F1',
            pointHoverBorderColor: '#FFFFFF',
            pointHoverBorderWidth: 3
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: '#0F172A',
            padding: 10,
            cornerRadius: 8,
            titleFont: { size: 12 },
            bodyFont: { size: 12 }
          }
        },
        scales: {
          x: {
            grid: { display: false },
            ticks: { color: '#94A3B8', font: { size: 12 } }
          },
          y: {
            min: 15,
            max: 45,
            grid: { color: '#F1F5F9' },
            ticks: { color: '#94A3B8', font: { size: 12 }, stepSize: 5 }
          }
        }
      }
    });
  }

  // Time Range Tabs Switcher
  const timeTabs = document.querySelectorAll('.dash-tab-pill');
  if (timeTabs.length && wavyChart) {
    const periodData = {
      daily: {
        labels: ['09:00', '12:00', '15:00', '18:00', '21:00'],
        ds1: [28, 38, 42, 34, 39],
        ds2: [18, 22, 32, 28, 24]
      },
      weekly: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
        ds1: [32, 40, 37, 44, 39],
        ds2: [22, 28, 30, 26, 21]
      },
      monthly: {
        labels: ['1', '2', '3', '4', '5'],
        ds1: [35, 41, 40, 30, 38],
        ds2: [20, 25, 35, 25, 22]
      }
    };

    timeTabs.forEach(tab => {
      tab.addEventListener('click', () => {
        timeTabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const period = tab.dataset.period || 'monthly';
        if (periodData[period]) {
          wavyChart.data.labels = periodData[period].labels;
          wavyChart.data.datasets[0].data = periodData[period].ds1;
          wavyChart.data.datasets[1].data = periodData[period].ds2;
          wavyChart.update();
        }
      });
    });
  }

  // 2. Circular Ring Gauge Chart (Matching Reference Screenshot 1 Right)
  const ringCtx = document.getElementById('circularRingChart');
  if (ringCtx) {
    new Chart(ringCtx, {
      type: 'doughnut',
      data: {
        labels: ['Progress', 'Remaining'],
        datasets: [{
          data: [84, 16],
          backgroundColor: ['#059669', '#E2E8F0'],
          borderWidth: 0,
          borderRadius: 12
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '78%',
        plugins: {
          legend: { display: false },
          tooltip: { enabled: false }
        }
      }
    });
  }

  // 3. Dual Semi-Arc Statistics Gauges (Matching Reference Screenshot 4 Left)
  const topArcCtx = document.getElementById('gaugeTopArc');
  if (topArcCtx) {
    new Chart(topArcCtx, {
      type: 'doughnut',
      data: {
        labels: ['August', 'Remaining'],
        datasets: [{
          data: [51, 49],
          backgroundColor: ['#10B981', '#E2E8F0'],
          borderWidth: 0,
          borderRadius: 10
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        rotation: -90,
        circumference: 180,
        cutout: '76%',
        plugins: {
          legend: { display: false },
          tooltip: { enabled: false }
        }
      }
    });
  }

  const bottomArcCtx = document.getElementById('gaugeBottomArc');
  if (bottomArcCtx) {
    new Chart(bottomArcCtx, {
      type: 'doughnut',
      data: {
        labels: ['July', 'Remaining'],
        datasets: [{
          data: [35, 65],
          backgroundColor: ['#F43F5E', '#E2E8F0'],
          borderWidth: 0,
          borderRadius: 10
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        rotation: 90,
        circumference: 180,
        cutout: '76%',
        plugins: {
          legend: { display: false },
          tooltip: { enabled: false }
        }
      }
    });
  }

  // 4. Speedometer Active Statistics Gauge (Matching Reference Screenshot 4 Right)
  const speedometerCtx = document.getElementById('speedometerChart');
  if (speedometerCtx) {
    new Chart(speedometerCtx, {
      type: 'doughnut',
      data: {
        labels: ['Acc 1', 'Acc 2', 'Acc 3'],
        datasets: [{
          data: [45, 30, 25],
          backgroundColor: ['#9333EA', '#F43F5E', '#3B82F6'],
          borderWidth: 0,
          borderRadius: 8
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        rotation: -90,
        circumference: 180,
        cutout: '78%',
        plugins: {
          legend: { display: false },
          tooltip: { enabled: true }
        }
      }
    });
  }
});
