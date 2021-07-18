<?php
require '../vendor/autoload.php';
require 'functions.php';

$conn = koneksi();

if (isset($_POST['submit'])) {
  $err = "";
  $ekstensi = "";
  $success = "";

  $file_name = $_FILES['uploadfile']['name']; // nama file
  $file_data = $_FILES['uploadfile']['tmp_name'];

  if (empty($file_name)) {
    $err .= "<li>Silakan masukkan file yang anda inginkan.</li>";
  } else {
    $ekstensi = pathinfo($file_name)['extension'];
    $ekstensi_allowed = array("xls", "xlsx");

    if (!in_array($ekstensi, $ekstensi_allowed)) {
      $err .= "Silahkan masukkan file tipe xls atau xlsx. File yang kamu masukkan $file_name punya tipe $ekstensi.";
    }
    if (empty($err)) {
      $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
      $spreadsheet = $reader->load($file_data);
      $sheetData = $spreadsheet->getActiveSheet()->toArray();

      $jumlahData = 0;
      for ($i = 1; $i < count($sheetData); $i++) {
        $idpel = $sheetData[$i]['0'];
        $nama = $sheetData[$i]['1'];
        $alamat = $sheetData[$i]['2'];

        // echo "$idpel - $nama - $alamat <br>";
        $sql1 = "INSERT INTO pelanggan(idpel,nama,alamat) VALUES ('$idpel', '$nama', '$alamat')";

        mysqli_query($conn, $sql1);
        $jumlahData++;
      }
      if ($jumlahData > 0) {
        $success = "$jumlahData Data berhasil dimasukkan ke database!";
      }
    }
    if ($err) {
      echo "<script>
              alert('$err')
            </script>";
    }
    if ($success) {
      echo "<script>
              alert('$success')
            </script>";
      header("Location : assign.php");
    }
  }
}
