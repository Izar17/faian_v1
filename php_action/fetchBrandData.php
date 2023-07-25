<?php 	

require_once 'core.php';

$sql = "SELECT brand_id, brand_name FROM brands WHERE brand_status = 1";
$result = $connect->query($sql);

$data = $result->fetch_all();

$connect->close();

echo json_encode($data);