<?php
$page_title = 'Board Detail - Richmondtech';
$page_js = 'board_detail.js';
require_once VIEWS_PATH . '/layouts/user/header.php';
?>

<!-- Board Header Sub-Navbar -->
<div class="board-header">
  <div class="board-title-group gap-12 flex-row">
    <button class="star-btn <?= $board['is_starred'] ? 'starred' : '' ?>" title="Star Board">
      <i class="fa-solid fa-star"></i>
    </button>
    <h1 class="board-title" id="board-title-text"><?= sanitize($board['title']) ?></h1>
  </div>

  <div class="gap-16 flex-row">
    <!-- Enterprise Board View Tabs (Board, Calendar, List View) -->
    <div class="board-view-tabs board-view-tabs-bar">
      <button class="btn btn-sm btn-view-tab-active active-view-tab" data-view-target="board-view-container">
        <i class="fa-solid fa-table-columns mr-4"></i> Board
      </button>
      <button class="btn btn-sm btn-view-tab" data-view-target="calendar-view-container">
        <i class="fa-regular fa-calendar mr-4"></i> Calendar
      </button>
      <button class="btn btn-sm btn-view-tab" data-view-target="list-view-container">
        <i class="fa-solid fa-list-ul mr-4"></i> List View
      </button>
    </div>

    <!-- In-Board Quick Filter Search -->
    <div class="board-search-wrapper">
      <i class="fa-solid fa-magnifying-glass board-search-icon"></i>
      <input type="text" id="board-search-input" class="board-search-input" placeholder="Filter cards...">
    </div>



    <!-- Board Member Avatars Stack (Far Right Corner) -->
    <div class="avatar-group avatar-group-stack">
      <?php 
        $members = $board['members'] ?? [];
        $visibleMembers = array_slice($members, 0, 3);
        $moreMembers = count($members) - 3;
      ?>
      <?php foreach ($visibleMembers as $m): ?>
        <img src="<?= $m['avatar'] ?>" class="avatar" title="<?= sanitize($m['name']) ?> (<?= $m['role'] ?>)">
      <?php endforeach; ?>
      <?php if ($moreMembers > 0): ?>
        <span class="avatar-more-badge" title="<?= $moreMembers ?> more members">+<?= $moreMembers ?></span>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- View 1: Horizontal Trello Kanban Canvas Container -->
