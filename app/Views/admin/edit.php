<!DOCTYPE html>
<html>
<head>
  <title>Edit Postingan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2>Edit Postingan</h2>
  <form action="<?= base_url('admin/posts/update/' . $post['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    
    <div class="mb-3">
      <label for="content" class="form-label">Konten</label>
      <textarea name="content" class="form-control" rows="4"><?= esc($post['content']) ?></textarea>
    </div>

    <div class="mb-3">
      <label for="media" class="form-label">Ganti Media (opsional)</label>
      <input type="file" name="media" class="form-control">
      <?php if (!empty($post['media_url'])): ?>
        <p class="mt-2">Media saat ini:</p>
        <img src="<?= base_url('uploads/media/' . $post['media_url']) ?>" alt="Media" class="img-fluid" style="max-height:200px;">
      <?php endif; ?>
    </div>

    <div class="mb-3 form-check">
      <input type="checkbox" name="is_anonymous" class="form-check-input" id="anonCheck" <?= $post['is_anonymous'] ? 'checked' : '' ?>>
      <label class="form-check-label" for="anonCheck">Posting sebagai Anonim</label>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= base_url('/admin/posts') ?>" class="btn btn-secondary">Batal</a>
  </form>
</div>
</body>
</html>
