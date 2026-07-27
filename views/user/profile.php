<?php
$page_title = 'Profile - Trello SaaS';
$page_js = 'profile.js';
require_once VIEWS_PATH . '/layouts/user/header.php';
?>

<div class="notif-center-wrapper">

  <!-- Page Header Toolbar (Consistent with All Boards Hub & Notifications) -->
  <div class="notif-header-toolbar mb-24">
    <div class="notif-header-left">
      <div class="notif-icon-badge notif-icon-badge-gradient">
        <i class="fa-solid fa-user icon-primary"></i>
      </div>
      <div>
        <h1 class="notif-main-title">Account & Profile Settings</h1>
        <p class="notif-subtext">Manage your public profile, notification preferences, and password.</p>
      </div>
    </div>
  </div>

  <div class="profile-layout-grid">
    <!-- Left Profile Card -->
    <div>
      <div class="table-card profile-card-center">
        <img src="<?= $user['avatar'] ?>" class="profile-avatar-img">
        <h3 class="profile-user-name"><?= sanitize($user['name']) ?></h3>
        <p class="profile-user-role"><?= sanitize($user['role']) ?></p>
        <span class="badge badge-success">Active Member</span>

        <div class="profile-info-block">
          <div class="profile-meta-item">
            <i class="fa-solid fa-location-dot profile-icon-primary"></i> <?= sanitize($user['location']) ?>
          </div>
          <div class="profile-meta-item">
            <i class="fa-regular fa-calendar-check profile-icon-primary"></i> Joined <?= sanitize($user['joined']) ?>
          </div>
          <div class="profile-meta-item-last">
            <i class="fa-solid fa-kanban profile-icon-primary"></i> <?= $user['boards_count'] ?> Active Boards
          </div>
        </div>
      </div>
    </div>

    <!-- Right Forms Column -->
    <div>
      <!-- Personal Information Form -->
      <div class="table-card profile-card-padded">
        <h3 class="section-title">Personal Information</h3>
        <form onsubmit="event.preventDefault(); alert('Static UI Preview: Profile Updated');">
          <div class="form-grid-2col">
            <div class="form-group">
              <label>Full Name</label>
              <input type="text" class="form-control" value="<?= sanitize($user['name']) ?>">
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" class="form-control" value="<?= sanitize($user['email']) ?>">
            </div>
          </div>

          <div class="form-group">
            <label>Bio / Headline</label>
            <textarea class="form-control no-resize" rows="2"><?= sanitize($user['bio']) ?></textarea>
          </div>

          <div class="form-group">
            <label>Location</label>
            <input type="text" class="form-control" value="<?= sanitize($user['location']) ?>">
          </div>

          <button type="submit" class="btn btn-primary btn-mt-sm">Save Profile Changes</button>
        </form>
      </div>

      <!-- Password Update Form -->
      <div class="table-card profile-card-plain">
        <h3 class="section-title">Update Password</h3>
        <form onsubmit="event.preventDefault(); alert('Static UI Preview: Password Changed');">
          <div class="form-group">
            <label>Current Password</label>
            <input type="password" class="form-control" placeholder="••••••••">
          </div>

          <div class="form-grid-2col">
            <div class="form-group">
              <label>New Password</label>
              <input type="password" class="form-control" placeholder="••••••••">
            </div>
            <div class="form-group">
              <label>Confirm New Password</label>
              <input type="password" class="form-control" placeholder="••••••••">
            </div>
          </div>

          <button type="submit" class="btn btn-secondary btn-mt-sm">Update Password</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once VIEWS_PATH . '/layouts/user/footer.php'; ?>
