    </div>
  </div>
</div>

<script src="<?= asset('js/admin/admin_common.js') ?>"></script>
<?php if (isset($page_js) && !empty($page_js)): ?>
  <script src="<?= asset('js/admin/' . $page_js) ?>"></script>
<?php else: ?>
  <script src="<?= asset('js/admin/admin.js') ?>"></script>
<?php endif; ?>
</body>
</html>
