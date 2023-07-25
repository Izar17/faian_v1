<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

	$brandName = $_POST['editCategoriesName'];
	$brandStatus = $_POST['editCategoriesStatus'];
	$categoriesId = $_POST['editCategoriesId'];

	$brandId = $_POST['editBrandId'];
	$brandType = $_POST['editBrandType'];
	$price = $_POST['editPrice'];
	$quantity = $_POST['editQuantity'];

	$sql = "UPDATE categories SET categories_name = '$brandName', categories_active = '$brandStatus' WHERE categories_id = '$categoriesId'";
	$result = $connect->query($sql); 

	if($brandType == 2){
		$priceValue = ", rate = '$price'";
	} else {$priceValue = "";}
	$sql1 = "UPDATE product SET quantity = '$quantity' $priceValue WHERE categories_id = '$categoriesId'";
	$result1 = $connect->query($sql1);

	$sql2 = "SELECT  sum(quantity) from product where brand_id = $brandId";
	$result2 = $connect->query($sql2);
		while($row2 = $result2->fetch_array()) {
			$sql3 = "UPDATE brands SET actual_weight = '$row2[0]' where brand_id = $brandId";
		}
	if ($connect->query($sql3) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating the categories";
	}

	$connect->close();

	echo json_encode($valid);

} // /if $_POST