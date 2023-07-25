<?php 	

require_once 'core.php';

$brandId = $_POST['brandId'];

$sql = "SELECT categories_id, categories_name status FROM categories WHERE brand_id = $brandId";
$result = $connect->query($sql);

$output = array('data' => array());
if($result->num_rows > 0) { 
 while($row = $result->fetch_array()) {

    $output['data'][] = array( 	
        // categories id
        $row[0], 
        // categories name
        $row[1], 
        ); 
        
        $categories[] = array("id" => $row[0], "name" => $row[1]);

 }
} else {
    $categories[] = array("id" => 0, "name" => "");
}


$connect->close();

echo json_encode($categories, JSON_PRETTY_PRINT);



