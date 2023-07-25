<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$brandId = $_POST['brandId'];

if($brandId) { 

 $sql = "DELETE from brands WHERE brand_id = {$brandId}";

 $sql2 = "DELETE from categories WHERE  brand_id = {$brandId}";
 $result2 = $connect->query($sql2);

 $sql3 = "DELETE from product WHERE brand_id = {$brandId}";

 $result3 = $connect->query($sql3);
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