<div id="board-view-container" class="view-container">
  <div class="kanban-canvas kanban-canvas-bg">
    <?php foreach ($board['lists'] as $list): ?>
      <div class="kanban-list" data-list-id="<?= $list['id'] ?>">
        <!-- List Header Bar -->
        <div class="list-header-bar">
          <div class="list-title-text">
            <div class="list-status-pill-line" data-bg="<?= sanitize($list['status_color'] ?? '#94A3B8') ?>"></div>
            <span contenteditable="false"><?= sanitize($list['title']) ?></span>
            <span class="list-card-count-badge"><?= count($list['cards']) ?></span>
          </div>

          <div class="list-header-actions">
            <button class="list-action-icon-btn" title="Add Card" data-modal-target="add-card-modal" onclick="openModal('add-card-modal', this);">
              <i class="fa-solid fa-plus"></i>
            </button>
            <div class="dropdown-wrapper">
              <button class="list-action-icon-btn dropdown-toggle" title="List Options">
                <i class="fa-solid fa-ellipsis"></i>
              </button>
              <div class="dropdown-menu list-options-menu list-options-menu-pos">
                <div class="dropdown-section-header">List Actions</div>
                <a href="#" class="dropdown-item" onclick="event.preventDefault(); editListTitle(this);">
                  <i class="fa-solid fa-pen icon-primary-xs"></i>
                  <span>Edit Title</span>
                </a>
                <a href="#" class="dropdown-item" data-modal-target="add-card-modal" onclick="event.preventDefault(); openModal('add-card-modal', this);">
                  <i class="fa-solid fa-plus icon-success-xs"></i>
                  <span>Add Card</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-item-danger" onclick="event.preventDefault(); deleteList(this);">
                  <i class="fa-regular fa-trash-can icon-danger-xs"></i>
                  <span>Delete List</span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Draggable Cards Container -->
        <div class="list-cards list-cards-stack">
          <?php foreach ($list['cards'] as $card): ?>
            <div class="kanban-card" data-card-id="<?= $card['id'] ?>" data-cover="<?= !empty($card['cover_image']) ? $card['cover_image'] : asset('images/covers/card_cover_design.png') ?>" data-modal-target="card-detail-modal">
              <!-- Cover Image -->
              <?php if (!empty($card['cover_image'])): ?>
                <div class="card-cover-img-box">
                  <img src="<?= $card['cover_image'] ?>" alt="Card Cover">
                </div>
              <?php endif; ?>

              <!-- Title & Subtitle -->
              <div class="card-title-text"><?= sanitize($card['title']) ?></div>
              <?php if (!empty($card['description'])): ?>
                <div class="card-subtitle-text"><?= sanitize($card['description']) ?></div>
              <?php endif; ?>

              <!-- Label Chips Row -->
              <?php if (!empty($card['labels'])): ?>
                <div class="card-label-badges-row">
                  <?php foreach ($card['labels'] as $label): ?>
                    <span class="pastel-label-chip" data-bg="<?= sanitize($label['bg'] ?? '#FFEDD5') ?>" data-fg="<?= sanitize($label['color'] ?? '#EA580C') ?>">
                      <?= sanitize($label['name']) ?>
                    </span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

              <!-- Progress Bar Row -->
              <div class="card-progress-bar-wrap">
                <div class="progress-info-row">
                  <span><i class="fa-regular fa-circle-check"></i> Progress</span>
                  <span><?= $card['progress'] ?? 0 ?>%</span>
                </div>
                <div class="progress-track-line">
                  <div class="progress-fill-line" data-progress="<?= (int)($card['progress'] ?? 0) ?>"></div>
                </div>
              </div>

              <!-- Footer Row -->
              <div class="card-footer-flex">
                <!-- Assignee Avatars Stack -->
                <div class="avatar-stack-group">
                  <?php 
                    $cardAssignees = $card['assignees'] ?? [];
                    $visibleAssignees = array_slice($cardAssignees, 0, 3);
                    $moreCardAssignees = count($cardAssignees) - 3;
                  ?>
                  <?php foreach ($visibleAssignees as $assignee): ?>
                    <img src="<?= $assignee['avatar'] ?>" alt="<?= sanitize($assignee['name']) ?>" title="<?= sanitize($assignee['name']) ?>">
                  <?php endforeach; ?>
                  <?php if ($moreCardAssignees > 0): ?>
                    <span class="avatar-more-badge" title="<?= $moreCardAssignees ?> more assignees">+<?= $moreCardAssignees ?></span>
                  <?php endif; ?>
                </div>

                <!-- Card Metrics -->
                <div class="card-metrics-right">
                  <span><i class="fa-regular fa-comment"></i> <?= $card['comments_count'] ?? 0 ?></span>
                  <span><i class="fa-solid fa-paperclip"></i> <?= $card['attachments_count'] ?? 0 ?></span>
                </div>
              </div>

            </div>
          <?php endforeach; ?>
        </div>

        <!-- Add Card Button -->
        <button class="add-card-btn" data-modal-target="add-card-modal" onclick="openModal('add-card-modal', this);">
          <i class="fa-solid fa-plus mr-6"></i> Add a card
        </button>
      </div>
    <?php endforeach; ?>

    <!-- Add Another List Button -->
    <div class="add-list-box" data-modal-target="add-list-modal" onclick="openModal('add-list-modal', this);">
      <span class="add-list-box-content">
        <i class="fa-solid fa-plus icon-primary"></i> Add another list
      </span>
    </div>
  </div>
</div>

