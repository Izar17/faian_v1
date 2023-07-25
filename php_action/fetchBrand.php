<?php

require_once 'core.php';

$sql = "SELECT brand_id, brand_name, brand_active, brand_status, price, actual_weight, brand_type FROM brands WHERE brand_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {

	// $row = $result->fetch_array();
	$activeBrands = "";
	while ($row = $result->fetch_array()) {
		$brandId = $row[0];
		// price
		if ($row[4] != 0) {
			$price = 'P' . number_format($row[4], 2) . '';
		} else {
			$price = 'Price is Per/Qty';
		}
		// active 
		if ($row[2] == 1) {
			// activate member
			$activeBrands = "<label class='label label-success'>Available</label>";
		} else {
			// deactivate member
			$activeBrands = "<label class='label label-danger'>Not Available</label>";
		}

		$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	  <li><a  type="button" onclick="addCategories(' . $brandId . ',' . $row[6] . ')"><i class="glyphicon glyphicon-plus-sign"></i> Manage Sub Category</a></li>
	  <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands(' . $brandId . ')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	  <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands(' . $brandId . ')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	</ul>
	</div>';  

		$output['data'][] = array(
			$row[1],
			$price,
			$row[5],
			$activeBrands,
			$button,
			$row[6]
		);
	} // /while 

} // if num_rows

$connect->close();

echo json_encode($output, JSON_PRETTY_PRINT);