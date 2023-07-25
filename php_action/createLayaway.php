<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$name = $_POST['customerName'];
    $startDate = date('m/d/Y');

	
	$sql = "SELECT id, name, address, contact_number from customer where id = '$name'";
	$result = $connect->query($sql);
	while($row = $result->fetch_row()) {
		list($customerId, $customerName, $customerAddress, $customerNumber) = $row;
	}

	$sql2 = "SELECT * from layaway where customer_id = '$name'";
	$result = $connect->query($sql2);
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			$valid['success'] = true;
			$valid['messages'] = "Customer already exist in Layaway";
		} else {
		//	$sql1 = "INSERT INTO layaway (name, address, contact_number, status, customer_id) VALUES ('$customerName', '$customerAddress','$customerNumber','1','$name')";		
			if($connect->query($sql1) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Successfully Added";	
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while adding the members";
			}
		}
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} 