<!-- Modal Dialog: Manage Workspace Members -->
<div class="modal-overlay" id="manage-workspace-members-modal">
  <div class="modal-container modal-container-lg-sub">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Manage Workspace Members</h3>
    <p class="modal-subtitle-desc">
      Add or remove team members across
      <strong id="workspace-name-manage-display" class="text-dark">this workspace</strong>.
    </p>

    <div class="modal-add-member-row position-relative">
      <div class="ws-search-wrapper flex-1">
        <input type="text" id="ws-member-search-input" class="form-control" placeholder="Type user name or email address..." autocomplete="off">
        <div id="ws-member-suggestions-dropdown" class="ws-suggestions-dropdown"></div>
      </div>
      <button type="button" id="ws-add-member-btn" class="btn btn-primary">Invite</button>
    </div>

    <div id="ws-members-scroll-box" class="modal-members-scroll-box mt-16">
      <div class="member-list-item-row" data-email="chris@richmondtech.com">
        <div class="member-info-flex member-profile-link">
          <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="member-avatar" alt="Avatar">
          <div class="member-meta">
            <div class="member-name-text">Chris Parker</div>
            <div class="member-email-text">chris@richmondtech.com</div>
          </div>
        </div>
        <button type="button" class="btn btn-danger btn-sm member-remove-btn" onclick="removeWsMember(this);"><i class="fa-regular fa-trash-can"></i> Remove</button>
      </div>

      <div class="member-list-item-row" data-email="sarah@richmondtech.com">
        <div class="member-info-flex member-profile-link">
          <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="member-avatar" alt="Avatar">
          <div class="member-meta">
            <div class="member-name-text">Sarah Connor</div>
            <div class="member-email-text">sarah@richmondtech.com</div>
          </div>
        </div>
        <button type="button" class="btn btn-danger btn-sm member-remove-btn" onclick="removeWsMember(this);"><i class="fa-regular fa-trash-can"></i> Remove</button>
      </div>

      <div class="member-list-item-row" data-email="david@richmondtech.com">
        <div class="member-info-flex member-profile-link">
          <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="member-avatar" alt="Avatar">
          <div class="member-meta">
            <div class="member-name-text">David Chen</div>
            <div class="member-email-text">david@richmondtech.com</div>
          </div>
        </div>
        <button type="button" class="btn btn-danger btn-sm member-remove-btn" onclick="removeWsMember(this);"><i class="fa-regular fa-trash-can"></i> Remove</button>
      </div>
    </div>

    <div class="modal-footer-actions modal-mt-20">
      <button type="button" class="btn btn-secondary" data-modal-close>Close</button>
    </div>
  </div>
</div>

