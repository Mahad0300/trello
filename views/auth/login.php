<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= sanitize($pageTitle ?? 'Sign In - Trello SaaS') ?></title>
  <!-- FontAwesome 6 Vector Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
<body class="auth-page">

<div class="auth-card">
  <div class="auth-brand">
    <div class="auth-brand-logo"><i class="fa-solid fa-kanban"></i></div>
    <h2 style="font-weight: 800; font-size: 22px; color: var(--text-main);">Welcome back</h2>
    <p style="color: var(--text-muted); font-size: 13px; margin-top: 4px;">Sign in to your Trello workspace account</p>
  </div>

  <form action="#" method="POST" onsubmit="event.preventDefault(); window.location.href='<?= route('user/dashboard') ?>';">
    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" id="email" class="form-control" placeholder="name@company.com" value="mahad@trello.com" required>
    </div>

    <div class="form-group">
      <div style="display: flex; justify-content: space-between; align-items: center;">
        <label for="password">Password</label>
        <a href="#" style="font-size: 12px;" onclick="alert('Static UI Preview: Password Reset');">Forgot?</a>
      </div>
      <input type="password" id="password" class="form-control" value="••••••••" required>
    </div>

    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px; padding: 11px;">
      Sign In to Workspace
    </button>
  </form>

  <div style="margin-top: 24px; text-align: center; font-size: 13px; color: var(--text-muted);">
    Don't have an account? <a href="<?= route('register') ?>" style="font-weight: 600;">Create Account</a>
  </div>

  <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid var(--border-color); display: flex; justify-content: space-around; font-size: 12px;">
    <a href="<?= route('user/dashboard') ?>">User Preview ➔</a>
    <a href="<?= route('admin/dashboard') ?>" style="color: var(--accent-purple);">Admin Preview ➔</a>
  </div>
</div>

</body>
</html>
