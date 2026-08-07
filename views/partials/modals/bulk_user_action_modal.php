<!-- Modal Dialog: Bulk User Actions Confirmation -->
<div class="modal-overlay" id="bulk-user-action-modal">
  <div class="modal-container modal-container-sm">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <div class="modal-text-center-padded">
      <div id="bulk-modal-icon-badge" class="modal-icon-warning">
        <i class="fa-solid fa-users-gear"></i>
      </div>
      <h3 id="bulk-modal-heading" class="modal-title-heading mb-8">Perform Bulk Action</h3>
      <p class="modal-subtitle-lh">
        Are you sure you want to <strong id="bulk-action-type-display" class="text-dark">perform action</strong>
        <strong id="bulk-selected-count-display" class="text-dark">0 selected users</strong>?
      </p>
    </div>
    <div class="modal-footer-actions modal-footer-center">
      <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
      <button type="button" id="confirm-bulk-action-btn" class="btn btn-primary" onclick="confirmBulkUserAction();">Confirm Action</button>
    </div>
  </div>
</div>
