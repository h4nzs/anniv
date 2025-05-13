<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anniversary - Slide 6</title>
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
	p {
    color: white; /* Mengubah warna teks paragraf menjadi putih */
}



        .paper-plane {
            position: absolute;
            bottom: 50px;
            left: 50px;
            width: 100px;
            cursor: pointer;
            transition: transform 0.5s ease-in-out;
        }

        @keyframes fly {
            0% {
                bottom: 50px;
                left: 50px;
                transform: rotate(0deg);
            }
            25% {
                bottom: 300px;
                left: 150px;
                transform: rotate(15deg);
            }
            50% {
                bottom: 500px;
                left: 300px;
                transform: rotate(-10deg);
            }
            75% {
                bottom: 700px;
                left: 600px;
                transform: rotate(20deg);
            }
            100% {
                bottom: 900px;
                left: 900px;
                opacity: 0;
            }
        }

        .fly-plane {
            animation: fly 3s ease-in-out forwards;
        }
    </style>
</head>
<body>
    <div class="container text-center mt-5">
        <div class="container-box">
            <h2>Jarak Tak Menghalangi Rasa sayang aku</h2>
            <p>Walaupun jarak memisahkan kita, percayalah aku akan selalu ada di hatimu. Mari kita terbangkan harapan ini, pencet gambar pesawat kertasnya biar doa kita didenger yang diatas :V </p>
        </div>
    </div>

    <!-- Gambar pesawat kertas -->
    <img src="/assets/images/pesawat-kertas.png" alt="Pesawat Kertas" id="paper-plane" class="paper-plane">

    <script>
        const paperPlane = document.getElementById('paper-plane');

        paperPlane.addEventListener('click', function() {
            paperPlane.classList.add('fly-plane');
        });
    </script>
</body>
</html>
