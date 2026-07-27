<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= sanitize($pageTitle ?? 'Create Account - Trello SaaS') ?></title>
  <!-- FontAwesome 6 Vector Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
<body class="auth-page">

<div class="auth-card">
  <div class="auth-brand">
    <div class="auth-brand-logo"><i class="fa-solid fa-kanban"></i></div>
    <h2 style="font-weight: 800; font-size: 22px; color: var(--text-main);">Create your account</h2>
    <p style="color: var(--text-muted); font-size: 13px; margin-top: 4px;">Start managing projects with high velocity</p>
  </div>

  <form action="#" method="POST" onsubmit="event.preventDefault(); window.location.href='<?= route('user/dashboard') ?>';">
    <div class="form-group">
      <label for="name">Full Name</label>
      <input type="text" id="name" class="form-control" placeholder="John Doe" required>
    </div>

    <div class="form-group">
      <label for="email">Work Email</label>
      <input type="email" id="email" class="form-control" placeholder="name@company.com" required>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" class="form-control" placeholder="Minimum 8 characters" required>
    </div>

    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px; padding: 11px;">
      Create Free Account
    </button>
  </form>

  <div style="margin-top: 24px; text-align: center; font-size: 13px; color: var(--text-muted);">
    Already have an account? <a href="<?= route('login') ?>" style="font-weight: 600;">Sign In</a>
  </div>
</div>

</body>
</html>
