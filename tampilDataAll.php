<?php 
require_once('koneksi.php');

$query = "SELECT * FROM tabelhotel";

$res = mysqli_query($con, $query);

$result = array();

while ($row = mysqli_fetch_array($res)){
    $result[] = $row;
}

echo json_encode($result);

mysqli_close($con);

?>