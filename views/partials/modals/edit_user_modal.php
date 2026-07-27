<!-- Modal Dialog: Edit Workspace User -->
<div class="modal-overlay" id="edit-user-modal">
  <div class="modal-container">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Edit Workspace User Account</h3>
    <form id="admin-edit-user-form" onsubmit="event.preventDefault(); submitEditUserForm(this);">
      <input type="hidden" id="edit-user-id">
      <div class="form-group">
        <label>Full Name</label>
        <input type="text" id="edit-user-name" class="form-control" required placeholder="Full Name">
      </div>
      <div class="form-group">
        <label>Email Address</label>
        <input type="email" id="edit-user-email" class="form-control" required placeholder="user@company.com">
      </div>
      <div class="form-group">
        <label>User Role</label>
        <select id="edit-user-role" class="form-control">
          <option value="user">Standard User</option>
          <option value="board_manager">Board Manager (Boards & Cards Only)</option>
          <option value="admin">Workspace Admin</option>
        </select>
      </div>
      <div class="form-group">
        <label>Account Status</label>
        <select id="edit-user-status" class="form-control">
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>
      <div class="modal-footer-actions">
        <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
        <button type="submit" class="btn btn-primary">Update User Details</button>
      </div>
    </form>
  </div>
</div>
