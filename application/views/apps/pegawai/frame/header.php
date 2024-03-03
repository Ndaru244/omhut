<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('assets/images/systems/logo.png') ?>" type="image/png" sizes="16x16 32x32 48x48">
    <?php
    if($report != "Laporan"){
        echo '<title>Omhut Parkopi | '.$report.'</title>';
    }else {
        echo '<title>Omhut Parkopi | '.$report.' '.$user['role_pegawai'].': '.$user['username_pegawai'].'</title>';
    }
    ?>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>

        <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">

    <!-- DataTables Buttons -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    
    <!-- my own css -->
    <link rel="stylesheet" href="<?= base_url("assets/css/main.css") ?>">

</head>

<body style="font-family: 'Nunito', sans-serif;" class="bg-body-tertiary">
    <nav class="navbar sticky-top bg-white">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><b>Omhut Parkopi</b> | Pegawai</span>
        </div>
    </nav>