<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #ff758c, #ff7eb3);
      min-height: 100vh;
    }
    .register-box {
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
      max-width: 450px;
      margin: 100px auto;
    }
  </style>
</head>
<body>
  <div class="register-box">
    <h2 class="text-center mb-4">Daftar Akun</h2>

    <?php if (session()->getFlashdata('errors')): ?>
      <div style="color: red;">
        <?php foreach (session()->getFlashdata('errors') as $err): ?>
          <p><?= esc($err) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('/register') ?>" method="post">
      <?= csrf_field() ?>
      
      <div class="mb-3">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input type="text" name="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="username" class="form-label">Username (Nama Profil)</label>
        <input type="text" name="username" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="confirm_password" class="form-label">Ulangi Kata Sandi</label>
        <input type="password" name="confirm_password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-success w-100">Daftar</button>
    </form>

    <p class="mt-3 text-center">Sudah punya akun? <a href="<?= base_url('/login') ?>">Login di sini</a></p>
  </div>
</body>
</html>
