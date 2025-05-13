<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body.dark-mode {
      background-color: #212529;
      color: white;
    }

    .dark-mode .card {
      background-color: #343a40;
      color: white;
    }

    .dark-mode .table {
      color: white;
    }

    .sidebar {
      height: 100vh;
      background: #343a40;
      color: white;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px 15px;
    }

    .sidebar a:hover {
      background: #495057;
    }

  .modal .form-label,
  .modal label {
    color: #333 !important;
    font-weight: 500;
  }

    .toast-container {
      position: fixed;
      top: 1rem;
      right: 1rem;
      z-index: 1055;
    }
    #userChart {
    max-width: 100%;
    max-height: 300px;
  }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <nav class="col-md-2 d-none d-md-block sidebar">
      <div class="p-3">
        <h4>Admin Panel</h4>
        <a href="<?= base_url('/admin') ?>">Dashboard</a>
        <a href="<?= base_url('/users') ?>">user list</a>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createUserModal">
  Tambah Pengguna
</button>
        <!-- Modal Tambah Pengguna -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('/store') ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="createUserModalLabel">Tambah Pengguna Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-select" required>
              <option value="user">User</option>
              <option value="admin">Admin</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
        <a href="<?= base_url('/dashboard') ?>">lihat aplikasi</a>
        <a href="<?= base_url('admin/posts') ?>">postingan</a>
        <a href="<?= base_url('/logout') ?>">Logout</a>
        <hr>
        <button class="btn btn-sm btn-outline-light" onclick="toggleDarkMode()">🌙 Dark Mode</button>
      </div>
    </nav>

    <!-- Main -->
    <main class="col-md-10 ms-sm-auto px-md-4 py-4">
      <h2 class="mb-4">Dashboard Admin</h2>

      <!-- Toast -->
      <?php if (session()->getFlashdata('success')): ?>
      <div class="toast-container">
        <div class="toast show bg-success text-white" role="alert">
          <div class="toast-body">
            <?= session()->getFlashdata('success') ?>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <!-- Chart -->
<div class="row mb-4">
  <div class="col-md-6">
    <div class="card p-3">
      <canvas id="userChart" width="300" height="300"></canvas>
    </div>
  </div>
</div>

      <!-- Search -->
      <form method="get" action="<?= base_url('/admin') ?>" class="mb-3">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Cari pengguna..." value="<?= $search ?? '' ?>">
          <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
      </form>

      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>Email</th>
              <th>Nama</th>
              <th>Role</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user): ?>
              <tr>
                <td><?= $user['id'] ?></td>
                <td><?= esc($user['username']) ?></td>
                <td><?= esc($user['email']) ?></td>
                <td><?= esc($user['name'] ?? '-') ?></td>
                <td><?= esc($user['role']) ?></td>
                <td>
                  <a href="<?= base_url('admin/edit/' . $user['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="<?= base_url('admin/reset-password/' . $user['id']) ?>" class="btn btn-info btn-sm">Reset</a>
                  <a href="<?= base_url('admin/delete/' . $user['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('userChart');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Admin', 'User Biasa'],
      datasets: [{
        label: 'Jumlah',
        data: [<?= $adminCount ?>, <?= $regularCount ?>],
        backgroundColor: ['#0d6efd', '#20c997'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
      }
    }
  });

  function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
  }
</script>

</body>
</html>
