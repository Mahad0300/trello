/**
 * Admin User Account Management JavaScript
 * Search/filter, provision user, edit/delete/bulk actions
 */

function getUserRoleCell(row) {
  return row ? row.children[2] : null;
}

function getUserStatusCell(row) {
  return row ? row.children[3] : null;
}

function fadeRemoveRow(row, delay) {
  if (!row) return;
  row.classList.add('row-fade-out');
  setTimeout(() => row.remove(), delay || 300);
}

function updateUsersEmptyState() {
  const emptyState = document.getElementById('users-empty-state');
  const titleEl = document.getElementById('users-empty-title');
  const subEl = document.getElementById('users-empty-subtext');
  const table = document.querySelector('.users-hub table.data-table');
  const filterInput = document.getElementById('user-filter-input');
  const userRows = document.querySelectorAll('.users-hub table.data-table tbody tr');
  const visibleRows = Array.from(userRows).filter((row) => !row.classList.contains('display-none'));
  const q = filterInput ? filterInput.value.trim() : '';
  const hasFilter = !!q;

  if (!emptyState) return;

  if (visibleRows.length === 0) {
    emptyState.classList.remove('is-hidden');
    if (table) table.classList.add('is-empty');
    if (titleEl) {
      titleEl.textContent = hasFilter ? 'No members found' : 'No members yet';
    }
    if (subEl) {
      subEl.textContent = hasFilter
        ? 'No users match “' + q + '”. Try a different name or email.'
        : 'Provision a new user to add them to the system.';
    }
  } else {
    emptyState.classList.add('is-hidden');
    if (table) table.classList.remove('is-empty');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const filterInput = document.getElementById('user-filter-input');
  const roleSelect = document.getElementById('role-filter-select');
  const statusSelect = document.getElementById('status-filter-select');

  function filterUsers() {
    const q = filterInput ? filterInput.value.toLowerCase().trim() : '';
    const roleVal = roleSelect ? roleSelect.value.toLowerCase() : 'all';
    const statusVal = statusSelect ? statusSelect.value.toLowerCase() : 'all';
    const userRows = document.querySelectorAll('.users-hub table.data-table tbody tr');

    userRows.forEach((row) => {
      const text = row.textContent.toLowerCase();
      const roleText = getUserRoleCell(row) ? getUserRoleCell(row).textContent.toLowerCase() : '';
      const statusText = getUserStatusCell(row) ? getUserStatusCell(row).textContent.toLowerCase() : '';

      const matchesSearch = !q || text.includes(q);
      const matchesRole = roleVal === 'all' || roleText.includes(roleVal);
      const matchesStatus = statusVal === 'all' || statusText.includes(statusVal);

      row.classList.toggle('display-none', !(matchesSearch && matchesRole && matchesStatus));
    });

    updateUsersEmptyState();
  }

  if (filterInput) filterInput.addEventListener('input', filterUsers);
  if (roleSelect) roleSelect.addEventListener('change', filterUsers);
  if (statusSelect) statusSelect.addEventListener('change', filterUsers);
  updateUsersEmptyState();

  const addUserForm = document.getElementById('admin-create-user-form') || document.getElementById('add-user-form');
  if (addUserForm) {
    addUserForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const nameInput = addUserForm.querySelector('input[type="text"]');
      const emailInput = addUserForm.querySelector('input[type="email"]');
      const name = nameInput ? nameInput.value.trim() : 'New User';
      const email = emailInput ? emailInput.value.trim() : 'user@richmondtech.com';
      const safeName = window.escapeHtml ? window.escapeHtml(name) : name;
      const safeEmail = window.escapeHtml ? window.escapeHtml(email) : email;
      const avatarSrc = document.querySelector('table.data-table .avatar');
      const avatar = avatarSrc ? avatarSrc.getAttribute('src') : '';

      const tbody = document.querySelector('table.data-table tbody');
      const profileBase = (typeof window.routeUserProfile === 'string')
        ? window.routeUserProfile
        : (window.location.pathname.replace(/\/admin\/.*$/, '/user/profile'));
      if (tbody) {
        tbody.insertAdjacentHTML('afterbegin', `
          <tr>
            <td class="text-center"><input type="checkbox" class="user-row-checkbox" onchange="onUserRowCheckboxChange();"></td>
            <td>
              <div class="users-user-cell">
                <a href="${profileBase}" class="users-user-link">
                  <img src="${avatar}" class="avatar" alt="Avatar">
                  <div>
                    <div class="users-user-name">${safeName}</div>
                    <div class="users-user-email">${safeEmail}</div>
                  </div>
                </a>
              </div>
            </td>
            <td><span class="badge badge-info">User</span></td>
            <td><span class="badge badge-success">Active</span></td>
            <td class="font-weight-600">0 Boards</td>
            <td class="font-size-12 text-muted">Just now</td>
            <td class="users-hub-actions-col users-hub-actions">
              <button type="button" class="btn btn-sm users-hub-btn-edit" onclick="editUser(this);">Edit</button>
              <button type="button" class="btn btn-sm users-hub-btn-remove" onclick="deleteUser(this);">Remove</button>
            </td>
          </tr>
        `);
      }

      addUserForm.reset();
      if (typeof window.closeModal === 'function') {
        window.closeModal('create-user-modal');
      } else {
        const modal = addUserForm.closest('.modal-overlay');
        if (modal) modal.classList.remove('active');
      }
      if (filterInput) filterInput.dispatchEvent(new Event('input'));
      else updateUsersEmptyState();
      window.onUserRowCheckboxChange();
    });
  }
});

