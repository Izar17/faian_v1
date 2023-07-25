<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

	$brandType = $_POST['brandType'];
	$brandId = $_POST['brandId'];
	$categoriesName = $_POST['categoriesName'];
	$categoriesStatus = $_POST['categoriesStatus'];
	
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];

	$sql = "SELECT  price, actual_weight from brands where brand_id = $brandId";
	$result = $connect->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_array()) {
			if($brandType == 2){
				$colPriceValue = "$price";
			} else {$colPriceValue =$row[0];}
			
			$fetchCategories = "SELECT * FROM categories ORDER BY categories_id DESC LIMIT 1";
			$catResult = $connect->query($fetchCategories);
			while ($catRow = $catResult->fetch_array()) {
				$categoryId = (int) $catRow[0] + 1;
			}

			$sql1 = "INSERT INTO product (product_name,  brand_id, categories_id, quantity, rate, active, status) 
				VALUES ('$categoriesName', '$brandId', '$categoryId', '$quantity', '$colPriceValue', 1, 1)";
			$result1 = $connect->query($sql1);

			$totalWeight = (int) $row[1] + $quantity;
			$sql2 = "UPDATE brands SET actual_weight = '$totalWeight' where brand_id = $brandId";
			$result2 = $connect->query($sql2);
		}
	}
	


	$sqladd = "INSERT INTO categories (categories_name, categories_active, categories_status, brand_id) 
	VALUES ('$categoriesName', '$categoriesStatus', 1, '$brandId')";

	if ($connect->query($sqladd) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the members";
	}

	$connect->close();

	echo json_encode($valid);

} // /if $_POST