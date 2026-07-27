<?php
$page_title = 'Dashboard - Trello SaaS';
$page_js = 'dashboard.js';
require_once VIEWS_PATH . '/layouts/user/header.php';
?>

<div class="dash-ref-container">

  <!-- ========================================== -->
  <!-- SECTION 1: HERO WELCOME HEADER & FEATURED PROJECTS (Screenshot 1) -->
  <!-- ========================================== -->
  <div class="dash-hero-header">
    <div>
      <h1 class="dash-hero-title">Hi Mahad! 👋</h1>
      <p class="dash-hero-subtext">Sprint 24 Command Center & Progress Tracking</p>
    </div>
    <div class="dash-task-completed-badge">
      <span>78% Sprint Goal Achieved</span>
      <div class="dash-progress-track-pill">
        <div class="dash-progress-fill-pink" style="width: 78%;"></div>
      </div>
    </div>
  </div>

  <!-- Featured Project Cards Grid -->
  <div class="dash-hero-cards-grid">
    <!-- Project Tile 1: Fintech Core API & Banking App -->
    <div class="dash-hero-tile-pink">
      <div class="dash-tile-top-flex">
        <div class="dash-tile-icon-badge">
          <i class="fa-solid fa-layer-group"></i>
        </div>
        <button class="dash-tile-action-btn" title="Project Actions">
          <i class="fa-solid fa-ellipsis"></i>
        </button>
      </div>
      <div class="dash-tile-title-text">
        Fintech Core API & Mobile App Architecture
      </div>
      <div class="dash-tile-avatar-stack">
        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" alt="Team Member">
        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" alt="Team Member">
        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&q=80" alt="Team Member">
      </div>
    </div>

    <!-- Project Tile 2: Enterprise OAuth & Signup Workflow -->
    <div class="dash-hero-tile-purple">
      <div class="dash-tile-top-flex">
        <div class="dash-tile-icon-badge">
          <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div class="dash-tile-emoji-badge">
          👌
        </div>
      </div>
      <div class="dash-tile-title-text">
        Enterprise SSO & OAuth Authentication Flow
      </div>
      <div class="dash-tile-avatar-stack">
        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&q=80" alt="Team Member">
        <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=100&q=80" alt="Team Member">
        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80" alt="Team Member">
      </div>
    </div>
  </div>


  <!-- ========================================== -->
  <!-- SECTION 2: THREE PROJECT MANAGEMENT WIDGETS (Screenshot 2) -->
  <!-- ========================================== -->
  <div class="dash-widget-grid-3">

    <!-- Widget 1: My Assigned Tasks -->
    <div class="dash-card-white">
      <div class="dash-widget-header">
        <h3 class="dash-widget-title">My Assigned Tasks</h3>
        <button class="dash-circle-btn" title="Create Task" data-modal-target="add-card-modal">
          <i class="fa-solid fa-plus"></i>
        </button>
      </div>

      <div class="dash-filter-row">
        <button class="dash-filter-pill-active">Today</button>
        <button class="dash-filter-pill-inactive">Tomorrow</button>
      </div>

      <div>
        <span class="dash-ongoing-select-pill">
          <strong class="dash-pill-bold">12</strong> Active Sprint Cards <i class="fa-solid fa-chevron-down dash-pill-chevron"></i>
        </span>
      </div>

      <!-- Active Task Tile -->
      <div class="dash-task-peach-tile">
        <div class="dash-task-card-top">
          <div class="dash-icon-fox" title="Framer Design Token">
            🦊
          </div>
          <div class="dash-check-badge" title="In Review">
            <i class="fa-solid fa-check"></i>
          </div>
        </div>
        <h4 class="dash-task-title">BrightBridge - Design System 2.0</h4>
        <p class="dash-task-desc">
          Create reusable Framer components & Figma design tokens for Sprint 24.
        </p>
      </div>
    </div>


    <!-- Widget 2: Projects Task Status Breakdown (Donut Chart.js) -->
    <div class="dash-card-white text-center">
      <div class="dash-widget-header">
        <h3 class="dash-widget-title">Tasks Breakdown</h3>
        <a href="<?= route('user/board-detail') ?>" class="dash-circle-btn" title="Open Board">
          <i class="fa-solid fa-arrow-up-right-from-square"></i>
        </a>
      </div>

      <!-- Real Chart.js Canvas -->
      <div class="dash-donut-container">
        <canvas id="projectsDonutChart"></canvas>
      </div>

      <!-- Legend Row -->
      <div class="dash-legend-row">
        <span><i class="fa-solid fa-circle dot-orange"></i> In Progress: 14</span>
        <span><i class="fa-solid fa-circle dot-blue"></i> Completed: 32</span>
      </div>
      <div class="dash-legend-sub">
        Backlog & To-Do: 54
      </div>
    </div>


    <!-- Widget 3: Sprint Velocity & Story Points Burndown (Line Chart.js) -->
    <div class="dash-card-white">
      <div class="dash-widget-header">
        <h3 class="dash-widget-title">Sprint Velocity (Story Pts)</h3>
        <button class="dash-circle-btn" title="Velocity Metrics">
          <i class="fa-solid fa-sliders"></i>
        </button>
      </div>

      <!-- Real Chart.js Line Canvas -->
      <div class="dash-chart-container">
        <canvas id="incomeExpenseLineChart"></canvas>
      </div>
    </div>

  </div>


  <!-- ========================================== -->
  <!-- SECTION 3: PROJECT TEAMS & SPRINT WORK SCHEDULE TIMELINE (Screenshot 3) -->
  <!-- ========================================== -->
  
  <!-- 4 Project Teams Cards Row -->
  <div class="dash-teams-grid">
    <!-- Team 1: Core API Engineering (Active Highlighted) -->
    <div class="dash-team-card dash-team-card-active">
      <div class="dash-team-header">
        <div class="dash-team-left-flex">
          <div class="dash-team-icon-clover">
            🍀
          </div>
          <div>
            <h4 class="dash-team-name">Core API Team</h4>
            <span class="dash-team-sub">Python & Microservices</span>
          </div>
        </div>
        <i class="fa-solid fa-ellipsis-vertical dash-team-options"></i>
      </div>

      <div class="dash-tile-avatar-stack mb-12">
        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&q=80" alt="Avatar">
        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" alt="Avatar">
        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" alt="Avatar">
        <div class="dash-avatar-add-btn">+</div>
      </div>

      <div class="dash-progress-meta-row">
        <span>Sprint Progress</span>
        <span class="text-primary-purple">80%</span>
      </div>
      <div class="dash-progress-bar-track">
        <div class="progress-bar-fill-80"></div>
      </div>

      <div class="dash-team-footer">
        <span class="dash-time-pill-purple">🕒 1 Week Left</span>
        <div class="gap-8 flex-row">
          <span>💬 12</span>
          <span>📎 7</span>
        </div>
      </div>
    </div>

    <!-- Team 2: UI/UX Product Design -->
    <div class="dash-team-card">
      <div class="dash-team-header">
        <div class="dash-team-left-flex">
          <div class="dash-team-icon-palette">
            🎨
          </div>
          <div>
            <h4 class="dash-team-name">UI/UX Product Design</h4>
            <span class="dash-team-sub">Figma Tokens</span>
          </div>
        </div>
        <i class="fa-solid fa-ellipsis-vertical dash-team-options"></i>
      </div>

      <div class="dash-tile-avatar-stack mb-12">
        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&q=80" alt="Avatar">
        <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=100&q=80" alt="Avatar">
        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80" alt="Avatar">
      </div>

      <div class="dash-progress-meta-row">
        <span>Sprint Progress</span>
        <span class="text-primary-purple">90%</span>
      </div>
      <div class="dash-progress-bar-track">
        <div class="progress-bar-fill-90"></div>
      </div>

      <div class="dash-team-footer">
        <span class="dash-time-pill-purple">🕒 5 Days Left</span>
        <div class="gap-8 flex-row">
          <span>💬 14</span>
          <span>📎 4</span>
        </div>
      </div>
    </div>

    <!-- Team 3: Frontend Web Apps -->
    <div class="dash-team-card">
      <div class="dash-team-header">
        <div class="dash-team-left-flex">
          <div class="dash-team-icon-laptop">
            💻
          </div>
          <div>
            <h4 class="dash-team-name">Frontend Web Apps</h4>
            <span class="dash-team-sub">React & TypeScript</span>
          </div>
        </div>
        <i class="fa-solid fa-ellipsis-vertical dash-team-options"></i>
      </div>

      <div class="dash-tile-avatar-stack mb-12">
        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" alt="Avatar">
        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" alt="Avatar">
      </div>

      <div class="dash-progress-meta-row">
        <span>Sprint Progress</span>
        <span class="text-info-blue">70%</span>
      </div>
      <div class="dash-progress-bar-track">
        <div class="progress-bar-fill-70"></div>
      </div>

      <div class="dash-team-footer">
        <span class="dash-time-pill-blue">🕒 2 Weeks Left</span>
        <div class="gap-8 flex-row">
          <span>💬 8</span>
          <span>📎 6</span>
        </div>
      </div>
    </div>

    <!-- Team 4: DevOps & Cloud Infra -->
    <div class="dash-team-card">
      <div class="dash-team-header">
        <div class="dash-team-left-flex">
          <div class="dash-team-icon-cloud">
            ☁️
          </div>
          <div>
            <h4 class="dash-team-name">DevOps & Infra</h4>
            <span class="dash-team-sub">Docker & AWS</span>
          </div>
        </div>
        <i class="fa-solid fa-ellipsis-vertical dash-team-options"></i>
      </div>

      <div class="dash-tile-avatar-stack mb-12">
        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&q=80" alt="Avatar">
        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80" alt="Avatar">
      </div>

      <div class="dash-progress-meta-row">
        <span>Sprint Progress</span>
        <span class="text-orange">40%</span>
      </div>
      <div class="dash-progress-bar-track">
        <div class="progress-bar-fill-40"></div>
      </div>

      <div class="dash-team-footer">
        <span class="dash-time-pill-orange">🕒 1 Week Left</span>
        <div class="gap-8 flex-row">
          <span>💬 19</span>
          <span>📎 10</span>
        </div>
      </div>
    </div>
  </div>


  <!-- Full Width Work Schedule & Sprint Timeline Grid -->
  <div class="dash-timeline-and-chat-grid">

    <!-- Work Schedule Timeline Card -->
    <div class="dash-card-white">
      <div class="dash-timeline-header">
        <div class="dash-timeline-title">
          <i class="fa-regular fa-calendar-days text-primary"></i> Sprint 24 Timeline • 11 July, 2026
        </div>
        <div class="dash-timeline-filters">
          <span class="dash-filter-active">Daily</span>
          <span class="cursor-pointer">Weekly</span>
          <span class="cursor-pointer">Monthly</span>
          <span class="cursor-pointer">Quarterly</span>
        </div>
      </div>

      <!-- Schedule Rows -->
      <!-- Row 1: API Architecture & Auth -->
      <div class="dash-timeline-row">
        <span class="dash-row-title-active">API Architecture & Auth</span>
        <div class="dash-timeline-bar-purple">
          <div class="align-center gap-6 flex-row">
            <div class="dash-tile-avatar-stack">
              <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&q=80">
              <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80">
            </div>
            <span>Core Endpoint Review</span>
          </div>
          <span class="dash-pct-pill">85%</span>
        </div>
      </div>

      <!-- Row 2: Mobile App Redesign -->
      <div class="dash-timeline-row">
        <span class="dash-row-title">Mobile App UI Redesign</span>
        <div class="flex-center">
          <div class="dash-timeline-bar-green w-280">
            <div class="align-center gap-6 flex-row">
              <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" class="avatar-sm">
              <span>Final QA Test</span>
            </div>
            <span class="dash-pct-pill">60%</span>
          </div>
        </div>
      </div>

      <!-- Row 3: Landing Page Wireframe -->
      <div class="dash-timeline-row">
        <span class="dash-row-title">Landing Page Wireframe</span>
        <div class="timeline-pl-80">
          <div class="dash-timeline-bar-vibrant-green w-320">
            <div class="align-center gap-6 flex-row">
              <div class="dash-tile-avatar-stack">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&q=80">
                <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=100&q=80">
              </div>
              <span>Wireframe Approval</span>
            </div>
            <span class="dash-pct-pill text-success">50%</span>
          </div>
        </div>
      </div>

      <!-- Row 4: Admin Portal Prototyping -->
      <div class="dash-timeline-row">
        <span class="dash-row-title">Admin Portal Prototyping</span>
        <div class="timeline-pr-60">
          <div class="dash-timeline-bar-pink w-280">
            <div class="align-center gap-6 flex-row">
              <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" class="avatar-sm">
              <span>Staging Deploy</span>
            </div>
            <span class="dash-pct-pill text-danger">55%</span>
          </div>
        </div>
      </div>

      <!-- Row 5: Sprint Demo & Retrospective -->
      <div class="dash-timeline-row">
        <span class="dash-row-title">Sprint Demo & Retro</span>
        <div class="timeline-pl-40">
          <div class="dash-timeline-bar-orange w-360">
            <div class="align-center gap-6 flex-row">
              <div class="dash-tile-avatar-stack">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&q=80">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80">
              </div>
              <span>Client Review & Retrospective</span>
            </div>
            <span class="dash-pct-pill text-orange">90%</span>
          </div>
        </div>
      </div>

      <!-- Time Stamps Bar -->
      <div class="dash-timestamps-bar">
        <span>09:00 AM</span><span>10:00 AM</span><span>11:00 AM</span><span>12:00 PM</span><span>01:00 PM</span><span>02:00 PM</span>
      </div>
    </div>

  </div>


  <!-- ========================================== -->
  <!-- SECTION 4: RECENT PROJECT MANAGEMENT ACTIVITY STREAM (Screenshot 4) -->
  <!-- ========================================== -->
  <div class="dash-card-white mt-10">
    <div class="dash-act-header">
      <h3 class="dash-act-title">Recent Activity Stream & Audit Log</h3>
      <i class="fa-solid fa-ellipsis-vertical dash-act-options"></i>
    </div>

    <div class="dash-act-stack">
      <!-- Vertical Dotted Line -->
      <div class="dash-vertical-line"></div>

      <!-- Item 1 -->
      <div class="dash-act-item">
        <div class="dash-act-left-flex">
          <div class="pos-relative">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&q=80" class="dash-act-avatar">
            <div class="dash-act-dot-green"></div>
          </div>
          <div>
            <h4 class="dash-act-username">Leslie Alexander</h4>
            <p class="dash-act-text">Moved card <strong class="text-dark-slate">"RESTful API Setup"</strong> to <span class="badge badge-success dash-done-badge">Done</span> column in Sprint 24 Architecture.</p>
          </div>
        </div>
        <span class="dash-act-time">Just now</span>
      </div>

      <!-- Item 2 -->
      <div class="dash-act-item">
        <div class="dash-act-left-flex">
          <div class="pos-relative">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" class="dash-act-avatar">
            <div class="dash-act-dot-orange"></div>
          </div>
          <div>
            <h4 class="dash-act-username">Jenny Wilson</h4>
            <p class="dash-act-text">Attached Figma design file <strong class="text-dark-slate">"Mobile_App_v2.fig"</strong> to User Profile Card.</p>
          </div>
        </div>
        <span class="dash-act-time">3 hours ago</span>
      </div>

      <!-- Item 3 -->
      <div class="dash-act-item">
        <div class="dash-act-left-flex">
          <div class="pos-relative">
            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80" class="dash-act-avatar">
            <div class="dash-act-dot-orange"></div>
          </div>
          <div>
            <h4 class="dash-act-username">Guy Hawkins</h4>
            <p class="dash-act-text">Resolved high priority blocker: <strong class="text-dark-slate">"Database Pool Connection Timeout"</strong> on Staging Server.</p>
          </div>
        </div>
        <span class="dash-act-time">16 hours ago</span>
      </div>

      <!-- Item 4 -->
      <div class="dash-act-item">
        <div class="dash-act-left-flex">
          <div class="pos-relative">
            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&q=80" class="dash-act-avatar">
            <div class="dash-act-dot-green"></div>
          </div>
          <div>
            <h4 class="dash-act-username">Robert Fox</h4>
            <p class="dash-act-text">Created new board: <strong class="text-dark-slate">"Q4 Growth Marketing & Launch Roadmap"</strong>.</p>
          </div>
        </div>
        <span class="dash-act-time">3 hours ago</span>
      </div>

      <!-- Item 5 -->
      <div class="dash-act-item">
        <div class="dash-act-left-flex">
          <div class="pos-relative">
            <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=100&q=80" class="dash-act-avatar">
            <div class="dash-act-dot-orange"></div>
          </div>
          <div>
            <h4 class="dash-act-username">Jacob Jones</h4>
            <p class="dash-act-text">Assigned 4 new backlog cards to <strong class="text-dark-slate">Mahad Bukhari</strong> in Sprint 24 Architecture.</p>
          </div>
        </div>
        <span class="dash-act-time">8 hours ago</span>
      </div>
    </div>
  </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // 1. Projects Overview Donut Chart
  const donutCtx = document.getElementById('projectsDonutChart');
  if (donutCtx) {
    new Chart(donutCtx, {
      type: 'doughnut',
      data: {
        labels: ['In Progress', 'Completed', 'Backlog'],
        datasets: [{
          data: [14, 32, 54],
          backgroundColor: ['#F97316', '#0284C7', '#CBD5E1'],
          borderWidth: 0,
          hoverOffset: 6
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '72%',
        plugins: {
          legend: { display: false },
          tooltip: {
            callbacks: {
              label: function(context) {
                return ' ' + context.label + ': ' + context.raw + ' Cards';
              }
            }
          }
        }
      }
    });
  }

  // 2. Sprint Velocity Line Chart (Completed vs Planned Story Points)
  const lineCtx = document.getElementById('incomeExpenseLineChart');
  if (lineCtx) {
    new Chart(lineCtx, {
      type: 'line',
      data: {
        labels: ['Wk 1', 'Wk 2', 'Wk 3', 'Wk 4', 'Wk 5', 'Wk 6'],
        datasets: [
          {
            label: 'Completed Pts',
            data: [42, 68, 55, 78, 92, 110],
            borderColor: '#0284C7',
            backgroundColor: 'rgba(2, 132, 199, 0.1)',
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointRadius: 3,
            pointHoverRadius: 6
          },
          {
            label: 'Planned Pts',
            data: [35, 50, 48, 60, 75, 90],
            borderColor: '#F97316',
            backgroundColor: 'rgba(249, 115, 22, 0.1)',
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointRadius: 3,
            pointHoverRadius: 6
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true,
            position: 'top',
            align: 'end',
            labels: {
              boxWidth: 8,
              usePointStyle: true,
              font: { size: 11, weight: '600' }
            }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                return ' ' + context.dataset.label + ': ' + context.raw + ' Story Pts';
              }
            }
          }
        },
        scales: {
          x: {
            grid: { display: false },
            ticks: { font: { size: 11, weight: '600' }, color: '#94A3B8' }
          },
          y: {
            display: false,
            grid: { display: false }
          }
        }
      }
    });
  }
});
</script>

<?php require_once VIEWS_PATH . '/layouts/user/footer.php'; ?>
