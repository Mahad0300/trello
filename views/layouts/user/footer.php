    </div>
  </div>
</div>

<!-- Global User Modal Dialog Components (Rendered directly under <body> for 100% Z-Index & Stacking Context Visibility) -->
<?php require_once VIEWS_PATH . '/partials/modals/create_board_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/edit_board_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/delete_board_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/card_detail_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/add_card_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/add_list_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/share_board_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/filter_board_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/edit_list_modal.php'; ?>
<?php require_once VIEWS_PATH . '/partials/modals/delete_list_modal.php'; ?>

<script src="<?= asset('js/user/common.js') ?>"></script>
<?php if (!empty($page_js)): ?>
  <script src="<?= asset('js/user/' . $page_js) ?>"></script>
<?php endif; ?>
</body>
</html>
