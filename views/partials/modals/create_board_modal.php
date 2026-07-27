<!-- Global User Create Board Modal Dialog -->
<div class="modal-overlay" id="user-create-board-modal">
  <div class="modal-container modal-md-520">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Create New Board</h3>
    <p class="modal-subtext-desc">A board is made of cards ordered on lists. Use it to manage projects and track tasks.</p>
    <form onsubmit="event.preventDefault(); alert('Board created successfully!'); document.getElementById('user-create-board-modal').classList.remove('active');">
      <div class="form-group">
        <label>Board Title <span class="required-asterisk">*</span></label>
        <input type="text" class="form-control" placeholder="e.g. Q4 Growth Marketing Campaign" required>
      </div>
      <div class="form-group">
        <label>Workspace</label>
        <select class="form-control">
          <option>Engineering Team</option>
          <option>Product Design & Marketing</option>
        </select>
      </div>
      <div class="form-group">
        <label>Visibility</label>
        <select class="form-control">
          <option>🔒 Private (Only board members)</option>
          <option selected>👥 Workspace (Anyone in Engineering Team)</option>
          <option>🌐 Public (Anyone with link)</option>
        </select>
      </div>
      <div class="modal-form-actions-lg">
        <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
        <button type="submit" class="btn btn-primary">Create Board</button>
      </div>
    </form>
  </div>
</div>
