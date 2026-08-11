<!-- Modal: Edit Card -->
<div class="modal-overlay" id="edit-card-modal">
  <div class="modal-container modal-container-480">
    <button type="button" class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Edit Card</h3>
    <p class="modal-subtext-desc">Update card title, column position, priority, and description.</p>
    <form id="edit-card-form">
      <input type="hidden" id="edit-card-id-input">
      <div class="form-group">
        <label>Card Title <span class="required-asterisk">*</span></label>
        <input type="text" id="edit-card-title-input" class="form-control" placeholder="Enter card title..." required>
      </div>
      <div class="form-group">
        <label>Move to Column</label>
        <select id="edit-card-list-select" class="form-control">
          <option value="To-Do">To-Do</option>
          <option value="In Progress">In Progress</option>
          <option value="Review">Review</option>
          <option value="Done">Done</option>
        </select>
      </div>
      <div class="form-group">
        <label>Priority Level</label>
        <select id="edit-card-priority-select" class="form-control">
          <option value="Low Priority">Low Priority</option>
          <option value="Medium Priority">Medium Priority</option>
          <option value="High Priority">High Priority / Urgent</option>
        </select>
      </div>
      <div class="form-group">
        <label>Description (Optional)</label>
        <textarea id="edit-card-desc-input" class="form-control no-resize" rows="3" placeholder="Card details and description..."></textarea>
      </div>
      <div class="modal-footer-actions">
        <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>
