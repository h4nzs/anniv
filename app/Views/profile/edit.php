<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #74ebd5, #acb6e5);
      min-height: 100vh;
    }
    .edit-box {
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
      max-width: 600px;
      margin: 80px auto;
    }
  </style>
</head>
<body>
  <div class="edit-box">
    <h2 class="text-center mb-4">Edit Profil Saya</h2>

    <?php if (session()->getFlashdata('errors')): ?>
      <div style="color: red;">
        <?php foreach (session()->getFlashdata('errors') as $err): ?>
          <p><?= esc($err) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('/profile/update') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>

      <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="name" class="form-control" value="<?= esc($user['name']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" value="<?= esc($user['username']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label>
        <select name="gender" class="form-control">
          <option value="">Pilih</option>
          <option value="Laki-laki" <?= ($user['gender'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
          <option value="Perempuan" <?= ($user['gender'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Tanggal Lahir</label>
        <input type="date" name="birthdate" class="form-control" value="<?= esc($user['birthdate']) ?>">
      </div>

      <div class="mb-3 form-check">
        <input type="checkbox" name="visible_birthdate" class="form-check-input" id="visible_birthdate" value="1" <?= $user['visible_birthdate'] ? '' : 'checked' ?>>
        <label class="form-check-label" for="visible_birthdate">Sembunyikan tanggal lahir dari publik</label>
      </div>

      <div class="mb-3">
        <label class="form-label">Deskripsi Singkat (Max 200 kata)</label>
        <textarea name="description" class="form-control" maxlength="200"><?= esc($user['description']) ?></textarea>
      </div>

        <div class="mb-3">
            <label class="form-label">Foto Profil</label>
            <input type="file" name="profile_pic" class="form-control" accept="image/*">            <?php if (!empty($user['profile_pic'])): ?>
                <img src="<?= base_url('uploads/profile_pics/' . $user['profile_pic']) ?>" class="img-thumbnail mt-2" width="100">
            <?php else: ?>
                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:100px; height:100px; font-size: 2rem;">
                    <?= strtoupper(substr($user['username'], 0, 1)) ?>
                </div>
            <?php endif; ?>
      <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
    </form>

    <p class="mt-3 text-center"><a href="<?= base_url('/profile') ?>">Kembali ke Profil</a></p>
  </div>
</body>
</html>
