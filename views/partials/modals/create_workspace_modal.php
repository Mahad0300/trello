<!-- Modal Dialog: Create Workspace -->
<div class="modal-overlay" id="create-workspace-modal">
  <div class="modal-container" style="max-width: 480px;">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Create New Workspace</h3>
    <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 20px;">Organize team projects, boards, and members in a dedicated workspace container.</p>
    <form onsubmit="event.preventDefault(); alert('Workspace created successfully!'); window.closeModal('create-workspace-modal');">
      <div class="form-group">
        <label>Workspace Name <span style="color: #ef4444;">*</span></label>
        <input type="text" class="form-control" placeholder="e.g. Mobile Apps & DevOps" required>
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" rows="3" placeholder="Briefly describe what your team works on..."></textarea>
      </div>
      <div class="form-group">
        <label>Visibility Level</label>
        <select class="form-control">
          <option value="Private">🔒 Private (Only invited members)</option>
          <option value="Workspace" selected>👥 Workspace (All organization members)</option>
          <option value="Public">🌐 Public (Anyone with link)</option>
        </select>
      </div>
      <div class="modal-footer-actions">
        <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
        <button type="submit" class="btn btn-primary">Create Workspace</button>
      </div>
    </form>
  </div>
</div>
