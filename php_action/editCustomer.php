
<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$name = $_POST['editCustomerName'];
	$address = $_POST['editCustomerAddress'];
  	$number = $_POST['editCustomerNumber']; 
  	$customerId = $_POST['customerId'];

	  $sql = "UPDATE customer SET name = '$name', address = '$address', contact_number = '$number' WHERE id = '$customerId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST