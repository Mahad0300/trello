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
        <button type="button" class="btn btn-hero-outline" data-modal-target="create-board-modal">
          <i class="fa-solid fa-square-plus mr-6"></i> Create Board
        </button>
        <button type="button" class="btn btn-hero-outline" data-modal-target="create-user-modal">
          <i class="fa-solid fa-user-plus mr-6"></i> Invite Member
        </button>
      </div>
    </div>
    <div class="hero-banner-graphics">
      <div class="hero-circle-shape shape-1"></div>
      <div class="hero-circle-shape shape-2"></div>
    </div>
  </div>

  <!-- 2. TRUE MASONRY 2-COLUMN ASYMMETRIC GRID CONTAINER (INSPIRED BY REFERENCE 2) -->
  <div class="dash-true-masonry-container">

    <!-- LEFT MAIN COLUMN (65% Width) -->
    <div class="dash-masonry-col-main">

      <!-- KPI Metrics Grid (4 Top Cards) -->
      <div class="dash-kpi-grid mb-24">
        <!-- KPI 1: Total Users -->
        <div class="dash-card-box kpi-box">
          <div class="kpi-header-row">
            <span class="kpi-title-text">Total Users</span>
            <div class="kpi-sparkline-wrap">
              <svg width="96" height="44" viewBox="0 0 96 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 34 C 16 18, 26 38, 40 18 C 52 4, 64 32, 76 16 C 84 6, 88 12, 92 6" stroke="#6366F1" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              </svg>
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

        <!-- KPI 2: Workspaces -->
        <div class="dash-card-box kpi-box">
          <div class="kpi-header-row">
            <span class="kpi-title-text">Workspaces</span>
            <div class="kpi-sparkline-wrap">
              <svg width="96" height="44" viewBox="0 0 96 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 36 C 18 12, 30 38, 44 16 C 56 2, 66 34, 78 18 C 85 8, 89 16, 92 8" stroke="#0D9488" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              </svg>
            </div>
          </div>
          <div class="kpi-main-val"><?= (int)($stats['active_workspaces'] ?? 12) ?></div>
          <div class="kpi-footer-row">
            <span class="badge-trend badge-trend-up">
              <i class="fa-solid fa-plus"></i> +2 new
            </span>
            <span class="kpi-sub-text">4 Depts</span>
          </div>
        </div>

        <!-- KPI 3: Total Boards -->
        <div class="dash-card-box kpi-box">
          <div class="kpi-header-row">
            <span class="kpi-title-text">Total Boards</span>
            <div class="kpi-sparkline-wrap">
              <svg width="96" height="44" viewBox="0 0 96 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 38 C 18 22, 28 8, 40 24 C 52 40, 64 12, 76 18 C 84 22, 88 10, 92 4" stroke="#8B5CF6" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              </svg>
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

        <!-- KPI 4: Task Velocity -->
        <div class="dash-card-box kpi-box">
          <div class="kpi-header-row">
            <span class="kpi-title-text">Task Velocity</span>
            <div class="kpi-sparkline-wrap">
              <svg width="96" height="44" viewBox="0 0 96 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 32 C 14 10, 24 38, 38 12 C 48 38, 62 6, 74 28 C 82 14, 88 8, 92 5" stroke="#10B981" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              </svg>
            </div>
          </div>
          <div class="kpi-main-val"><?= number_format((int)($stats['completed_tasks'] ?? 1240)) ?></div>
          <div class="kpi-footer-row">
            <span class="badge-trend badge-trend-up">
              <i class="fa-solid fa-arrow-trend-up"></i> <?= sanitize($stats['growth_rate'] ?? '+18.5%') ?>
            </span>
            <span class="kpi-sub-text">Completed</span>
          </div>
        </div>
      </div>

      <!-- Wavy Dual Line Chart Box (Task Velocity & Workload) -->
      <div class="dash-card-box chart-main-box mb-24">
        <div class="chart-box-header">
          <div>
            <span class="chart-kicker-title">Task Velocity & Workload</span>
            <div class="chart-amount-row mt-6">
              <span class="chart-big-amount"><?= number_format((int)($stats['completed_tasks'] ?? 1240)) ?></span>
              <span class="chart-unit-text">Completed Cards</span>
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
          <canvas id="adminWavyLineChart" height="260"></canvas>
        </div>
      </div>

      <!-- Recent Registered Users Table Box -->
      <div class="dash-card-box table-box-card mb-24">
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
                    <a href="<?= route('admin/users') ?>" class="btn-table-action" title="User Accounts">
                      <i class="fa-regular fa-eye"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- High-Priority Enterprise Boards Grid -->
      <div class="dash-card-box">
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
            <div class="dash-ref-board-card">
              <!-- Background Geometric Ring Shape (Top Right Only) -->
              <div class="dash-card-shape shape-bg-ring-top"></div>

              <!-- Top Category Pill Tag -->
              <div class="dash-ref-card-top mb-12 position-relative z-2">
                <span class="dash-ref-cat-pill" style="background: <?= sanitize($b['category_bg'] ?? '#FCE7F3') ?>; color: <?= sanitize($b['category_color'] ?? '#BE185D') ?>;">
                  <?= sanitize($b['category'] ?? 'Design') ?>
                </span>
              </div>

              <!-- Card Title & Description -->
              <h4 class="dash-ref-card-title position-relative z-2"><?= sanitize($b['title']) ?></h4>
              <p class="dash-ref-card-desc mt-6 mb-16 position-relative z-2"><?= sanitize($b['description'] ?? 'Design a cohesive set of onboarding illustrations that introduce key product features.') ?></p>

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

      <!-- Donut Ring Chart Box (Platform Workload Completion) -->
      <div class="dash-card-box chart-donut-box mb-24">
        <div class="donut-chart-header text-center mb-12">
          <h4 class="donut-box-title">Workload Completion</h4>
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
            Workload completion is <strong>84%</strong>. High efficiency across Engineering & Product design.
          </p>
        </div>
      </div>

      <!-- Speedometer Active Gauge & Engagement Stats Box -->
      <div class="dash-card-box gauge-stats-box mb-24">
        <div class="box-head-row mb-12">
          <div>
            <h4 class="box-head-title">Execution Speed</h4>
            <span class="text-muted font-size-12">Overall Workload Velocity</span>
          </div>
          <span class="badge-priority-high"><i class="fa-solid fa-bolt"></i> High</span>
        </div>

        <!-- Gauge Chart Centered Wrapper -->
        <div class="gauge-chart-wrapper">
          <canvas id="adminGaugeChart"></canvas>
          <div class="gauge-center-info">
            <span class="gauge-val-text">98 / 100</span>
            <span class="gauge-sub-text">Velocity Score</span>
          </div>
        </div>

        <!-- System Attachments Breakdown: Images vs PDFs -->
        <div class="arc-rings-flex mt-16 pt-16 border-top">
          <div class="arc-ring-item">
            <div class="arc-ring-val text-indigo"><?= (int)($stats['total_images'] ?? 48) ?></div>
            <div class="arc-ring-month">Images</div>
            <div class="arc-ring-desc">JPG, PNG, WebP</div>
          </div>
          <div class="arc-ring-divider"></div>
          <div class="arc-ring-item">
            <div class="arc-ring-val text-coral"><?= (int)($stats['total_pdfs'] ?? 24) ?></div>
            <div class="arc-ring-month">PDF Files</div>
            <div class="arc-ring-desc">Documents & Specs</div>
          </div>
        </div>
      </div>

      <!-- Live System Audit & Activity Feed Box -->
      <div class="dash-card-box activity-feed-box">
        <div class="box-head-row mb-16">
          <h4 class="box-head-title"><i class="fa-solid fa-bolt text-warning mr-6"></i> System Audit Log</h4>
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

<?php require_once VIEWS_PATH . '/layouts/admin/footer.php'; ?>
