<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandId 		= $_POST['brandId'];
	$productName 	= $_POST['productName'];
	$quantity 		= $_POST['quantity'];
	$brandName 		= $_POST['brandName'];
	$categoryName 	= $_POST['categoryName'];
	$productStatus 	= $_POST['productStatus'];
	$price 	= $_POST['price'];

	
	$sql = "SELECT  price, actual_weight from brands where brand_id = $brandId";
	$result = $connect->query($sql);

	if($result->num_rows > 0) { 
	while($row = $result->fetch_array()) {
		$sql1 = "INSERT INTO product (product_name,  brand_id, categories_id, quantity, rate, active, status) 
		VALUES ('$productName', '$brandName', '$categoryName', '$quantity', '$price', '$productStatus', 1)";

		$totalWeight = (int)$row[1]+$quantity;
		$sql2 = "UPDATE brands SET actual_weight = '$totalWeight' where brand_id = $brandId";

			if($connect->query($sql1) === TRUE && $connect->query($sql2) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Successfully Added";	
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while adding the members";
			}
		}
	}
		

	$connect->close();

	echo json_encode($valid, JSON_PRETTY_PRINT);
 
} // /if $_POST