<?php 	

require_once 'core.php';
$orderId = $_GET['orderId'];
$contId = $_GET['contId'];

$sql = "SELECT la.order_id, la.order_date, c.name, la.client_contact, la.payment_status, la.due, la.due_date, la.paid, la.grand_total, la.release_date FROM layaway_orders la
 INNER JOIN customer c ON la.client_name = c.id
 WHERE la.order_status = 1 and la.order_id = '$orderId' and la.order_type = '$contId'";
$result = $connect->query($sql);



$output = array('data' => array());

if($result->num_rows > 0) { 
 
 $paymentStatus = ""; 
 $x = 1;

 while($row = $result->fetch_array()) {
 	$orderId = $row[0];
	$rel_date = $row[9];

 	$countOrderItemSql = "SELECT count(*) FROM layaway_order_item WHERE order_id = $orderId";
 	$itemCountResult = $connect->query($countOrderItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();


 	// active 
 	if($row[4] == 1) { 		
 		$paymentStatus = "<label class='label label-success'>Fully Paid</label>";
 	} else if($row[4] == 2) { 		
 		$paymentStatus = "<label class='label label-info'>Advance Payment</label>";
 	} else if($row[4] == 4){ 		
		$paymentStatus = "<label class='label label-success'>Fully Paid</label> <label class='label label-info'>Released Date: $rel_date</label>";
	} else { 		
		$paymentStatus = "<label class='label label-warning'>Installment</label>";
	} // /else

	 $grandTotal = 'P'.number_format($row[8],2).'';
	 $due = 'P'.number_format($row[5],2).'';
	 $paid = 'P'.number_format($row[7],2).'';

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	  	<li><a href="addContainer.php?o=editOrd&i='.$orderId.'" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> View Payment Details</a></li>
	    <li><a type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="paymentOrder('.$orderId.')"> <i class="glyphicon glyphicon-save"></i> Payment</a></li>
	    <li><a type="button" onclick="printOrder('.$orderId.')"> <i class="glyphicon glyphicon-print"></i> Print </a></li>	
		<li><a type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="releaseItem('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Release Item</a></li>       
		
	    </ul>
	</div>';		
	//<li><a type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
  
	    
 	$output['data'][] = array( 		
 		// image
 		$x,
 		// Order No.
 		$row[0], 
 		// client name
 		$row[2], 
 		// client contact
 		$row[3], 		 
 		$itemCountRow, 		
 		// order date
 		$row[1],		
 		// due date
 		$row[6],	 
 		// grandTotal
		$grandTotal,		 
		// due
	    $due,	 	 
		// paid
 		$paid,	
 		$paymentStatus,
 		// button
 		$button 		
 		); 	
 	$x++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output, JSON_PRETTY_PRINT);