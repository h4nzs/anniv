<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Buat Postingan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f0f2f5;
    }
    .form-container {
      max-width: 600px;
      margin: 40px auto;
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    textarea {
      resize: vertical;
    }
    #preview-container {
      margin-top: 1rem;
    }
    #media-preview, #video-preview {
      max-width: 100%;
      max-height: 300px;
      border-radius: 6px;
      display: none;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="form-container">
    <h3 class="mb-4">📝 Buat Postingan Baru</h3>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('/posts/store') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>

      <div class="mb-3">
        <label for="content" class="form-label">Isi Postingan</label>
        <textarea name="content" id="content" class="form-control" rows="5" placeholder="Tulis sesuatu..." required></textarea>
      </div>

      <div class="mb-3 form-check">
        <input type="checkbox" name="is_anonymous" class="form-check-input" id="anonCheck">
        <label for="anonCheck" class="form-check-label">Posting sebagai anonim</label>
      </div>

      <div class="mb-3">
        <label for="media" class="form-label">Upload Gambar / Video</label>
        <input type="file" name="media" class="form-control" id="media" accept="image/*,video/*" onchange="previewMedia(event)">
      </div>

      <!-- Preview -->
      <div id="preview-container">
        <img id="media-preview" src="#" alt="Preview Gambar">
        <video id="video-preview" controls></video>
      </div>

      <div class="mt-4 d-grid">
        <button type="submit" class="btn btn-primary">Kirim Postingan</button>
      </div>
    </form>
  </div>
</div>

<script>
function previewMedia(event) {
  const file = event.target.files[0];
  const imagePreview = document.getElementById('media-preview');
  const videoPreview = document.getElementById('video-preview');

  if (!file) {
    imagePreview.style.display = 'none';
    videoPreview.style.display = 'none';
    return;
  }

  const fileURL = URL.createObjectURL(file);
  const isImage = file.type.startsWith('image/');
  const isVideo = file.type.startsWith('video/');

  if (isImage) {
    imagePreview.src = fileURL;
    imagePreview.style.display = 'block';
    videoPreview.style.display = 'none';
  } else if (isVideo) {
    videoPreview.src = fileURL;
    videoPreview.style.display = 'block';
    imagePreview.style.display = 'none';
  }
}
</script>

</body>
</html>
