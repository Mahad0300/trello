<?php
$page_title = 'User Dashboard - Richmondtech';
$page_js = 'user/user_dashboard.js';
require_once VIEWS_PATH . '/layouts/user/header.php';
?>

<div class="dashboard-wrapper p-24">

  <!-- 1. PERSONALIZED USER HERO BANNER -->
  <div class="dash-hero-banner mb-24">
    <div class="hero-banner-content">
      <h1 class="hero-banner-title">Welcome back, Chris! 👋</h1>
      <p class="hero-banner-subtitle">
        Here is your personal workspace velocity, active boards, assigned task focus, and real-time team activity timeline.
      </p>
      <div class="hero-banner-actions">
        <button type="button" class="btn btn-hero-white" data-modal-target="create-board-modal">
          <i class="fa-solid fa-plus mr-6"></i> Create Board
        </button>
        <a href="#my-focus-tasks" class="btn btn-hero-outline">
          <i class="fa-solid fa-list-check mr-6"></i> My Focus Tasks
        </a>
        <a href="<?= route('user/workspaces') ?>" class="btn btn-hero-outline">
          <i class="fa-solid fa-star mr-6"></i> Starred Boards
        </a>
      </div>
    </div>
    <div class="hero-banner-graphics">
      <div class="hero-circle-shape shape-1"></div>
      <div class="hero-circle-shape shape-2"></div>
    </div>
  </div>

  <!-- 2. TRUE MASONRY 2-COLUMN ASYMMETRIC GRID CONTAINER -->
  <div class="dash-true-masonry-container">

    <!-- LEFT MAIN COLUMN (65% Width) -->
    <div class="dash-masonry-col-main">

      <!-- 4 Top User KPI Cards (with Distinct SVG Sparklines) -->
      <div class="dash-kpi-grid mb-24">
        <!-- KPI 1: Active Boards -->
        <div class="dash-card-box kpi-box">
          <div class="kpi-header-row">
            <span class="kpi-title-text">Active Boards</span>
            <div class="kpi-sparkline-wrap">
              <svg width="96" height="44" viewBox="0 0 96 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 36 C 18 12, 30 38, 44 16 C 56 2, 66 34, 78 18 C 85 8, 89 16, 92 8" stroke="#0D9488" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              </svg>
            </div>
          </div>
          <div class="kpi-main-val"><?= (int)($stats['active_boards'] ?? 5) ?></div>
          <div class="kpi-footer-row">
            <span class="badge-trend badge-trend-up">
              <i class="fa-solid fa-star"></i> 3 Starred
            </span>
            <span class="kpi-sub-text">Workspaces</span>
          </div>
        </div>

        <!-- KPI 2: Assigned Tasks -->
        <div class="dash-card-box kpi-box">
          <div class="kpi-header-row">
            <span class="kpi-title-text">Assigned Tasks</span>
            <div class="kpi-sparkline-wrap">
              <svg width="96" height="44" viewBox="0 0 96 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 34 C 16 18, 26 38, 40 18 C 52 4, 64 32, 76 16 C 84 6, 88 12, 92 6" stroke="#6366F1" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              </svg>
            </div>
          </div>
          <div class="kpi-main-val"><?= (int)($stats['assigned_tasks'] ?? 14) ?></div>
          <div class="kpi-footer-row">
            <span class="badge-trend badge-trend-up">
              <i class="fa-solid fa-clock"></i> In Progress
            </span>
            <span class="kpi-sub-text">4 Boards</span>
          </div>
        </div>

        <!-- KPI 3: Tasks Completed -->
        <div class="dash-card-box kpi-box">
          <div class="kpi-header-row">
            <span class="kpi-title-text">Tasks Completed</span>
            <div class="kpi-sparkline-wrap">
              <svg width="96" height="44" viewBox="0 0 96 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 32 C 14 10, 24 38, 38 12 C 48 38, 62 6, 74 28 C 82 14, 88 8, 92 5" stroke="#10B981" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              </svg>
            </div>
          </div>
          <div class="kpi-main-val"><?= (int)($stats['completed_tasks'] ?? 38) ?></div>
          <div class="kpi-footer-row">
            <span class="badge-trend badge-trend-up">
              <i class="fa-solid fa-arrow-trend-up"></i> +86%
            </span>
            <span class="kpi-sub-text">Rate</span>
          </div>
        </div>

        <!-- KPI 4: Due Soon -->
        <div class="dash-card-box kpi-box">
          <div class="kpi-header-row">
            <span class="kpi-title-text">Due Soon</span>
            <div class="kpi-sparkline-wrap">
              <svg width="96" height="44" viewBox="0 0 96 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 38 C 18 22, 28 8, 40 24 C 52 40, 64 12, 76 18 C 84 22, 88 10, 92 4" stroke="#EF4444" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              </svg>
            </div>
          </div>
          <div class="kpi-main-val"><?= (int)($stats['due_soon'] ?? 3) ?></div>
          <div class="kpi-footer-row">
            <span class="badge-trend status-inactive">
              <i class="fa-solid fa-triangle-exclamation"></i> Action Req.
            </span>
            <span class="kpi-sub-text">This Week</span>
          </div>
        </div>
      </div>

      <!-- Chart 1 Box: Weekly Sprint Productivity (Grouped Bar Chart) -->
      <div class="dash-card-box chart-wavy-box mb-24">
        <div class="chart-box-header mb-16">
          <div>
            <span class="chart-kicker-title">WEEKLY SPRINT VELOCITY</span>
            <div class="chart-amount-row mt-4">
              <h2 class="chart-big-amount">92% Productivity</h2>
              <span class="chart-unit-text">Score</span>
            </div>
          </div>
          <div class="chart-time-pills">
            <button type="button" class="time-pill-btn active">This Week</button>
            <button type="button" class="time-pill-btn">Last Week</button>
          </div>
        </div>
        <div class="chart-canvas-wrap" style="height: 250px;">
          <canvas id="userSprintChart"></canvas>
        </div>
      </div>

      <!-- Focus Tasks Section: My High-Priority Focus Tasks List -->
      <div class="dash-card-box mb-24" id="my-focus-tasks">
        <div class="box-head-row mb-16">
          <div>
            <h4 class="box-head-title">My Focus Tasks</h4>
            <span class="text-muted font-size-12">High priority cards assigned to you across boards</span>
          </div>
          <a href="<?= route('user/my-cards') ?>" class="btn btn-secondary btn-sm">
            View All Tasks <i class="fa-solid fa-arrow-right ml-4"></i>
          </a>
        </div>

        <div class="user-focus-tasks-list">
          <?php foreach ($myTasks as $task): ?>
            <div class="user-task-card-item">
              <div class="user-task-left">
                <span class="user-task-category-badge" style="background: <?= sanitize($task['category_bg']) ?>; color: <?= sanitize($task['category_color']) ?>;">
                  <?= sanitize($task['board']) ?>
                </span>
                <h5 class="user-task-title mt-6 mb-4"><?= sanitize($task['title']) ?></h5>
                <div class="user-task-meta">
                  <span class="task-list-pill"><i class="fa-regular fa-folder mr-4"></i><?= sanitize($task['list']) ?></span>
                  <span class="task-due-pill"><i class="fa-regular fa-clock mr-4"></i><?= sanitize($task['due']) ?></span>
                </div>
              </div>
              <div class="user-task-right">
                <span class="badge <?= sanitize($task['priority_badge']) ?> mb-8"><?= sanitize($task['priority']) ?></span>
                <a href="<?= route('user/board-detail') ?>?id=1" class="btn btn-secondary btn-xs">
                  Open Card <i class="fa-solid fa-arrow-right font-size-10 ml-2"></i>
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- My Active Workspace Boards Grid (Reference Card Style) -->
      <div class="dash-card-box">
        <div class="box-head-row mb-16">
          <div>
            <h4 class="box-head-title">My Active Boards</h4>
            <span class="text-muted font-size-12">Boards you are actively contributing to</span>
          </div>
          <a href="<?= route('user/workspaces') ?>" class="btn btn-secondary btn-sm">
            All Workspaces <i class="fa-solid fa-arrow-right ml-4"></i>
          </a>
        </div>

        <div class="boards-masonry-grid">
          <?php foreach ($recentBoards as $b): ?>
            <div class="dash-ref-board-card">
              <!-- Background Geometric Ring Shape (Top Right Static) -->
              <div class="dash-card-shape shape-bg-ring-top"></div>

              <!-- Top Category Pill Tag & Options Button -->
              <div class="dash-ref-card-top mb-12 position-relative z-2">
                <span class="dash-ref-cat-pill" style="background: <?= sanitize($b['category_bg'] ?? '#FCE7F3') ?>; color: <?= sanitize($b['category_color'] ?? '#BE185D') ?>;">
                  <?= sanitize($b['category'] ?? 'Design') ?>
                </span>
                <button type="button" class="dash-ref-options-btn" title="Options">
                  <i class="fa-solid fa-ellipsis"></i>
                </button>
              </div>

              <!-- Card Title & Description -->
              <h4 class="dash-ref-card-title position-relative z-2"><?= sanitize($b['title']) ?></h4>
              <p class="dash-ref-card-desc mt-6 mb-16 position-relative z-2"><?= sanitize($b['description']) ?></p>

              <!-- Progress Section with Circle Handle Dot -->
              <div class="dash-ref-progress-block mb-16 position-relative z-2">
                <div class="dash-ref-progress-header mb-6">
                  <span class="dash-ref-progress-label">Progress</span>
                  <span class="dash-ref-progress-val"><?= (int)$b['progress'] ?>%</span>
                </div>
                <div class="dash-ref-progress-track">
                  <div class="dash-ref-progress-bar" style="width: <?= (int)$b['progress'] ?>%;">
                    <span class="dash-ref-progress-handle"></span>
                  </div>
                </div>
              </div>

              <!-- Bottom Row: Member Avatars & Meta Icons -->
              <div class="dash-ref-card-bottom pt-12 position-relative z-2">
                <div class="avatar-group avatar-group-stack">
                  <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="avatar" title="Sarah Connor">
                  <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="avatar" title="Chris Parker">
                </div>

                <div class="dash-ref-meta-icons">
                  <span class="dash-ref-meta-item">
                    <span class="meta-num"><?= (int)($b['attachments'] ?? 2) ?></span>
                    <i class="fa-solid fa-paperclip"></i>
                  </span>
                  <span class="dash-ref-meta-item">
                    <span class="meta-num"><?= (int)($b['comments'] ?? 1) ?></span>
                    <i class="fa-regular fa-rectangle-list"></i>
                  </span>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>

    <!-- RIGHT SIDEBAR COLUMN (35% Width Continuous Stack) -->
    <div class="dash-masonry-col-side">

      <!-- Chart 2 Box: Task Priority Allocation (Polar Area Chart) -->
      <div class="dash-card-box mb-24">
        <div class="donut-chart-header text-center mb-12">
          <h4 class="donut-box-title">Task Priority Allocation</h4>
          <p class="donut-box-subtitle">Assigned items by priority rating</p>
        </div>
        <div style="height: 220px; position: relative;">
          <canvas id="userPriorityPolarChart"></canvas>
        </div>
      </div>

      <!-- Chart 3 Box: Board Workload Distribution (Horizontal Bar Chart) -->
      <div class="dash-card-box mb-24">
        <div class="box-head-row mb-12">
          <div>
            <h4 class="box-head-title">Board Workload</h4>
            <span class="text-muted font-size-12">Completion status per board</span>
          </div>
          <span class="badge-status-pill status-active"><i class="fa-solid fa-circle font-size-8"></i> Active</span>
        </div>
        <div style="height: 180px; position: relative;" class="mt-12">
          <canvas id="userWorkloadBarChart"></canvas>
        </div>
      </div>

      <!-- Team Activity Feed Box (User Workspace Timeline) -->
      <div class="dash-card-box activity-feed-box">
        <div class="box-head-row mb-16">
          <h4 class="box-head-title"><i class="fa-solid fa-bolt text-warning mr-6"></i> Team Workspace Feed</h4>
        </div>

        <div class="dash-activity-list">
          <?php foreach ($activities as $act): ?>
            <div class="dash-act-item">
              <img src="<?= sanitize($act['avatar']) ?>" class="dash-act-avatar" alt="User">
              <div class="dash-act-content">
                <div class="dash-act-title">
                  <strong><?= sanitize($act['user']) ?></strong> <?= sanitize($act['action']) ?>
                  <span class="dash-act-target"><?= sanitize($act['target']) ?></span>
                </div>
                <div class="dash-act-meta">
                  <span class="dash-act-board"><i class="fa-regular fa-folder mr-4"></i><?= sanitize($act['board']) ?></span>
                  <span class="dash-act-time">• <?= sanitize($act['time']) ?></span>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>

  </div>

</div>

<!-- Shared Modals Include -->
<?php require_once VIEWS_PATH . '/layouts/user/footer.php'; ?>
