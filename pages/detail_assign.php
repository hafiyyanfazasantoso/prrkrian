<?php
require 'functions.php';

$id = $_GET['id'];

$p = query("SELECT * FROM pelanggan WHERE id_pelanggan = $id");

if (isset($_POST['hapus'])) {
  hapus($_POST['hapus']);
  echo "<script>
          alert('data berhasil dihapus!');
          document.location.href = 'index.php';
        </script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Piutang Ragu-Ragu PLN Krian</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
          <a class="nav-link text-primary" style="padding-top:6px; font-size: 20px;">Detail Piutang Ragu-Ragu</a>
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
            <a href="#" class="dropdown-item">
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
      <a href="../index_pegawai.php" class="brand-link" style="margin-bottom: 30px;">
        <img src="../dist/img/PLNLogo.png" alt="Logo PLN" class="brand-image" style="margin-top: 7px;">
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
              <a href="assign.php" class="nav-link">
                <i class="nav-icon fas fa-clipboard-list text-white"></i>
                <p class="text-white">Assign Tugas</p>
              </a>
            </li>
            <li class="nav-item" style="margin-bottom: 20px;">
              <a href="upload.php" class="nav-link">
                <i class="nav-icon fas fa-file-upload text-white"></i>
                <p class="text-white">Upload Data PRR</p>
              </a>
            </li>
            <li class="nav-item" style="margin-bottom: 20px;">
              <a href="monitor.php" class="nav-link">
                <i class="nav-icon fas fa-desktop text-white"></i>
                <p class="text-white">Monitor Progress PRR</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="petugas.php" class="nav-link">
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
    <div class="content-wrapper bg-white">
      <!-- Main content -->
      <section class="content mt-5">
        <div class="row">
          <div class="col-8">
            <table class="table table-borderless" style="font-size: larger;">
              <tr>
                <td>Nama Pelanggan</td>
                <td><?= $p['nama']; ?></td>
              </tr>
              <tr>
                <td>ID Pelanggan</td>
                <td><?= $p['idpel']; ?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td><?= $p['alamat']; ?></td>
              </tr>
              <tr>
                <td>Koordinat</td>
                <td><a href="#"><?= $p['koordinat']; ?></a></td>
              </tr>
              <tr>
                <td>Nomor Telpon</td>
                <td><?= $p['no_telp']; ?></td>
              </tr>
              <tr>
                <td>Rupiah PRR</td>
                <td><?= $p['rupiah_prr']; ?></td>
              </tr>
            </table>
          </div>
          <div class="col-4">
            <div class="row mb-4 d-flex justify-content-end mr-3">
              <a href="update_assign.php?id=<?= $p['id_pelanggan']; ?>" class="btn btn-primary btn-lg">
                UPDATE
              </a>
            </div>
            <div class="row mt-4 d-flex justify-content-end mr-3">
              <button class="btn btn-danger btn-lg" name="hapus">
                DELETE
              </button>
            </div>
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
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>