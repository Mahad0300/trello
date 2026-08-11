<!-- Modal: Card Attachments (picker-style layout) -->
<div class="modal-overlay" id="card-attachment-modal">
  <div class="modal-container attach-picker-modal">
    <div class="attach-picker-header">
      <div class="attach-picker-header-left">
        <div class="attach-picker-badge">
          <i class="fa-solid fa-paperclip"></i>
        </div>
        <div>
          <h3 class="attach-picker-title">Attachments</h3>
          <p class="attach-picker-sub">Choose files or images for this card.</p>
        </div>
      </div>
      <button type="button" class="modal-close-btn attach-picker-close" data-modal-close>&times;</button>
    </div>

    <div class="attach-picker-body">
      <aside class="attach-picker-sidebar">
        <button type="button" class="attach-side-item is-active" data-attach-tab="all" onclick="switchAttachTab(this, 'all');">
          <i class="fa-solid fa-layer-group"></i> All
        </button>
        <button type="button" class="attach-side-item" data-attach-tab="images" onclick="switchAttachTab(this, 'images');">
          <i class="fa-solid fa-image"></i> Images
        </button>
        <button type="button" class="attach-side-item" data-attach-tab="files" onclick="switchAttachTab(this, 'files');">
          <i class="fa-solid fa-file"></i> Files
        </button>
        <button type="button" class="attach-side-item" data-attach-tab="upload" onclick="switchAttachTab(this, 'upload');">
          <i class="fa-solid fa-cloud-arrow-up"></i> Upload
        </button>
      </aside>

      <div class="attach-picker-main">
        <div class="attach-picker-toolbar" id="attach-picker-toolbar">
          <div class="attach-picker-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="attach-search-input" placeholder="Search something..." oninput="filterAttachGrid(this.value);">
          </div>
        </div>

        <div class="attach-picker-grid" id="card-attachments-list">
          <button type="button" class="attach-grid-card" data-type="files" data-name="Sprint-24-requirements.pdf" title="Sprint-24-requirements.pdf">
            <div class="attach-grid-thumb attach-grid-thumb-pdf">
              <i class="fa-solid fa-file-pdf"></i>
            </div>
            <span class="attach-grid-remove" title="Remove" onclick="event.stopPropagation(); removeCardAttachment(this);"><i class="fa-solid fa-xmark"></i></span>
          </button>

          <button type="button" class="attach-grid-card" data-type="images" data-name="wireframe-preview.png" title="wireframe-preview.png">
            <div class="attach-grid-thumb">
              <img src="<?= asset('images/covers/card_cover_architecture.png') ?>" alt="wireframe">
            </div>
            <span class="attach-grid-remove" title="Remove" onclick="event.stopPropagation(); removeCardAttachment(this);"><i class="fa-solid fa-xmark"></i></span>
          </button>

          <button type="button" class="attach-grid-card" data-type="images" data-name="ui-mockup.jpg" title="ui-mockup.jpg">
            <div class="attach-grid-thumb">
              <img src="<?= asset('images/covers/card_cover_dragdrop.png') ?>" alt="mockup">
            </div>
            <span class="attach-grid-remove" title="Remove" onclick="event.stopPropagation(); removeCardAttachment(this);"><i class="fa-solid fa-xmark"></i></span>
          </button>

          <button type="button" class="attach-grid-card" data-type="files" data-name="api-notes.docx" title="api-notes.docx">
            <div class="attach-grid-thumb attach-grid-thumb-file">
              <i class="fa-solid fa-file-word"></i>
            </div>
            <span class="attach-grid-remove" title="Remove" onclick="event.stopPropagation(); removeCardAttachment(this);"><i class="fa-solid fa-xmark"></i></span>
          </button>

          <button type="button" class="attach-grid-card" data-type="images" data-name="board-cover.png" title="board-cover.png">
            <div class="attach-grid-thumb">
              <img src="<?= asset('images/covers/board_cover_engineering.png') ?>" alt="cover">
            </div>
            <span class="attach-grid-remove" title="Remove" onclick="event.stopPropagation(); removeCardAttachment(this);"><i class="fa-solid fa-xmark"></i></span>
          </button>

          <button type="button" class="attach-grid-card" data-type="images" data-name="nature-1.jpg" title="nature-1.jpg">
            <div class="attach-grid-thumb">
              <img src="<?= asset('images/covers/board_cover_triage.png') ?>" alt="nature">
            </div>
            <span class="attach-grid-remove" title="Remove" onclick="event.stopPropagation(); removeCardAttachment(this);"><i class="fa-solid fa-xmark"></i></span>
          </button>

          <button type="button" class="attach-grid-card" data-type="images" data-name="nature-2.jpg" title="nature-2.jpg">
            <div class="attach-grid-thumb">
              <img src="<?= asset('images/covers/board_cover_roadmap.png') ?>" alt="nature">
            </div>
            <span class="attach-grid-remove" title="Remove" onclick="event.stopPropagation(); removeCardAttachment(this);"><i class="fa-solid fa-xmark"></i></span>
          </button>

          <button type="button" class="attach-grid-card" data-type="images" data-name="nature-3.jpg" title="nature-3.jpg">
            <div class="attach-grid-thumb">
              <img src="<?= asset('images/covers/board_cover_design.png') ?>" alt="nature">
            </div>
            <span class="attach-grid-remove" title="Remove" onclick="event.stopPropagation(); removeCardAttachment(this);"><i class="fa-solid fa-xmark"></i></span>
          </button>
        </div>

        <div class="attach-upload-panel" id="attach-upload-panel" hidden>
          <label class="attach-upload-drop" for="card-attachment-file" id="attach-upload-drop">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <strong>Upload a file</strong>
            <span>Drag & drop here, or browse from your device</span>
            <input type="file" id="card-attachment-file" class="attach-file-native" onchange="onAttachFilePicked(this);">
            <span class="attach-browse-btn">
              <i class="fa-solid fa-folder-open"></i>
              Browse files
            </span>
            <span class="attach-file-name" id="attach-file-name">No file selected</span>
          </label>
        </div>
      </div>
    </div>

    <div class="attach-picker-footer">
      <button type="button" class="btn btn-secondary" data-modal-close>Cancel</button>
      <button type="button" class="btn btn-primary" onclick="addCardAttachment();">Attach</button>
    </div>
  </div>
</div>
