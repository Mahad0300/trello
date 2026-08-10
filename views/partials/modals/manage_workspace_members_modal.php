<!-- Modal Dialog: Manage Workspace Members -->
<div class="modal-overlay" id="manage-workspace-members-modal">
  <div class="modal-container modal-container-lg-sub">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Manage Workspace Members</h3>
    <p class="modal-subtitle-desc">
      Add or remove team members across
      <strong id="workspace-name-manage-display" class="text-dark">this workspace</strong>.
    </p>

    <div class="modal-add-member-row">
      <input type="email" class="form-control flex-1" placeholder="Enter user email address...">
      <button type="button" class="btn btn-primary">Invite</button>
    </div>

    <div class="modal-members-scroll-box">
      <div class="member-list-item-row">
        <a href="<?= route('admin/profile') ?>?id=2" class="member-info-flex member-profile-link">
          <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="member-avatar" alt="Avatar">
          <div class="member-meta">
            <div class="member-name-text">Chris Parker</div>
            <div class="member-email-text">chris@richmondtech.com</div>
          </div>
        </a>
        <button type="button" class="btn btn-danger btn-sm member-remove-btn"><i class="fa-regular fa-trash-can"></i> Remove</button>
      </div>

      <div class="member-list-item-row">
        <a href="<?= route('admin/profile') ?>?id=3" class="member-info-flex member-profile-link">
          <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="member-avatar" alt="Avatar">
          <div class="member-meta">
            <div class="member-name-text">Sarah Connor</div>
            <div class="member-email-text">sarah@richmondtech.com</div>
          </div>
        </a>
        <button type="button" class="btn btn-danger btn-sm member-remove-btn"><i class="fa-regular fa-trash-can"></i> Remove</button>
      </div>

      <div class="member-list-item-row">
        <a href="<?= route('admin/profile') ?>?id=6" class="member-info-flex member-profile-link">
          <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="member-avatar" alt="Avatar">
          <div class="member-meta">
            <div class="member-name-text">David Chen</div>
            <div class="member-email-text">david@richmondtech.com</div>
          </div>
        </a>
        <button type="button" class="btn btn-danger btn-sm member-remove-btn"><i class="fa-regular fa-trash-can"></i> Remove</button>
      </div>
    </div>

    <div class="modal-footer-actions modal-mt-20">
      <button type="button" class="btn btn-secondary" data-modal-close>Close</button>
    </div>
  </div>
</div>
