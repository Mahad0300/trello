<?php
$page_title = 'Admin Dashboard - Trello SaaS';
$page_js = 'admin_dashboard.js';
require_once VIEWS_PATH . '/layouts/admin/header.php';
?>

<div class="dash-ref-container">

  <!-- ========================================== -->
  <!-- SECTION 1: HERO WELCOME HEADER & TOP ACTIONS -->
  <!-- ========================================== -->
  <div class="dash-hero-header">
    <div>
      <h1 class="dash-hero-title">Admin Command Center! 🛡️</h1>
      <p class="dash-hero-subtext">System Performance, Workspaces & Active User Overview</p>
    </div>
    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
      
      <!-- Export Dropdown Expansion -->
      <div class="dropdown-wrapper" style="position: relative;">
        <button class="btn btn-secondary dropdown-toggle" style="background: white; color: var(--text-main); font-weight: 700; min-height: 40px;" data-toggle="dropdown">
          <i class="fa-solid fa-file-csv text-primary mr-6"></i> Export Report <i class="fa-solid fa-chevron-down font-size-11 ml-6"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end" style="width: 240px; padding: 8px;">
          <a href="#" class="dropdown-item" onclick="event.preventDefault(); alert('System Performance Report CSV downloaded!');">
            <i class="fa-solid fa-chart-line text-primary"></i> System Performance Report
          </a>
          <a href="#" class="dropdown-item" onclick="event.preventDefault(); alert('User Activity Audit CSV downloaded!');">
            <i class="fa-solid fa-users text-info"></i> User Activity Audit
          </a>
          <a href="#" class="dropdown-item" onclick="event.preventDefault(); alert('Workspace Metrics CSV downloaded!');">
            <i class="fa-solid fa-briefcase text-warning"></i> Workspace Metrics
          </a>
        </div>
      </div>

      <div class="dash-task-completed-badge">
        <span>92% System Uptime & Goal Achieved</span>
        <div class="dash-progress-track-pill">
          <div class="dash-progress-fill-pink" style="width: 92%;"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Navigation Row -->
  <div class="dash-quick-nav-row" style="display: flex; align-items: center; gap: 12px; overflow-x: auto; padding-bottom: 4px;">
    <button class="btn btn-secondary btn-sm" style="background: white; border-radius: 20px; font-weight: 600; min-height: 40px; padding: 8px 16px; white-space: nowrap;" data-modal-target="create-user-modal">
      <i class="fa-solid fa-user-plus text-primary mr-6"></i> Provision User
    </button>
    <button class="btn btn-secondary btn-sm" style="background: white; border-radius: 20px; font-weight: 600; min-height: 40px; padding: 8px 16px; white-space: nowrap;" data-modal-target="create-workspace-modal">
      <i class="fa-solid fa-plus text-purple mr-6"></i> Create Workspace
    </button>
    <button class="btn btn-secondary btn-sm" style="background: white; border-radius: 20px; font-weight: 600; min-height: 40px; padding: 8px 16px; white-space: nowrap;" data-modal-target="create-board-modal">
      <i class="fa-solid fa-table-columns text-warning mr-6"></i> Create Board
    </button>
    <button class="btn btn-secondary btn-sm" style="background: white; border-radius: 20px; font-weight: 600; min-height: 40px; padding: 8px 16px; white-space: nowrap;" onclick="window.location.href='<?= route('admin/all-boards') ?>';">
      <i class="fa-solid fa-box-archive text-danger mr-6"></i> View Archived
    </button>
  </div>

  <!-- Inactive / Pending Accounts Alert Banner -->
  <div class="dash-alert-banner" style="background: #FFFBEB; border: 1px solid #FCD34D; border-radius: var(--radius-md); padding: 12px 18px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
    <div style="display: flex; align-items: center; gap: 12px;">
      <i class="fa-solid fa-triangle-exclamation text-warning font-size-18"></i>
      <span style="font-size: 13.5px; font-weight: 600; color: #92400E;">
        <strong>12 Inactive Accounts</strong> need review & security policy verification.
      </span>
    </div>
    <div style="display: flex; align-items: center; gap: 12px;">
      <a href="<?= route('admin/users') ?>" class="btn btn-sm btn-warning" style="background: #F59E0B; color: white; border: none; font-weight: 700; padding: 6px 14px; border-radius: 16px;">View Accounts</a>
      <button type="button" style="background: none; border: none; font-size: 18px; color: #92400E; cursor: pointer;" onclick="this.closest('.dash-alert-banner').remove();">&times;</button>
    </div>
  </div>

  <!-- Featured Hero Cards Grid (3 Tiles) -->
  <div class="dash-hero-cards-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
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
      <div class="dash-tile-title-text">
        Infrastructure Core & Database Cluster Performance
      </div>
      <div class="dash-tile-avatar-stack">
        <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&q=80" alt="Admin System">
        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" alt="Mahad Bukhari">
        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" alt="Sarah Connor">
      </div>
    </div>

    <!-- Project Tile 2: Enterprise Security -->
    <div class="dash-hero-tile-purple">
      <div class="dash-tile-top-flex">
        <div class="dash-tile-icon-badge">
          <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div class="dash-tile-emoji-badge">⚡</div>
      </div>
      <div class="dash-tile-title-text">
        Enterprise Security & Role-Based Access Audit
      </div>
      <div class="dash-tile-avatar-stack">
        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80" alt="Alex Johnson">
        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&q=80" alt="Elena Rostova">
        <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&q=80" alt="Admin System">
      </div>
    </div>

    <!-- Project Tile 3: Archived Items Summary Tile -->
    <div class="dash-hero-tile-amber" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); border-radius: 24px; padding: 28px; color: white; box-shadow: 0 10px 25px rgba(245, 158, 11, 0.22); min-height: 200px; display: flex; flex-direction: column; justify-content: space-between;">
      <div class="dash-tile-top-flex">
        <div class="dash-tile-icon-badge" style="background: rgba(255, 255, 255, 0.25);">
          <i class="fa-solid fa-box-archive"></i>
        </div>
        <span class="badge" style="background: rgba(255, 255, 255, 0.3); color: white; font-weight: 700; font-size: 11px;">Soft-Archived</span>
      </div>
      <div class="dash-tile-title-text" style="font-size: 20px;">
        23 Archived Items
        <div style="font-size: 13px; font-weight: 500; opacity: 0.9; margin-top: 4px;">18 Cards • 5 List Columns</div>
      </div>
      <div style="display: flex; align-items: center; justify-content: space-between;">
        <button class="btn btn-sm" style="background: white; color: #D97706; font-weight: 700; border-radius: 16px; padding: 6px 14px;" onclick="window.location.href='<?= route('admin/all-boards') ?>';">Review Panel →</button>
      </div>
    </div>
  </div>


  <!-- ========================================== -->
  <!-- SECTION 2: SYSTEM MANAGEMENT WIDGETS -->
  <!-- ========================================== -->
  <div class="dash-widget-grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px;">

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
          <div class="dash-icon-fox" title="System Provisioning">🛡️</div>
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

      <div style="display: flex; flex-direction: column; gap: 14px; margin-top: 8px;">
        <div>
          <div style="display: flex; justify-content: space-between; font-size: 13px; font-weight: 600; margin-bottom: 4px;">
            <span><i class="fa-solid fa-circle text-info font-size-10 mr-6"></i> Standard Users</span>
            <span class="font-weight-700">112 (78%)</span>
          </div>
          <div style="height: 8px; border-radius: 4px; background: #E2E8F0; overflow: hidden;">
            <div style="height: 100%; width: 78%; background: #0284C7; border-radius: 4px;"></div>
          </div>
        </div>

        <div>
          <div style="display: flex; justify-content: space-between; font-size: 13px; font-weight: 600; margin-bottom: 4px;">
            <span><i class="fa-solid fa-circle text-warning font-size-10 mr-6"></i> Board Managers</span>
            <span class="font-weight-700">18 (13%)</span>
          </div>
          <div style="height: 8px; border-radius: 4px; background: #E2E8F0; overflow: hidden;">
            <div style="height: 100%; width: 13%; background: #F59E0B; border-radius: 4px;"></div>
          </div>
        </div>

        <div>
          <div style="display: flex; justify-content: space-between; font-size: 13px; font-weight: 600; margin-bottom: 4px;">
            <span><i class="fa-solid fa-circle text-purple font-size-10 mr-6"></i> Workspace Admins</span>
            <span class="font-weight-700">12 (9%)</span>
          </div>
          <div style="height: 8px; border-radius: 4px; background: #E2E8F0; overflow: hidden;">
            <div style="height: 100%; width: 9%; background: #8B5CF6; border-radius: 4px;"></div>
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

      <div class="dash-donut-container" style="height: 160px; position: relative;">
        <canvas id="projectsDonutChart"></canvas>
      </div>

      <div class="dash-legend-row" style="margin-top: 12px;">
        <span><i class="fa-solid fa-circle dot-orange"></i> Active Boards: 58</span>
        <span><i class="fa-solid fa-circle dot-blue"></i> Completed: 1,240</span>
      </div>
      <div class="dash-legend-sub">Workspaces: 12 Active</div>
    </div>

    <!-- Widget 4: System Load & Throughput (Line Chart.js) -->
    <div class="dash-card-white" style="grid-column: 1 / -1;">
      <div class="dash-widget-header">
        <h3 class="dash-widget-title">System Load & Throughput</h3>
        <button class="dash-circle-btn" title="Performance Metrics">
          <i class="fa-solid fa-sliders"></i>
        </button>
      </div>

      <div class="dash-chart-container" style="height: 200px; position: relative;">
        <canvas id="incomeExpenseLineChart"></canvas>
      </div>
    </div>

  </div>


  <!-- ========================================== -->
  <!-- SECTION 3: PROJECT TEAMS WORKSPACES GRID -->
  <!-- ========================================== -->
  <div style="margin-top: 8px;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; flex-wrap: wrap; gap: 12px;">
      <h3 style="font-size: 18px; font-weight: 800; margin: 0; color: #0F172A;">
        <i class="fa-solid fa-briefcase text-primary mr-6"></i> Organization Workspaces
      </h3>
      <div style="display: flex; align-items: center; gap: 12px;">
        <button class="btn btn-sm btn-primary" style="border-radius: 16px; font-weight: 600;" data-modal-target="create-workspace-modal">
          <i class="fa-solid fa-plus mr-4"></i> Create Workspace
        </button>
        <a href="<?= route('admin/workspaces') ?>" class="text-primary font-weight-700 font-size-13 text-decoration-none">
          Manage Workspaces →
        </a>
      </div>
    </div>

    <div class="dash-teams-grid">
      <!-- Team 1: Core Engineering -->
      <div class="dash-team-card dash-team-card-active">
        <div class="dash-team-header">
          <div class="dash-team-left-flex">
            <div class="dash-team-icon-clover">🍀</div>
            <div>
              <h4 class="dash-team-name">Engineering Team</h4>
              <span class="dash-team-sub">8 Boards • 24 Cards</span>
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
          <span>Workspace Progress</span>
          <span class="text-primary-purple">88%</span>
        </div>
        <div class="dash-progress-bar-track">
          <div class="progress-bar-fill-80" style="width: 88%;"></div>
        </div>

        <div class="dash-team-footer">
          <span class="dash-time-pill-purple">🕒 Active Workspace</span>
          <div class="gap-8 flex-row">
            <span>👥 8</span>
            <span>📋 24</span>
          </div>
        </div>
      </div>

      <!-- Team 2: Product Design -->
      <div class="dash-team-card">
        <div class="dash-team-header">
          <div class="dash-team-left-flex">
            <div class="dash-team-icon-palette">🎨</div>
            <div>
              <h4 class="dash-team-name">Product Design</h4>
              <span class="dash-team-sub">4 Boards • 18 Cards</span>
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
          <span>Workspace Progress</span>
          <span class="text-primary-purple">92%</span>
        </div>
        <div class="dash-progress-bar-track">
          <div class="progress-bar-fill-90" style="width: 92%;"></div>
        </div>

        <div class="dash-team-footer">
          <span class="dash-time-pill-purple">🕒 Active Workspace</span>
          <div class="gap-8 flex-row">
            <span>👥 4</span>
            <span>📋 18</span>
          </div>
        </div>
      </div>

      <!-- Team 3: Marketing & Growth -->
      <div class="dash-team-card">
        <div class="dash-team-header">
          <div class="dash-team-left-flex">
            <div class="dash-team-icon-laptop">💻</div>
            <div>
              <h4 class="dash-team-name">Growth Marketing</h4>
              <span class="dash-team-sub">5 Boards • 14 Cards</span>
            </div>
          </div>
          <i class="fa-solid fa-ellipsis-vertical dash-team-options"></i>
        </div>

        <div class="dash-tile-avatar-stack mb-12">
          <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" alt="Avatar">
          <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" alt="Avatar">
        </div>

        <div class="dash-progress-meta-row">
          <span>Workspace Progress</span>
          <span class="text-info-blue">75%</span>
        </div>
        <div class="dash-progress-bar-track">
          <div class="progress-bar-fill-70" style="width: 75%;"></div>
        </div>

        <div class="dash-team-footer">
          <span class="dash-time-pill-blue">🕒 Active Workspace</span>
          <div class="gap-8 flex-row">
            <span>👥 5</span>
            <span>📋 14</span>
          </div>
        </div>
      </div>

      <!-- Team 4: Operations -->
      <div class="dash-team-card">
        <div class="dash-team-header">
          <div class="dash-team-left-flex">
            <div class="dash-team-icon-cloud">☁️</div>
            <div>
              <h4 class="dash-team-name">Operations</h4>
              <span class="dash-team-sub">6 Boards • 9 Cards</span>
            </div>
          </div>
          <i class="fa-solid fa-ellipsis-vertical dash-team-options"></i>
        </div>

        <div class="dash-tile-avatar-stack mb-12">
          <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&q=80" alt="Avatar">
          <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80" alt="Avatar">
        </div>

        <div class="dash-progress-meta-row">
          <span>Workspace Progress</span>
          <span class="text-orange">65%</span>
        </div>
        <div class="dash-progress-bar-track">
          <div class="progress-bar-fill-40" style="width: 65%;"></div>
        </div>

        <div class="dash-team-footer">
          <span class="dash-time-pill-orange">🕒 Active Workspace</span>
          <div class="gap-8 flex-row">
            <span>👥 6</span>
            <span>📋 9</span>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- ========================================== -->
  <!-- SECTION 4: SPRINT WORK SCHEDULE TIMELINE -->
  <!-- ========================================== -->
  <div class="dash-timeline-and-chat-grid" style="margin-top: 8px;">
    <div class="dash-card-white">
      <div class="dash-timeline-header" style="flex-wrap: wrap; gap: 12px;">
        <div class="dash-timeline-title">
          <i class="fa-regular fa-calendar-days text-primary"></i> System Roadmap & Release Timeline • July 2026
        </div>
        <div class="dash-timeline-filters">
          <span class="dash-filter-active">Daily</span>
          <span class="cursor-pointer">Weekly</span>
          <span class="cursor-pointer">Monthly</span>
          <span class="cursor-pointer">Quarterly</span>
        </div>
      </div>

      <div style="overflow-x: auto;">
        <div style="min-width: 640px;">
          <!-- Schedule Rows -->
          <div class="dash-timeline-row">
            <span class="dash-row-title-active">Core Architecture Sprint</span>
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

          <div class="dash-timeline-row">
            <span class="dash-row-title">API v3 Security Migration</span>
            <div class="flex-center">
              <div class="dash-timeline-bar-green w-280">
                <div class="align-center gap-6 flex-row">
                  <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" class="avatar-sm">
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
                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&q=80">
                    <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=100&q=80">
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
            <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&q=80" class="dash-act-avatar">
            <div class="dash-act-dot-orange"></div>
          </div>
          <div>
            <h4 class="dash-act-username">
              Admin System
              <span class="badge" style="background: #FEF3C7; color: #D97706; font-weight: 700; font-size: 10px; padding: 2px 8px; border-radius: 10px; margin-left: 6px;">Bulk Action</span>
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
            <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&q=80" class="dash-act-avatar">
            <div class="dash-act-dot-green"></div>
          </div>
          <div>
            <h4 class="dash-act-username">Admin System</h4>
            <p class="dash-act-text">Provisioned new active user account <strong class="text-dark-slate">"David Chen (david@trello.com)"</strong> with Standard User role.</p>
          </div>
        </div>
        <span class="dash-act-time">25 mins ago</span>
      </div>

      <!-- Item 3 -->
      <div class="dash-act-item">
        <div class="dash-act-left-flex">
          <div class="pos-relative">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" class="dash-act-avatar">
            <div class="dash-act-dot-orange"></div>
          </div>
          <div>
            <h4 class="dash-act-username">Mahad Bukhari</h4>
            <p class="dash-act-text">Archived workspace board <strong class="text-dark-slate">"Q1 Legacy Architecture"</strong> in Engineering Team workspace.</p>
          </div>
        </div>
        <span class="dash-act-time">2 hours ago</span>
      </div>

      <!-- Item 4 -->
      <div class="dash-act-item">
        <div class="dash-act-left-flex">
          <div class="pos-relative">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" class="dash-act-avatar">
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
            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80" class="dash-act-avatar">
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

<!-- Modal Dialog Components -->
<?php require_once VIEWS_PATH . '/partials/modals/create_user_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/create_board_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/create_workspace_modal.php'; ?>

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
