<?php
$page_title = 'Admin Dashboard - Richmondtech';
$page_js = 'admin_dashboard.js';
require_once VIEWS_PATH . '/layouts/admin/header.php';
?>

<div class="dashboard-wrapper dash-masonry-wrapper p-24">

  <!-- 1. Hero Enterprise Banner Card (Green CTA Style) -->
  <div class="dash-hero-banner mb-24">
    <div class="hero-banner-content">
      <h2 class="hero-banner-title">Manage your enterprise project workload in one place</h2>
      <p class="hero-banner-subtitle">
        Monitor real-time task velocity, workspace analytics, user statistics, and system activity across all departments.
      </p>
      <div class="hero-banner-actions">
        <button type="button" class="btn btn-hero-white" data-modal-target="create-workspace-modal">
          <i class="fa-solid fa-plus mr-6"></i> Create Workspace
        </button>
        <button type="button" class="btn btn-hero-outline" data-modal-target="add-board-modal">
          <i class="fa-solid fa-square-plus mr-6"></i> Create Board
        </button>
        <button type="button" class="btn btn-hero-outline" data-modal-target="manage-workspace-members-modal">
          <i class="fa-solid fa-user-plus mr-6"></i> Invite Member
        </button>
      </div>
    </div>
    <div class="hero-banner-graphics">
      <div class="hero-circle-shape shape-1"></div>
      <div class="hero-circle-shape shape-2"></div>
    </div>
  </div>

  <!-- 2. KPI Metrics Grid (4 Masonry Boxes) -->
  <div class="dash-kpi-grid mb-24">
    <!-- KPI 1 -->
    <div class="dash-card-box kpi-box">
      <div class="kpi-header-row">
        <span class="kpi-title-text">Total Users</span>
        <div class="kpi-icon-badge bg-indigo-light text-indigo">
          <i class="fa-solid fa-users"></i>
        </div>
      </div>
      <div class="kpi-main-val"><?= (int)($stats['total_users'] ?? 142) ?></div>
      <div class="kpi-footer-row">
        <span class="badge-trend badge-trend-up">
          <i class="fa-solid fa-arrow-trend-up"></i> +12.4%
        </span>
        <span class="kpi-sub-text"><?= (int)($stats['active_users'] ?? 136) ?> Active</span>
      </div>
    </div>

    <!-- KPI 2 -->
    <div class="dash-card-box kpi-box">
      <div class="kpi-header-row">
        <span class="kpi-title-text">Active Workspaces</span>
        <div class="kpi-icon-badge bg-teal-light text-teal">
          <i class="fa-solid fa-layer-group"></i>
        </div>
      </div>
      <div class="kpi-main-val"><?= (int)($stats['active_workspaces'] ?? 12) ?></div>
      <div class="kpi-footer-row">
        <span class="badge-trend badge-trend-up">
          <i class="fa-solid fa-plus"></i> +2 new
        </span>
        <span class="kpi-sub-text">4 Departments</span>
      </div>
    </div>

    <!-- KPI 3 -->
    <div class="dash-card-box kpi-box">
      <div class="kpi-header-row">
        <span class="kpi-title-text">Total Boards</span>
        <div class="kpi-icon-badge bg-purple-light text-purple">
          <i class="fa-solid fa-table-columns"></i>
        </div>
      </div>
      <div class="kpi-main-val"><?= (int)($stats['total_boards'] ?? 58) ?></div>
      <div class="kpi-footer-row">
        <span class="badge-trend badge-trend-up">
          <i class="fa-solid fa-circle-check"></i> 84%
        </span>
        <span class="kpi-sub-text"><?= (int)($stats['active_boards'] ?? 52) ?> Active</span>
      </div>
    </div>

    <!-- KPI 4 (With Circular Green Arrow Button) -->
    <div class="dash-card-box kpi-box">
      <div class="kpi-header-row">
        <span class="kpi-title-text">Task Velocity</span>
        <div class="kpi-arrow-circle-btn">
          <i class="fa-solid fa-arrow-up-right-from-square"></i>
        </div>
      </div>
      <div class="kpi-main-val"><?= number_format((int)($stats['completed_tasks'] ?? 1240)) ?></div>
      <div class="kpi-footer-row">
        <span class="badge-trend badge-trend-up">
          <i class="fa-solid fa-arrow-trend-up"></i> <?= sanitize($stats['growth_rate'] ?? '+18.5%') ?>
        </span>
        <span class="kpi-sub-text">Completed Cards</span>
      </div>
    </div>
  </div>

  <!-- 3. Charts Row 1: Dual Wavy Line Chart + Donut Ring Chart -->
  <div class="dash-masonry-grid grid-2-col mb-24">
    
    <!-- Left Box: Wavy Dual Line Chart -->
    <div class="dash-card-box chart-main-box">
      <div class="chart-box-header">
        <div>
          <span class="chart-kicker-title">Task Velocity & Workload</span>
          <div class="chart-amount-row mt-6">
            <span class="chart-big-amount"><?= number_format((int)($stats['completed_tasks'] ?? 1240)) ?></span>
            <span class="chart-unit-text">Completed</span>
          </div>
          <p class="chart-growth-subtext text-emerald mt-4">
            <i class="fa-solid fa-arrow-trend-up mr-4"></i> +18.5% completion rate than last month
          </p>
        </div>

        <!-- Filter Time Pills (Daily, Weekly, Monthly) -->
        <div class="chart-time-pills" id="chart-time-toggle">
          <button type="button" class="time-pill-btn" data-period="daily">Daily</button>
          <button type="button" class="time-pill-btn" data-period="weekly">Weekly</button>
          <button type="button" class="time-pill-btn active" data-period="monthly">Monthly</button>
        </div>
      </div>

      <!-- Chart Container -->
      <div class="chart-canvas-wrap mt-20">
        <canvas id="adminWavyLineChart" height="240"></canvas>
      </div>
    </div>

    <!-- Right Box: Donut Ring Chart -->
    <div class="dash-card-box chart-donut-box">
      <div class="donut-chart-header text-center mb-16">
        <h4 class="donut-box-title">Platform Workload Completion</h4>
        <p class="donut-box-subtitle">Real-time status across active boards</p>
      </div>

      <!-- Donut Chart Centered Wrapper -->
      <div class="donut-chart-wrapper">
        <canvas id="adminDonutChart"></canvas>
        <div class="donut-center-badge">
          <span class="donut-center-val"><?= (int)($stats['completion_rate'] ?? 84) ?>%</span>
          <span class="donut-center-label">Completed</span>
        </div>
      </div>

      <div class="donut-footer-meta mt-16 text-center">
        <div class="donut-on-progress-chip mb-8">
          <i class="fa-solid fa-circle-check text-emerald mr-4"></i> 52 of 58 Boards On Track
        </div>
        <p class="donut-desc-text">
          Enterprise workload completion is <strong>84%</strong>. High efficiency across Engineering and Product teams.
        </p>
      </div>
    </div>

  </div>

  <!-- 4. Charts Row 2: Statistics Arc Rings + Speedometer Active Gauge -->
  <div class="dash-masonry-grid grid-2-col mb-24">

    <!-- Left Box: User Engagement Arc Rings -->
    <div class="dash-card-box arc-stats-box">
      <div class="box-head-row mb-16">
        <h4 class="box-head-title">User Engagement Statistics</h4>
        <span class="badge-status-progress"><i class="fa-regular fa-chart-bar"></i> Overview</span>
      </div>

      <div class="arc-rings-flex mt-16 mb-16">
        <div class="arc-ring-item">
          <div class="arc-ring-val text-emerald">96%</div>
          <div class="arc-ring-month">Active Users</div>
          <div class="arc-ring-desc">136 Active Accounts</div>
        </div>
        <div class="arc-ring-divider"></div>
        <div class="arc-ring-item">
          <div class="arc-ring-val text-coral">4%</div>
          <div class="arc-ring-month">Inactive Users</div>
          <div class="arc-ring-desc">6 Inactive Accounts</div>
        </div>
      </div>
      <p class="arc-footer-note text-center text-muted font-size-12 m-0">
        Active user engagement is at an all-time peak across 12 workspaces.
      </p>
    </div>

    <!-- Right Box: Speedometer / Active Statistics Gauge -->
    <div class="dash-card-box gauge-stats-box">
      <div class="box-head-row mb-12">
        <div>
          <h4 class="box-head-title">System Execution Speed</h4>
          <span class="text-muted font-size-12">Overall Workload Velocity</span>
        </div>
        <span class="badge-priority-high"><i class="fa-solid fa-bolt"></i> High Performance</span>
      </div>

      <!-- Gauge Chart Centered Wrapper -->
      <div class="gauge-chart-wrapper">
        <canvas id="adminGaugeChart"></canvas>
        <div class="gauge-center-info">
          <span class="gauge-val-text">98 / 100</span>
          <span class="gauge-sub-text">Velocity Score</span>
        </div>
      </div>

      <div class="gauge-legend-flex mt-12">
        <span class="legend-chip legend-purple"><span class="chip-dot"></span> Engineering</span>
        <span class="legend-chip legend-emerald"><span class="chip-dot"></span> Marketing</span>
        <span class="legend-chip legend-coral"><span class="chip-dot"></span> Design</span>
      </div>
    </div>

  </div>

  <!-- 5. Row 3: Recent Registered Users Table + Live Audit Activity Feed -->
  <div class="dash-masonry-grid grid-2-col-60-40 mb-24">

    <!-- Left Box: Users Data Table -->
    <div class="dash-card-box table-box-card">
      <div class="box-head-row mb-16">
        <div>
          <h4 class="box-head-title">Recently Registered Users</h4>
          <span class="text-muted font-size-12">Latest members onboarded to Richmondtech</span>
        </div>
        <a href="<?= route('admin/users') ?>" class="btn btn-secondary btn-sm">
          View All Users <i class="fa-solid fa-arrow-right ml-4"></i>
        </a>
      </div>

      <div class="table-responsive">
        <table class="dash-custom-table">
          <thead>
            <tr>
              <th>User</th>
              <th>Role & Department</th>
              <th>Status</th>
              <th>Joined</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentUsers as $u): ?>
              <tr>
                <td>
                  <div class="table-user-info-flex">
                    <img src="<?= sanitize($u['avatar']) ?>" class="table-user-avatar" alt="Avatar">
                    <div>
                      <div class="table-user-name"><?= sanitize($u['name']) ?></div>
                      <div class="table-user-email"><?= sanitize($u['email']) ?></div>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="role-dept-badge"><?= sanitize($u['role']) ?></span>
                </td>
                <td>
                  <?php if (strtolower($u['status']) === 'active'): ?>
                    <span class="badge-status-pill status-active"><i class="fa-solid fa-circle font-size-8"></i> Active</span>
                  <?php else: ?>
                    <span class="badge-status-pill status-inactive"><i class="fa-solid fa-circle font-size-8"></i> Inactive</span>
                  <?php endif; ?>
                </td>
                <td>
                  <span class="text-muted font-size-13"><?= sanitize($u['joined']) ?></span>
                </td>
                <td>
                  <a href="<?= route('admin/profile') ?>?id=<?= (int)$u['id'] ?>" class="btn-table-action" title="View Profile">
                    <i class="fa-regular fa-eye"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Right Box: Live Activity Feed -->
    <div class="dash-card-box activity-feed-box">
      <div class="box-head-row mb-16">
        <h4 class="box-head-title"><i class="fa-solid fa-bolt text-warning mr-6"></i> System Audit & Activity Log</h4>
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

  <!-- 6. Row 4: Top Active Boards Grid -->
  <div class="dash-card-box mb-24">
    <div class="box-head-row mb-16">
      <div>
        <h4 class="box-head-title">High-Priority Enterprise Boards</h4>
        <span class="text-muted font-size-12">Top active project boards with member progress</span>
      </div>
      <a href="<?= route('admin/all-boards') ?>" class="btn btn-secondary btn-sm">
        View All Boards <i class="fa-solid fa-arrow-right ml-4"></i>
      </a>
    </div>

    <div class="boards-masonry-grid">
      <?php foreach ($recentBoards as $b): ?>
        <div class="dash-board-card">
          <div class="board-card-header-bar" style="background: <?= sanitize($b['bg']) ?>;"></div>
          <div class="board-card-inner">
            <span class="board-card-workspace"><?= sanitize($b['workspace']) ?></span>
            <h4 class="board-card-title"><?= sanitize($b['title']) ?></h4>

            <div class="board-card-members-row mt-12 mb-12">
              <div class="avatar-group avatar-group-stack">
                <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="avatar" title="Sarah Connor">
                <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="avatar" title="Chris Parker">
                <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="avatar" title="Alex Johnson">
              </div>
              <span class="board-card-task-count"><i class="fa-solid fa-list-check mr-4"></i><?= (int)$b['cards'] ?> Cards</span>
            </div>

            <div class="board-card-progress-wrap mb-12">
              <div class="progress-track-sm">
                <div class="progress-fill-indigo" style="width: <?= (int)$b['progress'] ?>%;"></div>
              </div>
              <span class="progress-percent-text"><?= (int)$b['progress'] ?>% Complete</span>
            </div>

            <div class="board-card-footer">
              <span class="board-card-time"><i class="fa-regular fa-clock mr-4"></i><?= sanitize($b['updated']) ?></span>
              <a href="<?= route('admin/board-detail') ?>?id=<?= (int)$b['id'] ?>" class="btn btn-secondary btn-xs">
                Open Board <i class="fa-solid fa-arrow-right font-size-10 ml-2"></i>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

</div>

<?php require_once VIEWS_PATH . '/layouts/admin/footer.php'; ?>