window.editUser = function(btn) {
  window.activeEditUserRow = btn ? btn.closest('tr') : null;
  const row = window.activeEditUserRow;

  const nameEl = row ? row.querySelector('.users-user-name') : null;
  const emailEl = row ? row.querySelector('.users-user-email') : null;
  const roleCell = getUserRoleCell(row);
  const statusCell = getUserStatusCell(row);

  const nameVal = nameEl ? nameEl.textContent.trim() : '';
  const emailVal = emailEl ? emailEl.textContent.trim() : '';
  const roleText = roleCell ? roleCell.textContent.trim().toLowerCase() : 'user';
  const statusVal = statusCell ? statusCell.textContent.trim() : 'Active';

  const nameInput = document.getElementById('edit-user-name');
  const emailInput = document.getElementById('edit-user-email');
  const roleSelect = document.getElementById('edit-user-role');
  const statusSelect = document.getElementById('edit-user-status');

  if (nameInput) nameInput.value = nameVal;
  if (emailInput) emailInput.value = emailVal;
  if (roleSelect) {
    if (roleText.includes('board')) roleSelect.value = 'board_manager';
    else if (roleText.includes('admin')) roleSelect.value = 'admin';
    else roleSelect.value = 'user';
  }
  if (statusSelect) statusSelect.value = statusVal.includes('Inactive') ? 'Inactive' : 'Active';

  if (typeof window.openModal === 'function') {
    window.openModal('edit-user-modal', btn);
  }
};

window.submitEditUserForm = function() {
  const nameVal = document.getElementById('edit-user-name') ? document.getElementById('edit-user-name').value.trim() : '';
  const emailVal = document.getElementById('edit-user-email') ? document.getElementById('edit-user-email').value.trim() : '';
  const roleVal = document.getElementById('edit-user-role') ? document.getElementById('edit-user-role').value : 'user';
  const statusVal = document.getElementById('edit-user-status') ? document.getElementById('edit-user-status').value : 'Active';

  const row = window.activeEditUserRow;
  if (row) {
    const nameEl = row.querySelector('.users-user-name');
    const emailEl = row.querySelector('.users-user-email');
    const roleCell = getUserRoleCell(row);
    const statusCell = getUserStatusCell(row);

    if (nameEl) nameEl.textContent = nameVal;
    if (emailEl) emailEl.textContent = emailVal;
    if (roleCell) {
      const roleLabel = roleVal === 'admin' ? 'Admin' : (roleVal === 'board_manager' ? 'Board Manager' : 'User');
      const roleClass = roleVal === 'admin' ? 'badge-primary' : (roleVal === 'board_manager' ? 'badge-warning' : 'badge-info');
      roleCell.innerHTML = '<span class="badge ' + roleClass + '">' + roleLabel + '</span>';
    }
    if (statusCell) {
      statusCell.innerHTML = '<span class="badge ' + (statusVal === 'Active' ? 'badge-success' : 'badge-danger') + '">' + statusVal + '</span>';
    }
  }

  if (typeof window.closeModal === 'function') {
    window.closeModal('edit-user-modal');
  }
};

