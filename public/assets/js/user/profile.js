/**
 * User Profile Page JavaScript
 */

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
});
