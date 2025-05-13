<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anniversary - Slide 4</title>
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


        .pujian-box {
            display: none;
            font-size: 18px;
            color: #333;
            margin-top: 20px;
            white-space: pre-wrap; /* Membuat teks dapat garis baru secara otomatis */
            border-right: 2px solid rgba(0, 0, 0, 0.75);
            animation: blink-caret 0.75s step-end infinite;
        }

        .harapan-box {
            margin-top: 20px;
        }

        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: rgba(0, 0, 0, 0.75); }
        }

        .fade-out {
            animation: fadeOut 0.5s forwards;
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                visibility: hidden;
            }
        }
    </style>
</head>
<body>
    <div class="container text-center mt-5">
        <div class="container-box">
            <h2>Masukkan Harapanmu</h2>
            <div class="harapan-box">
                <textarea id="harapan-input" class="form-control" placeholder="Tulis harapanmu di sini"></textarea>
                <button id="submit-button" class="btn btn-primary mt-3">Oke</button>
            </div>
            <div id="pujian-text" class="pujian-box"></div>
        </div>

        <a href="/slide/5" class="btn btn-primary mt-4">Lanjut ke Slide 5</a>
        <a href="/slide/3" class="btn btn-secondary mt-4">Kembali</a>
    </div>

    <script>
        const pujianText = "Aminnn.. Semoga semuanya terkabul dan kita bisa terus bersama, semakin bahagia, dan saling percaya lebih kuat setiap harinya.";
        
        function typewriterEffect(element, text) {
            let i = 0;
            element.style.color = 'white';
            function typing() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(typing, 50); // Kecepatan mengetik
                } else {
                    element.classList.remove('pujian-box');
                }
            }
            element.classList.add('pujian-box');
            typing();
        }

        document.getElementById('submit-button').addEventListener('click', function() {
            const harapanInput = document.getElementById('harapan-input').value;
            const pujianElement = document.getElementById('pujian-text');
            const harapanBox = document.querySelector('.harapan-box');

            if (harapanInput) {
                harapanBox.classList.add('fade-out');
                pujianElement.style.display = 'block';
                typewriterEffect(pujianElement, pujianText);
            }
        });
    </script>
</body>
</html>
