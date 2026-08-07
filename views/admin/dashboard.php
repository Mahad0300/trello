<?php
$page_title = 'Admin Dashboard - Richmondtech';
$page_js = 'admin_dashboard.js';
require_once VIEWS_PATH . '/layouts/admin/header.php';
?>

<div class="dash-ref-container">

  <!-- ========================================== -->
  <!-- SECTION 1: HERO WELCOME HEADER & TOP ACTIONS -->
  <!-- ========================================== -->
  <div class="dash-hero-header">
    <div>
      <h1 class="dash-hero-title">Admin Command Center! <i class="fa-solid fa-shield-halved" aria-hidden="true"></i></h1>
      <p class="dash-hero-subtext">System Performance, Workspaces & Active User Overview</p>
    </div>
    <div class="dash-header-actions-group">
      
      <!-- Export Dropdown Expansion -->
      <div class="dropdown-wrapper pos-relative">
        <button class="btn btn-secondary dropdown-toggle bg-white text-main font-weight-700 min-height-40" data-toggle="dropdown">
          <i class="fa-solid fa-file-csv text-primary mr-6"></i> Export Report <i class="fa-solid fa-chevron-down font-size-11 ml-6"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end width-240 p-8">
          <a href="#" class="dropdown-item" onclick="event.preventDefault();">
            <i class="fa-solid fa-chart-line text-primary"></i> System Performance Report
          </a>
          <a href="#" class="dropdown-item" onclick="event.preventDefault();">
            <i class="fa-solid fa-users text-info"></i> User Activity Audit
          </a>
          <a href="#" class="dropdown-item" onclick="event.preventDefault();">
            <i class="fa-solid fa-briefcase text-warning"></i> Workspace Metrics
          </a>
        </div>
      </div>

      <div class="dash-task-completed-badge">
        <span>92% System Uptime & Goal Achieved</span>
        <div class="dash-progress-track-pill">
          <div class="dash-progress-fill-pink width-92-pc"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Navigation Row -->
  <div class="dash-quick-nav-row dash-quick-nav-wrapper">
    <button class="btn btn-secondary btn-sm dash-quick-nav-btn" data-modal-target="create-user-modal">
      <i class="fa-solid fa-user-plus text-primary mr-6"></i> Provision User
    </button>
    <button type="button" class="btn btn-secondary btn-sm dash-quick-nav-btn" data-modal-target="create-workspace-modal">
      <i class="fa-solid fa-plus text-primary mr-6"></i> Create Workspace
    </button>
    <button class="btn btn-secondary btn-sm dash-quick-nav-btn" data-modal-target="create-board-modal">
      <i class="fa-solid fa-table-columns text-warning mr-6"></i> Create Board
    </button>
  </div>

  <!-- Inactive / Pending Accounts Alert Banner -->
  <div class="dash-alert-banner">
    <div class="flex-row items-center gap-12">
      <i class="fa-solid fa-triangle-exclamation text-warning font-size-18"></i>
      <span class="dash-alert-text">
        <strong>12 Inactive Accounts</strong> need review & security policy verification.
      </span>
    </div>
    <div class="flex-row items-center gap-12">
      <a href="<?= route('admin/users') ?>" class="btn btn-sm btn-warning font-weight-700 br-16">View Accounts</a>
      <button type="button" class="dash-alert-close-btn" onclick="this.closest('.dash-alert-banner').remove();">&times;</button>
    </div>
  </div>

  <!-- Featured Hero Cards Grid (3 Tiles) -->
  <div class="dash-hero-cards-grid">
    <!-- Project Tile 1: Infrastructure Core -->
    <div class="dash-hero-tile-pink">
      <div class="dash-tile-top-flex">
        <div class="dash-tile-icon-badge">
          <i class="fa-solid fa-server"></i>
        </div>
        <button class="dash-tile-action-btn" title="System Actions">
          <i class="fa-solid fa-ellipsis"></i>
        </button>
      </div>
      <span class="badge badge-rose font-weight-700 font-size-11">System Node</span>
      <div class="dash-tile-title-text mt-8">
        Production Infrastructure
        <div class="dash-tile-subtext">PHP 8.2 &bull; MySQL PDO &bull; Apache XAMPP</div>
      </div>
      <div class="dash-tile-footer mt-16">
        <div class="dash-avatar-stack">
          <img src="<?= asset('images/avatars/avatar_elena.svg') ?>" class="avatar" alt="Dev">
          <img src="<?= asset('images/avatars/avatar_chris.svg') ?>" class="avatar" alt="Dev">
          <img src="<?= asset('images/avatars/avatar_sarah.svg') ?>" class="avatar" alt="Dev">
        </div>
        <button class="btn btn-sm dash-hero-btn" onclick="window.location.href='<?= route('admin/workspaces') ?>';">Workspaces &rarr;</button>
      </div>
    </div>

    <!-- Project Tile 2: User Security & Roles -->
    <div class="dash-hero-tile-purple">
      <div class="dash-tile-top-flex">
        <div class="dash-tile-icon-badge">
          <i class="fa-solid fa-shield-halved"></i>
        </div>
        <span class="badge badge-purple font-weight-700 font-size-11">Security Core</span>
      </div>
      <div class="dash-tile-title-text mt-8">
        User Access & RBAC
        <div class="dash-tile-subtext">254 Users &bull; 3 Roles &bull; Audit Logs</div>
      </div>
      <div class="dash-tile-footer mt-16">
        <div class="dash-avatar-stack">
          <img src="<?= asset('images/avatars/avatar_alex.svg') ?>" class="avatar" alt="Admin">
          <img src="<?= asset('images/avatars/avatar_maya.svg') ?>" class="avatar" alt="Admin">
        </div>
        <button class="btn btn-sm dash-hero-btn" onclick="window.location.href='<?= route('admin/users') ?>';">Manage Users &rarr;</button>
      </div>
    </div>

    <!-- Project Tile 3: Active Sprints & Platform Health -->
    <div class="dash-hero-emerald">
      <div class="dash-tile-top-flex">
        <div class="dash-tile-icon-badge bg-white-25">
          <i class="fa-solid fa-chart-line"></i>
        </div>
        <span class="badge dash-hero-emerald-badge">Active Sprints</span>
      </div>
      <div class="dash-tile-title-text font-size-20">
        12 Active Workspaces
        <div class="dash-tile-subtext opacity-9 mt-4">58 Boards &bull; 1,240 Tasks Completed</div>
      </div>
      <div class="flex-row items-center justify-between">
        <button class="btn btn-sm dash-hero-emerald-btn" onclick="window.location.href='<?= route('admin/all-boards') ?>';">View Boards &rarr;</button>
      </div>
    </div>
  </div>


  <!-- ========================================== -->
  <!-- SECTION 2: SYSTEM MANAGEMENT WIDGETS -->
  <!-- ========================================== -->
  <div class="dash-widget-grid-3">

    <!-- Widget 1: Administrative Actions -->
    <div class="dash-card-white">
      <div class="dash-widget-header">
        <h3 class="dash-widget-title">Administrative Actions</h3>
        <button class="dash-circle-btn" title="Provision User" data-modal-target="create-user-modal">
          <i class="fa-solid fa-plus"></i>
        </button>
      </div>

      <div class="dash-filter-row mb-12">
        <button class="dash-filter-pill-active">Today</button>
        <button class="dash-filter-pill-inactive">This Week</button>
      </div>

      <div>
        <span class="dash-ongoing-select-pill">
          <strong class="dash-pill-bold">142</strong> Registered System Users <i class="fa-solid fa-chevron-down dash-pill-chevron"></i>
        </span>
      </div>

      <!-- Active Task Tile -->
      <div class="dash-task-peach-tile">
        <div class="dash-task-card-top">
          <div class="dash-icon-fox" title="System Provisioning"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i></div>
          <div class="dash-check-badge" title="Active Status"><i class="fa-solid fa-check"></i></div>
        </div>
        <h4 class="dash-task-title">User Account Provisioning & Audit</h4>
        <p class="dash-task-desc">
          Manage system team members, access roles, security permissions, and active status.
        </p>
      </div>
    </div>

    <!-- Widget 2: Role Distribution Widget -->
    <div class="dash-card-white">
      <div class="dash-widget-header">
        <h3 class="dash-widget-title"><i class="fa-solid fa-user-shield text-primary mr-6"></i> Role Distribution</h3>
        <a href="<?= route('admin/users') ?>" class="dash-circle-btn" title="Manage Roles">
          <i class="fa-solid fa-arrow-up-right-from-square"></i>
        </a>
      </div>

      <div class="dash-role-dist-wrapper">
        <div>
          <div class="flex-row justify-between font-size-13 font-weight-600 mb-4">
            <span><i class="fa-solid fa-circle text-info font-size-10 mr-6"></i> Standard Users</span>
            <span class="font-weight-700">112 (78%)</span>
          </div>
          <div class="dash-role-progress-track">
            <div class="dash-role-progress-bar-blue"></div>
          </div>
        </div>

        <div>
          <div class="flex-row justify-between font-size-13 font-weight-600 mb-4">
            <span><i class="fa-solid fa-circle text-warning font-size-10 mr-6"></i> Board Managers</span>
            <span class="font-weight-700">18 (13%)</span>
          </div>
          <div class="dash-role-progress-track">
            <div class="dash-role-progress-bar-amber"></div>
          </div>
        </div>

        <div>
          <div class="flex-row justify-between font-size-13 font-weight-600 mb-4">
            <span><i class="fa-solid fa-circle text-purple font-size-10 mr-6"></i> Workspace Admins</span>
            <span class="font-weight-700">12 (9%)</span>
          </div>
          <div class="dash-role-progress-track">
            <div class="dash-role-progress-bar-purple"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Widget 3: System Tasks Breakdown (Donut Chart.js) -->
    <div class="dash-card-white text-center">
      <div class="dash-widget-header">
        <h3 class="dash-widget-title">System Tasks Breakdown</h3>
        <a href="<?= route('admin/all-boards') ?>" class="dash-circle-btn" title="Manage Boards">
          <i class="fa-solid fa-arrow-up-right-from-square"></i>
        </a>
      </div>

      <div class="dash-chart-donut-box">
        <canvas id="projectsDonutChart"></canvas>
      </div>

      <div class="dash-legend-row mt-12">
        <span><i class="fa-solid fa-circle dot-orange"></i> Active Boards: 58</span>
        <span><i class="fa-solid fa-circle dot-blue"></i> Completed: 1,240</span>
      </div>
      <div class="dash-legend-sub">Workspaces: 12 Active</div>
    </div>

    <!-- Widget 4: System Load & Throughput (Line Chart.js) -->
    <div class="dash-card-white dash-card-full-width">
      <div class="dash-widget-header">
        <h3 class="dash-widget-title">System Load & Throughput</h3>
        <button class="dash-circle-btn" title="Performance Metrics">
          <i class="fa-solid fa-sliders"></i>
        </button>
      </div>

      <div class="dash-chart-line-box">
        <canvas id="incomeExpenseLineChart"></canvas>
      </div>
    </div>

  </div>


  <!-- ========================================== -->
  <!-- SECTION 3: PROJECT TEAMS WORKSPACES GRID -->
  <!-- ========================================== -->
  <div class="mt-8">
    <div class="dash-section-header-flex">
      <h3 class="dash-section-title">
        <i class="fa-solid fa-briefcase text-primary mr-6"></i> Organization Workspaces
      </h3>
      <div class="flex-row items-center gap-12">
        <button type="button" class="btn btn-primary boards-hub-create-btn" data-modal-target="create-workspace-modal">
          <i class="fa-solid fa-plus mr-4"></i> Create Workspace
        </button>
        <a href="<?= route('admin/workspaces') ?>" class="text-primary font-weight-700 font-size-13 text-decoration-none">
          Manage Workspaces &rarr;
        </a>
      </div>
    </div>

    <div class="dash-teams-grid">
      <!-- Team 1: Core Engineering -->
      <div class="dash-team-card dash-team-card-active">
        <div class="dash-team-header">
          <div class="dash-team-left-flex">
            <div class="dash-team-icon-clover"><i class="fa-solid fa-leaf" aria-hidden="true"></i></div>
            <div>
              <h4 class="dash-team-name">Engineering Team</h4>
              <span class="dash-team-sub">8 Boards &bull; 24 Cards</span>
            </div>
          </div>
          <div class="dropdown-wrapper pos-relative">
            <button class="dropdown-toggle dash-dropdown-toggle-btn" title="Workspace Options">
              <i class="fa-solid fa-ellipsis-vertical dash-team-options"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end dash-dropdown-menu-sm">
              <a href="#" class="dropdown-item" data-modal-target="manage-workspace-members-modal" onclick="event.preventDefault(); document.getElementById('workspace-name-manage-display').textContent = 'Engineering Team'; window.openModal('manage-workspace-members-modal', this);">
                <i class="fa-solid fa-users text-primary mr-6"></i> Manage Members
              </a>
              <a href="<?= route('admin/workspaces') ?>" class="dropdown-item">
                <i class="fa-solid fa-gear text-info mr-6"></i> Workspace Settings
              </a>
              <a href="<?= route('admin/all-boards') ?>" class="dropdown-item">
                <i class="fa-solid fa-table-columns text-warning mr-6"></i> View All Boards
              </a>
            </div>
          </div>
        </div>

        <div class="dash-tile-avatar-stack mb-12">
          <img src="<?= asset('images/avatars/avatar_elena.svg') ?>" alt="Avatar">
          <img src="<?= asset('images/avatars/avatar_chris.svg') ?>" alt="Avatar">
          <img src="<?= asset('images/avatars/avatar_sarah.svg') ?>" alt="Avatar">
          <div class="dash-avatar-add-btn cursor-pointer" data-modal-target="manage-workspace-members-modal" onclick="document.getElementById('workspace-name-manage-display').textContent = 'Engineering Team'; window.openModal('manage-workspace-members-modal', this);">+</div>
        </div>

        <div class="dash-progress-meta-row">
          <span>Workspace Progress</span>
          <span class="text-primary-purple">88%</span>
        </div>
        <div class="dash-progress-bar-track">
          <div class="progress-bar-fill-80 width-88-pc"></div>
        </div>

        <div class="dash-team-footer">
          <span class="dash-time-pill-purple"><i class="fa-regular fa-clock" aria-hidden="true"></i> Active Workspace</span>
          <div class="gap-8 flex-row">
            <span><i class="fa-solid fa-users" aria-hidden="true"></i> 8</span>
            <span><i class="fa-solid fa-clipboard-list" aria-hidden="true"></i> 24</span>
          </div>
        </div>
      </div>

      <!-- Team 2: Product Design -->
      <div class="dash-team-card">
        <div class="dash-team-header">
          <div class="dash-team-left-flex">
            <div class="dash-team-icon-palette"><i class="fa-solid fa-palette" aria-hidden="true"></i></div>
            <div>
              <h4 class="dash-team-name">Product Design</h4>
              <span class="dash-team-sub">4 Boards &bull; 18 Cards</span>
            </div>
          </div>
          <div class="dropdown-wrapper pos-relative">
            <button class="dropdown-toggle dash-dropdown-toggle-btn" title="Workspace Options">
              <i class="fa-solid fa-ellipsis-vertical dash-team-options"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end dash-dropdown-menu-sm">
              <a href="#" class="dropdown-item" data-modal-target="manage-workspace-members-modal" onclick="event.preventDefault(); document.getElementById('workspace-name-manage-display').textContent = 'Product Design'; window.openModal('manage-workspace-members-modal', this);">
                <i class="fa-solid fa-users text-primary mr-6"></i> Manage Members
              </a>
              <a href="<?= route('admin/workspaces') ?>" class="dropdown-item">
                <i class="fa-solid fa-gear text-info mr-6"></i> Workspace Settings
              </a>
              <a href="<?= route('admin/all-boards') ?>" class="dropdown-item">
                <i class="fa-solid fa-table-columns text-warning mr-6"></i> View All Boards
              </a>
            </div>
          </div>
        </div>

        <div class="dash-tile-avatar-stack mb-12">
          <img src="<?= asset('images/avatars/avatar_default.svg') ?>" alt="Avatar">
          <img src="<?= asset('images/avatars/avatar_default.svg') ?>" alt="Avatar">
          <img src="<?= asset('images/avatars/avatar_alex.svg') ?>" alt="Avatar">
        </div>

        <div class="dash-progress-meta-row">
          <span>Workspace Progress</span>
          <span class="text-primary-purple">92%</span>
        </div>
        <div class="dash-progress-bar-track">
          <div class="progress-bar-fill-90 width-92-pc"></div>
        </div>

        <div class="dash-team-footer">
          <span class="dash-time-pill-purple"><i class="fa-regular fa-clock" aria-hidden="true"></i> Active Workspace</span>
          <div class="gap-8 flex-row">
            <span><i class="fa-solid fa-users" aria-hidden="true"></i> 4</span>
            <span><i class="fa-solid fa-clipboard-list" aria-hidden="true"></i> 18</span>
          </div>
        </div>
      </div>

      <!-- Team 3: Marketing & Growth -->
      <div class="dash-team-card">
        <div class="dash-team-header">
          <div class="dash-team-left-flex">
            <div class="dash-team-icon-laptop"><i class="fa-solid fa-laptop-code" aria-hidden="true"></i></div>
            <div>
              <h4 class="dash-team-name">Growth Marketing</h4>
              <span class="dash-team-sub">5 Boards &bull; 14 Cards</span>
            </div>
          </div>
          <div class="dropdown-wrapper pos-relative">
            <button class="dropdown-toggle dash-dropdown-toggle-btn" title="Workspace Options">
              <i class="fa-solid fa-ellipsis-vertical dash-team-options"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end dash-dropdown-menu-sm">
              <a href="#" class="dropdown-item" data-modal-target="manage-workspace-members-modal" onclick="event.preventDefault(); document.getElementById('workspace-name-manage-display').textContent = 'Growth Marketing'; window.openModal('manage-workspace-members-modal', this);">
                <i class="fa-solid fa-users text-primary mr-6"></i> Manage Members
              </a>
              <a href="<?= route('admin/workspaces') ?>" class="dropdown-item">
                <i class="fa-solid fa-gear text-info mr-6"></i> Workspace Settings
              </a>
              <a href="<?= route('admin/all-boards') ?>" class="dropdown-item">
                <i class="fa-solid fa-table-columns text-warning mr-6"></i> View All Boards
              </a>
            </div>
          </div>
        </div>

        <div class="dash-tile-avatar-stack mb-12">
          <img src="<?= asset('images/avatars/avatar_chris.svg') ?>" alt="Avatar">
          <img src="<?= asset('images/avatars/avatar_sarah.svg') ?>" alt="Avatar">
        </div>

        <div class="dash-progress-meta-row">
          <span>Workspace Progress</span>
          <span class="text-info-blue">75%</span>
        </div>
        <div class="dash-progress-bar-track">
          <div class="progress-bar-fill-70 width-75-pc"></div>
        </div>

        <div class="dash-team-footer">
          <span class="dash-time-pill-blue"><i class="fa-regular fa-clock" aria-hidden="true"></i> Active Workspace</span>
          <div class="gap-8 flex-row">
            <span><i class="fa-solid fa-users" aria-hidden="true"></i> 5</span>
            <span><i class="fa-solid fa-clipboard-list" aria-hidden="true"></i> 14</span>
          </div>
        </div>
      </div>

      <!-- Team 4: Operations -->
      <div class="dash-team-card">
        <div class="dash-team-header">
          <div class="dash-team-left-flex">
            <div class="dash-team-icon-cloud"><i class="fa-solid fa-cloud" aria-hidden="true"></i></div>
            <div>
              <h4 class="dash-team-name">Operations</h4>
              <span class="dash-team-sub">6 Boards &bull; 9 Cards</span>
            </div>
          </div>
          <div class="dropdown-wrapper pos-relative">
            <button class="dropdown-toggle dash-dropdown-toggle-btn" title="Workspace Options">
              <i class="fa-solid fa-ellipsis-vertical dash-team-options"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end dash-dropdown-menu-sm">
              <a href="#" class="dropdown-item" data-modal-target="manage-workspace-members-modal" onclick="event.preventDefault(); document.getElementById('workspace-name-manage-display').textContent = 'Operations'; window.openModal('manage-workspace-members-modal', this);">
                <i class="fa-solid fa-users text-primary mr-6"></i> Manage Members
              </a>
              <a href="<?= route('admin/workspaces') ?>" class="dropdown-item">
                <i class="fa-solid fa-gear text-info mr-6"></i> Workspace Settings
              </a>
              <a href="<?= route('admin/all-boards') ?>" class="dropdown-item">
                <i class="fa-solid fa-table-columns text-warning mr-6"></i> View All Boards
              </a>
            </div>
          </div>
        </div>

        <div class="dash-tile-avatar-stack mb-12">
          <img src="<?= asset('images/avatars/avatar_elena.svg') ?>" alt="Avatar">
          <img src="<?= asset('images/avatars/avatar_alex.svg') ?>" alt="Avatar">
        </div>

        <div class="dash-progress-meta-row">
          <span>Workspace Progress</span>
          <span class="text-orange">65%</span>
        </div>
        <div class="dash-progress-bar-track">
          <div class="progress-bar-fill-40 width-65-pc"></div>
        </div>

        <div class="dash-team-footer">
          <span class="dash-time-pill-orange"><i class="fa-regular fa-clock" aria-hidden="true"></i> Active Workspace</span>
          <div class="gap-8 flex-row">
            <span><i class="fa-solid fa-users" aria-hidden="true"></i> 6</span>
            <span><i class="fa-solid fa-clipboard-list" aria-hidden="true"></i> 9</span>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- ========================================== -->
  <!-- SECTION 4: SPRINT WORK SCHEDULE TIMELINE -->
  <!-- ========================================== -->
  <div class="dash-timeline-and-chat-grid mt-8">
    <div class="dash-card-white">
      <div class="dash-timeline-header flex-wrap gap-12">
        <div class="dash-timeline-title">
          <i class="fa-regular fa-calendar-days text-primary"></i> System Roadmap & Release Timeline &bull; July 2026
        </div>
        <div class="dash-timeline-filters">
          <span class="dash-filter-active">Daily</span>
          <span class="cursor-pointer">Weekly</span>
          <span class="cursor-pointer">Monthly</span>
          <span class="cursor-pointer">Quarterly</span>
        </div>
      </div>

      <div class="overflow-x-auto">
        <div class="min-width-640">
          <!-- Schedule Rows -->
          <div class="dash-timeline-row">
            <span class="dash-row-title-active">Core Architecture Sprint</span>
            <div class="dash-timeline-bar-purple">
              <div class="align-center gap-6 flex-row">
                <div class="dash-tile-avatar-stack">
                  <img src="<?= asset('images/avatars/avatar_elena.svg') ?>">
                  <img src="<?= asset('images/avatars/avatar_chris.svg') ?>">
                </div>
                <span>Core Endpoint Review</span>
              </div>
              <span class="dash-pct-pill">85%</span>
            </div>
          </div>

          <div class="dash-timeline-row">
            <span class="dash-row-title">API v3 Security Migration</span>
            <div class="flex-center">
              <div class="dash-timeline-bar-green w-280">
                <div class="align-center gap-6 flex-row">
                  <img src="<?= asset('images/avatars/avatar_sarah.svg') ?>" class="avatar-sm">
                  <span>Security Audit Pass</span>
                </div>
                <span class="dash-pct-pill">70%</span>
              </div>
            </div>
          </div>

          <div class="dash-timeline-row">
            <span class="dash-row-title">Design System 2.0 Deployment</span>
            <div class="timeline-pl-80">
              <div class="dash-timeline-bar-vibrant-green w-320">
                <div class="align-center gap-6 flex-row">
                  <div class="dash-tile-avatar-stack">
                    <img src="<?= asset('images/avatars/avatar_default.svg') ?>">
                    <img src="<?= asset('images/avatars/avatar_default.svg') ?>">
                  </div>
                  <span>Token Approval</span>
                </div>
                <span class="dash-pct-pill text-success">90%</span>
              </div>
            </div>
          </div>

          <!-- Time Stamps Bar -->
          <div class="dash-timestamps-bar">
            <span>09:00 AM</span><span>10:00 AM</span><span>11:00 AM</span><span>12:00 PM</span><span>01:00 PM</span><span>02:00 PM</span>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- ========================================== -->
  <!-- SECTION 5: SYSTEM ACTIVITY STREAM & AUDIT LOG -->
  <!-- ========================================== -->
  <div class="dash-card-white mt-10">
    <div class="dash-act-header">
      <h3 class="dash-act-title">System Activity Stream & Audit Log</h3>
      <i class="fa-solid fa-ellipsis-vertical dash-act-options"></i>
    </div>

    <div class="dash-act-stack">
      <div class="dash-vertical-line"></div>

      <!-- Item 1 (Bulk Action Highlighted) -->
      <div class="dash-act-item">
        <div class="dash-act-left-flex">
          <div class="pos-relative">
            <img src="<?= asset('images/avatars/avatar_admin.svg') ?>" class="dash-act-avatar">
            <div class="dash-act-dot-orange"></div>
          </div>
          <div>
            <h4 class="dash-act-username">
              Admin System
              <span class="badge dash-badge-bulk">Bulk Action</span>
            </h4>
            <p class="dash-act-text">Executed bulk deactivation on <strong class="text-dark-slate">12 inactive user accounts</strong> for security policy compliance.</p>
          </div>
        </div>
        <span class="dash-act-time">5 mins ago</span>
      </div>

      <!-- Item 2 -->
      <div class="dash-act-item">
        <div class="dash-act-left-flex">
          <div class="pos-relative">
            <img src="<?= asset('images/avatars/avatar_admin.svg') ?>" class="dash-act-avatar">
            <div class="dash-act-dot-green"></div>
          </div>
          <div>
            <h4 class="dash-act-username">Admin System</h4>
            <p class="dash-act-text">Provisioned new active user account <strong class="text-dark-slate">"David Chen (david@richmondtech.com)"</strong> with Standard User role.</p>
          </div>
        </div>
        <span class="dash-act-time">25 mins ago</span>
      </div>

      <!-- Item 3 -->
      <div class="dash-act-item">
        <div class="dash-act-left-flex">
          <div class="pos-relative">
            <img src="<?= asset('images/avatars/avatar_chris.svg') ?>" class="dash-act-avatar">
            <div class="dash-act-dot-orange"></div>
          </div>
          <div>
            <h4 class="dash-act-username">Chris Parker</h4>
            <p class="dash-act-text">Updated board settings for <strong class="text-dark-slate">"Q1 Legacy Architecture"</strong> in Engineering Team workspace.</p>
          </div>
        </div>
        <span class="dash-act-time">2 hours ago</span>
      </div>

      <!-- Item 4 -->
      <div class="dash-act-item">
        <div class="dash-act-left-flex">
          <div class="pos-relative">
            <img src="<?= asset('images/avatars/avatar_sarah.svg') ?>" class="dash-act-avatar">
            <div class="dash-act-dot-green"></div>
          </div>
          <div>
            <h4 class="dash-act-username">Sarah Connor</h4>
            <p class="dash-act-text">Updated board permissions for <strong class="text-dark-slate">"Sprint 24 - Core Architecture"</strong>.</p>
          </div>
        </div>
        <span class="dash-act-time">5 hours ago</span>
      </div>

      <!-- Item 5 -->
      <div class="dash-act-item">
        <div class="dash-act-left-flex">
          <div class="pos-relative">
            <img src="<?= asset('images/avatars/avatar_alex.svg') ?>" class="dash-act-avatar">
            <div class="dash-act-dot-orange"></div>
          </div>
          <div>
            <h4 class="dash-act-username">Alex Johnson</h4>
            <p class="dash-act-text">Executed automated nightly database backup and file uploads synchronization.</p>
          </div>
        </div>
        <span class="dash-act-time">1 day ago</span>
      </div>
    </div>
  </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // 1. Donut Chart
  const donutCtx = document.getElementById('projectsDonutChart');
  if (donutCtx) {
    new Chart(donutCtx, {
      type: 'doughnut',
      data: {
        labels: ['Active Boards', 'Completed Tasks', 'Workspaces'],
        datasets: [{
          data: [58, 1240, 12],
          backgroundColor: ['#F97316', '#0284C7', '#8B5CF6'],
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
                return ' ' + context.label + ': ' + context.raw;
              }
            }
          }
        }
      }
    });
  }

  // 2. Line Chart
  const lineCtx = document.getElementById('incomeExpenseLineChart');
  if (lineCtx) {
    new Chart(lineCtx, {
      type: 'line',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [
          {
            label: 'System Load %',
            data: [45, 62, 58, 74, 85, 92, 88],
            borderColor: '#0284C7',
            backgroundColor: 'rgba(2, 132, 199, 0.1)',
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointRadius: 3,
            pointHoverRadius: 6
          },
          {
            label: 'API Throughput',
            data: [30, 48, 42, 55, 68, 80, 75],
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

<?php require_once VIEWS_PATH . '/layouts/admin/footer.php'; ?>
