<!-- Modal Dialog: Create Workspace -->
<div class="modal-overlay" id="create-workspace-modal">
  <div class="modal-container modal-container-md">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Create Workspace</h3>
    <p class="modal-subtitle-desc">Organize team projects, boards, and members in one place.</p>

    <form id="create-workspace-form" onsubmit="event.preventDefault(); submitCreateWorkspace();">
      <div class="form-group">
        <label>Workspace Name <span class="required-asterisk">*</span></label>
        <input type="text" class="form-control" placeholder="e.g. Engineering, Marketing, Operations" required>
      </div>

      <div class="form-group">
        <label>Description (Optional)</label>
        <textarea class="form-control no-resize" rows="3" placeholder="Briefly describe what this workspace is about..."></textarea>
      </div>

      <div class="form-group">
        <label>Visibility</label>
        <select class="form-control">
          <option value="Private">Private - Only invited members</option>
          <option value="Public">Public - Anyone in organization</option>
        </select>
      </div>

      <div class="modal-footer-actions">
        <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
        <button type="submit" class="btn btn-primary">Create Workspace</button>
      </div>
    </form>
  </div>
</div>
