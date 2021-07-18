<?php
$conn = mysqli_connect('localhost', 'root', '', 'prrkrian');

$query = "SELECT 
            * 
          FROM 
            penugasan
          JOIN
            pelanggan 
          ON
            pelanggan.id_pelanggan = penugasan.id_pelanggan
          JOIN
            petugas
          ON
            petugas.id_petugas = penugasan.id_petugas";

// Query isi tabel pelanggan
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

if ($result) {
  echo 'data masyuk gaess';
  // echo $result['id_pelanggan'];
  return $result;
} else {
  echo 'data tyda masyuk gaes';
}

// // jika hasilnya 1 data
// if (mysqli_num_rows($result) == 1) {
//   echo $result;
//   return mysqli_fetch_assoc($result);
// }

// // ubah data kek dalam array
// // array numerik >> $baris = mysqli_fetch_row($result);
// // array asosiasi >> $baris = mysqli_fetch_assoc($result);
// $rows = [];
// while ($row = mysqli_fetch_assoc($result)) {
//   $rows[] = $row;
// }
// echo $rows[0];

// return $rows;
