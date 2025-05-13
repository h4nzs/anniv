<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #c9d6ff, #e2e2e2);
      height: 100vh;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      animation: fadeIn 1s ease-in-out;
    }

    h1 {
      font-size: 3rem;
      margin-bottom: 30px;
      color: #333;
    }

    .btn {
      width: 200px;
      padding: 15px 0;
      font-size: 1.2rem;
      margin: 10px;
      border-radius: 30px;
      transition: all 0.3s ease-in-out;
    }

    .top-right {
            position: absolute;
            top: 20px;
            right: 30px;
        }

    .btn-anniv {
      background-color: #6c5ce7;
      color: #fff;
    }

    .btn-anniv:hover {
      background-color: #4834d4;
    }

    .btn-movies {
      background-color: #00cec9;
      color: #fff;
    }

    .btn-movies:hover {
      background-color: #00b894;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    footer {
      position: absolute;
      bottom: 15px;
      font-size: 0.85rem;
      color: #666;
    }
  </style>
</head>
<body>

  <h1>Selamat Datang 👋</h1>

  <div class="top-right">
  <?php if (session()->get('logged_in')): ?>
    <span class="me-2 fw-bold text-dark">👋 <?= esc(session()->get('username')) ?></span>
    <a href="<?= base_url('/logout') ?>" class="btn btn-outline-danger">Logout</a>
  <?php else: ?>
    <a href="<?= base_url('/login') ?>" class="btn btn-outline-primary me-2">Login</a>
    <a href="<?= base_url('/register') ?>" class="btn btn-primary">Register</a>
  <?php endif; ?>
</div>

  <div class="text-center">
    <a href="/anniv-key" class="btn btn-anniv">?</a>
    <a href="/movies" class="btn btn-movies">Pilih Film</a>
    <a href="/posts" class="btn btn-movies">Postingan Forum</a>
  </div>

  <footer>
    &copy; <?= date('Y') ?> Aplikasi by Dehans. All rights reserved.
  </footer>

</body>
</html>
