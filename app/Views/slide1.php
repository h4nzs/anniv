<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anniversary - Slide 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <style>
    body {
        background-image: url('/assets/images/bg.jpg'); /* Menggunakan gambar sebagai background */
        background-size: cover; /* Agar gambar menutupi seluruh halaman */
        background-position: center; /* Gambar berada di tengah */
        background-repeat: no-repeat; /* Mencegah pengulangan gambar */
        background-attachment: fixed; /* Background tetap saat scroll */
        color: #333; /* Warna teks */
    }

    p {
        color: white; /* Mengubah warna teks paragraf menjadi putih */
    }

    /* Animasi gerakan kupu-kupu dari kanan ke kiri */
    .butterfly-right-to-left {
        position: absolute;
        width: 100px;
        animation: flyButterflyRightToLeft 10s infinite linear;
        z-index: 1; /* Menyatakan kupu-kupu di belakang teks */
    }

    /* Animasi gerakan kupu-kupu dari kiri ke kanan */
    .butterfly-left-to-right {
        position: absolute;
        width: 100px;
        animation: flyButterflyLeftToRight 10s infinite linear;
        z-index: 1; /* Menyatakan kupu-kupu di belakang teks */
    }

    /* Keyframes untuk animasi kupu-kupu dari kanan ke kiri */
    @keyframes flyButterflyRightToLeft {
        0% {
            right: -100px;
            top: 50px;
            transform: rotate(0deg);
        }
        25% {
            right: 25%;
            top: 40%;
            transform: rotate(15deg);
        }
        50% {
            right: 50%;
            top: 30%;
            transform: rotate(-10deg);
        }
        75% {
            right: 75%;
            top: 20%;
            transform: rotate(5deg);
        }
        100% {
            right: 100%;
            top: 10%;
            opacity: 0;
        }
    }

    /* Keyframes untuk animasi kupu-kupu dari kiri ke kanan */
    @keyframes flyButterflyLeftToRight {
        0% {
            left: -100px;
            top: 50px;
            transform: rotate(0deg);
        }
        25% {
            left: 25%;
            top: 40%;
            transform: rotate(-15deg);
        }
        50% {
            left: 50%;
            top: 30%;
            transform: rotate(10deg);
        }
        75% {
            left: 75%;
            top: 20%;
            transform: rotate(-5deg);
        }
        100% {
            left: 100%;
            top: 10%;
            opacity: 0;
        }
    }

    /* Typewriter effect styling */
    #paragraf1, #paragraf2 {
        font-family: 'Courier New', Courier, monospace;
        border-right: 2px solid;
        white-space: normal; /* Mengubah agar teks bisa menjuntai */
        overflow: hidden;
        display: inline-block;
        animation: none; /* Animasi diinisialisasi lewat JS */
        position: relative;
        z-index: 10; /* Menyatakan teks di atas kupu-kupu */
    }

    /* CSS untuk menjaga tombol tetap di tempat */
    .content-wrapper {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 100vh; /* Minimal tinggi 100% dari viewport */
        position: relative;
        z-index: 10; /* Menjaga elemen teks di atas kupu-kupu */
    }

    .btn-next {
        margin-bottom: 2rem; /* Beri jarak di bawah tombol */
    }
    </style>
</head>
<body>

    <!-- Kupu-kupu berterbangan dengan animasi dari kanan ke kiri -->
    <img src="/assets/images/butterfly.png" alt="Kupu-kupu" class="butterfly-right-to-left" style="top: 50px; right: 100px;">
    <img src="/assets/images/butterfly.png" alt="Kupu-kupu" class="butterfly-right-to-left" style="top: 200px; right: 300px;">
    <img src="/assets/images/butterfly.png" alt="Kupu-kupu" class="butterfly-right-to-left" style="top: 150px; right: 50px;">

    <!-- Kupu-kupu berterbangan dengan animasi dari kiri ke kanan -->
    <img src="/assets/images/butterfly.png" alt="Kupu-kupu" class="butterfly-left-to-right" style="top: 100px; left: 100px;">
    <img src="/assets/images/butterfly.png" alt="Kupu-kupu" class="butterfly-left-to-right" style="top: 250px; left: 200px;">
    <img src="/assets/images/butterfly.png" alt="Kupu-kupu" class="butterfly-left-to-right" style="top: 300px; left: 50px;">

    <div class="container text-center mt-5 content-wrapper">
        <div>
            <h1>Selamat Hari Anniversary ke-2!</h1>

            <!-- Paragraf yang akan mendapatkan animasi mesin ketik -->
            <p id="paragraf1"></p>
            <p id="paragraf2" class="mt-4"></p>
        </div>

        <!-- Tombol Lanjut ke Slide 2 -->
        <div>
            <a href="/slide/2" class="btn btn-primary mt-4 btn-next">Lanjut ke Slide 2</a>
        </div>
    </div>

    <script>
        // Fungsi untuk animasi typewriter
        function typeWriterEffect(elementId, text, speed, delay = 0) {
            var element = document.getElementById(elementId);
            var i = 0;
            element.style.width = 'auto'; // Set auto agar teks bisa berkembang
            setTimeout(function() {
                var typeWriterInterval = setInterval(function() {
                    if (i < text.length) {
                        element.innerHTML += text.charAt(i);
                        i++;
                    } else {
                        clearInterval(typeWriterInterval);  // Hentikan interval setelah teks selesai
                    }
                }, speed);
            }, delay);
        }

        // Teks paragraf
        var textParagraf1 = "Ara, dua tahun bersamamu adalah perjalanan yang penuh warna. Terima kasih telah menjadi bagian terindah dalam hidupku. Setiap momen bersamamu adalah anugerah yang tak ternilai. Aku bersyukur atas setiap detik yang kita lalui, setiap tawa, setiap air mata, dan setiap mimpi yang kita rajut bersama. Kamu adalah sosok yang luar biasa, hatimu yang penuh kasih, senyummu yang menenangkan, dan kehadiranmu yang selalu membuatku merasa istimewa.";
        
        var textParagraf2 = "Di hari yang istimewa ini, aku ingin mengungkapkan rasa syukurku yang tak terhingga. Kamu adalah hadiah terindah yang pernah aku terima. Dua tahun ini adalah bukti betapa sempurnanya kita saat bersama. Mari kita jadikan anniversary ke-2 ini sebagai awal dari perjalanan yang lebih indah. Semoga cinta kita terus tumbuh dan bersemi, selamanya. Selamat anniversary, Ara. Aku mencintaimu lebih dari kata-kata.";

        // Inisialisasi efek typewriter untuk paragraf 1 dan 2
        typeWriterEffect('paragraf1', textParagraf1, 50);
        typeWriterEffect('paragraf2', textParagraf2, 50, textParagraf1.length * 50); // Paragraf 2 muncul setelah paragraf 1 selesai
    </script>
</body>
</html>
