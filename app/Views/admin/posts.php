<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Postingan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f0f2f5;
    }
    .admin-name {
  color: #d60000;
  font-weight: bold;
}

    .post-card {
      background: white;
      border-radius: 8px;
      padding: 1.5rem;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-bottom: 1.5rem;
    }
    .comment {
      border-top: 1px solid #eee;
      padding-top: 0.5rem;
      margin-top: 1rem;
    }
  </style>
</head>
<body>
<div class="container mt-4">
  <h2 class="mb-4">Panel Admin - Semua Postingan</h2>
  <a href="<?= base_url('admin/posts/create') ?>" class="btn btn-success">+ Buat Postingan</a>


  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <?php foreach ($posts as $post): ?>
    <div class="post-card">
      <div class="d-flex justify-content-between">
        <p><strong>Post ID:</strong> <?= $post['id'] ?></p>
        <form action="<?= base_url('admin/posts/delete/' . $post['id']) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus postingan ini?')">
          <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
          <?php if (session()->get('user_id') == $post['user_id']): ?>
  <div class="mt-2">
    <a href="<?= base_url('admin/posts/edit/' . $post['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
    <?= csrf_field() ?>
  </div>
          <?php endif; ?>    
    </form>
      </div>

      <p><?= esc($post['content']) ?></p>

      <?php if (!empty($post['media_url'])): ?>
        <img src="<?= base_url('uploads/media/' . $post['media_url']) ?>" alt="Gambar Postingan" class="img-fluid rounded mb-3">
      <?php endif; ?>

      <p><strong>Dibuat oleh:</strong>
        <?= $post['is_anonymous'] ? '[Anonim, user #' . $post['username'] . ']' : esc($post['username']) ?>
      </p>

      <p class="text-muted"><small>Dibuat pada: <?= date('d M Y H:i', strtotime($post['created_at'])) ?></small></p>
        
      <!-- Komentar -->
      <div class="comment">
        <h6>Komentar:</h6>

        <?php if (!empty($post['comments'])): ?>
          <?php foreach ($post['comments'] as $comment): ?>
            <p><strong><?= esc($comment['username'] ?? 'User') ?>:</strong> <?= esc($comment['comment']) ?></p>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-muted">Belum ada komentar.</p>
        <?php endif; ?>

        <!-- Form komentar admin -->
        <form action="<?= base_url('admin/posts/comment/' . $post['id']) ?>" method="post" class="mt-2">
          <div class="mb-2">
            <textarea name="comment" class="form-control" placeholder="Tulis komentar sebagai admin..." required></textarea>
          </div>
          <button type="submit" class="btn btn-sm btn-outline-primary">Kirim</button>
        </form>
      </div>
    </div>
  <?php endforeach; ?>
</div>
</body>
</html>
