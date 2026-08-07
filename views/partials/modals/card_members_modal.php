<!-- Modal: Card Members -->
<div class="modal-overlay" id="card-members-modal">
  <div class="modal-container modal-container-md">
    <button type="button" class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Members</h3>
    <p class="modal-subtitle-desc">Assign people to this card.</p>

    <div class="modal-add-member-row">
      <input type="email" class="form-control flex-1" placeholder="Search by name or email...">
      <button type="button" class="btn btn-primary" data-modal-close>Add</button>
    </div>

    <div class="modal-members-scroll-box">
      <div class="member-list-item-row">
        <div class="member-info-flex">
          <img src="<?= asset('images/avatars/avatar_chris.svg') ?>" class="member-avatar" alt="Avatar">
          <div class="member-meta">
            <div class="member-name-text">Alex Turner</div>
            <div class="member-email-text">alex@company.com</div>
          </div>
        </div>
        <button type="button" class="btn btn-danger btn-sm member-remove-btn"><i class="fa-regular fa-trash-can"></i> Remove</button>
      </div>
      <div class="member-list-item-row">
        <div class="member-info-flex">
          <img src="<?= asset('images/avatars/avatar_sarah.svg') ?>" class="member-avatar" alt="Avatar">
          <div class="member-meta">
            <div class="member-name-text">Sarah Connor</div>
            <div class="member-email-text">sarah@company.com</div>
          </div>
        </div>
        <button type="button" class="btn btn-danger btn-sm member-remove-btn"><i class="fa-regular fa-trash-can"></i> Remove</button>
      </div>
    </div>

    <div class="modal-footer-actions modal-mt-20">
      <button type="button" class="btn btn-secondary" data-modal-close>Done</button>
    </div>
  </div>
</div>
