<?php
require 'pages/functions.php';

$conn = koneksi();
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Piutang Ragu-Ragu PLN Krian</title>
  <style>
    .chart-wrapper {
      width: 500px;
      height: 500px;
      margin: 0 auto;
    }
  </style>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color:#E0E0E0;"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-primary" style="padding-top:6px; font-size: 20px;">Dashboard</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user-circle"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Menu</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-user-cog mr-2"></i> Profil Admin
            </a>
            <div class="dropdown-divider"></div>
            <a href="logout.php" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i> Keluar
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4" style="background-color: #39F;">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link" style="margin-bottom: 30px;">
        <img src="dist/img/PLNLogo.png" alt="Logo PLN" class="brand-image" style="margin-top: 7px;">
        <span class="brand-text text-white" style="font-size:17px;">PT. PLN (PERSERO)</span><br>
        <span class="brand-text font-weight-light text-white" style="font-size:16px;">ULP Krian</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item" style="margin-bottom: 20px;">
              <a href="pages/assign.php" class="nav-link">
                <i class="nav-icon fas fa-clipboard-list text-white"></i>
                <p class="text-white">Assign Tugas</p>
              </a>
            </li>
            <li class="nav-item" style="margin-bottom: 20px;">
              <a href="pages/upload.php" class="nav-link">
                <i class="nav-icon fas fa-file-upload text-white"></i>
                <p class="text-white">Upload Data PRR</p>
              </a>
            </li>
            <li class="nav-item" style="margin-bottom: 20px;">
              <a href="pages/monitor.php" class="nav-link">
                <i class="nav-icon fas fa-desktop text-white"></i>
                <p class="text-white">Monitor Progress PRR</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/petugas.php" class="nav-link">
                <i class="nav-icon fas fa-toolbox text-white"></i>
                <p class="text-white">CRUD Petugas</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1></h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="input-daterange">
            <div class="col-2">
              <input type="text" name="start_date" id="start_date" class="form-control">
            </div>
            <div class="col-2">
              <input type="text" name="end_date" id="end_date" class="form-control">
            </div>
          </div>
          <div class="col-2">
            <input type="button" name="search" id="search" value="Cari">
          </div>
        </div>

        <div class="d-flex flex-column justify-content-center align-items-center">
          <div class="title text-center mb-3">
            <h3>Ketercapaian PRR PLN ULP Krian</h3>
          </div>
          <div class="chart-wrapper">
            <canvas id="pietercapaian"></canvas>
          </div>
        </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>by</b> <a href="https://instagram.com/hfazass">Hafiyyan FS</a>
      </div>
      <strong>&copy;</strong> 2021 from <strong><a href="https://youthms.web.app">Youthms.id</a></strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <script>
    let ctx = document.getElementById('pietercapaian').getContext('2d');
    let labels = ['Tercapai', 'Belum Tercapai'];
    let colorHex = ['#1492e6', '#faf056'];

    let pietercapaian = new Chart(ctx, {
      type: 'pie',
      data: {
        datasets: [{
          data: [
            <?php
            $jumlah_tercapai = mysqli_query($conn, "SELECT * FROM penugasan WHERE kondisi='tercapai'");
            echo mysqli_num_rows($jumlah_tercapai);
            ?>,
            <?php
            $jumlah_belum_tercapai = mysqli_query($conn, "SELECT * FROM penugasan WHERE kondisi='belum tercapai'");
            echo mysqli_num_rows($jumlah_belum_tercapai);
            ?>
          ],
          backgroundColor: colorHex
        }],
        labels: labels
      },
      options: {
        responsive: true,
        legend: {
          position: 'bottom'
        },
        plugins: {
          datalabels: {
            color: '#fff',
            anchor: 'end',
            align: 'start',
            offset: -10,
            borderWidth: 2,
            borderColor: '#fff',
            borderRadius: 25,
            backgroundColor: (context) => {
              return context.dataset.backgroundColor;
            },
            font: {
              weight: 'bold',
              size: '10'
            },
            formatter: (value) => {
              return value + '%';
            }
          }
        }
      }
    })
  </script>
</body>

</html>