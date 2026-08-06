<!-- Modal Dialog: Delete User Confirmation -->
<div class="modal-overlay" id="delete-user-modal">
  <div class="modal-container modal-container-sm">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <div class="modal-text-center-padded">
      <div class="modal-icon-danger">
        <i class="fa-solid fa-user-xmark"></i>
      </div>
      <h3 class="modal-title-heading mb-8">Remove User Account?</h3>
      <p class="modal-subtitle-lh">
        Are you sure you want to remove user <strong id="delete-user-name-display" class="text-dark">"User Name"</strong>? This action cannot be undone and will revoke all access.
      </p>
    </div>
    <div class="modal-footer-actions modal-footer-center">
      <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
      <button type="button" class="btn btn-danger" onclick="confirmDeleteUser();">Remove User</button>
    </div>
  </div>
</div>
