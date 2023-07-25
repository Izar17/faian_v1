<?php 	

require_once 'core.php';

$categoriesId = $_POST['categoriesId'];

$sql = "SELECT p.product_id, p.product_name, b.brand_type FROM product p 
        INNER JOIN brands b on p.brand_id = b.brand_id
        WHERE p.categories_id = $categoriesId";
$result = $connect->query($sql);

$output = array('data' => array());
if($result->num_rows > 0) { 
    

 while($row = $result->fetch_array()) {

    $output['data'][] = array( 	
        // product id
        $row[0], 
        // product name
        $row[1], 
        // brand type
        $row[2], 
        ); 
        
        $product[] = array("id" => $row[0], "name" => $row[1], "brandType" => $row[2]);

 }
} else {
    $product[] = array("id" => 0, "name" => "");
}

$connect->close();

echo json_encode($product, JSON_PRETTY_PRINT);



