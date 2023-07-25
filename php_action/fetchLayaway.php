<?php 	

require_once 'core.php';
$contId = $_GET['contId'];

$sql = "SELECT distinct lo.order_id, c.name, c.address, c.contact_number, c.status, lo.due_date FROM customer c
 inner join layaway_orders lo on c.id = lo.client_name
 where lo.order_status !=0 and lo.order_type = '$contId' order by lo.due_date asc";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 
 // $row = $result->fetch_array();
 while($row = $result->fetch_array()) {
	$orderId = $row[0];

	if($row[4] == 1){
		$status = "<label class='label label-success'>Active</label>";
	} else {
		// deactivate member
		$status = "<label class='label label-danger'>No Active Transaction</label>";
	}
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	  <li><a  type="button" onclick="manageLayaway('.$orderId.','.$contId.')"><i class="glyphicon glyphicon-plus-sign"></i> Manage Layaway</a></li>
	  <li><a type="button" data-toggle="modal" data-target="#editCustomerModel" onclick="editCustomer('.$orderId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	  <li><a type="button" data-toggle="modal" data-target="#removeCustomerModal" onclick="removeCustomer('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 			
		$row[1], 	
		$row[2], 	
		$row[3], 	
		$row[5], 	
		$status, 
		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output, JSON_PRETTY_PRINT);