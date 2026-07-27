<?php
$page_title = 'All Boards - Trello SaaS';
$page_js = 'all_boards.js';
require_once VIEWS_PATH . '/layouts/user/header.php';
?>

<!-- Official Trello-Style All Boards Hub Container -->
<div class="notif-center-wrapper">

  <!-- Boards Hub Top Header Toolbar -->
  <div class="notif-header-toolbar mb-24">
    <div class="notif-header-left">
      <div class="notif-icon-badge notif-icon-badge-gradient">
        <i class="fa-solid fa-table-columns icon-primary"></i>
      </div>
      <div>
        <h1 class="notif-main-title">All Boards</h1>
        <p class="notif-subtext">Manage, view, and organize all your team boards across active workspaces.</p>
      </div>
    </div>

    <!-- Header Right Filter & Create Action -->
    <div class="notif-header-right">
      <div class="board-search-wrapper board-search-wrapper-sm">
        <i class="fa-solid fa-magnifying-glass board-search-icon"></i>
        <input type="text" id="all-boards-search-input" class="board-search-input" placeholder="Filter boards by title...">
      </div>

      <button class="btn btn-primary btn-create-board-action" data-modal-target="user-create-board-modal">
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
          <a href="<?= route('user/board-detail') ?>" class="trello-board-tile board-card-link" data-board-title="<?= strtolower(sanitize($b['title'])) ?>" style="background-image: linear-gradient(180deg, rgba(0,0,0,0.15) 0%, rgba(0,0,0,0.75) 100%), url('<?= $b['cover_image'] ?>');">
            <div class="tile-top-row">
              <span class="tile-title"><?= sanitize($b['title']) ?></span>
              <span class="star-board-btn active" title="Unstar Board" onclick="toggleBoardStar(this, event);">
                <i class="fa-solid fa-star text-warning"></i>
              </span>
            </div>
            <div class="tile-bottom-row">
              <span><i class="fa-regular fa-rectangle-list"></i> <?= $b['cards_count'] ?> Cards</span>
              <span><i class="fa-solid fa-users"></i> <?= $b['members_count'] ?> Members</span>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

  <!-- SECTION 2: Recently Viewed Boards -->
  <?php if (!empty($recentBoards)): ?>
    <div class="workspace-block-margin mb-36">
      <div class="notif-group-title mb-16">
        <i class="fa-regular fa-clock icon-primary-sm"></i>
        <span class="section-header-title-text">Recently Viewed</span>
        <div class="notif-divider-line"></div>
      </div>

      <div class="boards-grid">
        <?php foreach ($recentBoards as $b): ?>
          <?php $isStarred = !empty($b['starred']) || !empty($b['is_starred']); ?>
          <a href="<?= route('user/board-detail') ?>" class="trello-board-tile board-card-link" data-board-title="<?= strtolower(sanitize($b['title'])) ?>" style="background-image: linear-gradient(180deg, rgba(0,0,0,0.15) 0%, rgba(0,0,0,0.75) 100%), url('<?= $b['cover_image'] ?>');">
            <div class="tile-top-row">
              <span class="tile-title"><?= sanitize($b['title']) ?></span>
              <span class="star-board-btn <?= $isStarred ? 'active' : '' ?>" title="<?= $isStarred ? 'Unstar Board' : 'Star Board' ?>" onclick="toggleBoardStar(this, event);">
                <i class="<?= $isStarred ? 'fa-solid fa-star text-warning' : 'fa-regular fa-star' ?>"></i>
              </span>
            </div>
            <div class="tile-bottom-row">
              <span><i class="fa-regular fa-rectangle-list"></i> <?= $b['cards_count'] ?> Cards</span>
              <span><i class="fa-solid fa-users"></i> <?= $b['members_count'] ?> Members</span>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

  <!-- SECTION 3: Trello Workspaces List -->
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
              <div class="workspace-icon-badge workspace-icon-badge-dynamic" style="background: linear-gradient(135deg, <?= $ws['color'] ?>, var(--accent-purple));">
                <i class="fa-solid <?= $ws['icon'] ?>"></i>
              </div>
              <div>
                <div class="gap-10 flex-row">
                  <h2 class="workspace-title workspace-title-heading"><?= sanitize($ws['name']) ?></h2>
                  <span class="badge badge-visibility-pill">
                    <i class="fa-solid fa-lock-open font-size-10"></i> <?= $ws['visibility'] ?>
                  </span>
                </div>
                <p class="workspace-desc workspace-desc-text"><?= sanitize($ws['description']) ?></p>
              </div>
            </div>
          </div>

          <!-- Workspace Boards Grid -->
          <div class="boards-grid">
            <?php foreach ($ws['boards'] as $b): ?>
              <?php $isStarred = !empty($b['starred']) || !empty($b['is_starred']); ?>
              <a href="<?= route('user/board-detail') ?>" class="trello-board-tile board-card-link" data-board-title="<?= strtolower(sanitize($b['title'])) ?>" style="background-image: linear-gradient(180deg, rgba(0,0,0,0.15) 0%, rgba(0,0,0,0.75) 100%), url('<?= $b['cover_image'] ?>');">
                <div class="tile-top-row">
                  <span class="tile-title"><?= sanitize($b['title']) ?></span>
                  <span class="star-board-btn <?= $isStarred ? 'active' : '' ?>" title="<?= $isStarred ? 'Unstar Board' : 'Star Board' ?>" onclick="toggleBoardStar(this, event);">
                    <i class="<?= $isStarred ? 'fa-solid fa-star text-warning' : 'fa-regular fa-star' ?>"></i>
                  </span>
                </div>
                <div class="tile-bottom-row">
                  <span><i class="fa-regular fa-rectangle-list"></i> <?= $b['cards_count'] ?> Cards</span>
                  <span><i class="fa-solid fa-users"></i> <?= $b['members_count'] ?> Members</span>
                </div>
              </a>
            <?php endforeach; ?>

            <!-- Create New Board Tile -->
            <div class="create-board-tile" data-modal-target="user-create-board-modal">
              <i class="fa-solid fa-plus create-board-tile-icon"></i>
              <span class="create-board-tile-text">Create new board</span>
            </div>
          </div>

        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- SECTION 4: Archived & Closed Boards Bar -->
  <?php if (!empty($closedBoards)): ?>
    <div class="closed-boards-banner">
      <div class="closed-boards-left">
        <i class="fa-solid fa-box-archive closed-boards-icon"></i>
        <div>
          <div class="closed-boards-title">View Closed & Archived Boards</div>
          <div class="closed-boards-desc">You have <?= count($closedBoards) ?> archived project board available for restoration.</div>
        </div>
      </div>
      <button class="btn btn-secondary btn-sm font-weight-700" onclick="alert('Static UI Preview: 1 Closed Board: Q1 Legacy Architecture');">
        Reopen Closed Boards
      </button>
    </div>
  <?php endif; ?>

</div>

<!-- Filter Search JS Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('all-boards-search-input');
  if (searchInput) {
    searchInput.addEventListener('input', function(e) {
      const term = e.target.value.toLowerCase().trim();
      const boardLinks = document.querySelectorAll('.board-card-link');
      
      boardLinks.forEach(link => {
        const title = link.getAttribute('data-board-title') || '';
        if (!term || title.includes(term)) {
          link.style.display = 'flex';
        } else {
          link.style.display = 'none';
        }
      });
    });
  }
});
</script>

<?php require_once VIEWS_PATH . '/layouts/user/footer.php'; ?>
