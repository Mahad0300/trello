<?php
$page_title = 'Workspace Management - Trello Admin';
$page_js = 'admin_common.js';
require_once VIEWS_PATH . '/layouts/admin/header.php';
?>

<div class="notif-center-wrapper">
  <!-- Header Toolbar (Consistent with Admin Panel) -->
  <div class="notif-header-toolbar mb-24">
    <div class="notif-header-left">
      <div class="notif-icon-badge notif-icon-badge-gradient">
        <i class="fa-solid fa-briefcase icon-primary"></i>
      </div>
      <div>
        <h1 class="notif-main-title">Workspace Management</h1>
        <p class="notif-subtext">Create, configure, and manage organization teams and user access permissions.</p>
      </div>
    </div>
    <div class="notif-header-right">
      <button class="btn btn-primary" data-modal-target="create-workspace-modal" onclick="window.openModal('create-workspace-modal', this);">
        <i class="fa-solid fa-plus mr-6"></i> Create Workspace
      </button>
    </div>
  </div>

  <!-- Workspaces Grid Cards -->
  <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 24px;">
    <?php foreach ($workspaces as $ws): ?>
      <div style="background: white; border-radius: var(--radius-lg); border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); padding: 24px; display: flex; flex-direction: column; justify-content: space-between; min-height: 220px; transition: all 0.2s ease;">
        <div>
          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
            <div style="display: flex; align-items: center; gap: 12px;">
              <div style="background: linear-gradient(135deg, <?= $ws['color'] ?>, var(--accent-purple)); width: 44px; height: 44px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; box-shadow: var(--shadow-sm);">
                <i class="fa-solid <?= $ws['icon'] ?>"></i>
              </div>
              <div>
                <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: var(--text-main);"><?= sanitize($ws['name']) ?></h3>
                <span class="badge badge-info" style="font-size: 11px; margin-top: 4px; display: inline-flex; align-items: center; gap: 4px;">
                  <i class="fa-solid fa-lock-open font-size-10"></i> <?= $ws['visibility'] ?>
                </span>
              </div>
            </div>
          </div>
          <p style="font-size: 13px; color: var(--text-muted); line-height: 1.6; margin: 0 0 20px;"><?= sanitize($ws['description']) ?></p>
        </div>

        <div style="padding-top: 16px; border-top: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; gap: 12px;">
          <div style="font-size: 12px; font-weight: 600; color: var(--text-muted); display: flex; align-items: center; gap: 10px;">
            <span><i class="fa-solid fa-users text-primary mr-4"></i> <?= $ws['members_count'] ?> Members</span>
            <span>•</span>
            <span><i class="fa-solid fa-table-columns text-warning mr-4"></i> <?= $ws['boards_count'] ?> Boards</span>
          </div>
          <button class="btn btn-secondary btn-sm font-weight-600" data-modal-target="manage-workspace-members-modal" onclick="document.getElementById('workspace-name-manage-display').textContent = '<?= sanitize($ws['name']) ?>'; window.openModal('manage-workspace-members-modal', this);">
            Manage Members
          </button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Modal Dialog Components -->
<?php require_once VIEWS_PATH . '/partials/modals/create_workspace_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/manage_workspace_members_modal.php'; ?>

<?php require_once VIEWS_PATH . '/layouts/admin/footer.php'; ?>
