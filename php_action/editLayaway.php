
<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$name = $_POST['editCustomerName'];
	$address = $_POST['editCustomerAddress'];
  	$number = $_POST['editCustomerNumber']; 
  	$dueDate = $_POST['editDueDate'];
  	$orderId = $_POST['orderId'];

	  $sql = "UPDATE layaway_orders SET due_date = '$dueDate' WHERE order_id = '$orderId'";

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