<!-- View 3: Flat Sortable List / Table View Container -->
<div id="list-view-container" class="view-container list-view-padding display-none">
  <div class="table-card-box">
    
    <!-- Table Header Toolbar -->
    <div class="table-header-toolbar">
      <div class="table-header-left">
        <div class="table-header-icon-badge">
          <i class="fa-solid fa-list-check"></i>
        </div>
        <div>
          <h3 class="table-header-title">Board Cards & Task Directory</h3>
          <p class="table-header-subtext">Overview of all cards across active kanban columns</p>
        </div>
      </div>

      <div class="table-header-right">
        <div class="search-input-group search-input-sm">
          <i class="fa-solid fa-magnifying-glass search-icon"></i>
          <input type="text" id="list-table-filter-input" placeholder="Search tasks..." class="table-filter-input">
        </div>
        <span class="badge badge-active-tasks">6 Active Tasks</span>
      </div>
    </div>

    <!-- Data Table Container -->
    <div class="table-desktop-fit-wrapper">
      <table class="data-directory-table">
        <thead>
          <tr class="table-head-row">
            <th class="col-title">Task & Card Title</th>
            <th class="col-status">Column Status</th>
            <th class="col-assignees">Assignees</th>
            <th class="col-priority">Priority</th>
            <th class="col-progress">Progress</th>
            <th class="col-due">Due Date</th>
            <th class="col-action">Action</th>
          </tr>
        </thead>
        <tbody id="list-table-body">
          <tr class="table-hover-row" onclick="window.openModal('card-detail-modal');">
            <td class="cell-title">
              <div class="task-title-flex">
                <div class="task-folder-badge task-folder-indigo">
                  <i class="fa-regular fa-folder"></i>
                </div>
                <div class="task-text-block">
                  <div class="task-main-name" title="HTML5 Drag & Drop Card Physics">HTML5 Drag & Drop Card Physics</div>
                  <div class="task-sub-desc" title="Implement draggable physics & container drop handlers">Implement draggable physics & container drop handlers</div>
                </div>
              </div>
            </td>
            <td class="cell-status">
              <span class="badge-status-progress">
                <i class="fa-solid fa-spinner font-size-10"></i> In Progress
              </span>
            </td>
            <td class="cell-assignees">
              <div class="assignees-avatar-flex">
                <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="table-user-avatar" title="Sarah Connor">
                <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="table-user-avatar table-user-avatar-overlap" title="Chris Parker">
                <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="table-user-avatar table-user-avatar-overlap" title="Alex Johnson">
                <span class="avatar-more-badge" title="2 more assignees">+2</span>
              </div>
            </td>
            <td class="cell-priority">
              <span class="badge-priority-high">
                <i class="fa-solid fa-angle-up font-size-10"></i> High
              </span>
            </td>
            <td class="cell-progress">
              <div class="progress-cell-flex">
                <div class="progress-track-sm">
                  <div class="progress-fill-indigo progress-w-50"></div>
                </div>
                <span class="progress-percentage-indigo">50%</span>
              </div>
            </td>
            <td class="cell-date">
              <span class="date-chip"><i class="fa-regular fa-calendar text-primary"></i> Oct 28, 2026</span>
            </td>
            <td class="cell-action">
              <button class="btn btn-secondary btn-sm btn-view-card-table">
                View Card <i class="fa-solid fa-arrow-right font-size-10 ml-2"></i>
              </button>
            </td>
          </tr>
          <tr class="table-hover-row" onclick="window.openModal('card-detail-modal');">
            <td class="cell-title">
              <div class="task-title-flex">
                <div class="task-folder-badge task-folder-blue">
                  <i class="fa-regular fa-folder"></i>
                </div>
                <div class="task-text-block">
                  <div class="task-main-name" title="MySQL PDO Prepared Statements">MySQL PDO Prepared Statements</div>
                  <div class="task-sub-desc" title="Write secure database query handlers & migrations">Write secure database query handlers & migrations</div>
                </div>
              </div>
            </td>
            <td class="cell-status">
              <span class="badge-status-todo">
                <i class="fa-regular fa-circle font-size-10"></i> To-Do
              </span>
            </td>
            <td class="cell-assignees">
              <div class="assignees-avatar-flex">
                <img src="<?= asset('images/avatars/default-image.jpg') ?>" class="table-user-avatar" title="Alex Johnson">
              </div>
            </td>
            <td class="cell-priority">
              <span class="badge-priority-medium">
                <i class="fa-solid fa-minus font-size-10"></i> Medium
              </span>
            </td>
            <td class="cell-progress">
              <div class="progress-cell-flex">
                <div class="progress-track-sm">
                  <div class="progress-fill-blue progress-w-25"></div>
                </div>
                <span class="progress-percentage-blue">25%</span>
              </div>
            </td>
            <td class="cell-date">
              <span class="date-chip"><i class="fa-regular fa-calendar text-info"></i> Nov 02, 2026</span>
            </td>
            <td class="cell-action">
              <button class="btn btn-secondary btn-sm btn-view-card-table">
                View Card <i class="fa-solid fa-arrow-right font-size-10 ml-2"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- View 2: Enterprise Google Calendar / ClickUp Style Calendar Container -->
