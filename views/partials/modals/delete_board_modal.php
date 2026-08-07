<!-- Delete Board Confirmation Modal -->
<div class="modal-overlay" id="delete-board-modal">
  <div class="modal-container modal-container-sm">
    <button type="button" class="modal-close-btn" data-modal-close>&times;</button>
    <div class="modal-text-center-padded">
      <div class="modal-icon-danger">
        <i class="fa-solid fa-trash-can"></i>
      </div>
      <h3 class="modal-title-heading mb-8">Delete Board?</h3>
      <p class="modal-subtitle-lh">
        Are you sure you want to delete <strong id="delete-board-name-display" class="text-dark">"Board Name"</strong>? This action cannot be undone.
      </p>
    </div>
    <div class="modal-footer-actions modal-footer-center">
      <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
      <button type="button" class="btn btn-danger" onclick="confirmDeleteBoard();">Delete Board</button>
    </div>
  </div>
</div>
