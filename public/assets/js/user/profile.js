/**
 * User Profile Page JavaScript
 * Specific to Profile View (views/user/profile.php)
 */

document.addEventListener('DOMContentLoaded', () => {
  console.log('User Profile JS Loaded');

  // Avatar Upload / Change Preview Handler
  const avatarUploadInput = document.getElementById('avatar-upload-input');
  const avatarPreviewImg = document.getElementById('avatar-preview-img');

  if (avatarUploadInput && avatarPreviewImg) {
    avatarUploadInput.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(evt) {
          avatarPreviewImg.src = evt.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  }

  // Profile Form Validation & Save Toast Preview
  const profileForm = document.getElementById('profile-settings-form');
  if (profileForm) {
    profileForm.addEventListener('submit', (e) => {
      e.preventDefault();
      alert('Profile details updated successfully!');
    });
  }
});
