<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('assets/images/systems/logo.png') ?>" type="image/png" sizes="16x16 32x32 48x48">
    <title>Omhut Parkopi | Self Service</title>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
        <!-- Toastr -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- my own css -->
    <link rel="stylesheet" href="<?= base_url("assets/css/main.css") ?>">
</head>

<body style="font-family: 'Nunito', sans-serif;" class="bg-body-tertiary">
    <nav class="navbar sticky-top" style="background-color: #fff;">
        <div class="container-fluid text-center">
            <span class="navbar-brand mx-auto mb-0 h1"><b>Omhut Parkopi</b><br>
                <span class="text-muted h6">Login Page</span>
            </span>

            <!-- <button class="d-flex btn btn-success">Meja : F01</button> -->
        </div>
    </nav>

    <main class="container">
        <div class="d-flex align-items-center justify-content-center" style="height: 70vh;">
            <div class="card border-0 rounded-4 shadow">
                <div class="card-body">
                    <form id="login-form">
                        <h5 class="card-title text-center"><b>Masuk</b></h5>
                        <p class="text-muted text-center small">Selamat Datang Kembali.</p>
                        <hr class="border border-secondary-subtle rounded-5 border-2 opacity-25">

                        <div class="form-floating ">
                            <input type="text" class="form-control bg-body-secondary border-0 rounded-3" id="username" autocomplete="off"
                                placeholder="Username">
                            <label for="username">Username</label>
                        </div>

                        <div class="input-group mt-2">
                            <div class="form-floating">
                                <input type="password" class="form-control bg-body-secondary border-0 rounded-start-3" id="password" autocomplete="off"
                                    placeholder="Password">
                                <label for="password">Password</label>
                            </div>
                            <button class="input-group-text btn btn-primary border-0 rounded-end-3" id="togglePasswordButton" onclick="togglePasswordVisibility()" type="button">
                                &nbsp;
                                <i id="eyeIcon" class="bi bi-eye-slash-fill" style="font-size: 20px;"></i>
                                &nbsp;
                            </button>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-lg btn-primary d-grid rounded-3 mt-4" id="login"><b>Masuk</b></button>
                        </div>
                        <script>
                            function togglePasswordVisibility() {
                                var passInput = document.getElementById('password');
                                var eyeIcon = document.getElementById('eyeIcon');

                                if (passInput.type === 'password') {
                                    passInput.type = 'text';
                                    eyeIcon.classList.remove("bi-eye-slash-fill");
                                    eyeIcon.classList.add("bi-eye-fill");
                                } else {
                                    passInput.type = 'password';
                                    eyeIcon.classList.remove("bi-eye-fill");
                                    eyeIcon.classList.add("bi-eye-slash-fill");
                                }
                            }
                        </script>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <br><br><br>
    <footer>
        <nav class="navbar fixed-bottom" style="background-color: #fff;">
            <div class="container-fluid">
                <div class="mx-auto p-2">
                    <span class="navbar-text">
                        Copyright &#169; <?= date("Y"); ?>. All Rights Reserved.
                    </span>
                </div>
            </div>
        </nav>
    </footer>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <script>
    toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-center mt-5",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
    </script>

    <script>
        $(document).ready(function() {
            $(document).on("click", "#login", function(e) {
                e.preventDefault();

                var username = $('#username').val().toLowerCase()
                var password = $('#password').val()
                var allowedCharacters = /^[a-zA-Z0-9\-.]+$/
                $.ajax({
                    url: '<?= base_url('auth/auth') ?>',
                    type: 'POST',
                    dataType: "json",
                    data: {
                        username: username,
                        password: password
                    },
                    success: function(data) {
                        if (data.responce === 'success') {
                            toastr["success"]('selamat datang', "Berhasil")

                            setTimeout(function() {
                                if(data.role === 'admin') {
                                    window.location.href = '<?= base_url('admin')?>';
                                } else if (data.role === 'kasir') {
                                    window.location.href = '<?= base_url('kasir')?>';
                                } else if (data.role === 'kitchen') {
                                    window.location.href = '<?= base_url('kitchen')?>';
                                } else if (data.role === 'barista') {
                                    window.location.href = '<?= base_url('barista')?>';
                                } else {
                                    window.location.href = '<?= base_url('auth/logout')?>';
                                }
                            },500)
                        } else {
                            toastr["error"](data.message, "Gagal")
                            // console.log(data)
                        }
                    }
                });
            })
        })
    </script>
</body>

</html>