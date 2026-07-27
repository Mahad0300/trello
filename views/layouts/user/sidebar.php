<aside class="user-sidebar">
  <div>
    <div class="sidebar-section-title">Navigation</div>

    <a href="<?= route('user/dashboard') ?>" class="sidebar-nav-item <?= strpos($_SERVER['REQUEST_URI'] ?? '', 'user/dashboard') !== false ? 'active' : '' ?>">
      <i class="fa-solid fa-chart-pie sidebar-icon"></i>
      <span>Dashboard</span>
    </a>

    <!-- Sidebar Boards Accordion / Collapsible Dropdown -->
    <div class="sidebar-dropdown-wrapper mt-4">
      <button class="sidebar-nav-item sidebar-dropdown-btn sidebar-dropdown-btn-reset <?= (strpos($_SERVER['REQUEST_URI'] ?? '', 'user/board') !== false || strpos($_SERVER['REQUEST_URI'] ?? '', 'user/all-boards') !== false) ? 'active' : '' ?>">
        <div class="sidebar-btn-inner">
          <i class="fa-solid fa-table-columns sidebar-icon"></i>
          <span>Boards</span>
        </div>
        <i class="fa-solid fa-chevron-down dropdown-arrow dropdown-arrow-icon"></i>
      </button>

      <div class="sidebar-submenu show sidebar-submenu-stack">
        <a href="<?= route('user/all-boards') ?>" class="sidebar-sublink <?= (strpos($_SERVER['REQUEST_URI'] ?? '', 'user/all-boards') !== false || strpos($_SERVER['REQUEST_URI'] ?? '', 'user/boards') !== false) ? 'active-sublink' : '' ?>">
          <i class="fa-solid fa-border-all icon-sublink-hub"></i>
          <span>All Boards</span>
        </a>
        <a href="<?= route('user/board-detail') ?>" class="sidebar-sublink">
          <i class="fa-regular fa-folder icon-sublink-folder"></i>
          <span class="text-ellipsis">Sprint 24 Architecture</span>
        </a>
        <a href="<?= route('user/board-detail') ?>" class="sidebar-sublink">
          <i class="fa-regular fa-folder icon-sublink-folder"></i>
          <span class="text-ellipsis">Bug Triage & Hotfixes</span>
        </a>
        <a href="<?= route('user/board-detail') ?>" class="sidebar-sublink">
          <i class="fa-regular fa-folder icon-sublink-folder"></i>
          <span class="text-ellipsis">API v3 Migration</span>
        </a>
        <a href="<?= route('user/board-detail') ?>" class="sidebar-sublink">
          <i class="fa-regular fa-folder icon-sublink-folder"></i>
          <span class="text-ellipsis">Design System 2.0</span>
        </a>
        <a href="<?= route('user/board-detail') ?>" class="sidebar-sublink">
          <i class="fa-regular fa-folder icon-sublink-folder"></i>
          <span class="text-ellipsis">Q4 Growth Marketing</span>
        </a>
        <a href="#" class="sidebar-sublink sublink-create" data-modal-target="user-create-board-modal">
          <i class="fa-solid fa-plus icon-sublink-plus"></i>
          <span>Create Board...</span>
        </a>
      </div>
    </div>

    <a href="<?= route('user/profile') ?>" class="sidebar-nav-item mt-2 <?= strpos($_SERVER['REQUEST_URI'] ?? '', 'user/profile') !== false ? 'active' : '' ?>">
      <i class="fa-regular fa-user sidebar-icon"></i>
      <span>My Profile</span>
    </a>
  </div>

  <div>
    <div class="sidebar-section-title">Starred Boards</div>
    <a href="<?= route('user/board-detail') ?>" class="sidebar-nav-item">
      <i class="fa-solid fa-star sidebar-icon star-gold-icon"></i>
      <span class="text-ellipsis">Sprint 24 Architecture</span>
    </a>
    <a href="<?= route('user/board-detail') ?>" class="sidebar-nav-item">
      <i class="fa-solid fa-star sidebar-icon star-gold-icon"></i>
      <span class="text-ellipsis">Design System 2.0</span>
    </a>
  </div>

  <div class="mt-auto">
    <a href="<?= route('login') ?>" class="sidebar-nav-item nav-item-danger">
      <i class="fa-solid fa-arrow-right-from-bracket sidebar-icon"></i>
      <span>Log Out</span>
    </a>
  </div>
</aside>
