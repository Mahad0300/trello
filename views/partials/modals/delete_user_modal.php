<!-- Modal Dialog: Delete User Confirmation -->
<div class="modal-overlay" id="delete-user-modal">
  <div class="modal-container" style="max-width: 440px;">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <div style="text-align: center; padding: 12px 0 20px;">
      <div style="width: 56px; height: 56px; border-radius: 50%; background: #fee2e2; color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 24px; margin: 0 auto 16px;">
        <i class="fa-solid fa-triangle-exclamation"></i>
      </div>
      <h3 class="modal-title-heading" style="margin-bottom: 8px;">Remove User Account?</h3>
      <p style="font-size: 14px; color: var(--text-muted); line-height: 1.5;">
        Are you sure you want to remove user <strong id="delete-user-name-display" style="color: var(--text-main);">"User"</strong>? This action will revoke workspace access.
      </p>
    </div>
    <div class="modal-footer-actions" style="justify-content: center; gap: 12px;">
      <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
      <button type="button" class="btn btn-danger" onclick="confirmDeleteUser();">Yes, Remove User</button>
    </div>
  </div>
</div>
