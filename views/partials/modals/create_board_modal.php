<!-- Create Board Modal -->
<div class="modal-overlay" id="create-board-modal">
  <div class="modal-container modal-md-520">
    <button type="button" class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Create New Board</h3>
    <p class="modal-subtext-desc">A board is made of cards ordered on lists. Use it to manage projects and track tasks.</p>
    <form onsubmit="event.preventDefault(); this.closest('.modal-overlay').classList.remove('active');">
      <div class="form-group">
        <label>Board Title <span class="required-asterisk">*</span></label>
        <input type="text" class="form-control" name="board_title" placeholder="e.g. Q4 Growth Marketing Campaign" required>
      </div>
      <div class="form-group">
        <label>Description (Optional)</label>
        <textarea class="form-control no-resize" name="board_description" rows="3" placeholder="Briefly describe what this board is about..."></textarea>
      </div>
      <div class="form-group">
        <label>Workspace</label>
        <select class="form-control" name="board_workspace">
          <option>Engineering Team</option>
          <option>Product Design & Marketing</option>
        </select>
      </div>
      <div class="form-group">
        <label>Visibility</label>
        <select class="form-control" name="board_visibility">
          <option>Private (Only board members)</option>
          <option selected>Workspace (Anyone in Engineering Team)</option>
          <option>Public (Anyone with link)</option>
        </select>
      </div>
      <div class="modal-form-actions-lg">
        <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
        <button type="submit" class="btn btn-primary">Create Board</button>
      </div>
    </form>
  </div>
</div>
