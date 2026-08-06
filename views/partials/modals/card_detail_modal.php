<!-- Rich Trello-Style Card Detail Modal -->
<div class="modal-overlay" id="card-detail-modal">
  <div class="modal-container modal-container-card-detail">
    <button class="modal-close-btn modal-close-glass" id="modal-close-btn" data-modal-close>&times;</button>
    
    <!-- Hero Modal Cover Banner -->
    <div id="modal-cover-banner" class="modal-cover-banner">
      <img id="modal-cover-img" src="<?= asset('images/card_cover_design.png') ?>" class="modal-cover-img">
    </div>

    <div class="modal-card-detail-body">
      <div class="modal-flex-layout">
        <!-- Left Main Column (75% Width) -->
        <div class="modal-left-main">
          <div class="modal-header-row">
            <i class="fa-solid fa-credit-card icon-primary-20"></i>
            <h2 id="modal-card-title" class="modal-card-title-text">Card Detail View</h2>
          </div>
          <div class="modal-sub-info-row">
            <i class="fa-solid fa-list-ul"></i> in list <span class="modal-list-link">In Progress</span>
          </div>

          <!-- Label Badges -->
          <div class="mb-20">
            <div class="modal-section-uppercase-title">Labels</div>
            <div class="gap-8 flex-row">
              <span class="badge badge-indigo">Feature</span>
              <span class="badge badge-red">High Priority</span>
              <span class="badge badge-emerald">Design System</span>
            </div>
          </div>

          <!-- Description Box -->
          <div class="mb-24">
            <div class="flex-between-mb-8">
              <div class="section-title-sm font-weight-700">
                <i class="fa-solid fa-align-left text-muted-icon"></i> Description
              </div>
              <button class="btn btn-secondary btn-sm" onclick="alert('Description editor focused');">
                <i class="fa-solid fa-pen"></i> Edit
              </button>
            </div>
            <p class="modal-description-box">
              Implement plain HTML5 drag-and-drop physics and events in user.js for moving card containers between columns. Ensure real-time card counter updates and dropzone highlight indicators.
            </p>
          </div>

          <!-- Checklist Progress -->
          <div class="mb-28">
            <div class="flex-between-mb-8">
              <div class="section-title-sm font-weight-700">
                <i class="fa-regular fa-square-check icon-primary"></i> Checklist (Sub-tasks)
              </div>
              <span id="checklist-progress-text" class="checklist-progress-text font-weight-700 color-primary">50%</span>
            </div>
            <!-- Progress Bar -->
            <div class="checklist-track">
              <div id="checklist-progress-bar" class="checklist-fill-line" style="width: 50%;"></div>
            </div>

            <div class="checklist-list-wrapper" id="checklist-items-container">
              <div class="checklist-parent-wrapper">
                <label class="checklist-item-row" style="display: flex; align-items: center; justify-content: space-between;">
                  <span style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" class="checklist-checkbox" checked onchange="recalculateChecklistProgress();">
                    <span class="checklist-text-completed">Attach draggable=true attribute to cards</span>
                  </span>
                  <button class="btn btn-secondary btn-sm" style="padding: 2px 6px; font-size: 10px;" onclick="addNestedSubtask(this);">+ Sub-task</button>
                </label>
              </div>
              
              <div class="checklist-parent-wrapper">
                <label class="checklist-item-row" style="display: flex; align-items: center; justify-content: space-between;">
                  <span style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" class="checklist-checkbox" checked onchange="recalculateChecklistProgress();">
                    <span class="checklist-text-completed">Handle dragstart and dragend opacity states</span>
                  </span>
                  <button class="btn btn-secondary btn-sm" style="padding: 2px 6px; font-size: 10px;" onclick="addNestedSubtask(this);">+ Sub-task</button>
                </label>
              </div>

              <div class="checklist-parent-wrapper">
                <label class="checklist-item-row" style="display: flex; align-items: center; justify-content: space-between;">
                  <span style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" class="checklist-checkbox" onchange="recalculateChecklistProgress();">
                    <span>Calculate element drop position relative to sibling cards</span>
                  </span>
                  <button class="btn btn-secondary btn-sm" style="padding: 2px 6px; font-size: 10px;" onclick="addNestedSubtask(this);">+ Sub-task</button>
                </label>
                <!-- Nested Indented Subtask Item Example -->
                <div class="checklist-subitem-row" style="display: flex; align-items: center; justify-content: space-between; margin-left: 28px; margin-top: 4px; padding-left: 8px; border-left: 2px solid var(--primary-glow);">
                  <span style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" class="checklist-checkbox" onchange="recalculateChecklistProgress();">
                    <span style="font-size: 12px;">Compute cursor Y-midpoint offset</span>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- Comments & Activity Timeline -->
          <div>
            <div class="section-title-sm font-weight-700 mb-12">
              <i class="fa-regular fa-comments text-muted-icon"></i> Activity & Comments
            </div>
            
            <!-- Comment Box -->
            <div class="comment-input-row">
              <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" class="avatar" alt="Avatar">
              <div class="flex-1">
                <textarea id="comment-input" class="form-control comment-textarea-box" rows="2" placeholder="Write a comment..."></textarea>
                <button id="add-comment-btn" class="btn btn-primary btn-sm">
                  <i class="fa-solid fa-paper-plane"></i> Save Comment
                </button>
              </div>
            </div>

            <!-- Comments Feed -->
            <div id="comments-feed">
              <div class="comment-feed-item">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" class="avatar" alt="Avatar">
                <div class="comment-bubble-box">
                  <div class="comment-header-row">
                    <span>Sarah Connor</span>
                    <span class="comment-time-text">2 hours ago</span>
                  </div>
                  <p class="m-0 font-size-13">Drag physics work smoothly! Added smooth CSS transitions for card drop preview.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Action Sidebar (25% Width) -->
        <div class="modal-sidebar-column">
          <div class="modal-section-uppercase-title">Add to Card</div>
          <button class="btn btn-secondary btn-sm btn-start" data-modal-target="share-board-modal">
            <i class="fa-solid fa-users"></i> Members
          </button>
          <button class="btn btn-secondary btn-sm btn-start" data-modal-target="filter-board-modal">
            <i class="fa-solid fa-tag"></i> Labels
          </button>
          <button class="btn btn-secondary btn-sm btn-start" onclick="document.getElementById('comment-input').focus();">
            <i class="fa-regular fa-square-check"></i> Checklist
          </button>
          <button class="btn btn-secondary btn-sm btn-start" data-modal-target="add-card-modal">
            <i class="fa-regular fa-calendar-days"></i> Due Date
          </button>
          <button class="btn btn-secondary btn-sm btn-start" data-modal-target="add-card-modal">
            <i class="fa-solid fa-paperclip"></i> Attachment
          </button>

          <div class="modal-sidebar-title-spaced">Actions</div>
          <button class="btn btn-secondary btn-sm btn-start" data-modal-target="add-card-modal">
            <i class="fa-solid fa-arrow-right-arrow-left"></i> Move
          </button>
          <button class="btn btn-secondary btn-sm btn-start" data-modal-target="add-card-modal">
            <i class="fa-regular fa-copy"></i> Copy
          </button>

        </div>
      </div>
    </div>
  </div>
</div>
