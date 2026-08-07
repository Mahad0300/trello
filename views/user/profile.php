<?php
$page_title = 'Profile - Richmondtech';
$page_js = 'profile.js';
require_once VIEWS_PATH . '/layouts/user/header.php';

$statusLabel = $user['status_label'] ?? 'Active Member';
$statusClass = ($user['status'] ?? 'Active') === 'Inactive' ? 'badge-danger' : 'badge-success';
?>

<div class="notif-center-wrapper profile-page">
  <div class="notif-header-toolbar mb-24">
    <div class="notif-header-left">
      <div class="notif-icon-badge notif-icon-badge-gradient">
        <i class="fa-solid fa-user"></i>
      </div>
      <div>
        <h1 class="notif-main-title">Account & Profile Settings</h1>
        <p class="notif-subtext">Manage your personal details and password for Richmondtech.</p>
      </div>
    </div>
  </div>

  <div class="profile-layout-grid">
    <aside class="profile-side-col">
      <div class="table-card profile-identity-card">
        <div class="profile-avatar-wrap">
          <img src="<?= $user['avatar'] ?>" id="avatar-preview-img" class="profile-avatar-img" alt="<?= sanitize($user['name']) ?>">
          <label class="profile-avatar-edit" for="avatar-upload-input" title="Change photo">
            <i class="fa-solid fa-camera"></i>
          </label>
          <input type="file" id="avatar-upload-input" class="display-none" accept="image/*">
        </div>
        <h3 class="profile-user-name"><?= sanitize($user['name']) ?></h3>
        <p class="profile-user-role"><?= sanitize($user['role']) ?></p>
        <span class="badge <?= $statusClass ?> profile-status-badge"><?= sanitize($statusLabel) ?></span>

        <div class="profile-info-block">
          <div class="profile-meta-item">
            <i class="fa-solid fa-building profile-icon-primary"></i>
            <span><?= sanitize($user['department']) ?></span>
          </div>
          <div class="profile-meta-item">
            <i class="fa-regular fa-envelope profile-icon-primary"></i>
            <span><?= sanitize($user['email']) ?></span>
          </div>
          <div class="profile-meta-item-last">
            <i class="fa-regular fa-calendar-check profile-icon-primary"></i>
            <span>Joined <?= sanitize($user['joined']) ?></span>
          </div>
        </div>
      </div>
    </aside>

    <div class="profile-forms-col">
      <div class="table-card profile-form-card">
        <div class="profile-section-head">
          <span class="profile-section-icon"><i class="fa-solid fa-id-card"></i></span>
          <div>
            <h3 class="profile-section-title">Personal Information</h3>
            <p class="profile-section-sub">Update your name, email, and department.</p>
          </div>
        </div>

        <form id="profile-settings-form" onsubmit="event.preventDefault();">
          <div class="form-grid-3col">
            <div class="form-group">
              <label for="profile-full-name">Full Name</label>
              <input type="text" id="profile-full-name" class="form-control" value="<?= sanitize($user['name']) ?>" placeholder="Your full name">
            </div>
            <div class="form-group">
              <label for="profile-email">Email Address</label>
              <input type="email" id="profile-email" class="form-control" value="<?= sanitize($user['email']) ?>" placeholder="name@richmondtech.com">
            </div>
            <div class="form-group">
              <label for="profile-department">Department</label>
              <input type="text" id="profile-department" class="form-control" value="<?= sanitize($user['department']) ?>" placeholder="e.g. Engineering">
            </div>
          </div>
          <div class="profile-form-actions">
            <button type="submit" class="btn btn-primary">Save Profile Changes</button>
          </div>
        </form>
      </div>

      <div class="table-card profile-form-card profile-password-card">
        <div class="profile-section-head">
          <span class="profile-section-icon profile-section-icon--lock"><i class="fa-solid fa-lock"></i></span>
          <div>
            <h3 class="profile-section-title">Update Password</h3>
            <p class="profile-section-sub">Choose a strong password to keep your account secure.</p>
          </div>
        </div>

        <form id="profile-password-form" onsubmit="event.preventDefault();">
          <div class="form-group">
            <label for="profile-current-password">Current Password</label>
            <input type="password" id="profile-current-password" class="form-control" placeholder="Enter current password" autocomplete="current-password">
          </div>
          <div class="form-grid-2col">
            <div class="form-group">
              <label for="profile-new-password">New Password</label>
              <input type="password" id="profile-new-password" class="form-control" placeholder="Enter new password" autocomplete="new-password">
            </div>
            <div class="form-group">
              <label for="profile-confirm-password">Confirm New Password</label>
              <input type="password" id="profile-confirm-password" class="form-control" placeholder="Confirm new password" autocomplete="new-password">
            </div>
          </div>
          <div class="profile-form-actions">
            <button type="submit" class="btn btn-primary">Update Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once VIEWS_PATH . '/layouts/user/footer.php'; ?>