window.deleteUser = function(btn) {
  window.activeDeleteUserRow = btn ? btn.closest('tr') : null;
  const row = window.activeDeleteUserRow;
  const nameEl = row ? row.querySelector('.users-user-name') : null;
  const userName = nameEl ? nameEl.textContent.trim() : 'User';

  const nameDisplay = document.getElementById('delete-user-name-display');
  if (nameDisplay) nameDisplay.textContent = '"' + userName + '"';

  if (typeof window.openModal === 'function') {
    window.openModal('delete-user-modal', btn);
  }
};

window.confirmDeleteUser = function() {
  fadeRemoveRow(window.activeDeleteUserRow);
  if (typeof window.closeModal === 'function') {
    window.closeModal('delete-user-modal');
  }
  setTimeout(updateUsersEmptyState, 320);
};

window.toggleSelectAllUsers = function(masterCb) {
  document.querySelectorAll('.user-row-checkbox').forEach((cb) => {
    cb.checked = !!(masterCb && masterCb.checked);
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
    masterCb.checked = totalCbs.length > 0 && selectedCbs.length === totalCbs.length;
  }
  if (countEl) countEl.textContent = selectedCbs.length;
  if (toolbar) toolbar.classList.toggle('display-none', selectedCbs.length === 0);
};

window.triggerBulkAction = function(actionType) {
  window.activeBulkActionType = actionType;
  const selectedCbs = document.querySelectorAll('.user-row-checkbox:checked');
  const count = selectedCbs.length;
  if (count === 0) return;

  const displayEl = document.getElementById('bulk-action-type-display');
  const countEl = document.getElementById('bulk-selected-count-display');
  const headingEl = document.getElementById('bulk-modal-heading');
  const btnEl = document.getElementById('confirm-bulk-action-btn');
  const iconEl = document.getElementById('bulk-modal-icon-badge');

  if (displayEl) displayEl.textContent = actionType.toLowerCase();
  if (countEl) countEl.textContent = count === 1 ? '1 selected user' : count + ' selected users';
  if (headingEl) headingEl.textContent = 'Bulk ' + actionType + ' Users';
  if (iconEl) iconEl.className = actionType === 'Remove' ? 'modal-icon-danger' : 'modal-icon-warning';
  if (btnEl) {
    btnEl.textContent = 'Confirm ' + actionType;
    btnEl.className = actionType === 'Remove' ? 'btn btn-danger' : 'btn btn-primary';
  }

  if (typeof window.openModal === 'function') {
    window.openModal('bulk-user-action-modal');
  }
};

window.confirmBulkUserAction = function() {
  const actionType = window.activeBulkActionType;
  const selectedCbs = document.querySelectorAll('.user-row-checkbox:checked');

  selectedCbs.forEach((cb) => {
    const row = cb.closest('tr');
    if (!row) return;

    if (actionType === 'Activate') {
      const statusCell = getUserStatusCell(row);
      if (statusCell) statusCell.innerHTML = '<span class="badge badge-success">Active</span>';
      row.classList.remove('row-dimmed');
      cb.checked = false;
    } else if (actionType === 'Deactivate') {
      const statusCell = getUserStatusCell(row);
      if (statusCell) statusCell.innerHTML = '<span class="badge badge-danger">Inactive</span>';
      row.classList.add('row-dimmed');
      cb.checked = false;
    } else if (actionType === 'Remove') {
      fadeRemoveRow(row);
    }
  });

  if (typeof window.closeModal === 'function') {
    window.closeModal('bulk-user-action-modal');
  }
  setTimeout(() => {
    window.onUserRowCheckboxChange();
    updateUsersEmptyState();
  }, 350);
};

window.executeBulkAction = window.confirmBulkUserAction;
