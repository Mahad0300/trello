<?php require VIEWS_PATH . '/layouts/admin/header.php'; ?>

<div class="dashboard-wrapper dash-masonry-wrapper p-24">

    <!-- Header Toolbar (Consistent with User Accounts & Workspaces) -->
    <div class="notif-header-toolbar">
      <div class="notif-header-left">
        <div class="notif-icon-badge notif-icon-badge-gradient">
          <i class="fa-solid fa-clock-rotate-left"></i>
        </div>
        <div>
          <h1 class="notif-main-title">Activity Log & Audit Trail</h1>
          <p class="notif-subtext">Real-time system operation logs, user security events, and audit feed.</p>
        </div>
      </div>
      <div class="notif-header-right">
        <button type="button" class="btn btn-secondary" id="export-activity-csv-btn">
          <i class="fa-solid fa-file-export mr-6"></i> Export CSV
        </button>
        <button type="button" class="btn btn-primary" onclick="location.reload();">
          <i class="fa-solid fa-rotate-right mr-6"></i> Refresh Trail
        </button>
      </div>
    </div>

    <!-- ENTERPRISE ACTIVITY LOG TABLE CARD CONTAINER -->
    <div class="dash-card-box p-24 overflow-hidden">
      <!-- Filter & Search Bar -->
      <div class="table-filter-bar mb-20">
        <div class="search-input-wrap flex-1">
          <i class="fa-solid fa-magnifying-glass search-icon"></i>
          <input type="text" id="log-search-input" class="form-input search-input-field" placeholder="Search by user, action, target item, IP address...">
        </div>

        <div class="filter-controls-group">
          <select id="log-category-filter" class="form-select filter-select">
            <option value="all">All Categories</option>
            <option value="cards">Card Operations</option>
            <option value="boards">Board Activity</option>
            <option value="security">User & Security</option>
          </select>

          <select id="log-per-page-select" class="form-select filter-select">
            <option value="10" selected>10 per page</option>
            <option value="25">25 per page</option>
            <option value="50">50 per page</option>
            <option value="all">Show All</option>
          </select>
        </div>
      </div>

      <!-- Padded Datatable Wrapper -->
      <div class="table-responsive activity-table-wrapper">
        <table class="dash-table activity-log-table" id="activity-log-table">
          <thead>
            <tr>
              <th>USER / ACTOR</th>
              <th>ACTION EVENT</th>
              <th>TARGET SUBJECT</th>
              <th>IP & DEVICE</th>
              <th>TIMESTAMP</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($logs as $log): ?>
              <tr class="log-row" data-category="<?= sanitize($log['action']['category'] ?? 'cards') ?>">
                <!-- 1. USER / ACTOR -->
                <td>
                  <div class="log-user-flex">
                    <img src="<?= sanitize($log['user']['avatar']) ?>" class="log-user-avatar" alt="User Avatar">
                    <div class="log-user-details">
                      <span class="log-user-name"><?= sanitize($log['user']['name']) ?></span>
                      <span class="log-user-email"><?= sanitize($log['user']['email']) ?></span>
                    </div>
                  </div>
                </td>

                <!-- 2. ACTION EVENT -->
                <td>
                  <span class="badge-action-pill <?= sanitize($log['action']['badge_class']) ?>">
                    <i class="<?= sanitize($log['action']['icon']) ?> mr-6"></i>
                    <?= sanitize($log['action']['label']) ?>
                  </span>
                </td>

                <!-- 3. TARGET SUBJECT -->
                <td>
                  <span class="log-target-title" title="<?= sanitize($log['target_item']) ?>">
                    <?= sanitize($log['target_item']) ?>
                  </span>
                </td>

                <!-- 4. IP & DEVICE -->
                <td>
                  <div class="log-ip-stack">
                    <code class="ip-address-badge"><?= sanitize($log['log_ip'] ?? $log['ip_address']) ?></code>
                    <span class="log-device-text"><i class="fa-solid fa-laptop mr-6"></i> <?= sanitize($log['device']) ?></span>
                  </div>
                </td>

                <!-- 5. TIMESTAMP -->
                <td>
                  <div class="log-time-stack">
                    <span class="log-time-ago"><?= sanitize($log['time_ago']) ?></span>
                    <span class="log-time-exact"><?= sanitize(date('M d, H:i', strtotime($log['timestamp']))) ?></span>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- TABLE FOOTER / PAGINATION -->
        <div class="table-footer-bar">
          <div class="table-footer-info">
            <span>Showing <strong class="text-main"><?= count($logs) ?></strong> of <strong class="text-main"><?= number_format($stats['total_events']) ?></strong> system audit entries</span>
          </div>

          <div class="table-pagination-group">
            <button type="button" class="pagination-btn pagination-btn-prev" disabled>
              <i class="fa-solid fa-chevron-left mr-4"></i> Prev
            </button>
            <div class="pagination-numbers">
              <button type="button" class="pagination-num active">1</button>
              <button type="button" class="pagination-num">2</button>
              <button type="button" class="pagination-num">3</button>
              <span class="pagination-ellipsis">...</span>
              <button type="button" class="pagination-num">128</button>
            </div>
            <button type="button" class="pagination-btn pagination-btn-next">
              Next <i class="fa-solid fa-chevron-right ml-4"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

  </div>

<?php require VIEWS_PATH . '/layouts/admin/footer.php'; ?>
