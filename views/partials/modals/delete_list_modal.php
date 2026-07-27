<!-- Modal: Delete List Confirmation -->
<div class="modal-overlay" id="delete-list-modal">
  <div class="modal-container modal-container-delete">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <div class="delete-modal-icon-badge">
      <i class="fa-regular fa-trash-can"></i>
    </div>
    <h3 class="delete-modal-title">Delete List?</h3>
    <p class="delete-modal-text">
      Are you sure you want to delete <strong id="delete-list-name" class="text-main-bold">"Backlog"</strong> and all of its cards? This action cannot be undone.
    </p>
    <div class="modal-footer-center">
      <button type="button" class="btn btn-secondary min-w-100" data-modal-close>Cancel</button>
      <button type="button" id="confirm-delete-list-btn" class="btn btn-danger min-w-120">Delete List</button>
    </div>
  </div>
</div>
