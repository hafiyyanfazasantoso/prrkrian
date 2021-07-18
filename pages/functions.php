<?php
function koneksi()
{
  //Koneksi ke DB & pilih database
  return mysqli_connect('localhost', 'root', '', 'prrkrian');
}

function query($query)
{
  $conn = koneksi();

  // Query isi tabel pelanggan
  $result = mysqli_query($conn, $query);

  // jika hasilnya 1 data
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  // ubah data kek dalam array
  // array numerik >> $baris = mysqli_fetch_row($result);
  // array asosiasi >> $baris = mysqli_fetch_assoc($result);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function tambah($data)
{
  $conn = koneksi();

  $nama = htmlspecialchars($data['nama']);
  $idpel = htmlspecialchars($data['idpel']);
  $alamat = htmlspecialchars($data['alamat']);
  $id_petugas = htmlspecialchars($data['id_petugas']);
  $ket = htmlspecialchars($data['ket']);

  $query = "INSERT INTO
                pelanggan
              VALUES
              (NULL, '$idpel', '$nama', '$alamat', '$id_petugas', '$ket', '', '', '', '');
            ";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function tambah_petugas($data)
{
  $conn = koneksi();

  $nama = htmlspecialchars($data['nama']);
  if ($data['foto']) {
    $foto = $data['foto'];
  }
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  // jika username password kosong
  if (empty($nama)) {
    echo "<script>
            alert('Nama tidak boleh kosong!');
            document.location.href = 'add_petugas.php';
          </script>";
    return false;
  }
  if (empty($password1) || empty($password2)) {
    echo "<script>
            alert('Password tidak boleh kosong!');
            document.location.href = 'add_petugas.php';
          </script>";
    return false;
  }

  // jika nama sudah ada
  if (query("SELECT * FROM users WHERE nama = '$nama'")) {
    echo "<script>
            alert('Nama sudah terdaftar!');
            document.location.href = 'add_petugas.php';
          </script>";
    return false;
  }

  // jika konfirmasi password tidak sesuai
  if ($password1 !== $password2) {
    echo "<script>
            alert('konfirmasi password tidak sesuai!');
            document.location.href = 'add_petugas.php';
          </script>";
    return false;
  }

  // jika password <5 digit 
  if (strlen($password1) < 5) {
    echo "<script>
              alert('password terlalu pendek!');
              document.location.href = 'add_petugas.php';
          </script>";
    return false;
  }
  // jika nama & password sudah sesuai 
  // enksripsi password 
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);

  $query = "INSERT INTO
                petugas
              VALUES
              (NULL, '$nama', '$password1', '$foto', '1');
            ";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}


function ubah($data)
{
  $conn = koneksi();

  $id_pelanggan = $_GET['id'];
  $nama = htmlspecialchars($data['nama']);
  $idpel = htmlspecialchars($data['idpel']);
  $alamat = htmlspecialchars($data['alamat']);
  $koordinat = htmlspecialchars($data['koordinat']);
  $no_telp = htmlspecialchars($data['no_telp']);
  $rupiah_prr = htmlspecialchars($data['rupiah_prr']);


  $query = "UPDATE pelanggan SET
              nama = '$nama',
              idpel = '$idpel',
              alamat = '$alamat',
              koordinat = '$koordinat',
              no_telp = '$no_telp',
              rupiah_prr = '$rupiah_prr'
              WHERE id_pelanggan = '$id_pelanggan'";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function ubah_petugas($data)
{
  $conn = koneksi();

  $id_petugas = $_GET['id'];
  $nama_petugas = htmlspecialchars($data['nama_petugas']);
  $password1 = htmlspecialchars($data['password1']);
  $password2 = htmlspecialchars($data['password2']);
  if ($data['foto']) {
    $foto = $data['foto'];
  }

  if ($password1 == $password2) {
    $query = "UPDATE petugas SET
              nama_petugas = '$nama_petugas',
              password_petugas = '$password1',
              foto_petugas = '$foto'
              WHERE id_petugas = '$id_petugas'";
  }

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function ubah_penugasan($data)
{
  // echo 'sudah masuk fungsi (y)';
  $conn = koneksi();

  $id_pelanggan = $data['id_pelanggan'];
  $nama = htmlspecialchars($data['nama']);
  $idpel = htmlspecialchars($data['idpel']);
  $alamat = htmlspecialchars($data['alamat']);
  $koordinat = htmlspecialchars($data['koordinat']);
  $nama_penerima = htmlspecialchars($data['nama_penerima']);
  $no_telp = htmlspecialchars($data['no_telp']);
  $rupiah_prr = htmlspecialchars($data['rupiah_prr']);

  $query1 = "UPDATE pelanggan SET
              nama = '$nama',
              idpel = '$idpel',
              alamat = '$alamat',
              koordinat = '$koordinat',
              no_telp = $no_telp,
              rupiah_prr = $rupiah_prr
              WHERE id_pelanggan = '$id_pelanggan'";
  mysqli_query($conn, $query1) or die(mysqli_error($conn));

  $query2 = "UPDATE penugasan SET
              nama_penerima = '$nama_penerima'
              WHERE id_pelanggan = '$id_pelanggan'";

  // if ($query1 && $query2) {
  //   echo 'masuk';
  // } else {
  //   echo 'kok kosong';
  // }

  mysqli_query($conn, $query2) or die(mysqli_error($conn));

  if ($query1) {
    if ($query2) {
      return true;
    }
  } else {
    return false;
  }
}

function hapus($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM pelanggan WHERE idpel = $id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function hapus_petugas($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM petugas WHERE nip = $id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function login($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  // cek dulu username
  if ($user = query("SELECT * FROM users WHERE username = '$username'")) {
    //cek password
    if (password_verify($password, $user['password'])) {

      //set session
      $_SESSION['login'] = true;

      header("Location: index_pegawai.php");
      exit;
    }
  } else if ($user = query("SELECT * FROM petugas WHERE nama_petugas = '$username'")) {
    if ($password == $user['password_petugas']) {

      //set session
      $_SESSION['login'] = true;

      header("Location: index_petugas.php");
      exit;
    }
  }
  return [
    'error' => true,
    'pesan' => 'Username / Password Salah...'
  ];
}

function cari($keyword)
{
  $query = "SELECT * FROM pelanggan
WHERE
nama LIKE '%$keyword%' OR
idpel LIKE '%$keyword%' OR
alamat LIKE '%$keyword%'
";
  return query($query);
}

function registrasi($data)
{
  $conn = koneksi();

  $username = htmlspecialchars(strtolower($data['username']));
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  // jika username password kosong
  if (empty($username) || empty($password1) || empty($password2)) {
    echo "<script>
  alert('username / password tidak boleh kosong!');
  document.location.href = 'registrasi.php';
</script>";
    return false;
  }

  // jika username sudah ada
  if (query("SELECT * FROM users WHERE username = '$username'")) {
    echo "<script>
  alert('username sudah terdaftar!');
  document.location.href = 'registrasi.php';
</script>";
    return false;
  }

  // jika konfirmasi password tidak sesuai
  if ($password1 !== $password2) {
    echo "<script>
  alert('konfirmasi password tidak sesuai!');
  document.location.href = 'registrasi.php';
</script>";
    return false;
  }

  // jika password <5 digit 
  if (strlen($password1) < 5) {
    echo "<script>
              alert('password terlalu pendek!');
              document.location.href = 'registrasi.php';
          </script>";
    return false;
  }
  // jika username & password sudah sesuai 
  // enksripsi password 
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);
  // insert ke tabel user 
  $query = "INSERT INTO users
              VALUES
            (NULL, '$username', '$password_baru')
            ";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
