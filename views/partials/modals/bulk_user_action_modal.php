<!-- Modal Dialog: Bulk User Action Confirmation -->
<div class="modal-overlay" id="bulk-user-action-modal">
  <div class="modal-container" style="max-width: 440px;">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <div style="text-align: center; padding: 12px 0 20px;">
      <div id="bulk-modal-icon-badge" style="width: 56px; height: 56px; border-radius: 50%; background: #fee2e2; color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 24px; margin: 0 auto 16px;">
        <i class="fa-solid fa-layer-group"></i>
      </div>
      <h3 id="bulk-modal-heading" class="modal-title-heading" style="margin-bottom: 8px;">Perform Bulk Action?</h3>
      <p style="font-size: 14px; color: var(--text-muted); line-height: 1.5;">
        Are you sure you want to <strong id="bulk-action-type-display" style="color: var(--text-main);">perform this action</strong> on <strong id="bulk-action-count-display">0 selected users</strong>?
      </p>
    </div>
    <div class="modal-footer-actions" style="justify-content: center; gap: 12px;">
      <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
      <button type="button" id="bulk-modal-confirm-btn" class="btn btn-danger" onclick="confirmBulkUserAction();">Confirm Action</button>
    </div>
  </div>
</div>
