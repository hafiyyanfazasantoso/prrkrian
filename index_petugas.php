<?php
require 'pages/functions.php';

$conn = koneksi();
$pelanggan = query("SELECT * FROM pelanggan");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Piutang Ragu-Ragu PLN Krian | Petugas Site</title>
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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="index.php" class="brand-link">
          <img src="dist/img/PLNLogo.png" alt="Logo PLN" class="brand-image mb-2">
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white mt-1" style="font-size: 18px;">Aplikasi PRR Petugas</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt text-white"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user-circle text-white"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="background-color: #39F;">
          <span class="dropdown-item dropdown-header text-white">Menu</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item text-white">
            <i class="fas fa-user-cog mr-2"></i> Profil Petugas
          </a>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item text-white">
            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

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
    <section class="content mt-5" style="padding-top: 100px;">
      <div class="row mb-5 mt-5">
        <div class="col-2"></div>
        <div class="col-8">
          <a href="pages/petugas/hariini.php">
            <button class="btn btn-primary btn-lg btn-block">
              PRR Hari Ini
            </button>
          </a>
        </div>
        <div class="col-2"></div>
      </div>

      <div class="row mt-5">
        <div class="col-2"></div>
        <div class="col-8">
          <a href="pages/petugas/monitoring.php">
            <button class="btn btn-primary btn-lg btn-block">
              Monitoring Kinerja
            </button>
          </a>
        </div>
        <div class="col-2"></div>
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

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
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