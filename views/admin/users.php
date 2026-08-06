<?php
$page_js = 'admin_users.js';
require_once VIEWS_PATH . '/layouts/admin/header.php';
?>

<div class="notif-center-wrapper">
  <!-- Header Toolbar (Consistent with User Panel) -->
  <div class="notif-header-toolbar mb-24">
    <div class="notif-header-left">
      <div class="notif-icon-badge notif-icon-badge-gradient">
        <i class="fa-solid fa-users icon-primary"></i>
      </div>
      <div>
        <h1 class="notif-main-title">User Account Management</h1>
        <p class="notif-subtext">Manage registered team members, roles, permissions, and active status.</p>
      </div>
    </div>
    <div class="notif-header-right users-table-header-group">
      <button class="btn btn-secondary" onclick="alert('User Activity Audit CSV downloaded!');">
        <i class="fa-solid fa-file-csv text-primary mr-6"></i> Export Audit
      </button>
      <button class="btn btn-primary" data-modal-target="create-user-modal">
        <i class="fa-solid fa-user-plus mr-6"></i> Provision New User
      </button>
    </div>
  </div>

  <div class="table-card">
    <div class="table-header">
      <div class="table-title">All System Users (<?= count($users) ?>)</div>
      <div class="board-search-wrapper board-search-wrapper-sm">
        <i class="fa-solid fa-magnifying-glass board-search-icon"></i>
        <input type="text" id="user-filter-input" class="board-search-input" placeholder="Filter by name/email...">
      </div>
    </div>

    <table class="data-table">
      <thead>
        <tr>
          <th class="text-center" style="width: 40px;"><input type="checkbox" id="select-all-users-checkbox" onchange="toggleSelectAllUsers(this);"></th>
          <th>User Details</th>
          <th>Role</th>
          <th>Status</th>
          <th>Boards Joined</th>
          <th>Joined Date</th>
          <th class="text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td class="text-center"><input type="checkbox" class="user-row-checkbox" onchange="onUserRowCheckboxChange();"></td>
            <td>
              <div class="users-user-cell">
                <img src="<?= $user['avatar'] ?>" class="avatar" alt="Avatar">
                <div>
                  <div class="users-user-name"><?= sanitize($user['name']) ?></div>
                  <div class="users-user-email"><?= sanitize($user['email']) ?></div>
                </div>
              </div>
            </td>
            <td>
              <span class="badge <?= $user['role'] === 'admin' ? 'badge-primary' : ($user['role'] === 'board_manager' ? 'badge-warning' : 'badge-info') ?>">
                <?= $user['role'] === 'board_manager' ? 'Board Manager' : ucfirst($user['role']) ?>
              </span>
            </td>
            <td>
              <span class="badge <?= $user['status'] === 'Active' ? 'badge-success' : 'badge-danger' ?>">
                <?= $user['status'] ?>
              </span>
            </td>
            <td class="font-weight-600"><?= $user['boards'] ?> Boards</td>
            <td class="font-size-12 text-muted"><?= $user['joined'] ?></td>
            <td class="text-right">
              <button class="btn btn-secondary btn-sm" onclick="editUser(this);">Edit</button>
              <button class="btn btn-danger btn-sm" onclick="deleteUser(this);">Remove</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Floating Bulk Actions Sticky Toolbar -->
<div id="bulk-actions-toolbar" class="bulk-toolbar-floating" style="display: none;">
  <span class="bulk-toolbar-count"><span id="bulk-selected-count">0</span> Selected</span>
  <div class="bulk-toolbar-actions">
    <button class="btn btn-sm btn-success" style="background: #10b981; color: white; border: none;" onclick="triggerBulkAction('Activate');"><i class="fa-solid fa-check"></i> Activate</button>
    <button class="btn btn-sm btn-warning" style="background: #f59e0b; color: white; border: none;" onclick="triggerBulkAction('Deactivate');"><i class="fa-solid fa-ban"></i> Deactivate</button>
    <button class="btn btn-sm btn-danger" onclick="triggerBulkAction('Remove');"><i class="fa-regular fa-trash-can"></i> Remove</button>
  </div>
</div>

<!-- Modal Dialog Partial Components -->
<?php require_once VIEWS_PATH . '/partials/modals/create_user_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/edit_user_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/delete_user_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/bulk_user_action_modal.php'; ?>

<?php require_once VIEWS_PATH . '/layouts/admin/footer.php'; ?>

