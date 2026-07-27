<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= sanitize($pageTitle ?? 'Admin Panel - Trello SaaS') ?></title>
  <!-- FontAwesome 6 Vector Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
  <!-- Chart.js Library for Real Interactive Dashboard Charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="app-container app-container-column">
  <!-- Admin Top Navigation Header -->
  <header class="user-header">
    <div class="header-left">
      <a href="<?= route('admin/dashboard') ?>" class="header-logo">
        <div class="header-logo-icon" style="background: linear-gradient(135deg, #6366F1, #8B5CF6);"><i class="fa-solid fa-user-shield"></i></div>
        <span>Trello Admin</span>
      </a>
    </div>

    <div class="header-right">
      <div class="search-input-group" style="position: relative;">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <input type="text" id="global-header-search-input" placeholder="Search system users, boards, cards..." oninput="handleGlobalHeaderSearch(this, true);">
        <div id="global-search-dropdown" class="global-search-dropdown-results" style="display: none;"></div>
      </div>

      <span class="badge badge-primary font-weight-600">
        <i class="fa-solid fa-shield-halved mr-4"></i> Super Admin
      </span>

      <a href="<?= route('admin/notifications') ?>" class="icon-btn relative-btn" title="System Notifications">
        <i class="fa-regular fa-bell"></i>
        <span class="notification-dot"></span>
      </a>

      <div class="user-avatar-link">
        <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&q=80" class="avatar" alt="Admin System">
      </div>
    </div>
  </header>

  <div class="app-body-wrapper">
    <!-- Admin Workspace Sidebar Included Separately -->
    <?php require_once VIEWS_PATH . '/layouts/admin/sidebar.php'; ?>

    <!-- Main Content Area -->
    <div class="main-content">
