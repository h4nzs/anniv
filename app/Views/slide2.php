<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anniversary - Slide 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <style>
    body {
    background-image: url('/assets/images/bg.jpg'); /* Menggunakan gambar sebagai background */
    background-size: cover; /* Agar gambar menutupi seluruh halaman */
    background-position: center; /* Gambar berada di tengah */
    background-repeat: no-repeat; /* Mencegah pengulangan gambar */
    background-attachment: fixed; /* Background tetap saat scroll */
    color: #333; /* Warna teks, opsional jika ingin lebih terlihat */
}

	p {
    color: white; /* Mengubah warna teks paragraf menjadi putih */
}


        .polaroid {
            position: relative;
            padding: 10px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            border: 1px solid #ddd;
            width: 250px; /* ukuran polaroid */
            margin-bottom: 20px;
            transition: transform 0.6s ease, box-shadow 0.6s ease;
        }

        .polaroid img {
            width: 100%;
            height: auto;
            transition: transform 1s ease, opacity 1s ease; /* Animasi untuk zoom dan fade */
        }

        .polaroid .caption {
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }

        /* Gulungan kertas yang tersembunyi */
        .hidden-image {
            opacity: 0;
            max-height: 0;
            transform: scale(0.8); /* Memperkecil gambar sebelum muncul */
            overflow: hidden;
            transition: max-height 1s ease, opacity 1s ease, transform 1s ease;
        }

        /* Saat gulungan terbuka */
        .show-image {
            max-height: 500px;
            opacity: 1;
            transform: scale(1); /* Zoom-in efek */
        }

        /* Tombol untuk membuka kenangan */
        .btn-show-image {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
            font-family: 'Courier New', Courier, monospace;
            margin-bottom: 20px;
        }

        .btn-show-image:hover {
            background-color: #e2e6ea;
        }

    </style>
</head>
<body>
    <div class="container text-center mt-5">
        <h2>gatau apa bingung judulnya</h2>
        <p class="typewriter-text">
            sebelumnya aku minta maaf yaaaa, di hari yang spesial ini aku malah lupa dan gabisa kasih apa apa selain ini sebagai perayaan kita hehee.
        </p>
        <p class="typewriter-text-delayed">
            sebenernya aku pengen ngerayain kaya kita ketemu atau main tapi apalah daya, semoga kita bisa terus bersama dan bahagia selamanya ya sayang. nih beberapa momen kita yang gabakal bisa dilupainn
        </p>

        <!-- Gambar kenangan dengan tombol untuk setiap gambar -->
        <div class="row justify-content-center">
            <div class="col-md-3">
                <!-- Tombol dan gambar untuk foto1 -->
                <div class="btn-show-image" data-target="foto1">Lihat Kenangan 1</div>
                <div id="foto1" class="hidden-image">
                    <div class="polaroid">
                        <img src="/assets/images/foto1.jpg" alt="Kenangan 1">
                        <div class="caption">jadi kangen kamu ama rambut panjang aku deh</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Tombol dan gambar untuk foto2 -->
                <div class="btn-show-image" data-target="foto2">Lihat Kenangan 2</div>
                <div id="foto2" class="hidden-image">
                    <div class="polaroid">
                        <img src="/assets/images/foto2.jpg" alt="Kenangan 2">
                        <div class="caption">kata temen aku foto ini bagus feel nya vintage</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Tombol dan gambar untuk foto3 -->
                <div class="btn-show-image" data-target="foto3">Lihat Kenangan 3</div>
                <div id="foto3" class="hidden-image">
                    <div class="polaroid">
                        <img src="/assets/images/foto3.jpg" alt="Kenangan 3">
                        <div class="caption">lagi liatin si cantik :3</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Tombol dan gambar untuk foto4 -->
                <div class="btn-show-image" data-target="foto4">Lihat Kenangan 4</div>
                <div id="foto4" class="hidden-image">
                    <div class="polaroid">
                        <img src="/assets/images/foto4.jpg" alt="Kenangan 4">
                        <div class="caption">ini kaya jadi model brand fashion :v</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <!-- Tombol dan gambar untuk foto5 -->
                <div class="btn-show-image" data-target="foto5">Lihat Kenangan 5</div>
                <div id="foto5" class="hidden-image">
                    <div class="polaroid">
                        <img src="/assets/images/foto5.jpg" alt="Kenangan 5">
                        <div class="caption">foto waktu kapan ini wkwkw</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Tombol dan gambar untuk foto6 -->
                <div class="btn-show-image" data-target="foto6">Lihat Kenangan 6</div>
                <div id="foto6" class="hidden-image">
                    <div class="polaroid">
                        <img src="/assets/images/foto6.jpg" alt="Kenangan 6">
                        <div class="caption">hayooo nangisss</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Tombol dan gambar untuk foto7 -->
                <div class="btn-show-image" data-target="foto7">Lihat Kenangan 7</div>
                <div id="foto7" class="hidden-image">
                    <div class="polaroid">
                        <img src="/assets/images/foto7.jpg" alt="Kenangan 7">
                        <div class="caption">gaseru muka kamunya ketutupan hp</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigasi slide -->
        <a href="/slide/3" class="btn btn-primary mt-4">Lanjut ke Slide 3</a>
        <a href="/slide/1" class="btn btn-secondary mt-4">Kembali</a>
    </div>

    <script>
        // JavaScript untuk interaksi gulungan kertas
        document.querySelectorAll('.btn-show-image').forEach(button => {
            button.addEventListener('click', function() {
                var targetId = this.getAttribute('data-target');
                var targetElement = document.getElementById(targetId);

                // Gunakan requestAnimationFrame untuk memaksa transisi
                requestAnimationFrame(() => {
                    // Toggle class untuk animasi gulungan
                    if (targetElement.classList.contains('show-image')) {
                        targetElement.classList.remove('show-image');
                        this.innerText = `Lihat Kenangan ${targetId.charAt(targetId.length - 1)}`;
                    } else {
                        targetElement.classList.add('show-image');
                        this.innerText = `Sembunyikan Kenangan ${targetId.charAt(targetId.length - 1)}`;
                    }
                });
            });
        });
    </script>
</body>
</html>
