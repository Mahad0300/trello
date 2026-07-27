<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= sanitize($pageTitle ?? 'Trello Workspace') ?></title>
  <!-- FontAwesome 6 Vector Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
  <!-- Chart.js Library for Real Interactive Dashboard Charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="app-container app-container-column">
  <!-- User Top Navigation Header -->
  <header class="user-header">
    <div class="header-left">
      <a href="<?= route('user/dashboard') ?>" class="header-logo">
        <div class="header-logo-icon"><i class="fa-solid fa-kanban"></i></div>
        <span>Trello SaaS</span>
      </a>
    </div>

    <div class="header-right">
      <div class="search-input-group" style="position: relative;">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <input type="text" id="global-header-search-input" placeholder="Search boards, cards, tasks..." oninput="handleGlobalHeaderSearch(this);">
        <div id="global-search-dropdown" class="global-search-dropdown-results" style="display: none;"></div>
      </div>

      <a href="<?= route('user/notifications') ?>" class="icon-btn relative-btn" title="Notifications">
        <i class="fa-regular fa-bell"></i>
        <span class="notification-dot"></span>
      </a>

      <a href="<?= route('user/profile') ?>" class="user-avatar-link">
        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" class="avatar" alt="Mahad Bukhari">
      </a>
    </div>
  </header>

  <div class="app-body-wrapper">
    <!-- User Workspace Sidebar Included Separately -->
    <?php require_once VIEWS_PATH . '/layouts/user/sidebar.php'; ?>

    <!-- Main Content Area -->
    <div class="main-content">
