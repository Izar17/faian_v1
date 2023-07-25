<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$actualCash = $_POST['actualCash'];
	$actualEwallet = $_POST['actualEwallet'];
	$actualBank = $_POST['actualBank'];
	$actualCc = $_POST['actualCc'];
	$userId = $_POST['userId'];



	$sql2 = "SELECT * FROM eod_revenue WHERE cur_date = '$curDate'";
	$result = $connect->query($sql2);

	if($result->num_rows == 1) {
 		$sql = "UPDATE eod_revenue SET 
		cash = $actualCash,
		ewallet = $actualEwallet,
		bank = $actualBank,
		credit_card = $actualCc,
		user_id = $userId 
		WHERE cur_date = '$curDate'";
			if($connect->query($sql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Successfully Updated";	
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while adding the members";
			}
	} else {		
		$sql = "INSERT INTO eod_revenue (cash, ewallet, bank, credit_card, user_id, cur_date) VALUES ('$actualCash', '$actualEwallet','$actualBank','$actualCc','$userId','$curDate')";		
			if($connect->query($sql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Successfully Added";	
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while adding the members";
			}
	} // /else
	$connect->close();

	echo json_encode($valid);
 
} 