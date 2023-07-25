<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$productId 		= $_POST['productId'];
	$productName 	= $_POST['editProductName']; 
	$quantity 		= $_POST['editQuantity'];
	$rate 			= $_POST['editRate'];
	$brandName 		= $_POST['editBrandName'];
	$categoryName 	= $_POST['editCategoryName'];
	$productStatus 	= $_POST['editProductStatus'];

				
	$sqlProduct = "UPDATE product SET product_name = '$productName', brand_id = '$brandName', categories_id = '$categoryName', quantity = '$quantity', rate = '$rate', active = '$productStatus', status = 1 WHERE product_id = $productId ";
	$resultProduct = $connect->query($sqlProduct);
	
	$sql = "SELECT  sum(quantity) from product inner join brands on product.brand_id = brands.brand_id 
			where brands.brand_type = 2";
	$result = $connect->query($sql);
		while($row = $result->fetch_array()) {
			$sql2 = "UPDATE brands SET actual_weight = '$row[0]' where brand_id = $brandName";
			;
		}

	if($connect->query($sql2) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
