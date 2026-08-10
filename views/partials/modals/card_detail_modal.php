<!-- Premium Card Detail Modal -->
<div class="modal-overlay" id="card-detail-modal">
  <div class="modal-container modal-container-card-detail">
    <button type="button" class="modal-close-btn modal-close-glass" id="modal-close-btn" data-modal-close>&times;</button>

    <div id="modal-cover-banner" class="modal-cover-banner">
      <img id="modal-cover-img" src="<?= asset('images/card_cover_design.png') ?>" class="modal-cover-img" alt="Card cover">
      <div class="modal-cover-fade"></div>
    </div>

    <div class="modal-card-detail-body">
      <div class="modal-flex-layout">
        <div class="modal-left-main">
          <div class="cd-title-block">
            <span class="cd-title-icon"><i class="fa-solid fa-credit-card"></i></span>
            <div class="cd-title-copy">
              <div class="cd-title-top">
                <h2 id="modal-card-title" class="modal-card-title-text">Card Detail View</h2>
                <span class="modal-list-link">In Progress</span>
              </div>
            </div>
          </div>

          <section class="cd-section">
            <div class="modal-section-uppercase-title">Labels</div>
            <div class="cd-labels-row">
              <span class="badge badge-label-feature">Feature</span>
              <span class="badge badge-label-priority">High Priority</span>
              <span class="badge badge-label-design">Design System</span>
            </div>
          </section>

          <section class="cd-section">
            <div class="cd-section-head">
              <div class="cd-section-title">
                <i class="fa-solid fa-align-left"></i> Description
              </div>
            </div>
            <p class="modal-description-box">
              Implement plain HTML5 drag-and-drop physics and events in board_detail.js for moving card containers between columns. Ensure real-time card counter updates and dropzone highlight indicators.
            </p>
          </section>

          <section class="cd-section cd-section-last">
            <div class="cd-section-title">
              <i class="fa-regular fa-comments"></i> Activity & Comments
            </div>

            <div class="cd-comment-compose">
              <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="avatar cd-avatar" alt="Avatar">
              <div class="cd-comment-compose-body">
                <input type="text" id="comment-input" class="form-control comment-textarea-box" placeholder="Write a comment...">
                <button type="button" id="add-comment-btn" class="cd-send-comment-btn" aria-label="Send comment" title="Send">
                  <i class="fa-solid fa-paper-plane"></i>
                </button>
              </div>
            </div>

            <div id="comments-feed" class="cd-comments-feed">
              <div class="cd-comment-item">
                <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="avatar cd-avatar" alt="Avatar">
                <div class="comment-bubble-box">
                  <div class="comment-header-row">
                    <span class="cd-comment-author">Sarah Connor</span>
                    <span class="comment-time-text">2 hours ago</span>
                  </div>
                  <p class="m-0 cd-comment-text">Drag physics work smoothly! Added smooth CSS transitions for card drop preview.</p>
                </div>
              </div>

              <div class="cd-comment-item">
                <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="avatar cd-avatar" alt="Avatar">
                <div class="comment-bubble-box">
                  <div class="comment-header-row">
                    <span class="cd-comment-author">Alex Rivera</span>
                    <span class="comment-time-text">5 hours ago</span>
                  </div>
                  <p class="m-0 cd-comment-text">Can we also highlight the active dropzone when a card is dragged over a list?</p>
                </div>
              </div>

              <div class="cd-comment-item">
                <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="avatar cd-avatar" alt="Avatar">
                <div class="comment-bubble-box">
                  <div class="comment-header-row">
                    <span class="cd-comment-author">Maya Chen</span>
                    <span class="comment-time-text">Yesterday</span>
                  </div>
                  <p class="m-0 cd-comment-text">Card counters look good. Please keep the list totals in sync after every move.</p>
                </div>
              </div>

              <div class="cd-comment-item">
                <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="avatar cd-avatar" alt="Avatar">
                <div class="comment-bubble-box">
                  <div class="comment-header-row">
                    <span class="cd-comment-author">Jordan Lee</span>
                    <span class="comment-time-text">2 days ago</span>
                  </div>
                  <p class="m-0 cd-comment-text">Started the HTML5 DnD events in board_detail.js. Next up: drop preview states.</p>
                </div>
              </div>
            </div>
          </section>
        </div>

        <aside class="modal-sidebar-column">
          <div class="modal-section-uppercase-title">Add to Card</div>
          <button type="button" class="btn btn-secondary btn-sm btn-start" data-modal-target="card-members-modal" onclick="event.stopPropagation(); window.openModal('card-members-modal', this);">
            <i class="fa-solid fa-users"></i> Members
          </button>
          <button type="button" class="btn btn-secondary btn-sm btn-start" data-modal-target="card-labels-modal" onclick="event.stopPropagation(); window.openModal('card-labels-modal', this);">
            <i class="fa-solid fa-tag"></i> Labels
          </button>
          <button type="button" class="btn btn-secondary btn-sm btn-start" data-modal-target="card-attachment-modal" onclick="event.stopPropagation(); window.openModal('card-attachment-modal', this);">
            <i class="fa-solid fa-paperclip"></i> Attachment
          </button>
          <button type="button" class="btn btn-secondary btn-sm btn-start" data-modal-target="card-move-modal" onclick="event.stopPropagation(); window.openModal('card-move-modal', this);">
            <i class="fa-solid fa-arrow-right-arrow-left"></i> Move
          </button>
        </aside>
      </div>
    </div>
  </div>
</div>
