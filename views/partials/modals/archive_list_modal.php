<!-- Modal Dialog: Archive List Confirmation -->
<div class="modal-overlay" id="archive-list-modal">
  <div class="modal-container" style="max-width: 440px;">
    <button class="modal-close-btn" data-modal-close>&times;</button>
    <div style="text-align: center; padding: 12px 0 20px;">
      <div style="width: 56px; height: 56px; border-radius: 50%; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 24px; margin: 0 auto 16px;">
        <i class="fa-solid fa-box-archive"></i>
      </div>
      <h3 class="modal-title-heading" style="margin-bottom: 8px;">Archive List Column?</h3>
      <p style="font-size: 14px; color: var(--text-muted); line-height: 1.5;">
        Are you sure you want to archive list <strong id="archive-list-name-display" style="color: var(--text-main);">"List Title"</strong>? All cards in this column will be moved to the Archived Items drawer.
      </p>
    </div>
    <div class="modal-footer-actions" style="justify-content: center; gap: 12px;">
      <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
      <button type="button" class="btn btn-warning" style="background: #d97706; color: #fff;" onclick="confirmArchiveList();">Archive List</button>
    </div>
  </div>
</div>
