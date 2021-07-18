<?php
$conn = mysqli_connect("localhost", "root", "", "prrkrian");

$result = mysqli_query($conn, "SELECT * FROM ketercapaian");

$rows = array();
while ($r = mysqli_fetch_array($result)) {
  $row[0] = $r[0];
  $row[1] = $r[1];
  array_push($rows, $row);
}

print json_encode($rows, JSON_NUMERIC_CHECK);
mysqli_close($conn);
