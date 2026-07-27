<!-- Modal: Add New Card -->
<div class="modal-overlay" id="add-card-modal">
  <div class="modal-container modal-container-480">
    <button type="button" class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Add New Card</h3>
    <form id="add-card-form">
      <div class="form-group">
        <label>Card Title</label>
        <input type="text" id="add-card-title-input" class="form-control" placeholder="Enter card title..." required>
      </div>
      <div class="form-group">
        <label>Select List Column</label>
        <select id="add-card-list-select" class="form-control">
          <option>Backlog</option>
          <option selected>In Progress</option>
          <option>Review & QA</option>
          <option>Done</option>
        </select>
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea id="add-card-desc-input" class="form-control" rows="2" placeholder="Card details..."></textarea>
      </div>
      <div class="modal-footer-actions">
        <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
        <button type="submit" class="btn btn-primary">Add Card</button>
      </div>
    </form>
  </div>
</div>
