<?php 	

require_once 'core.php';

$categoriesId = $_POST['categoriesId'];

$sql = "SELECT c.categories_id, c.categories_name, c.categories_active, c.categories_status, p.quantity, p.rate FROM categories c 
        INNER JOIN product p on c.categories_id = p.categories_id
        WHERE c.categories_id = $categoriesId";
$result = $connect->query($sql);

 $row = $result->fetch_array();

$connect->close();

echo json_encode($row, JSON_PRETTY_PRINT);