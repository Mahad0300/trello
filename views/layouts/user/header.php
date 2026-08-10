<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= sanitize($pageTitle ?? 'Richmondtech') ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>window.BASE_URL = "<?= BASE_URL ?>";</script>
</head>
<body>
<div class="app-container app-container-column">
  <header class="app-topbar">
    <div class="topbar-left">
      <a href="<?= route('user/dashboard') ?>" class="header-logo">
        <span class="header-logo-icon"><i class="fa-solid fa-layer-group"></i></span>
        <span class="header-logo-copy">
          <span class="header-logo-name">Richmondtech</span>
          <span class="header-logo-tag">Workspace</span>
        </span>
      </a>
    </div>

    <div class="topbar-center">
      <div class="search-input-group topbar-search">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <input type="text" id="global-header-search-input" placeholder="Search boards, cards, tasks..." data-global-search>
        <div id="global-search-dropdown" class="global-search-dropdown-results display-none"></div>
      </div>
    </div>

    <div class="topbar-right">
      <a href="<?= route('user/notifications') ?>" class="icon-btn relative-btn" title="Notifications">
        <i class="fa-regular fa-bell"></i>
        <span class="notification-dot"></span>
      </a>

      <a href="<?= route('user/profile') ?>" class="topbar-profile topbar-profile--link">
        <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="avatar topbar-avatar" alt="Chris Parker">
        <span class="topbar-profile-meta">
          <span class="topbar-profile-name">Chris Parker</span>
          <span class="topbar-profile-email">chris@richmondtech.com</span>
        </span>
      </a>
    </div>
  </header>

  <div class="app-body-wrapper">
    <?php require_once VIEWS_PATH . '/layouts/user/sidebar.php'; ?>
    <div class="main-content">
