<div class="tile-top-actions">
  <div class="dropdown-wrapper board-tile-menu">
    <button type="button" class="board-tile-menu-btn" title="Board options" onclick="toggleBoardTileMenu(this, event);">
      <i class="fa-solid fa-ellipsis"></i>
    </button>
    <div class="dropdown-menu board-tile-dropdown list-options-menu">
      <div class="dropdown-section-header">Board Actions</div>
      <button type="button" class="dropdown-item board-tile-star-item" onclick="toggleBoardStarFromMenu(this, event);">
        <?php if (!empty($isStarred)): ?>
          <i class="fa-solid fa-star text-warning"></i>
          <span>Unstar Board</span>
        <?php else: ?>
          <i class="fa-regular fa-star"></i>
          <span>Star Board</span>
        <?php endif; ?>
      </button>
      <button type="button" class="dropdown-item" onclick="openBoardEditFromTile(this, event);">
        <i class="fa-solid fa-pen icon-primary-xs"></i>
        <span>Edit Board</span>
      </button>
      <div class="dropdown-divider"></div>
      <button type="button" class="dropdown-item dropdown-item-danger" onclick="openBoardDeleteFromTile(this, event);">
        <i class="fa-regular fa-trash-can icon-danger-xs"></i>
        <span>Delete Board</span>
      </button>
    </div>
  </div>
</div>
