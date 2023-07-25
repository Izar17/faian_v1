<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$expensesId = $_POST['expensesId'];

if($expensesId) { 

 $sql = "UPDATE expenses SET status = 0 WHERE ex_id = {$expensesId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the expense";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST