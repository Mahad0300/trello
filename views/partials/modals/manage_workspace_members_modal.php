<!-- Modal Dialog: Manage Workspace Members -->
<div class="modal-overlay" id="manage-workspace-members-modal">
  <div class="modal-container" style="max-width: 520px;">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Manage Workspace Members</h3>
    <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 20px;">Add or remove team members from <strong id="workspace-name-manage-display">Engineering Team</strong>.</p>
    
    <div style="margin-bottom: 20px; display: flex; gap: 8px;">
      <input type="email" class="form-control" placeholder="Enter user email address..." style="flex: 1;">
      <button type="button" class="btn btn-primary" onclick="alert('User added to workspace!');">Add Member</button>
    </div>

    <div style="max-height: 240px; overflow-y: auto; border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 8px;">
      <div style="display: flex; align-items: center; justify-content: space-between; padding: 8px; border-bottom: 1px solid var(--border-color);">
        <div style="display: flex; align-items: center; gap: 10px;">
          <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&q=80" class="avatar avatar-sm">
          <div>
            <div style="font-weight: 600; font-size: 13px;">Alex Turner</div>
            <div style="font-size: 11px; color: var(--text-muted);">alex@company.com</div>
          </div>
        </div>
        <span class="badge badge-primary">Admin</span>
      </div>
      <div style="display: flex; align-items: center; justify-content: space-between; padding: 8px; border-bottom: 1px solid var(--border-color);">
        <div style="display: flex; align-items: center; gap: 10px;">
          <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" class="avatar avatar-sm">
          <div>
            <div style="font-weight: 600; font-size: 13px;">Sarah Connor</div>
            <div style="font-size: 11px; color: var(--text-muted);">sarah@company.com</div>
          </div>
        </div>
        <button class="btn btn-secondary btn-sm" onclick="this.closest('div').remove();">Remove</button>
      </div>
      <div style="display: flex; align-items: center; justify-content: space-between; padding: 8px;">
        <div style="display: flex; align-items: center; gap: 10px;">
          <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" class="avatar avatar-sm">
          <div>
            <div style="font-weight: 600; font-size: 13px;">David Chen</div>
            <div style="font-size: 11px; color: var(--text-muted);">david@company.com</div>
          </div>
        </div>
        <button class="btn btn-secondary btn-sm" onclick="this.closest('div').remove();">Remove</button>
      </div>
    </div>

    <div class="modal-footer-actions" style="margin-top: 20px;">
      <button type="button" class="btn btn-secondary" data-modal-close>Close</button>
    </div>
  </div>
</div>
