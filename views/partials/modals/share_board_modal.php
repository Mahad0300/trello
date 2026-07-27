<!-- Modal: Share Board -->
<div class="modal-overlay" id="share-board-modal">
  <div class="modal-container modal-container-500">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <h3 class="modal-title-heading">Share Board</h3>
    <p class="modal-subtitle-text">Invite team members or copy share link.</p>
    <div class="form-group">
      <label>Email Address or Name</label>
      <input type="email" class="form-control" placeholder="colleague@company.com">
    </div>
    <div class="share-link-row">
      <span class="modal-subtitle-text mb-0">http://localhost/trello/public/user/board</span>
      <button class="btn btn-secondary btn-sm" onclick="alert('Share link copied to clipboard!');">Copy Link</button>
    </div>
  </div>
</div>
