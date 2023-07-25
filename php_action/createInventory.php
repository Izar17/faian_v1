<?php 	
//ALTER TABLE `orders` ADD `payment_place` INT NOT NULL AFTER `payment_status`;
//TER TABLE `orders` ADD `gstn` VARCHAR(255) NOT NULL AFTER `payment_place`;
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	
	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['subCategoryId']); $x++) {			
		$updateProductQuantitySql = "SELECT categories_id FROM categories WHERE categories_id = ".$_POST['subCategoryId'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		$totalQty=0;
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {	
				$sql2 = "SELECT * FROM inventory WHERE date = '$curDate' and categories_id = '".$_POST['subCategoryId'][$x]."'";
				$result2 = $connect->query($sql2);
				if($result2->num_rows > 0) {
				while($row2 = $result2->fetch_row()) {
							// update into order_item
							$sql = "UPDATE inventory SET qty = '".$_POST['subCategoryQty'][$x]."' WHERE date = '$curDate' and categories_id = '".$_POST['subCategoryId'][$x]."'";	
							if($connect->query($sql) === TRUE) {
							$valid['success'] = true;
							$valid['messages'] = "Inventory Successfully Updated.";		
							}
						} 
					} else {
						// add into order_item
						$orderItemSql = "INSERT INTO inventory (categories_id, brand_id, categories_name, qty, date) 
						VALUES ('".$_POST['subCategoryId'][$x]."','".$_POST['brandId'][$x]."','".$_POST['subCategoryName'][$x]."', '".$_POST['subCategoryQty'][$x]."', '$curDate')";

						$connect->query($orderItemSql);		
						$valid['success'] = true;
						$valid['messages'] = "Inventory Successfully Saved";	
						}
					if($x == count($_POST['subCategoryId'])) {
						$orderItemStatus = true;
					}	
			} // while	
		} // /for quantity
	
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);