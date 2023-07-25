<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName = $_POST['editBrandName'];
	$price = $_POST['editPrice'];
  	$brandStatus = $_POST['editBrandStatus']; 
  	$brandId = $_POST['brandId'];

	  $sql = "UPDATE brands SET brand_name = '$brandName', price = '$price', brand_active = '$brandStatus' WHERE brand_id = '$brandId'";
	  $sql2 = "UPDATE product SET rate = '$price' WHERE brand_id = '$brandId'";

	if($connect->query($sql) === TRUE && $connect->query($sql2) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST