<?php

$config = parse_ini_file('../../../private/dbconfig.ini');

$sql = "SELECT * FROM comment WHERE image_id = " . $image_id . ", ORDER BY, date_time asc";

$result = mysqli_query($conn, $sql);
$record_set = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($record_set, $row);
}
mysqli_free_result($result);

mysqli_close($conn);
echo json_encode($record_set);
