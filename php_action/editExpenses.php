
<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	
	$detail = $_POST['editDetail'];
	$amount = $_POST['editAmount'];
	$paidBy = $_POST['editPaidBy'];
	$receivedBy = $_POST['editReceivedBy'];
	$paymentType = $_POST['editPaymentType'];
	$referenceNo = $_POST['editReferenceNo'];
	$expenseId = $_POST['editExpenseId'];

	  $sql = "UPDATE expenses SET 
	  details = '$detail', 
	  amount = '$amount', 
	  paid_by = '$paidBy',
	  received_by = '$receivedBy',
	  payment_type = '$paymentType',
	  reference_no = '$referenceNo' 
	  WHERE ex_id = '$expenseId'";

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