/**
 * Admin User Account Management JavaScript
 * Search filters, Role/Status filters, Provision User Form, Edit Modal, Delete Modal Popup
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('Admin User Management JS Initialized');

  const filterInput = document.getElementById('user-filter-input');
  const roleSelect = document.getElementById('role-filter-select');
  const statusSelect = document.getElementById('status-filter-select');
  const userRows = document.querySelectorAll('table.data-table tbody tr');

  function filterUsers() {
    const q = filterInput ? filterInput.value.toLowerCase().trim() : '';
    const roleVal = roleSelect ? roleSelect.value.toLowerCase() : 'all';
    const statusVal = statusSelect ? statusSelect.value.toLowerCase() : 'all';

    userRows.forEach(row => {
      const text = row.textContent.toLowerCase();
      const roleText = row.children[1] ? row.children[1].textContent.toLowerCase() : '';
      const statusText = row.children[2] ? row.children[2].textContent.toLowerCase() : '';

      const matchesSearch = !q || text.includes(q);
      const matchesRole = roleVal === 'all' || roleText.includes(roleVal);
      const matchesStatus = statusVal === 'all' || statusText.includes(statusVal);

      if (matchesSearch && matchesRole && matchesStatus) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  if (filterInput) filterInput.addEventListener('input', filterUsers);
  if (roleSelect) roleSelect.addEventListener('change', filterUsers);
  if (statusSelect) statusSelect.addEventListener('change', filterUsers);

  // Add User Form Listener
  const addUserForm = document.getElementById('admin-create-user-form') || document.getElementById('add-user-form');
  if (addUserForm) {
    addUserForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const nameInput = addUserForm.querySelector('input[type="text"]');
      const emailInput = addUserForm.querySelector('input[type="email"]');
      const name = nameInput ? nameInput.value.trim() : 'New User';
      const email = emailInput ? emailInput.value.trim() : 'user@trello.com';

      const tbody = document.querySelector('table.data-table tbody');
      if (tbody) {
        const newRowHtml = `
          <tr>
            <td>
              <div style="display: flex; align-items: center; gap: 12px;">
                <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&q=80" class="avatar" alt="Avatar">
                <div>
                  <div style="font-weight: 600; font-size: 14px;">${window.escapeHtml ? window.escapeHtml(name) : name}</div>
                  <div style="font-size: 12px; color: var(--text-muted);">${window.escapeHtml ? window.escapeHtml(email) : email}</div>
                </div>
              </div>
            </td>
            <td><span class="badge badge-info">User</span></td>
            <td><span class="badge badge-success">Active</span></td>
            <td style="font-weight: 600;">0 Boards</td>
            <td style="font-size: 12px; color: var(--text-muted);">Just now</td>
            <td style="text-align: right;">
              <button class="btn btn-secondary btn-sm" onclick="editUser(this);">Edit</button>
              <button class="btn btn-danger btn-sm" onclick="deleteUser(this);">Remove</button>
            </td>
          </tr>
        `;
        tbody.insertAdjacentHTML('afterbegin', newRowHtml);
      }

      addUserForm.reset();
      const modal = addUserForm.closest('.modal-overlay');
      if (modal) modal.classList.remove('active');
    });
  }
});

// Global Edit User Popup Function
window.editUser = function(btn, id, name, email, role, status) {
  window.activeEditUserRow = btn.closest('tr');
  const row = btn.closest('tr');

  const nameVal = name || (row ? row.querySelector('div[style*="font-weight: 600"]').textContent.trim() : '');
  const emailVal = email || (row ? row.querySelector('div[style*="font-size: 12px"]').textContent.trim() : '');
  const roleVal = role || (row && row.children[1] ? row.children[1].textContent.trim().toLowerCase() : 'user');
  const statusVal = status || (row && row.children[2] ? row.children[2].textContent.trim() : 'Active');

  const modal = document.getElementById('edit-user-modal');
  if (modal) {
    const nameInput = document.getElementById('edit-user-name');
    const emailInput = document.getElementById('edit-user-email');
    const roleSelect = document.getElementById('edit-user-role');
    const statusSelect = document.getElementById('edit-user-status');

    if (nameInput) nameInput.value = nameVal;
    if (emailInput) emailInput.value = emailVal;
    if (roleSelect) roleSelect.value = roleVal.includes('admin') ? 'admin' : 'user';
    if (statusSelect) statusSelect.value = statusVal.includes('Inactive') ? 'Inactive' : 'Active';

    modal.classList.add('active');
  }
};

window.submitEditUserForm = function(form) {
  const nameVal = document.getElementById('edit-user-name') ? document.getElementById('edit-user-name').value.trim() : '';
  const emailVal = document.getElementById('edit-user-email') ? document.getElementById('edit-user-email').value.trim() : '';
  const roleVal = document.getElementById('edit-user-role') ? document.getElementById('edit-user-role').value : 'user';
  const statusVal = document.getElementById('edit-user-status') ? document.getElementById('edit-user-status').value : 'Active';

  const row = window.activeEditUserRow;
  if (row) {
    const nameEl = row.querySelector('div[style*="font-weight: 600"]');
    const emailEl = row.querySelector('div[style*="font-size: 12px"]');
    const roleCell = row.children[1];
    const statusCell = row.children[2];

    if (nameEl) nameEl.textContent = nameVal;
    if (emailEl) emailEl.textContent = emailVal;
    if (roleCell) {
      roleCell.innerHTML = `<span class="badge ${roleVal === 'admin' ? 'badge-primary' : 'badge-info'}">${roleVal === 'admin' ? 'Admin' : 'User'}</span>`;
    }
    if (statusCell) {
      statusCell.innerHTML = `<span class="badge ${statusVal === 'Active' ? 'badge-success' : 'badge-danger'}">${statusVal}</span>`;
    }
  }

  const modal = document.getElementById('edit-user-modal');
  if (modal) modal.classList.remove('active');
};

// Global Delete User Confirmation Modal Popup Trigger
window.deleteUser = function(btn) {
  window.activeDeleteUserRow = btn.closest('tr');
  const row = btn.closest('tr');
  const nameEl = row ? row.querySelector('div[style*="font-weight: 600"]') : null;
  const userName = nameEl ? nameEl.textContent.trim() : 'User';

  const nameDisplay = document.getElementById('delete-user-name-display');
  if (nameDisplay) nameDisplay.textContent = `"${userName}"`;

  const modal = document.getElementById('delete-user-modal');
  if (modal) modal.classList.add('active');
};

window.confirmDeleteUser = function() {
  const row = window.activeDeleteUserRow;
  if (row) {
    row.style.transition = 'all 0.3s ease';
    row.style.opacity = '0';
    row.style.transform = 'scale(0.95)';
    setTimeout(() => row.remove(), 300);
  }

  const modal = document.getElementById('delete-user-modal');
  if (modal) modal.classList.remove('active');
};

// Global Bulk Actions Selection Logic
window.toggleSelectAllUsers = function(masterCb) {
  const checkboxes = document.querySelectorAll('.user-row-checkbox');
  checkboxes.forEach(cb => {
    cb.checked = masterCb.checked;
  });
  window.onUserRowCheckboxChange();
};

window.onUserRowCheckboxChange = function() {
  const selectedCbs = document.querySelectorAll('.user-row-checkbox:checked');
  const totalCbs = document.querySelectorAll('.user-row-checkbox');
  const masterCb = document.getElementById('select-all-users-checkbox');
  const toolbar = document.getElementById('bulk-actions-toolbar');
  const countEl = document.getElementById('bulk-selected-count');

  if (masterCb) {
    masterCb.checked = (totalCbs.length > 0 && selectedCbs.length === totalCbs.length);
  }

  if (countEl) countEl.textContent = selectedCbs.length;

  if (toolbar) {
    toolbar.style.display = selectedCbs.length > 0 ? 'flex' : 'none';
  }
};

window.triggerBulkAction = function(actionType) {
  window.activeBulkActionType = actionType;
  const selectedCbs = document.querySelectorAll('.user-row-checkbox:checked');
  const count = selectedCbs.length;

  const displayEl = document.getElementById('bulk-action-type-display');
  const countEl = document.getElementById('bulk-action-count-display');
  const headingEl = document.getElementById('bulk-modal-heading');
  const btnEl = document.getElementById('bulk-modal-confirm-btn');

  if (displayEl) displayEl.textContent = actionType.toLowerCase();
  if (countEl) countEl.textContent = `${count} selected account${count > 1 ? 's' : ''}`;
  if (headingEl) headingEl.textContent = `Bulk ${actionType} Users`;

  if (btnEl) {
    btnEl.textContent = `Confirm Bulk ${actionType}`;
    if (actionType === 'Activate') {
      btnEl.className = 'btn btn-success';
      btnEl.style.background = '#10b981';
    } else if (actionType === 'Deactivate') {
      btnEl.className = 'btn btn-warning';
      btnEl.style.background = '#f59e0b';
    } else {
      btnEl.className = 'btn btn-danger';
      btnEl.style.background = '#ef4444';
    }
  }

  window.openModal('bulk-user-action-modal');
};

window.confirmBulkUserAction = function() {
  const actionType = window.activeBulkActionType;
  const selectedCbs = document.querySelectorAll('.user-row-checkbox:checked');

  selectedCbs.forEach(cb => {
    const row = cb.closest('tr');
    if (!row) return;

    if (actionType === 'Activate') {
      const statusCell = row.children[3];
      if (statusCell) statusCell.innerHTML = '<span class="badge badge-success">Active</span>';
      row.style.opacity = '1';
      cb.checked = false;
    } else if (actionType === 'Deactivate') {
      const statusCell = row.children[3];
      if (statusCell) statusCell.innerHTML = '<span class="badge badge-danger">Inactive</span>';
      row.style.opacity = '0.6';
      cb.checked = false;
    } else if (actionType === 'Remove') {
      row.style.transition = 'all 0.3s ease';
      row.style.opacity = '0';
      row.style.transform = 'scale(0.95)';
      setTimeout(() => row.remove(), 300);
    }
  });

  window.closeModal('bulk-user-action-modal');
  setTimeout(() => window.onUserRowCheckboxChange(), 350);
};
