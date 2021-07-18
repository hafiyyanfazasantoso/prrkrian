<?php

$conn = mysqli_connect('localhost', 'root', '', 'prrkrian');
$petugas = $_POST['pilihpetugas'];

foreach ($_POST['cek_idpel'] as $pelanggan) {
  // if (!$petugas) {
  $query = "INSERT INTO
              penugasan
            VALUES
            (NULL, '$pelanggan', '$petugas', 'belum tercapai', '', '', '')";

  $qry = mysqli_query($conn, $query) or die(mysqli_error($conn));
  // } else {
  //   echo "<script>
  //         alert('Data petugas tidak bisa diambil!');
  //         document.location.href = 'assign.php';
  //       </script>";
  // }
  if ($qry) {
    echo "<script>
          alert('Data pelanggan telah diinput!');
          document.location.href = 'monitor.php';
        </script>";
  }
}
