<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Postingan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      background: #f0f2f5;
      font-family: 'Arial', sans-serif;
    }

    .container-fluid {
      height: 100vh;
      display: flex;
      overflow: hidden;
    }

    .left-content {
      flex: 1;
      overflow-y: auto;
      padding: 20px;
    }

    .right-sidebar {
      width: 250px;
      background: #333;
      color: white;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: sticky;
      top: 0;
      height: 100vh;
    }

    .profile-pic {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background: #fff;
      color: black;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      font-size: 14px;
      text-align: center;
      overflow: hidden;
    }

    .username {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 15px;
      text-align: center;
    }

    .sidebar-links a {
      color: white;
      text-decoration: none;
      margin: 5px 0;
      display: block;
    }

    .sidebar-buttons {
      margin-top: 20px;
    }

    .sidebar-buttons a {
      display: block;
      width: 100%;
      margin-bottom: 10px;
      padding: 8px;
      border-radius: 8px;
      text-align: center;
      font-weight: bold;
    }

    .btn-post {
      background: white;
      color: black;
    }

    .btn-message {
      background: #c2e9fb;
      color: black;
      position: relative;
    }

    .btn-message::after {
      content: '';
      width: 8px;
      height: 8px;
      background: red;
      border-radius: 50%;
      position: absolute;
      top: 8px;
      right: 8px;
    }

    .logout {
      color: red;
      margin-top: 30px;
      font-weight: bold;
    }

    .post-card {
      background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
      border-radius: 20px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      position: relative;
    }

    .post-header {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .post-profile-pic {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: black;
      color: white;
      font-size: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 10px;
    }

    .post-username {
      font-weight: bold;
    }

    .post-time {
      font-size: 12px;
      color: #777;
    }

    .post-content {
      margin: 15px 0;
      font-size: 20px;
    }

    .post-actions {
      position: absolute;
      top: 10px;
      right: 10px;
    }

    .post-actions a,
    .post-actions form {
      display: inline-block;
      margin-left: 5px;
    }

    .comment-box {
      margin-top: 10px;
      display: flex;
    }

    .comment-box input {
      flex: 1;
      border-radius: 10px;
      border: 1px solid #ccc;
      padding: 8px;
      margin-right: 5px;
    }

    .comment-box button {
      border-radius: 20px;
      background: #7986cb;
      border: none;
      color: white;
      padding: 5px 15px;
    }

    .comment-list {
      margin-top: 10px;
      font-size: 14px;
    }

    .comment-list strong {
      margin-right: 5px;
    }

    .post-img {
  max-width: 100%;
  max-height: 300px;
  height: auto;
  margin-top: 10px;
  border-radius: 10px;
  display: block;
}
    .post-video {
      max-width: 100%;
      max-height: 300px;
      height: auto;
      margin-top: 10px;
      border-radius: 10px;
      display: block;
    }

  </style>

</head>

<body>

<div class="container-fluid">
  <!-- Right Sidebar -->
  <div class="right-sidebar">
    <div class="profile-pic">
      <?php if (!empty(session()->get('profile_pic'))): ?>
        <img src="<?= base_url('uploads/profile_pics/' . session()->get('profile_pic')) ?>" alt="Profile" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
      <?php else: ?>
        <div class="d-flex align-items-center justify-content-center w-100 h-100 bg-secondary text-white" style="border-radius: 50%; font-size: 2rem;">
          <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="username"><?= esc(session()->get('username')) ?></div>

    <div class="sidebar-links">
      <a href="<?= base_url('/profile') ?>">Profile</a>
      <a href="<?= base_url('/profile/edit') ?>">Edit Profile</a>
      <a href="<?= base_url('/') ?>">Dashboard</a>
    </div>

    <div class="sidebar-buttons">
      <a href="<?= base_url('/posts/create') ?>" class="btn-post">Buat Postingan+</a>
      
      <a href="<?= base_url('/chat') ?>" class="btn-message position-relative">
        Pesan
        <?php if (!empty($newMessages)): ?>
          <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
            <span class="visually-hidden">New messages</span>
          </span>
        <?php endif; ?>
      </a>
    </div>

    <div class="logout">
      <a href="<?= base_url('/logout') ?>" class="text-danger">Logout</a>
    </div>
  </div>

  <!-- Left Content (Postingan) -->
  <div class="left-content">
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php foreach ($posts as $post): ?>
      <div class="post-card">
        <div class="post-header">
          <div class="post-profile-pic" style="background: none; padding: 0;">
          <?php if (!empty($post['profile_pic'])): ?>
  <img src="<?= base_url('uploads/profile_pics/' . $post['profile_pic']) ?>" alt="Profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
<?php else: ?>
  <div class="d-flex align-items-center justify-content-center bg-secondary text-white" style="width: 50px; height: 50px; border-radius: 50%; font-size: 1.2rem;">
    <?= strtoupper(substr($post['username'], 0, 1)) ?>
  </div>
<?php endif; ?>
          </div>
          <div>
            <div class="post-username"><?= $post['is_anonymous'] ? 'Anonim' : esc($post['username']) ?></div>
            <div class="post-time"><?= date('d M Y H:i', strtotime($post['created_at'])) ?></div>
          </div>
        </div>

        <div class="post-content"><?= esc($post['content']) ?></div>

        <?php if (!empty($post['media_url'])): ?>
  <?php
    $ext = pathinfo($post['media_url'], PATHINFO_EXTENSION);
    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    $isVideo = in_array(strtolower($ext), ['mp4', 'webm', 'ogg']);
  ?>

  <?php if ($isImage): ?>
    <img src="<?= base_url('uploads/media/' . $post['media_url']) ?>" alt="Media" class="post-img">
  <?php elseif ($isVideo): ?>
    <video controls class="post-video">
      <source src="<?= base_url('uploads/media/' . $post['media_url']) ?>" type="video/<?= $ext ?>">
      Browser Anda tidak mendukung video.
    </video>
  <?php endif; ?>
<?php endif; ?>

        <?php if (session()->get('user_id') == $post['user_id']): ?>
          <div class="post-actions">
            <a href="<?= base_url('posts/edit/' . $post['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
            <form action="<?= base_url('posts/delete/' . $post['id']) ?>" method="post" style="display:inline;">
              <?= csrf_field() ?>
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus postingan ini?')">Hapus</button>
            </form>
          </div>
        <?php endif; ?>

        <!-- Komentar -->
        <div class="comment-list">
          <?php foreach ($post['comments'] as $comment): ?>
            <div><strong><?= esc($comment['username']) ?>:</strong> <?= esc($comment['comment']) ?></div>
          <?php endforeach; ?>
        </div>

        <?php if (session()->get('logged_in')): ?>
          <form action="<?= base_url('posts/comment/' . $post['id']) ?>" method="post" class="comment-box">
            <?= csrf_field() ?>
            <input type="text" name="comment" placeholder="Tulis komentar..." required>
            <button type="submit">Kirim</button>
          </form>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>

</body>
</html>
