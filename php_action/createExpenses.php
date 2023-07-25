<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$detail = $_POST['detail'];
	$amount = $_POST['amount'];
	$paidBy = $_POST['paidBy'];
	$receivedBy = $_POST['receivedBy'];
	$paymentType = $_POST['paymentType'];
	$referenceNo = $_POST['referenceNo'];

	$sql = "INSERT INTO expenses (details, amount, paid_by, received_by, date, reference_no, payment_type, status) VALUES ('$detail', '$amount','$paidBy','$receivedBy','$curDate','$referenceNo','$paymentType',1)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} 