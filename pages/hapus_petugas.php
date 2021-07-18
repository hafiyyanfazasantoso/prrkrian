<?php
require 'functions.php';

$id = $_GET['id'];

$conn = koneksi();
mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas = $id") or die(mysqli_error($conn));

echo "<script>
        alert('Data berhasil dihapus!');
        document.location.href = 'petugas.php';
      </script>";

return mysqli_affected_rows($conn);
