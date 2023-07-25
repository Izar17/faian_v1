<?php 	

require_once 'core.php';

$sql = "SELECT ex_id, details, amount, paid_by, received_by, date, reference_no FROM expenses where status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 
 // $row = $result->fetch_array();
 while($row = $result->fetch_array()) {
 	$expenseId = $row[0];

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
	 <li><a type="button" data-toggle="modal" data-target="#editExpensesModel" onclick="editExpenses('.$expenseId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	  <li><a type="button" data-toggle="modal" data-target="#removeExpensesModal" onclick="removeExpenses('.$expenseId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 			
		$row[1], 	
		$row[2], 	
		$row[3], 	
		$row[4],	
		$row[6],	
		$row[5], 
		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output, JSON_PRETTY_PRINT);