<div id="calendar-view-container" class="view-container calendar-view-wrapper display-none">
  <!-- Header Toolbar -->
  <div class="calendar-toolbar">
    <!-- Left Navigation & Title -->
    <div class="calendar-left-group">
      <h2 id="calendar-month-title" class="calendar-month-heading">
        <span id="cal-month-text">July 2026</span>
      </h2>

      <div class="calendar-nav-buttons">
        <button id="cal-today-btn" class="btn btn-secondary btn-sm btn-cal-today" title="Jump to Today">Today</button>
        <button id="cal-prev-btn" class="btn btn-secondary btn-sm btn-cal-nav" title="Previous Month"><i class="fa-solid fa-chevron-left"></i></button>
        <button id="cal-next-btn" class="btn btn-secondary btn-sm btn-cal-nav" title="Next Month"><i class="fa-solid fa-chevron-right"></i></button>
      </div>
    </div>

    <!-- Right Controls: View Modes (Month, Week, Day) -->
    <div class="calendar-right-controls">
      <div class="cal-mode-wrapper">
        <button class="btn btn-sm cal-mode-btn active-cal-mode" data-cal-mode="month">Month</button>
        <button class="btn btn-sm cal-mode-btn cal-mode-btn-inactive" data-cal-mode="week">Week</button>
        <button class="btn btn-sm cal-mode-btn cal-mode-btn-inactive" data-cal-mode="day">Day</button>
      </div>
    </div>
  </div>

  <!-- Calendar Container Grid -->
  <div class="cal-grid-wrapper">
    <!-- Header Weekdays Row -->
    <div class="cal-header-row">
      <div class="cal-header-cell">Sun</div>
      <div class="cal-header-cell">Mon</div>
      <div class="cal-header-cell">Tue</div>
      <div class="cal-header-cell">Wed</div>
      <div class="cal-header-cell">Thu</div>
      <div class="cal-header-cell">Fri</div>
      <div class="cal-header-cell">Sat</div>
    </div>

    <!-- Month Grid Days (Sun & Sat are Weekends - No Task Data) -->
    <div class="cal-month-grid">
      <!-- Week 1: Sun 20 - Sat 26 -->
      <div class="cal-day-cell cal-day-cell-weekend">
        <div class="cal-day-num">20</div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">21</div>
        <div class="cal-event-pill cal-pill-purple cal-span-bar" data-modal-target="card-detail-modal">
          Implement Core Feature
        </div>
        <div class="cal-event-pill cal-pill-peach cal-span-bar" data-modal-target="card-detail-modal">
          Refactor Component Logic
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">22</div>
        <div class="cal-event-pill cal-pill-purple cal-span-bar-continue opacity-85" data-modal-target="card-detail-modal">
          Implement Core Feature
        </div>
        <div class="cal-event-pill cal-pill-peach cal-span-bar-continue opacity-85" data-modal-target="card-detail-modal">
          Refactor Component Logic
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">23</div>
        <div class="cal-event-pill cal-pill-purple cal-icon-circle-wrap" data-modal-target="card-detail-modal">
          <span class="cal-icon-circle"><i class="fa-solid fa-layer-group"></i></span> TM-02...
        </div>
        <div class="cal-event-pill cal-pill-mint cal-icon-circle-wrap" data-modal-target="card-detail-modal">
          <span class="cal-icon-circle"><i class="fa-solid fa-asterisk"></i></span> TM-04 Improve App Perform...
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">24</div>
        <div class="cal-event-pill cal-pill-blue cal-icon-circle-wrap" data-modal-target="card-detail-modal">
          <span class="cal-icon-circle"><i class="fa-solid fa-rotate"></i></span> TM-03 Update Database
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">25</div>
      </div>

      <div class="cal-day-cell cal-day-cell-weekend">
        <div class="cal-day-num">26</div>
      </div>

      <!-- Week 2: Sun 27 - Sat 2 -->
      <div class="cal-day-cell cal-day-cell-weekend">
        <div class="cal-day-num">27</div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">28</div>
        <div class="cal-event-pill cal-pill-mint cal-span-bar" data-modal-target="card-detail-modal">
          <span class="cal-icon-circle"><i class="fa-solid fa-asterisk"></i></span> TM-08 Adjust Responsive Layout
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">29</div>
        <div class="cal-event-pill cal-pill-mint cal-span-bar-continue" data-modal-target="card-detail-modal">
          TM-08 Adjust Responsive Layout
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">30</div>
        <div class="cal-event-pill cal-pill-blue cal-icon-circle-wrap" data-modal-target="card-detail-modal">
          <span class="cal-icon-circle"><i class="fa-solid fa-rotate"></i></span> TM-06 Update API Integration
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">31</div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">1</div>
      </div>

      <div class="cal-day-cell cal-day-cell-weekend">
        <div class="cal-day-num">2</div>
      </div>

      <!-- Week 3: Sun 3 - Sat 9 -->
      <div class="cal-day-cell cal-day-cell-weekend">
        <div class="cal-day-num">3</div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">4</div>
        <div class="cal-event-pill cal-pill-lavender cal-icon-circle-wrap" data-modal-target="card-detail-modal">
          <span class="cal-icon-circle"><i class="fa-solid fa-link"></i></span> TM-09 Enhance Error Handling
        </div>
        <div class="cal-event-pill cal-pill-peach cal-icon-circle-wrap" data-modal-target="card-detail-modal">
          <span class="cal-icon-circle"><i class="fa-solid fa-bolt"></i></span> TM-10 Review Code Quality
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">5</div>
        <div class="cal-event-pill cal-pill-rose cal-icon-circle-wrap" data-modal-target="card-detail-modal">
          <span class="cal-icon-circle"><i class="fa-solid fa-bookmark"></i></span> TM-10 Deploy Staging Build
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">6</div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">7</div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">8</div>
      </div>

      <div class="cal-day-cell cal-day-cell-weekend">
        <div class="cal-day-num">9</div>
      </div>

      <!-- Week 4: Sun 10 - Sat 16 -->
      <div class="cal-day-cell cal-day-cell-weekend">
        <div class="cal-day-num">10</div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">11</div>
        <div class="cal-event-pill cal-pill-mint cal-icon-circle-wrap" data-modal-target="card-detail-modal">
          <span class="cal-icon-circle"><i class="fa-solid fa-asterisk"></i></span> TM-12...
        </div>
        <div class="cal-event-pill cal-pill-blue cal-span-bar" data-modal-target="card-detail-modal">
          Update State Management
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">12</div>
        <div class="cal-event-pill cal-pill-blue cal-span-bar-continue" data-modal-target="card-detail-modal">
          Update State Management
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">13</div>
        <div class="cal-event-pill cal-pill-purple cal-icon-circle-wrap" data-modal-target="card-detail-modal">
          <span class="cal-icon-circle"><i class="fa-solid fa-layer-group"></i></span> TM-13...
        </div>
        <div class="cal-event-pill cal-pill-lavender cal-icon-circle-wrap" data-modal-target="card-detail-modal">
          <span class="cal-icon-circle"><i class="fa-solid fa-link"></i></span> TM-15 Fix Navigation Issues
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">14</div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">15</div>
      </div>

      <div class="cal-day-cell cal-day-cell-weekend">
        <div class="cal-day-num">16</div>
      </div>

      <!-- Week 5: Sun 17 - Sat 23 -->
      <div class="cal-day-cell cal-day-cell-weekend">
        <div class="cal-day-num">17</div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">18</div>
        <div class="cal-event-pill cal-pill-peach cal-span-bar" data-modal-target="card-detail-modal">
          Valid Input Validation
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">19</div>
        <div class="cal-event-pill cal-pill-peach cal-span-bar-end" data-modal-target="card-detail-modal">
          Valid Input Validation
        </div>
        <div class="cal-event-pill cal-pill-lavender cal-icon-circle-wrap" data-modal-target="card-detail-modal">
          <span class="cal-icon-circle"><i class="fa-solid fa-link"></i></span> TM-17...
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">20</div>
        <div class="cal-event-pill cal-pill-peach cal-icon-circle-wrap" data-modal-target="card-detail-modal">
          <span class="cal-icon-circle"><i class="fa-solid fa-sliders"></i></span> TM-18...
        </div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">21</div>
      </div>

      <div class="cal-day-cell">
        <div class="cal-day-num">22</div>
      </div>

      <div class="cal-day-cell cal-day-cell-weekend">
        <div class="cal-day-num">23</div>
      </div>
    </div>
  </div>
</div>

<!-- Card-only modals (shared board/list/card modals load from user footer) -->
<?php require_once VIEWS_PATH . '/partials/modals/card_members_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/card_labels_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/card_attachment_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/card_move_modal.php'; ?>

<?php require_once VIEWS_PATH . '/layouts/user/footer.php'; ?>
