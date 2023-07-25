<?php 	

require_once 'core.php';

$orderId = $_POST['orderId'];

$sql = "SELECT lo.order_id, c.name, c.address, c.contact_number, lo.due_date FROM customer c 
inner join layaway_orders lo on c.id = lo.client_name
WHERE lo.order_id = $orderId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row, JSON_PRETTY_PRINT);