<script>
(function() {
  const allUsersPool = [
    { name: 'Chris Parker', email: 'chris@richmondtech.com', avatar: '<?= asset("images/avatars/default-image.jpg") ?>' },
    { name: 'Sarah Connor', email: 'sarah@richmondtech.com', avatar: '<?= asset("images/avatars/default-image.jpg") ?>' },
    { name: 'Alex Johnson', email: 'alex@richmondtech.com', avatar: '<?= asset("images/avatars/default-image.jpg") ?>' },
    { name: 'Elena Rostova', email: 'elena@richmondtech.com', avatar: '<?= asset("images/avatars/default-image.jpg") ?>' },
    { name: 'David Chen', email: 'david@richmondtech.com', avatar: '<?= asset("images/avatars/default-image.jpg") ?>' },
    { name: 'Maya Lin', email: 'maya@richmondtech.com', avatar: '<?= asset("images/avatars/default-image.jpg") ?>' },
    { name: 'Jordan Lee', email: 'jordan@richmondtech.com', avatar: '<?= asset("images/avatars/default-image.jpg") ?>' }
  ];

  window.removeWsMember = function(btn) {
    const row = btn.closest('.member-list-item-row');
    if (row) {
      row.style.transition = 'all 0.2s ease';
      row.style.opacity = '0';
      row.style.transform = 'scale(0.95)';
      setTimeout(() => row.remove(), 200);
    }
  };

  document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('ws-member-search-input');
    const dropdown = document.getElementById('ws-member-suggestions-dropdown');
    const inviteBtn = document.getElementById('ws-add-member-btn');
    const membersContainer = document.getElementById('ws-members-scroll-box');

    if (!searchInput || !dropdown || !membersContainer) return;

    function getExistingEmails() {
      const rows = membersContainer.querySelectorAll('.member-list-item-row');
      const emails = [];
      rows.forEach(r => {
        const emailText = r.querySelector('.member-email-text');
        if (emailText) emails.push(emailText.textContent.trim().toLowerCase());
      });
      return emails;
    }

    function addMemberToContainer(user) {
      const existing = getExistingEmails();
      if (existing.includes(user.email.toLowerCase())) {
        alert(user.name + ' is already a member of this workspace.');
        return;
      }

      const newRowHtml = `
        <div class="member-list-item-row" data-email="${user.email}">
          <a href="#" class="member-info-flex member-profile-link" onclick="event.preventDefault();">
            <img src="${user.avatar}" class="member-avatar" alt="Avatar">
            <div class="member-meta">
              <div class="member-name-text">${user.name}</div>
              <div class="member-email-text">${user.email}</div>
            </div>
          </a>
          <button type="button" class="btn btn-danger btn-sm member-remove-btn" onclick="removeWsMember(this);"><i class="fa-regular fa-trash-can"></i> Remove</button>
        </div>
      `;
      membersContainer.insertAdjacentHTML('beforeend', newRowHtml);
      searchInput.value = '';
      dropdown.classList.remove('active');
    }

    searchInput.addEventListener('input', () => {
      const query = searchInput.value.trim().toLowerCase();
      if (!query) {
        dropdown.innerHTML = '';
        dropdown.classList.remove('active');
        return;
      }

      const existingEmails = getExistingEmails();
      const matches = allUsersPool.filter(u => 
        (u.name.toLowerCase().includes(query) || u.email.toLowerCase().includes(query)) &&
        !existingEmails.includes(u.email.toLowerCase())
      );

      if (matches.length === 0) {
        dropdown.innerHTML = '<div class="p-12 text-muted font-size-12">No matching user found</div>';
        dropdown.classList.add('active');
        return;
      }

      dropdown.innerHTML = matches.map(u => `
        <div class="ws-suggestion-item" data-email="${u.email}" data-name="${u.name}">
          <img src="${u.avatar}" class="ws-suggestion-avatar" alt="Avatar">
          <div>
            <div class="ws-suggestion-name">${u.name}</div>
            <div class="ws-suggestion-email">${u.email}</div>
          </div>
        </div>
      `).join('');
      dropdown.classList.add('active');

      dropdown.querySelectorAll('.ws-suggestion-item').forEach(item => {
        item.addEventListener('click', () => {
          const email = item.getAttribute('data-email');
          const matchedUser = allUsersPool.find(u => u.email === email);
          if (matchedUser) {
            addMemberToContainer(matchedUser);
          }
        });
      });
    });

    if (inviteBtn) {
      inviteBtn.addEventListener('click', () => {
        const query = searchInput.value.trim().toLowerCase();
        if (!query) return;
        const matchedUser = allUsersPool.find(u => 
          u.name.toLowerCase() === query || u.email.toLowerCase() === query ||
          u.name.toLowerCase().includes(query) || u.email.toLowerCase().includes(query)
        );
        if (matchedUser) {
          addMemberToContainer(matchedUser);
        } else {
          addMemberToContainer({
            name: query.split('@')[0] || query,
            email: query.includes('@') ? query : query + '@richmondtech.com',
            avatar: '<?= asset("images/avatars/default-image.jpg") ?>'
          });
        }
      });
    }

    document.addEventListener('click', (e) => {
      if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.remove('active');
      }
    });
  });
})();
</script>
