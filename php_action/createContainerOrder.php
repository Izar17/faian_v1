<?php 	
//ALTER TABLE `orders` ADD `payment_place` INT NOT NULL AFTER `payment_status`;
//TER TABLE `orders` ADD `gstn` VARCHAR(255) NOT NULL AFTER `payment_place`;
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	

  $orderDate 			= date('m/d/Y', strtotime($_POST['orderDate']));	
  $clientName 			= $_POST['clientName'];
  $clientContact 		= $_POST['clientContact'];
  $subTotalValue 		= $_POST['subTotalValue'];
  $vatValue 			= $_POST['vatValue'];
  $totalAmountValue     = $_POST['totalAmountValue'];
  $discount 			= $_POST['discount'];
  $grandTotalValue 		= $_POST['grandTotalValue'];
  $paid 				= $_POST['paid'];
  $dueValue 			= $_POST['dueValue'];
  $layaway 				= date('m/d/Y', strtotime($_POST['dueDate']));
  $pickup 				= date('m/d/Y', strtotime($_POST['dueDates']));
  $orderType 			= $_POST['orderType'];
  $paymentStatus 		= $_POST['paymentStatus'];
  $paymentPlace 		= $_POST['paymentPlace'];
  $gstn 				= $_POST['gstn'];
  $cash 				= $_POST['cash'];
  $gcash 				= $_POST['gcash'];
  $bank 				= $_POST['bank'];
  $credit				= $_POST['credit'];
  $userid 				= $_SESSION['userId'];
  $paymentType 			= 1;

	if($orderType == 1){
		$dueDate = $layaway;
	} else {
		$dueDate = $pickup;
	}
	$sql = "INSERT INTO layaway_orders (order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_type, payment_status,payment_place, gstn,order_status,user_id,cash,gcash,bank,credit_card, order_type, due_date) VALUES ('$orderDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', '$paymentType', '$paymentStatus','$paymentPlace','$gstn', '1','$userid','$cash','$gcash','$bank','$credit','$orderType','$dueDate')";
	
	$order_id;
	$orderStatus = false;
	if($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

		$orderStatus = true;
	}

	$paymentDetails = "INSERT INTO payment_details (order_id, pay_amount, type, status, paid, due, paid_date) values ('$order_id','$grandTotalValue','$paymentType','$paymentStatus','$paid','$dueValue','$orderDate')"; 
	$connect->query($paymentDetails);	

		
	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		$totalQty=0;
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];			
			if($paymentStatus == 4){		
				// update brand table
				$updateBrand = "UPDATE brands SET actual_weight = actual_weight - ".$_POST['quantity'][$x]." WHERE brand_id = ".$_POST['brandName'][$x]."";
				$connect->query($updateBrand);			

				// update product table
				$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);
			}
				// add into order_item
				$orderItemSql = "INSERT INTO layaway_order_item (order_id, product_id, quantity, rate, total, order_item_status) 
				VALUES ('$order_id', '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";
				$connect->query($orderItemSql);			

				if($x == count($_POST['productName'])) {
					$orderItemStatus = true;
				}		
		} // while	
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);