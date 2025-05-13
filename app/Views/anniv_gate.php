<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kunci Masuk Anniv</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0c3fc, #8ec5fc);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            text-align: center;
            max-width: 450px;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="card text-center">
    <h4 class="mb-4">Masukkan Kunci untuk Mengakses Halaman Ini.</h4>
    <p class="text-muted mb-3">Halaman ini hanya diperuntukan pada orang tertentu.<br>Jika kamu adalah orangnya maka seharusnya kamu memiliki kunci untuk melanjutkan.</p>

    <h4 class="mb-3">Masukkan Kata Kunci</h4>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="/anniv-key/check" method="post">
        <input type="password" name="keyword" class="form-control mb-3" placeholder="Masukkan kata kunci..." required>
        <button class="btn btn-primary">Masuk</button>
    </form>
</div>

</body>
</html>
