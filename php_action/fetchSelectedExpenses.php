<?php 	

require_once 'core.php';

$expensesId = $_POST['expensesId'];

$sql = "SELECT ex_id, details, amount, paid_by, received_by, date, reference_no, payment_type FROM expenses WHERE ex_id = $expensesId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row, JSON_PRETTY_PRINT);