<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "prrkrian");
$columns = array('idpel', 'nama', 'alamat', 'rupiah_prr', 'created');

$query = "SELECT * FROM pelanggan WHERE ";

if ($_POST["is_date_search"] == "yes") {
  $query .= 'created BETWEEN "' . $_POST["start_date"] . '" AND "' . $_POST["end_date"] . '" AND ';
}

if (isset($_POST["search"]["value"])) {
  $query .= '
  (idpel LIKE "%' . $_POST["search"]["value"] . '%" 
  OR nama LIKE "%' . $_POST["search"]["value"] . '%" 
  OR alamat LIKE "%' . $_POST["search"]["value"] . '%" 
  OR rupiah_prr LIKE "%' . $_POST["search"]["value"] . '%")
 ';
}

if (isset($_POST["order"])) {
  $query .= 'ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' 
 ';
} else {
  $query .= 'ORDER BY idpel DESC ';
}

$query1 = '';

if ($_POST["length"] != -1) {
  $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while ($row = mysqli_fetch_array($result)) {
  $sub_array = array();
  $sub_array[] = $row["idpel"];
  $sub_array[] = $row["nama"];
  $sub_array[] = $row["alamat"];
  $sub_array[] = $row["rupiah_prr"];
  $sub_array[] = $row["created"];
  $data[] = $sub_array;
}

function get_all_data($connect)
{
  $query = "SELECT * FROM pelanggan";
  $result = mysqli_query($connect, $query);
  return mysqli_num_rows($result);
}

$output = array(
  "draw"    => intval($_POST["draw"]),
  "recordsTotal"  =>  get_all_data($connect),
  "recordsFiltered" => $number_filter_row,
  "data"    => $data
);

echo json_encode($output);
