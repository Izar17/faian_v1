<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName = $_POST['brandName'];
	$price = $_POST['price'];
	$brandStatus = $_POST['brandStatus']; 
	$brandType = $_POST['brandType']; 

	$sql = "INSERT INTO brands (brand_name, brand_active, brand_status, price, brand_type) VALUES ('$brandName', '$brandStatus', 1, '$price', '$brandType')";

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