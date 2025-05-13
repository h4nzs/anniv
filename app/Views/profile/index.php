<style>
body {
  background: linear-gradient(to right, #c9d6ff, #e2e2e2);
  font-family: 'Segoe UI', sans-serif;
  min-height: 100vh;
  margin: 0;
  padding: 2rem;
}

.profile-box {
  background: #ffffff;
  border-radius: 12px;
  padding: 2rem;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  text-align: center;
  margin-bottom: 2rem;
}

.profile-box img, .profile-box .initials {
  width: 120px;
  height: 120px;
  object-fit: cover;
  border-radius: 50%;
  margin-bottom: 1rem;
  background-color: #6c5ce7;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2.5rem;
}

.profile-box h3 {
  margin: 0;
  font-size: 1.8rem;
  color: #333;
}

.profile-box p {
  color: #666;
  margin: 0.5rem 0 1rem 0;
}

.profile-box ul {
  list-style: none;
  padding: 0;
  color: #555;
  text-align: left;
  margin-top: 1rem;
}

.profile-box ul li {
  margin-bottom: 0.5rem;
}

.btn-primary {
  background-color: #6c5ce7;
  border: none;
}

.btn-primary:hover {
  background-color: #4834d4;
}

.post-card {
  background: #fff;
  border-radius: 10px;
  padding: 1.5rem;
  margin-bottom: 1.5rem;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.post-img {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
  margin-top: 1rem;
}

h2, h4 {
  color: #333;
  text-align: center;
  margin-bottom: 1.5rem;
}

form input, form textarea, form select {
  margin-bottom: 1rem;
}

footer {
  margin-top: 2rem;
  text-align: center;
  color: #777;
  font-size: 0.85rem;
}
</style>

<h2>Profil Saya</h2>

<div class="profile-box p-4 mb-4 bg-white rounded shadow">
  <?php if (!empty($user['profile_pic'])): ?>
    <img src="<?= base_url('uploads/profile_pics/' . $user['profile_pic']) ?>" class="rounded-circle" width="100">
  <?php else: ?>
    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:100px; height:100px; font-size: 2rem;">
      <?= strtoupper(substr($user['username'], 0, 1)) ?>
    </div>
  <?php endif; ?>

  <h3><?= esc($user['name']) ?> (<?= esc($user['username']) ?>)</h3>
  <?php if ($user['description']): ?>
    <p><?= esc($user['description']) ?></p>
  <?php endif; ?>

  <ul>
    <?php if ($user['gender']): ?>
      <li>Jenis Kelamin: <?= esc($user['gender']) ?></li>
    <?php endif; ?>

    <?php if (!$user['visible_birthdate'] && $user['birthdate']): ?>
      <li>Tanggal Lahir: <?= date('d M Y', strtotime($user['birthdate'])) ?></li>
    <?php endif; ?>
  </ul>

  <a href="<?= base_url('/profile/edit') ?>" class="btn btn-sm btn-primary">Edit Profil</a>
</div>

<h4>Postingan Saya</h4>
<?php foreach ($posts as $post): ?>
  <div class="post-card">
    <p><?= esc($post['content']) ?></p>
    <?php if (!empty($post['media_url'])): ?>
      <img src="<?= base_url('uploads/media/' . $post['media_url']) ?>" class="post-img">
    <?php endif; ?>
    <p class="text-muted"><small><?= date('d M Y H:i', strtotime($post['created_at'])) ?></small></p>
  </div>
<?php endforeach; ?>
