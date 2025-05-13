<?php if ($post['is_anonymous'] && session('roles') === 'admin'): ?>
    <p><strong>Dipost oleh:</strong> <?= esc($post['username']) ?></p>
<?php elseif (!$post['is_anonymous']): ?>
    <p><strong>Dipost oleh:</strong> <?= esc($post['username']) ?></p>
<?php else: ?>
    <p><strong>Dipost oleh:</strong> Anonim</p>
<?php endif; ?>
