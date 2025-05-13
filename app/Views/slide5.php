<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anniversary - Slide 5</title>
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


        .container-box {
    margin-top: 50px;
    padding: 30px;
    background-color: rgba(255, 255, 255, 0.2); /* Warna putih transparan */
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    backdrop-filter: blur(10px); /* Efek kaca buram */
    border: 1px solid rgba(255, 255, 255, 0.3); /* Border semi-transparan */
}


        .gift-box {
            display: inline-block;
            margin: 20px;
            transition: transform 0.5s ease, opacity 0.5s ease;
            opacity: 0;
            transform: scale(0);
        }

        .gift-box img {
            width: 200px;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .gift-box.show {
            opacity: 1;
            transform: scale(1);
        }

        .gift-text {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
            overflow: hidden;
            white-space: normal;
            word-break: break-word;
            border-right: 2px solid rgba(0, 0, 0, 0.75);
            display: inline-block;
            animation: typing 4s steps(40, end), blink-caret 0.75s step-end infinite;
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: black; }
        }

        .fade-in {
            opacity: 0;
            animation: fadeIn 2s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container text-center mt-5">
        <div class="container-box">
            <h2>Hadiah Untukmu</h2>
            <div class="gift-text fade-in">Aku ada hadiah buat kamu meskipun virtual hihi</div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div id="chocolate-box" class="gift-box">
                        <img src="/assets/images/coklat.jpg" alt="Coklat">
                        <div class="caption">Coklat</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="flower-box" class="gift-box">
                        <img src="/assets/images/bunga.jpg" alt="Bunga">
                        <div class="caption">Bunga</div>
                    </div>
                </div>
            </div>
            <a href="/slide/6" class="btn btn-primary mt-4">Lanjut ke Slide 6</a>
            <a href="/slide/4" class="btn btn-secondary mt-4">Kembali</a>
        </div>
    </div>

    <script>
        window.onload = function() {
            // Menampilkan hadiah coklat dan bunga dengan efek pop-up
            setTimeout(function() {
                document.getElementById('chocolate-box').classList.add('show');
            }, 2000); // Waktu tunda untuk coklat
            
            setTimeout(function() {
                document.getElementById('flower-box').classList.add('show');
            }, 3000); // Waktu tunda untuk bunga
        };
    </script>
</body>
</html>
