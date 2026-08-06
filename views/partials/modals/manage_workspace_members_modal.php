<!-- Modal Dialog: Manage Workspace Members -->
<div class="modal-overlay" id="manage-workspace-members-modal">
  <div class="modal-container modal-container-lg-sub">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Manage Workspace Members</h3>
    <p class="modal-subtitle-desc">Add or remove team members across this workspace.</p>

    <div class="modal-add-member-row">
      <input type="email" class="form-control flex-1" placeholder="Enter user email address...">
      <button class="btn btn-primary btn-sm">Invite</button>
    </div>

    <div class="modal-members-scroll-box">
      <div class="member-list-item-row">
        <div class="member-info-flex">
          <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" class="avatar-sm" alt="Avatar">
          <div>
            <div class="member-name-text">Alex Turner</div>
            <div class="member-email-text">alex@company.com</div>
          </div>
        </div>
        <button class="btn btn-secondary btn-sm text-danger">Remove</button>
      </div>

      <div class="member-list-item-row">
        <div class="member-info-flex">
          <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" class="avatar-sm" alt="Avatar">
          <div>
            <div class="member-name-text">Sarah Connor</div>
            <div class="member-email-text">sarah@company.com</div>
          </div>
        </div>
        <button class="btn btn-secondary btn-sm text-danger">Remove</button>
      </div>

      <div class="member-list-item-row border-none">
        <div class="member-info-flex">
          <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80" class="avatar-sm" alt="Avatar">
          <div>
            <div class="member-name-text">David Chen</div>
            <div class="member-email-text">david@company.com</div>
          </div>
        </div>
        <button class="btn btn-secondary btn-sm text-danger">Remove</button>
      </div>
    </div>

    <div class="modal-footer-actions modal-mt-20">
      <button type="button" class="btn btn-secondary" data-modal-close>Close</button>
    </div>
  </div>
</div>
