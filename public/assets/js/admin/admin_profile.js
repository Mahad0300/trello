/**
 * Admin Profile Page JavaScript
 */

function setProfileAccountStatus(status) {
  const isActive = status === 'Active';
  const badge = document.getElementById('profile-status-badge');
  const wrap = document.getElementById('profile-account-status');
  const activateBtn = document.getElementById('profile-activate-btn');
  const deactivateBtn = document.getElementById('profile-deactivate-btn');

  if (badge) {
    badge.dataset.status = status;
    badge.textContent = isActive ? 'Active Member' : 'Inactive';
    badge.classList.remove('badge-success', 'badge-danger', 'badge-primary');
    badge.classList.add(isActive ? 'badge-success' : 'badge-danger');
  }

  if (wrap) wrap.dataset.status = status;

  if (activateBtn) {
    activateBtn.disabled = isActive;
    activateBtn.classList.toggle('is-active', isActive);
  }
  if (deactivateBtn) {
    deactivateBtn.disabled = !isActive;
    deactivateBtn.classList.toggle('is-active', !isActive);
  }

  document.body.classList.toggle('profile-user-inactive', !isActive);
}

document.addEventListener('DOMContentLoaded', () => {
  const avatarUploadInput = document.getElementById('avatar-upload-input');
  const avatarPreviewImg = document.getElementById('avatar-preview-img');

  if (avatarUploadInput && avatarPreviewImg) {
    avatarUploadInput.addEventListener('change', (e) => {
      const file = e.target.files && e.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = function(evt) {
        avatarPreviewImg.src = evt.target.result;
      };
      reader.readAsDataURL(file);
    });
  }

  const profileForm = document.getElementById('profile-settings-form');
  if (profileForm) {
    profileForm.addEventListener('submit', (e) => {
      e.preventDefault();
    });
  }

  const passwordForm = document.getElementById('profile-password-form');
  if (passwordForm) {
    passwordForm.addEventListener('submit', (e) => {
      e.preventDefault();
    });
  }

  const activateBtn = document.getElementById('profile-activate-btn');
  const deactivateBtn = document.getElementById('profile-deactivate-btn');

  if (activateBtn) {
    activateBtn.addEventListener('click', () => setProfileAccountStatus('Active'));
  }
  if (deactivateBtn) {
    deactivateBtn.addEventListener('click', () => setProfileAccountStatus('Inactive'));
  }
});
