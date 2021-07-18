<?php
require 'functions.php';

$conn = koneksi();
//tampung ke variabel pelanggan
$pelanggan = query("SELECT * FROM pelanggan");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Piutang Ragu-Ragu PLN Krian | Assign Tugas</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />

  <!-- daterange -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

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
          <a class="nav-link text-primary" style="padding-top:6px; font-size: 20px;">Monitor Progress PRR</a>
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
            <a href="../logout.php" class="dropdown-item">
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
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="card">
          <div class="row input-daterange ml-3 mt-4">
            <div class="col-3">
              <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Tanggal Awal" autocomplete="off">
            </div>
            <div class="col-3">
              <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Tanggal Akhir" autocomplete="off">
            </div>
            <div class="col">
              <input type="submit" class="btn btn-info" name="search" id="search" value="Cari">
            </div>
          </div>

          <div class="card-body">
            <table id="tabel_pelanggan" class="table table-borderless table-striped table-hover" style="font-size: larger;">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>ID Pelanggan</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Rupiah PRR</th>
                  <th>Waktu Data Diperbaharui</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($pelanggan as $p) : ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $p['idpel']; ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td><?= $p['alamat']; ?></td>
                    <td><?= $p['rupiah_prr']; ?></td>
                    <td><?= $p['updated']; ?></td>
                    <td>
                      <a href="detail_monitor.php?id=<?= $p['idpel']; ?>">
                        <button type="button" class="btn btn-primary">
                          Detail
                        </button>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
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

  <!-- Page specific script -->
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
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

  <!-- date range -->
  <script type="text/javascript" language="javascript">
    $(document).ready(function() {

      $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: "yyyy-mm-dd",
        autoclose: true
      });

      fetch_data('no');

      function fetch_data(is_date_search, start_date = '', end_date = '') {
        var dataTable = $('#tabel_pelanggan').DataTable({
          "processing": true,
          "serverSide": true,
          "order": [],
          "ajax": {
            url: "fetch.php",
            type: "POST",
            data: {
              is_date_search: is_date_search,
              start_date: start_date,
              end_date: end_date
            }
          }
        });
      }

      $('#search').click(function() {
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        if (start_date != '' && end_date != '') {
          $('#tabel_pelanggan').DataTable().destroy();
          fetch_data('yes', start_date, end_date);
        } else {
          alert("Both Date is Required");
        }
      });

    });
  </script>
</body>

</html>