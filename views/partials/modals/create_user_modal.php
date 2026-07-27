<!-- Modal Dialog: Create Workspace User -->
<div class="modal-overlay" id="create-user-modal">
  <div class="modal-container">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Provision New Workspace User</h3>
    <form id="admin-create-user-form" onsubmit="event.preventDefault();">
      <div class="form-group">
        <label>Full Name</label>
        <input type="text" class="form-control" required placeholder="Alex Turner">
      </div>
      <div class="form-group">
        <label>Email Address</label>
        <input type="email" class="form-control" required placeholder="alex@company.com">
      </div>
      <div class="form-group">
        <label>Assign Role</label>
        <select class="form-control">
          <option value="user">Standard User</option>
          <option value="board_manager">Board Manager (Boards & Cards Only)</option>
          <option value="admin">Workspace Admin</option>
        </select>
      </div>
      <div class="modal-footer-actions">
        <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
        <button type="submit" class="btn btn-primary">Save User</button>
      </div>
    </form>
  </div>
</div>
