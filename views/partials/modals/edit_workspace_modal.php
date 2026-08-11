<!-- Modal Dialog: Edit Workspace -->
<div class="modal-overlay" id="edit-workspace-modal">
  <div class="modal-container modal-container-md">
    <button type="button" class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Edit Workspace</h3>
    <p class="modal-subtitle-desc">Update workspace name and description to keep your team aligned.</p>

    <form id="edit-workspace-form" onsubmit="event.preventDefault(); window.closeModal('edit-workspace-modal');">
      <input type="hidden" id="edit-workspace-id">
      <div class="form-group">
        <label>Workspace Name <span class="required-asterisk">*</span></label>
        <input type="text" id="edit-workspace-name" class="form-control" placeholder="e.g. Engineering, Marketing, Operations" required>
      </div>

      <div class="form-group">
        <label>Description (Optional)</label>
        <textarea id="edit-workspace-desc" class="form-control no-resize" rows="3" placeholder="Briefly describe what this workspace is about..."></textarea>
      </div>

      <div class="modal-footer-actions">
        <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>
