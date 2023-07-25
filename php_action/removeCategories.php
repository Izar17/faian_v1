<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_POST['categoriesId'];
$brandId = $_POST['brandId'];

if($categoriesId) { 


 $sql = "DELETE from categories WHERE categories_id = {$categoriesId}";

 $sql2 = "DELETE from product WHERE categories_id = {$categoriesId}";
 $result2 = $connect->query($sql2);

 $sql3 = "SELECT sum(quantity) from product where brand_id = $brandId";
 $result3 = $connect->query($sql3);
	 while($row3 = $result3->fetch_array()) {
		 $sql4 = "UPDATE brands SET actual_weight = '$row3[0]' where brand_id = $brandId";
		 $result4 = $connect->query($sql4);
	 }
 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST