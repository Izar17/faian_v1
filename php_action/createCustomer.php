<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$name = $_POST['customerName'];
	$address = $_POST['customerAddress'];
	$contactNum = $_POST['customerNumber'];
    $startDate = date('m/d/Y');

	$sql = "INSERT INTO customer (name, address, contact_number, status) VALUES ('$name', '$address','$contactNum','1')";

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