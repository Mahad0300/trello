    </div>
  </div>
</div>

<!-- Shared admin modals (sidebar + multi-page actions) -->
<?php require_once VIEWS_PATH . '/partials/modals/create_board_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/create_workspace_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/edit_workspace_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/add_card_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/edit_card_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/card_detail_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/manage_workspace_members_modal.php'; ?>

<script src="<?= asset('js/admin/admin_common.js') ?>"></script>
<?php if (!empty($page_js)): ?>
  <script src="<?= asset('js/admin/' . $page_js) ?>"></script>
<?php endif; ?>
</body>
</html>
