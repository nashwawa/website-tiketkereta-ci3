<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f6fa;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .login-card {
      display: flex;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      overflow: hidden;
      max-width: 850px;
      width: 100%;
    }
    .login-form {
      flex: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .login-form h2 {
      font-weight: 700;
      margin-bottom: 20px;
    }
    .form-control {
      border-radius: 6px;
      margin-bottom: 15px;
      height: 45px;
    }
    .btn-pastel {
      background-color: #8ecae6;
      border: none;
      border-radius: 25px;
      padding: 10px;
      font-weight: bold;
      color: #fff;
      width: 100%;
      transition: 0.3s;
    }
    .btn-pastel:hover {
      background-color: #219ebc;
    }
    .small-text {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <!-- Form login -->
    <div class="login-form">
      <h4 class="text-muted">Welcome back !!!</h4>
      <h2>Log In</h2>

      <!-- Notifikasi -->
      <?php if ($this->session->flashdata('notifikasi')): ?>
        <?= $this->session->flashdata('notifikasi'); ?>
      <?php endif; ?>

      <form method="post" action="<?= base_url('auth/login') ?>" id="loginForm" class="pt-3">
        <div class="form-group">
            <label class="form-label" for="name">Nama</label>
            <input class="form-control" type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn-pastel">LOGIN</button>
      </form>

      <!-- Link ke Register -->
      <div class="text-center mt-3 small-text">
        Belum punya akun? 
        <a href="<?= base_url('auth/register') ?>" class="text-decoration-none text-primary">Daftar disini</a>
      </div>
    </div>
  </div>
</body>
</html>
