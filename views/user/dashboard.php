<?php
$page_title = 'User Dashboard - Richmondtech';
$page_js = 'dashboard.js';
require_once VIEWS_PATH . '/layouts/user/header.php';
?>

<div class="dashboard-wrapper p-24">

  <!-- 1. PERSONALIZED USER HERO BANNER -->
  <div class="dash-hero-banner mb-24">
    <div class="hero-banner-content">
      <h1 class="hero-banner-title">Welcome back, Chris! 👋</h1>
      <p class="hero-banner-subtitle">
        Here is your personal focus agenda, active project progress, assigned task velocity, and team mentions stream.
      </p>
      <div class="hero-banner-actions">
        <button type="button" class="btn btn-hero-white" data-modal-target="create-board-modal">
          <i class="fa-solid fa-plus mr-6"></i> Create Board
        </button>
        <button type="button" class="btn btn-hero-outline" data-modal-target="add-card-modal">
          <i class="fa-solid fa-square-plus mr-6"></i> Add Quick Card
        </button>
        <a href="#focus-agenda-section" class="btn btn-hero-outline">
          <i class="fa-solid fa-circle-check mr-6"></i> Today's Agenda
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

      <!-- 4 Top User KPI Metrics Cards (with 4 Unique Custom SVG Graphics) -->
      <div class="dash-kpi-grid mb-24">
        <!-- KPI 1: Active Projects (Connected Workspace Project Nodes) -->
        <div class="dash-card-box kpi-box">
          <div class="kpi-header-row">
            <span class="kpi-title-text">Active Projects</span>
            <div class="kpi-sparkline-wrap">
              <svg width="85" height="40" viewBox="0 0 85 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M 10 24 L 30 8 L 50 28 L 74 10" stroke="#0D9488" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                <circle cx="10" cy="24" r="3.5" fill="#14B8A6"/>
                <circle cx="30" cy="8" r="4" fill="#0D9488"/>
                <circle cx="50" cy="28" r="3.5" fill="#14B8A6"/>
                <circle cx="74" cy="10" r="4.5" fill="#0D9488"/>
                <circle cx="74" cy="10" r="7.5" fill="#0D9488" fill-opacity="0.25"/>
              </svg>
            </div>
          </div>
          <div class="kpi-main-val"><?= (int)($stats['active_boards'] ?? 5) ?></div>
          <div class="kpi-footer-row">
            <span class="badge-trend badge-trend-up">
              <i class="fa-solid fa-star"></i> 2 Starred
            </span>
            <span class="kpi-sub-text">Workspaces</span>
          </div>
        </div>

        <!-- KPI 2: Assigned Focus (5 Rising Velocity Pillar Columns) -->
        <div class="dash-card-box kpi-box">
          <div class="kpi-header-row">
            <span class="kpi-title-text">Assigned Focus</span>
            <div class="kpi-sparkline-wrap">
              <svg width="80" height="40" viewBox="0 0 80 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="4" y="24" width="8" height="12" rx="4" fill="#818CF8" fill-opacity="0.4"/>
                <rect x="18" y="16" width="8" height="20" rx="4" fill="#6366F1" fill-opacity="0.6"/>
                <rect x="32" y="10" width="8" height="26" rx="4" fill="#6366F1" fill-opacity="0.8"/>
                <rect x="46" y="20" width="8" height="16" rx="4" fill="#818CF8" fill-opacity="0.5"/>
                <rect x="60" y="4" width="8" height="32" rx="4" fill="#4F46E5"/>
              </svg>
            </div>
          </div>
          <div class="kpi-main-val"><?= (int)($stats['assigned_tasks'] ?? 14) ?></div>
          <div class="kpi-footer-row">
            <span class="badge-trend badge-trend-up">
              <i class="fa-solid fa-clock"></i> In Progress
            </span>
            <span class="kpi-sub-text">Active Items</span>
          </div>
        </div>

        <!-- KPI 3: Tasks Completed (Radial Completion Arc Segment) -->
        <div class="dash-card-box kpi-box">
          <div class="kpi-header-row">
            <span class="kpi-title-text">Tasks Completed</span>
            <div class="kpi-sparkline-wrap">
              <svg width="80" height="40" viewBox="0 0 80 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="40" cy="38" r="28" stroke="#E2E8F0" stroke-width="5" fill="none"/>
                <path d="M 12 38 A 28 28 0 0 1 65 24" stroke="#10B981" stroke-width="5" stroke-linecap="round" fill="none"/>
                <circle cx="65" cy="24" r="4" fill="#10B981"/>
              </svg>
            </div>
          </div>
          <div class="kpi-main-val"><?= (int)($stats['completed_tasks'] ?? 38) ?></div>
          <div class="kpi-footer-row">
            <span class="badge-trend badge-trend-up">
              <i class="fa-solid fa-arrow-trend-up"></i> +86%
            </span>
            <span class="kpi-sub-text">Velocity</span>
          </div>
        </div>

        <!-- KPI 4: Due Soon (Stepped Deadline Staircase Path) -->
        <div class="dash-card-box kpi-box">
          <div class="kpi-header-row">
            <span class="kpi-title-text">Due Soon</span>
            <div class="kpi-sparkline-wrap">
              <svg width="85" height="40" viewBox="0 0 85 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M 4 34 H 22 V 24 H 42 V 14 H 62 V 6 H 78" stroke="#EF4444" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                <circle cx="78" cy="6" r="4.5" fill="#EF4444"/>
                <circle cx="78" cy="6" r="8" fill="#EF4444" fill-opacity="0.25"/>
              </svg>
            </div>
          </div>
          <div class="kpi-main-val"><?= (int)($stats['due_soon'] ?? 3) ?></div>
          <div class="kpi-footer-row">
            <span class="badge-trend status-inactive">
              <i class="fa-solid fa-triangle-exclamation"></i> Action Req.
            </span>
            <span class="kpi-sub-text">Critical</span>
          </div>
        </div>
      </div>

      <!-- Chart 1 Box: Weekly Sprint Productivity (Grouped Bar Chart) -->
      <div class="dash-card-box chart-wavy-box mb-24">
        <div class="chart-box-header mb-16">
          <div>
            <span class="chart-kicker-title">WEEKLY SPRINT PRODUCTIVITY</span>
            <div class="chart-amount-row mt-4">
              <h2 class="chart-big-amount">92% Completion</h2>
              <span class="chart-unit-text">Score</span>
            </div>
          </div>
          <div class="chart-time-pills">
            <button type="button" class="time-pill-btn active">This Week</button>
            <button type="button" class="time-pill-btn">Last Week</button>
          </div>
        </div>
        <div class="chart-canvas-wrap chart-canvas-250">
          <canvas id="userSprintChart"></canvas>
        </div>
      </div>

      <!-- NEW MODULE 1: Today's Actionable Agenda & Personal Focus Checklist -->
      <div class="dash-card-box mb-24" id="focus-agenda-section">
        <div class="box-head-row mb-16">
          <div>
            <h4 class="box-head-title"><i class="fa-solid fa-circle-check text-emerald mr-6"></i> Today's Focus Agenda</h4>
            <span class="text-muted font-size-12">Interactive daily action pad — check off completed focus items</span>
          </div>
          <span class="donut-on-progress-chip font-size-12"><i class="fa-solid fa-bolt mr-4"></i> High Priority</span>
        </div>

        <!-- Quick Add Agenda Input -->
        <div class="user-quick-add-wrap mb-16">
          <div class="input-group">
            <input type="text" id="quick-agenda-input" class="form-control" placeholder="+ Type a quick focus note or task and press Enter...">
            <button type="button" class="btn btn-primary btn-sm" id="quick-agenda-add-btn">Add Note</button>
          </div>
        </div>

        <!-- Interactive Checklist Items List -->
        <div class="user-agenda-list" id="user-agenda-list-container">
          <?php foreach ($todayAgenda as $item): ?>
            <div class="user-agenda-item <?= $item['completed'] ? 'agenda-completed' : '' ?>">
              <label class="agenda-checkbox-label">
                <input type="checkbox" class="agenda-checkbox" <?= $item['completed'] ? 'checked' : '' ?>>
                <span class="custom-checkbox-mark"></span>
              </label>
              
              <div class="agenda-item-content">
                <div class="agenda-item-title"><?= sanitize($item['title']) ?></div>
                <div class="agenda-item-meta mt-2">
                  <span class="text-muted font-size-12"><i class="fa-regular fa-clock mr-6"></i><?= sanitize($item['created_at'] ?? 'Aug 11, 2026') ?></span>
                </div>
              </div>

              <div class="agenda-item-right">
                <div class="agenda-action-btns">
                  <button type="button" class="btn-action-icon btn-action-edit agenda-edit-btn" title="Edit Note">
                    <i class="fa-regular fa-pen-to-square"></i>
                  </button>
                  <button type="button" class="btn-action-icon btn-action-delete agenda-delete-btn" title="Delete Note">
                    <i class="fa-regular fa-trash-can"></i>
                  </button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- NEW MODULE 2: My Workspace Projects & Starred Shortcuts Grid -->
      <div class="dash-card-box">
        <div class="box-head-row mb-16">
          <div>
            <h4 class="box-head-title"><i class="fa-solid fa-layer-group text-primary mr-6"></i> My Starred Projects</h4>
            <span class="text-muted font-size-12">Quick project hubs with one-click "+ Add Card" shortcuts</span>
          </div>
          <a href="<?= route('user/workspaces') ?>" class="btn btn-secondary btn-sm">
            All Workspaces <i class="fa-solid fa-arrow-right ml-4"></i>
          </a>
        </div>

        <div class="boards-masonry-grid">
          <?php foreach ($userBoards as $b): ?>
            <div class="user-project-hub-card">
              <div class="project-hub-top">
                <span class="dash-ref-cat-pill" style="background: <?= sanitize($b['category_bg']) ?>; color: <?= sanitize($b['category_color']) ?>;">
                  <?= sanitize($b['category']) ?>
                </span>
                <button type="button" class="star-toggle-btn <?= $b['starred'] ? 'is-starred' : '' ?>" title="Star Board">
                  <i class="fa-<?= $b['starred'] ? 'solid' : 'regular' ?> fa-star"></i>
                </button>
              </div>

              <h4 class="project-hub-title"><?= sanitize($b['title']) ?></h4>
              <div class="project-hub-workspace mb-14">
                <i class="fa-regular fa-building font-size-12"></i>
                <span><?= sanitize($b['workspace']) ?></span>
              </div>

              <!-- Progress bar -->
              <div class="dash-ref-progress-block mt-12 mb-16">
                <div class="dash-ref-progress-header mb-6">
                  <span class="dash-ref-progress-label">Completion</span>
                  <span class="dash-ref-progress-val"><?= (int)$b['progress'] ?>%</span>
                </div>
                <div class="dash-ref-progress-track">
                  <div class="dash-ref-progress-bar" style="width: <?= (int)$b['progress'] ?>%;">
                    <span class="dash-ref-progress-handle"></span>
                  </div>
                </div>
              </div>

              <!-- Member Avatars Stack -->
              <div class="avatar-group avatar-group-stack mb-12">
                <?php 
                  $boardMembers = $b['members'] ?? [
                    ['name' => 'Sarah Connor', 'avatar' => asset('images/avatars/default-image.jpg')],
                    ['name' => 'Chris Parker', 'avatar' => asset('images/avatars/default-image.jpg')],
                    ['name' => 'Alex Johnson', 'avatar' => asset('images/avatars/default-image.jpg')],
                    ['name' => 'Elena Rostova', 'avatar' => asset('images/avatars/default-image.jpg')],
                    ['name' => 'David Chen', 'avatar' => asset('images/avatars/default-image.jpg')]
                  ];
                  $visibleBoardMembers = array_slice($boardMembers, 0, 3);
                  $moreBoardMembers = count($boardMembers) - 3;
                ?>
                <?php foreach ($visibleBoardMembers as $m): ?>
                  <img src="<?= $m['avatar'] ?>" class="avatar" title="<?= sanitize($m['name']) ?>">
                <?php endforeach; ?>
                <?php if ($moreBoardMembers > 0): ?>
                  <span class="avatar-more-badge" title="<?= $moreBoardMembers ?> more members">+<?= $moreBoardMembers ?></span>
                <?php endif; ?>
              </div>

              <!-- Quick action footer -->
              <div class="project-hub-footer pt-10">
                <span class="text-muted font-size-12"><i class="fa-regular fa-clock mr-4"></i><?= sanitize($b['updated']) ?></span>
                <div class="project-hub-actions">
                  <button type="button" class="btn btn-secondary btn-xs" data-modal-target="add-card-modal">
                    <i class="fa-solid fa-plus mr-4"></i> Add Card
                  </button>
                  <a href="<?= route('user/board-detail') ?>?id=<?= (int)$b['id'] ?>" class="btn btn-primary btn-xs">
                    Open <i class="fa-solid fa-arrow-right font-size-10 ml-2"></i>
                  </a>
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
          <p class="donut-box-subtitle">Assigned focus items by priority rating</p>
        </div>
        <div class="chart-canvas-220">
          <canvas id="userPriorityPolarChart"></canvas>
        </div>
      </div>

      <!-- Chart 3 Box: Board Workload Distribution (Horizontal Bar Chart) -->
      <div class="dash-card-box mb-24">
        <div class="box-head-row mb-12">
          <div>
            <h4 class="box-head-title">Board Workload</h4>
            <span class="text-muted font-size-12">Completion status per project</span>
          </div>
          <span class="badge-status-pill status-active"><i class="fa-solid fa-circle font-size-8"></i> Active</span>
        </div>
        <div class="chart-canvas-180 mt-12">
          <canvas id="userWorkloadBarChart"></canvas>
        </div>
      </div>

      <!-- NEW MODULE 3: Team Mentions & Recent Discussions Stream -->
      <div class="dash-card-box activity-feed-box">
        <div class="box-head-row mb-16">
          <h4 class="box-head-title"><i class="fa-solid fa-at text-indigo mr-6"></i> Team Mentions & Discussions</h4>
        </div>

        <div class="user-discussions-stream">
          <?php foreach ($userComments as $com): ?>
            <div class="discussion-item-box mb-12">
              <div class="discussion-item-top mb-8">
                <div class="discussion-user-info">
                  <img src="<?= sanitize($com['avatar']) ?>" class="dash-act-avatar" alt="User">
                  <div class="discussion-user-name-wrap">
                    <span class="discussion-user-name"><?= sanitize($com['user']) ?></span>
                    <span class="discussion-time">• <?= sanitize($com['time']) ?></span>
                  </div>
                </div>
                <span class="role-dept-badge font-size-10"><?= sanitize($com['board']) ?></span>
              </div>
              <p class="discussion-text-content mt-8 mb-8 font-size-12.5 text-secondary">
                <?= sanitize($com['comment']) ?>
              </p>
              <div class="discussion-actions text-right">
                <button type="button" class="btn btn-secondary btn-xs" data-modal-target="card-detail-modal">
                  <i class="fa-solid fa-reply mr-4"></i> Quick Reply
                </button>
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
