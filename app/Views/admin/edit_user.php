<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
  <div class="card shadow-sm p-4">
    <h3 class="mb-4">Edit Pengguna</h3>
    <form action="<?= base_url('admin/update/' . $user['id']) ?>" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" value="<?= esc($user['username']) ?>" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" value="<?= esc($user['email']) ?>" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input type="text" name="name" id="name" value="<?= esc($user['name']) ?>" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select name="role" id="role" class="form-select">
          <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
          <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      <a href="<?= base_url('admin') ?>" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<?= $this->endSection() ?>

</body>
</html>
