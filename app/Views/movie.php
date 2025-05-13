<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Pilih Film Berdasarkan Mood</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      transition: background-color 0.3s ease;
    }

    body.light-mode {
      background: linear-gradient(to right, #f5f7fa, #c3cfe2);
      color: #000;
    }

    body.dark-mode {
      background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
      color: #fff;
    }

    .movie-card {
      margin: 15px;
      padding: 15px;
      border-radius: 12px;
      background-color: rgba(255, 255, 255, 0.9);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease, background-color 0.3s;
      backdrop-filter: blur(6px);
      animation: fadeIn 0.6s ease-in-out;
    }

    .dark-mode .movie-card {
      background-color: rgba(30, 30, 30, 0.8);
      color: #fff;
    }

    .movie-card:hover {
      transform: scale(1.03);
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(15px);}
      to {opacity: 1; transform: translateY(0);}
    }

    #loader {
      display: none;
    }

    h2 {
      font-weight: 600;
    }

    .form-select, .btn {
      border-radius: 8px;
    }

    #toggleMode {
      border-radius: 30px;
    }

    footer {
      margin-top: 50px;
      text-align: center;
      font-size: 0.9rem;
      opacity: 0.6;
    }
  </style>
</head>
<body class="light-mode">
<div class="container text-center py-5">
  <div class="d-flex justify-content-between align-items-center">
    <h2 class="flex-grow-1">🎬 Pilih Film Berdasarkan Mood Kamu</h2>
    <button id="toggleMode" class="btn btn-outline-light btn-sm">Dark Mode</button>
  </div>

  <form id="moodForm" class="my-5">
    <div class="row justify-content-center g-3">
      <div class="col-md-3">
        <select name="mood" id="mood" class="form-select shadow">
          <option value="">-- Pilih Mood --</option>
          <option value="bahagia">Bahagia</option>
          <option value="sedih">Sedih</option>
          <option value="romantis">Romantis</option>
          <option value="takut">Takut</option>
          <option value="semangat">Semangat</option>
        </select>
      </div>
      <div class="col-md-3">
        <select name="genre" id="genre" class="form-select shadow">
          <option value="">-- Tambah Genre (Opsional) --</option>
          <option value="16">Animasi</option>
          <option value="53">Thriller</option>
          <option value="12">Petualangan</option>
          <option value="878">Sci-Fi</option>
          <option value="10752">Perang</option>
        </select>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100 shadow">Cari Film</button>
      </div>
    </div>
  </form>

  <div id="loader" class="my-4">
    <div class="spinner-border text-light" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
    <p class="mt-2">Memuat film untuk kamu...</p>
  </div>

  <div id="result" class="row justify-content-center"></div>

  <footer class="text-center mt-5">
    <p class="text-muted small">This product uses the <a href="https://www.themoviedb.org/" target="_blank" rel="noopener">TMDb API</a> but is not endorsed or certified by TMDb.</p>
    <img src="/assets/images/tmdb.svg"
         alt="TMDb Logo" width="100" style="margin-top: 10px; opacity: 0.8;">
</footer>


  <footer class="text-muted mt-5">
    &copy; 2025 Mood Movie Picker · By Dehans 😎
  </footer>
</div>

<script>
  const form = document.getElementById('moodForm');
  const loader = document.getElementById('loader');
  const resultContainer = document.getElementById('result');
  const toggleBtn = document.getElementById('toggleMode');

  toggleBtn.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    document.body.classList.toggle('light-mode');
    toggleBtn.textContent = document.body.classList.contains('dark-mode') ? 'Light Mode' : 'Dark Mode';
  });

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    const mood = document.getElementById('mood').value;
    const genre = document.getElementById('genre').value;

    loader.style.display = 'block';
    resultContainer.innerHTML = '';

    fetch('/movies/search', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `mood=${mood}&genre=${genre}`
    })
    .then(res => res.json())
    .then(data => {
      loader.style.display = 'none';
      resultContainer.innerHTML = '';

      if (data.length === 0) {
        resultContainer.innerHTML = '<p class="text-muted">Tidak ada film ditemukan 😔</p>';
        return;
      }

      data.forEach(movie => {
        const overview = movie.overview ? movie.overview.slice(0, 100) + '...' : 'Deskripsi tidak tersedia.';
        const poster = movie.poster_path ? `https://image.tmdb.org/t/p/w200${movie.poster_path}` : 'https://via.placeholder.com/200x300?text=No+Image';

        resultContainer.innerHTML += `
          <div class="col-md-3 movie-card">
            <img src="${poster}" class="img-fluid mb-2 rounded" alt="${movie.title}">
            <h5>${movie.title}</h5>
            <p>${overview}</p>
          </div>`;
      });
    })
    .catch(() => {
      loader.style.display = 'none';
      resultContainer.innerHTML = '<p class="text-danger">Ups! Gagal memuat film.</p>';
    });
  });
</script>
</body>
</html>
