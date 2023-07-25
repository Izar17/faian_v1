<?php

require_once 'core.php';
$brandId = $_GET['brandId'];
$brandType = $_GET['brandType'];


$sql = "SELECT c.categories_id, c.categories_name, c.categories_active, c.categories_status FROM categories c
		WHERE c.categories_status = 1 and c.brand_id = $brandId";
$result = $connect->query($sql);
$output = array('data' => array());

if ($result->num_rows > 0) {

	// $row = $result->fetch_array();
	$activeCategories = "";
	while ($row = $result->fetch_array()) {
		$categoriesId = $row[0];
		$sql2 = "SELECT sum(quantity) FROM product where categories_id = '$categoriesId'";
		$result2 = $connect->query($sql2);
			while ($row2 = $result2->fetch_array()) {
				$quantity = $row2[0];
			}
		// active 
		if ($row[2] == 1) {
			// activate member
			$activeCategories = "<label class='label label-success'>Available</label>";
		} else {
			// deactivate member
			$activeCategories = "<label class='label label-danger'>Not Available</label>";
		}
		$manage = '';
		if ($brandType == 0) {
			$manage = '<li><a  type="button" onclick="addCategories(' . $categoriesId . ',' . $brandId . ')"><i class="glyphicon glyphicon-plus-sign"></i> Manage Product</a></li>';
		}

		$button = '<!-- Single button -->
			<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Action <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				' . $manage . '
				<li><a type="button" data-toggle="modal" id="editCategoriesModalBtn" data-target="#editCategoriesModal" onclick="editCategories(' . $categoriesId . ')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
				<li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories(' . $categoriesId . ',' . $brandId . ')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
		</ul>
			</div>';

		$output['data'][] = array(
			$row[1],
			$quantity,
			$activeCategories,
			$button
		);
	} // /while 

} // if num_rows

$connect->close();

echo json_encode($output, JSON_PRETTY_PRINT);