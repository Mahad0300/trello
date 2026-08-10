<?php
$page_title = 'Admin Dashboard - Richmondtech';
$page_js = 'admin_dashboard.js';
require_once VIEWS_PATH . '/layouts/admin/header.php';
?>

<div class="dashboard-wrapper p-24">
  
  <!-- 1. Hero Green Banner (Clean Overflow & Crisp Typography) -->
  <div class="dash-hero-banner mb-24">
    <div class="dash-hero-content">
      <h1 class="dash-hero-title">Manage your project in one touch</h1>
      <p class="dash-hero-subtitle">Let Richmondtech manage your team workspaces and active boards automatically with real-time systems.</p>
    </div>
    <div class="dash-hero-action">
      <button type="button" class="btn btn-pill-white" data-modal-target="create-workspace-modal">
        <i class="fa-solid fa-plus mr-6"></i> Create Workspace
      </button>
    </div>
    <div class="dash-hero-bg-circles"></div>
  </div>

  <!-- 2. Row 1: Dual Main Cards (Matching Reference Screenshot 1) -->
  <div class="dash-grid-2col mb-24">
    
    <!-- Left Card: Current Activity Wavy Chart Card -->
    <div class="dash-card">
      <div class="dash-card-head">
        <div>
          <span class="dash-card-label">Task Velocity & Activity</span>
          <div class="dash-card-value-row">
            <h2 class="dash-card-big-value">1,240 Tasks</h2>
            <span class="dash-card-arrow-icon"><i class="fa-solid fa-arrow-up-right-from-square font-size-12"></i></span>
          </div>
          <span class="dash-badge-green"><i class="fa-solid fa-arrow-trend-up"></i> <?= sanitize($stats['growth_rate']) ?> than last week</span>
        </div>
        
        <!-- Time Range Pill Selector -->
        <div class="dash-time-tabs">
          <button class="dash-tab-pill" data-period="daily">Daily</button>
          <button class="dash-tab-pill" data-period="weekly">Weekly</button>
          <button class="dash-tab-pill active" data-period="monthly">Monthly</button>
        </div>
      </div>

      <!-- Dual Wavy Line Chart Container (Matching Screenshot 1 & 2) -->
      <div class="dash-chart-container-lg mt-16">
        <canvas id="wavyLineChart"></canvas>
      </div>
    </div>

    <!-- Right Card: Circular Gauge Ring Card (Matching Screenshot 1 Right) -->
    <div class="dash-card dash-card-flex-center">
      <div class="dash-ring-wrapper">
        <canvas id="circularRingChart"></canvas>
        <div class="dash-ring-center-text">
          <span class="dash-ring-percent">84%</span>
        </div>
      </div>

      <div class="text-center mt-16">
        <div class="dash-ring-status-text">On Progress <span class="text-emerald font-weight-700">84%</span></div>
        <h3 class="dash-card-section-heading mt-6 mb-6">Workload Dashboard For Enterprise Teams</h3>
        <p class="dash-card-muted-desc">Real-time workspace activity, board completions, and active task distribution across departments.</p>
      </div>
    </div>

  </div>

  <!-- 3. Row 2: Secondary Statistics Grid (Matching Reference Screenshot 4) -->
  <div class="dash-grid-2col mb-24">
    
    <!-- Left Card: Dual Semi-Arc Statistics -->
    <div class="dash-card">
      <div class="dash-card-head mb-12">
        <h3 class="dash-card-title">Statistics</h3>
        <span class="font-size-12 text-muted">August vs July Execution</span>
      </div>
      <div class="dash-dual-gauge-layout">
        <div class="dash-gauge-item">
          <div class="dash-arc-container">
            <canvas id="gaugeTopArc"></canvas>
            <div class="dash-arc-label">
              <span class="text-emerald font-weight-700 font-size-16">51%</span>
              <span class="font-size-11 text-muted">August</span>
            </div>
          </div>
        </div>
        <div class="dash-gauge-item">
          <div class="dash-arc-container">
            <canvas id="gaugeBottomArc"></canvas>
            <div class="dash-arc-label">
              <span class="text-rose font-weight-700 font-size-16">35%</span>
              <span class="font-size-11 text-muted">July</span>
            </div>
          </div>
        </div>
      </div>
      <p class="text-center text-muted font-size-12 mt-12 m-0">Monthly sprint completion consistency breakdown across active boards.</p>
    </div>

    <!-- Right Card: Speedometer Active Statistics -->
    <div class="dash-card">
      <div class="dash-card-head mb-12">
        <div>
          <h3 class="dash-card-title">Active Statistics</h3>
          <span class="font-size-12 text-muted">All Workspace Accounts</span>
        </div>
      </div>

      <div class="dash-speedometer-wrapper">
        <canvas id="speedometerChart"></canvas>
        <div class="dash-speedometer-center-val">
          <span class="font-weight-700 font-size-20 text-dark">90<small class="font-size-12 text-muted">c</small> / 25<small class="font-size-12 text-muted">c</small></span>
          <span class="font-size-11 text-muted">Total Speed</span>
        </div>
      </div>

      <div class="dash-pill-legend-row mt-12">
        <span class="dash-legend-pill pill-purple">Acc 1</span>
        <span class="dash-legend-pill pill-rose">Acc 2</span>
        <span class="dash-legend-pill pill-blue">Acc 3</span>
      </div>
    </div>

  </div>

  <!-- 4. Row 3: Users Table & Live Activity Feed -->
  <div class="dash-grid-main-side">
    
    <!-- Left Column: Recent Users Directory Table -->
    <div class="dash-card p-0">
      <div class="dash-table-header p-20 border-bottom">
        <div>
          <h3 class="dash-card-title">Recent System Users</h3>
          <span class="font-size-12 text-muted">Active team members and platform administrators</span>
        </div>
        <a href="<?= route('admin/users') ?>" class="btn btn-secondary btn-sm">View All Users <i class="fa-solid fa-arrow-right ml-4 font-size-10"></i></a>
      </div>

      <div class="table-responsive">
        <table class="table dash-custom-table">
          <thead>
            <tr>
              <th>User</th>
              <th>Department</th>
              <th>Status</th>
              <th>Joined</th>
              <th class="text-end">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentUsers as $u): ?>
            <tr>
              <td>
                <div class="d-flex align-items-center gap-10">
                  <img src="<?= $u['avatar'] ?>" class="dash-user-table-avatar" alt="User">
                  <div>
                    <div class="font-weight-600 font-size-13 text-dark"><?= sanitize($u['name']) ?></div>
                    <div class="font-size-11 text-muted"><?= sanitize($u['email']) ?></div>
                  </div>
                </div>
              </td>
              <td>
                <span class="badge badge-dept"><?= sanitize($u['department']) ?></span>
              </td>
              <td>
                <?php if ($u['status'] === 'Active'): ?>
                  <span class="badge badge-status-active"><i class="fa-solid fa-circle font-size-8"></i> Active</span>
                <?php else: ?>
                  <span class="badge badge-status-inactive"><i class="fa-solid fa-circle font-size-8"></i> Inactive</span>
                <?php endif; ?>
              </td>
              <td class="font-size-12 text-muted"><?= sanitize($u['joined']) ?></td>
              <td class="text-end">
                <a href="<?= route('admin/profile') ?>?id=<?= (int)$u['id'] ?>" class="btn btn-sm btn-ghost-primary">Profile</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Right Column: Live Enterprise Activity Feed -->
    <div class="dash-card">
      <div class="dash-card-head mb-16">
        <h3 class="dash-card-title">System Activity Log</h3>
        <span class="badge badge-indigo">Live Feed</span>
      </div>

      <div class="dash-activity-list">
        <?php foreach ($activities as $act): ?>
        <div class="dash-act-item">
          <img src="<?= $act['avatar'] ?>" class="dash-act-avatar" alt="Avatar">
          <div class="dash-act-info">
            <div class="dash-act-text">
              <strong class="text-dark"><?= sanitize($act['user']) ?></strong> 
              <?= sanitize($act['action']) ?> 
              <span class="text-primary font-weight-500">"<?= sanitize($act['target']) ?>"</span>
            </div>
            <div class="dash-act-meta">
              <span class="dash-act-board"><i class="fa-regular fa-folder font-size-10"></i> <?= sanitize($act['board']) ?></span>
              <span class="dash-act-time"><i class="fa-regular fa-clock font-size-10"></i> <?= sanitize($act['time']) ?></span>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

  </div>

</div>

<?php require_once VIEWS_PATH . '/layouts/admin/footer.php'; ?>
