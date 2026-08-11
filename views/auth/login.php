<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= sanitize($pageTitle ?? 'Sign In - Richmondtech') ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
<body class="auth-page">

  <div class="auth-shell">
    <aside class="auth-visual" aria-hidden="false">
      <div class="auth-visual-bg" style="background-image: url('<?= asset('images/auth/login_bg_3d.png') ?>');"></div>
      <div class="auth-visual-mesh"></div>

      <div class="auth-visual-content">
        <a href="<?= route('login') ?>" class="auth-brand-mark">
          <span class="auth-brand-mark-icon"><i class="fa-solid fa-layer-group"></i></span>
          <span class="auth-brand-mark-text"><?= sanitize(APP_NAME) ?></span>
        </a>

        <h1 class="auth-visual-headline">Boards that keep every team in motion.</h1>
        <p class="auth-visual-sub">Plan, track, and ship work from one shared workspace - without the noise.</p>
      </div>
    </aside>

    <main class="auth-panel">
      <div class="auth-panel-inner">
        <header class="auth-panel-header">
          <p class="auth-panel-eyebrow">Welcome back</p>
          <h2 class="auth-panel-title">Sign in to your workspace</h2>
          <p class="auth-panel-desc">Enter your work email to continue to <?= sanitize(APP_NAME) ?>.</p>
        </header>

        <form
          class="auth-form"
          action="#"
          method="POST"
          onsubmit="event.preventDefault(); window.location.href='<?= route('user/dashboard') ?>';"
        >
          <div class="form-group auth-field">
            <label for="email">Email address</label>
            <div class="auth-input-wrap">
              <i class="fa-regular fa-envelope auth-input-icon" aria-hidden="true"></i>
              <input
                type="email"
                id="email"
                name="email"
                class="form-control auth-input"
                placeholder="name@company.com"
                value="chris@richmondtech.com"
                autocomplete="email"
                required
              >
            </div>
          </div>

          <div class="form-group auth-field">
            <div class="auth-label-row">
              <label for="password">Password</label>
              <a href="#" class="auth-forgot" onclick="event.preventDefault(); alert('Static UI Preview: Password Reset');">Forgot password?</a>
            </div>
            <div class="auth-input-wrap">
              <i class="fa-regular fa-lock auth-input-icon" aria-hidden="true"></i>
              <input
                type="password"
                id="password"
                name="password"
                class="form-control auth-input"
                placeholder="Enter your password"
                autocomplete="current-password"
                required
              >
              <button type="button" class="auth-toggle-pass" id="togglePassword" aria-label="Show password">
                <i class="fa-regular fa-eye" aria-hidden="true"></i>
              </button>
            </div>
          </div>

          <label class="auth-remember">
            <input type="checkbox" name="remember" checked>
            <span>Keep me signed in</span>
          </label>

          <button type="submit" class="btn btn-primary auth-submit">
            <span>Sign in</span>
            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
          </button>
        </form>

        <p class="auth-switch">
          Don't have an account?
          <a href="<?= route('register') ?>">Create account</a>
        </p>

        <div class="auth-previews">
          <span class="auth-previews-label">Quick preview</span>
          <div class="auth-previews-links">
            <a href="<?= route('user/dashboard') ?>" class="auth-preview-link">
              <i class="fa-regular fa-user" aria-hidden="true"></i>
              User
            </a>
            <a href="<?= route('admin/dashboard') ?>" class="auth-preview-link auth-preview-link--admin">
              <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
              Admin
            </a>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    (function () {
      var btn = document.getElementById('togglePassword');
      var input = document.getElementById('password');
      if (!btn || !input) return;
      btn.addEventListener('click', function () {
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        btn.innerHTML = show
          ? '<i class="fa-regular fa-eye-slash" aria-hidden="true"></i>'
          : '<i class="fa-regular fa-eye" aria-hidden="true"></i>';
      });
    })();
  </script>
</body>
</html>
