<?php
$page_title = 'All Boards - Richmondtech';
$page_js = 'all_boards.js';
require_once VIEWS_PATH . '/layouts/user/header.php';
?>

<!-- All Boards Hub Container -->
<div class="notif-center-wrapper boards-hub">

  <!-- Boards Hub Top Header Toolbar -->
  <div class="notif-header-toolbar mb-24">
    <div class="notif-header-left">
      <div class="notif-icon-badge boards-hub-badge">
        <i class="fa-solid fa-table-columns"></i>
      </div>
      <div>
        <h1 class="notif-main-title">All Boards</h1>
        <p class="notif-subtext">Manage, view, and organize all your team boards across active workspaces.</p>
      </div>
    </div>

    <!-- Header Right Filter & Create Action -->
    <div class="notif-header-right">
      <div class="board-search-wrapper board-search-wrapper-sm hub-search">
        <i class="fa-solid fa-magnifying-glass board-search-icon"></i>
        <input type="text" id="all-boards-search-input" class="board-search-input" placeholder="Filter boards by title...">
      </div>

      <button class="btn btn-primary btn-create-board-action boards-hub-create-btn" data-modal-target="create-board-modal">
        <i class="fa-solid fa-plus"></i> Create Board
      </button>
    </div>
  </div>

  <!-- SECTION 1: Starred Boards -->
  <?php if (!empty($starredBoards)): ?>
    <div class="workspace-block-margin mb-32">
      <div class="notif-group-title mb-16">
        <i class="fa-solid fa-star star-gold-icon"></i>
        <span class="section-header-title-text">Starred Boards</span>
        <div class="notif-divider-line"></div>
      </div>

      <div class="boards-grid" id="starred-boards-grid">
        <?php foreach ($starredBoards as $b): ?>
          <?php $isStarred = true; $boardDesc = $b['description'] ?? ''; ?>
          <div class="trello-board-tile board-card-link is-starred" role="link" tabindex="0" data-board-href="<?= route('user/board-detail') ?>" data-board-title="<?= strtolower(sanitize($b['title'])) ?>" data-board-name="<?= sanitize($b['title']) ?>" data-board-description="<?= sanitize($boardDesc) ?>" data-cover="<?= sanitize($b['cover_image']) ?>" onclick="openBoardTile(this, event);">
            <div class="tile-top-row">
              <span class="tile-title"><?= sanitize($b['title']) ?></span>
              <?php require VIEWS_PATH . '/partials/board_tile_actions.php'; ?>
            </div>
            <div class="tile-bottom-row">
              <span><i class="fa-regular fa-rectangle-list"></i> <?= $b['cards_count'] ?> Cards</span>
              <span><i class="fa-solid fa-users"></i> <?= $b['members_count'] ?> Members</span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

  <!-- SECTION 2: Workspaces List -->
  <div class="workspace-block-margin">
    <div class="notif-group-title mb-20">
      <i class="fa-solid fa-briefcase icon-primary-sm"></i>
      <span class="section-header-title-text">YOUR WORKSPACES</span>
      <div class="notif-divider-line"></div>
    </div>

    <div class="workspaces-list-stack">
      <?php foreach ($workspaces as $ws): ?>
        <div>
          <!-- Workspace Header Bar -->
          <div class="mb-16">
            <div class="workspace-header-bar mb-0">
              <div class="workspace-icon-badge workspace-icon-badge-dynamic">
                <i class="fa-solid <?= $ws['icon'] ?>"></i>
              </div>
              <div>
                <h2 class="workspace-title workspace-title-heading"><?= sanitize($ws['name']) ?></h2>
                <p class="workspace-desc workspace-desc-text"><?= sanitize($ws['description']) ?></p>
              </div>
            </div>
          </div>

          <!-- Workspace Boards Grid -->
          <div class="boards-grid">
            <?php foreach ($ws['boards'] as $b): ?>
              <?php $isStarred = !empty($b['starred']) || !empty($b['is_starred']); $boardDesc = $b['description'] ?? ''; ?>
              <div class="trello-board-tile board-card-link <?= $isStarred ? 'is-starred' : '' ?>" role="link" tabindex="0" data-board-href="<?= route('user/board-detail') ?>" data-board-title="<?= strtolower(sanitize($b['title'])) ?>" data-board-name="<?= sanitize($b['title']) ?>" data-board-description="<?= sanitize($boardDesc) ?>" data-cover="<?= sanitize($b['cover_image']) ?>" onclick="openBoardTile(this, event);">
                <div class="tile-top-row">
                  <span class="tile-title"><?= sanitize($b['title']) ?></span>
                  <?php require VIEWS_PATH . '/partials/board_tile_actions.php'; ?>
                </div>
                <div class="tile-bottom-row">
                  <span><i class="fa-regular fa-rectangle-list"></i> <?= $b['cards_count'] ?> Cards</span>
                  <span><i class="fa-solid fa-users"></i> <?= $b['members_count'] ?> Members</span>
                </div>
              </div>
            <?php endforeach; ?>

            <!-- Create New Board Tile -->
            <div class="create-board-tile" data-modal-target="create-board-modal">
              <i class="fa-solid fa-plus create-board-tile-icon"></i>
              <span class="create-board-tile-text">Create new board</span>
            </div>
          </div>

        </div>
      <?php endforeach; ?>
    </div>
  </div>

</div>

<?php require_once VIEWS_PATH . '/layouts/user/footer.php'; ?>
