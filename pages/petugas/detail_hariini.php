<?php
require '../functions.php';

$conn = koneksi();
$id = $_GET['id'];

// $p = query("SELECT * FROM pelanggan WHERE idpel = $id");
$p = query("SELECT * FROM penugasan JOIN pelanggan ON pelanggan.id_pelanggan = penugasan.id_pelanggan JOIN petugas ON petugas.id_petugas = penugasan.id_petugas WHERE idpel = $id");
if (!$p) {
  echo "<script>
          alert('Kok kosong?!');
          document.location.href = 'monitor.php';
        </script>";
}

if (isset($_POST['hapus'])) {
  hapus($_POST);
  echo "<script>
          alert('Data berhasil dihapus!');
          document.location.href = 'monitor.php';
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
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-primary navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="hariini.php" class="brand-link">
            <img src="../../dist/img/PLNLogo.png" alt="Logo PLN" class="brand-image mb-2">
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white mt-2">Detail Piutang Ragu-Ragu</a>
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
              <i class="fas fa-user-cog mr-2"></i> Profil Admin
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item text-white">
              <i class="fas fa-sign-out-alt mr-2"></i> Keluar
            </a>
          </div>
        </li>
      </ul>
    </nav>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-white">
      <!-- Main content -->
      <section class="content mt-5">
        <div class="row">
          <div class="col-8">
            <table class="table table-borderless">
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
                <td><?= $p['koordinat']; ?></td>
              </tr>
              <tr>
                <td>Nama Penerima</td>
                <td><?= $p['nama_penerima']; ?></td>
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
              <a href="update_hariini.php?id=<?= $p['idpel']; ?>" class="btn btn-primary">
                UPDATE
              </a>
            </div>
            <div class="row mt-4 d-flex justify-content-end mr-3">
              <button class="btn btn-danger" name="hapus">
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
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
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