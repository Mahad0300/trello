<!-- Modal: Move Card -->
<div class="modal-overlay" id="card-move-modal">
  <div class="modal-container modal-container-md">
    <button type="button" class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Move Card</h3>
    <p class="modal-subtitle-desc">Choose a list to move this card into.</p>

    <div class="form-group">
      <label>Board</label>
      <select class="form-control">
        <option selected>Sprint 24 - Core Architecture</option>
        <option>Bug Triage & Polish</option>
        <option>Design System 2.0</option>
      </select>
    </div>

    <div class="form-group">
      <label>List</label>
      <select class="form-control" id="card-move-list-select">
        <option>Backlog</option>
        <option selected>In Progress</option>
        <option>Review & QA</option>
        <option>Done</option>
      </select>
    </div>

    <div class="modal-footer-actions">
      <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
      <button type="button" class="btn btn-primary" data-modal-close>Move</button>
    </div>
  </div>
</div>
