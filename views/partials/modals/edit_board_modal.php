<!-- Edit Board Modal -->
<div class="modal-overlay" id="edit-board-modal">
  <div class="modal-container modal-md-520">
    <button type="button" class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Edit Board</h3>
    <p class="modal-subtext-desc">Update the board name and description to keep your team aligned.</p>
    <form id="edit-board-form" onsubmit="event.preventDefault(); if (typeof window.submitEditBoardForm === 'function') { window.submitEditBoardForm(this); } else { this.closest('.modal-overlay').classList.remove('active'); }">
      <div class="form-group">
        <label>Board Name <span class="required-asterisk">*</span></label>
        <input type="text" id="edit-board-name" class="form-control" name="board_name" placeholder="e.g. Q4 Growth Marketing Campaign" required value="Sprint 24 - Core Architecture">
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea id="edit-board-description" class="form-control no-resize" name="board_description" rows="3" placeholder="Briefly describe what this board is about...">Core product architecture, API services, microservices, and database schemas.</textarea>
      </div>
      <div class="modal-form-actions-lg">
        <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>
