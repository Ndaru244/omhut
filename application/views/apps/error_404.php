<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?= base_url('assets/images/systems/logo.png') ?>" type="image/png" sizes="16x16 32x32 48x48">
  <title>Omhut Parkopi | 404 Page Not Found</title>

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

  <!-- Option 1: Include in HTML -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <!-- my own css  -->
  <link rel="stylesheet" href="<?= base_url("assets/css/main.css") ?>">
</head>

<body style="font-family: 'Nunito', sans-serif;" class="bg-body-tertiary">
  <nav class="navbar sticky-top" style="background-color: #fff;">
    <div class="container-fluid text-center">
      <span class="navbar-brand mx-auto mb-0 h1"><b>Omhut Parkopi</b><br>
        <span class="text-muted h6">Halaman 404</span>
      </span>
    </div>
  </nav>
  
  <main>
    <div class="d-flex align-items-center justify-content-center" style="height: 70vh;">
      <div class="card border-0 rounded-4 shadow-lg">
        <div class="card-body">
          <h3 class="card-title text-center"><b>404</b></h3>
          <p class="text-muted text-center small">Halaman tidak ditemukan.</p>
          <hr class="border border-secondary-subtle rounded-5 border-2 opacity-25">
          <img src="<?= base_url('assets/images/systems/logo.png') ?>" width="150px" alt="" class="img-fluid mx-auto d-block">
          <p class=""card-text>Halaman yang Anda minta tidak di temukan.</p>
          <div class="d-grid">
            <a class="btn btn-lg btn-primary d-grid rounded-3" onclick="window.history.back()"><b>Kembali</b></a>
        </div>
        </div>
      </div>
    </div>
  </main>
<br><br><br><br><br>
  <footer>
    <nav class="navbar fixed-bottom" style="background-color: #fff;">
      <div class="container-fluid">
        <div class="mx-auto p-2">
          <span class="navbar-text">
            Copyright &#169;
            <?= date("Y"); ?>. All Rights Reserved.
          </span>
        </div>
      </div>
    </nav>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>