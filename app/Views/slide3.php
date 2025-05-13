<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anniversary - Slide 3 (Surat buatmu)</title>
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

.surat-container {
    margin-top: 50px;
    background-color: rgba(255, 255, 255, 0.2); /* Warna putih transparan */
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px); /* Efek kaca buram */
    border: 1px solid rgba(255, 255, 255, 0.3); /* Border semi-transparan */
}

.surat-container h2 {
    color: #d32f2f;
    margin-bottom: 20px;
}

.surat-paragraph {
    display: none;
    font-size: 18px;
    color: #333;
    margin-bottom: 15px;
    white-space: pre-wrap; /* Agar teks membuat garis baru */
}

.typewriter-text {
    border-right: 2px solid rgba(0, 0, 0, 0.75);
    animation: blink-caret 0.75s step-end infinite;
}

@keyframes blink-caret {
    from, to { border-color: transparent; }
    50% { border-color: rgba(0, 0, 0, 0.75); }
}

.reveal-btn {
    display: block;
    margin: 0 auto;
    padding: 10px 20px;
    background-color: #d32f2f;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.reveal-btn:hover {
    background-color: #c62828;
}

.reveal-btn:focus {
    outline: none;
}

    </style>
</head>
<body>
    <div class="container text-center">
        <div class="surat-container">
            <h2>Surat Cinta untuk Anniversary</h2>
            
            <!-- Bagian paragraf yang muncul saat tombol ditekan -->
            <div id="surat-part1" class="surat-paragraph"></div>
            <button id="reveal1" class="reveal-btn">Buka Surat Bagian 1</button>

            <div id="surat-part2" class="surat-paragraph"></div>
            <button id="reveal2" class="reveal-btn" style="display: none;">Buka Surat Bagian 2</button>

            <div id="surat-part3" class="surat-paragraph"></div>
            <button id="reveal3" class="reveal-btn" style="display: none;">Buka Surat Bagian 3</button>
        </div>

        <a href="/slide/4" class="btn btn-primary mt-4">Lanjut ke Slide 4</a>
        <a href="/slide/2" class="btn btn-secondary mt-4">Kembali</a>
    </div>

    <script>
        const paragraphs = [
            "Ara, hari ini adalah hari yang sangat spesial, dua tahun telah kita lalui bersama. Dalam suka dan duka, kamu selalu ada di sisiku. Tak ada yang bisa menggantikanmu di hatiku.",
            "Aku hanya ingin mengucapkan terima kasih untuk semua yang telah kamu lakukan. Terima kasih telah mencintaiku dengan tulus, selalu mendukungku dalam segala hal, dan menjadi kekuatan di hidupku.",
            "Semoga cinta kita terus tumbuh dan tak pernah pudar, walau jarak kadang memisahkan. Aku percaya, kita bisa melalui semua ini bersama. Aku mencintaimu lebih dari kata-kata yang bisa diungkapkan."
        ];

        function typewriterEffect(element, text, callback) {
            let i = 0;
            element.style.color = 'white';
            function typing() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(typing, 50); // Kecepatan mengetik
                } else {
                    element.classList.remove('typewriter-text');
                    if (callback) callback();
                }
            }
            element.classList.add('typewriter-text');
            typing();
        }

        document.getElementById('reveal1').addEventListener('click', function() {
            const part1 = document.getElementById('surat-part1');
            this.style.display = 'none';
            part1.style.display = 'block';
            typewriterEffect(part1, paragraphs[0], function() {
                document.getElementById('reveal2').style.display = 'block';
            });
        });

        document.getElementById('reveal2').addEventListener('click', function() {
            const part2 = document.getElementById('surat-part2');
            this.style.display = 'none';
            part2.style.display = 'block';
            typewriterEffect(part2, paragraphs[1], function() {
                document.getElementById('reveal3').style.display = 'block';
            });
        });

        document.getElementById('reveal3').addEventListener('click', function() {
            const part3 = document.getElementById('surat-part3');
            this.style.display = 'none';
            part3.style.display = 'block';
            typewriterEffect(part3, paragraphs[2]);
        });
    </script>
</body>
</html>
