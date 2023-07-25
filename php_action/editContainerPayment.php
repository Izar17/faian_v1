<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$orderId 		= $_POST['orderId'];
	$payAmount 		= $_POST['payAmount']; 
	$due 			= $_POST['due']; 
	$paymentType 	= $_POST['paymentType'];
	$paymentStatus 	= $_POST['paymentStatus'];  
	$paidAmount     = $_POST['paidAmount'];
	$grandTotal     = $_POST['grandTotal'];
	$orderDate 		= date('m/d/Y');

  $updatePaidAmount = $payAmount + $paidAmount;
  $updateDue = $grandTotal - $updatePaidAmount;

	$sql = "UPDATE layaway_orders SET paid = '$updatePaidAmount', due = '$updateDue', payment_status = '$paymentStatus' WHERE order_id = {$orderId}";

	$sql2 = "INSERT INTO payment_details (order_id, pay_amount, type, status, paid, due, paid_date) values ('$orderId','$due','$paymentType','$paymentStatus','$payAmount','$updateDue','$orderDate')"; 

	if($connect->query($sql) === TRUE && $connect->query($sql2) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

	 
$connect->close();

echo json_encode($valid, JSON_PRETTY_PRINT);
 
} // /if $_POST