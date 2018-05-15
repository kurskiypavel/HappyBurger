<?php
/**
 * Created by PhpStorm.
 * User: pavelkurskiy
 * Date: 5/10/18
 * Time: 7:03 AM
 */
require_once '../config.php';


$input = $_POST['input'];

$return_arr = array();

$query = "SELECT * FROM products WHERE MATCH(product_name)
AGAINST('$input' IN BOOLEAN MODE)";
$result = $mysqli->query($query);


while($row = mysqli_fetch_array($result)){
    $product_name = $row['product_name'];
    $product_id = $row['id'];
    $return_arr[] = array("product_name" => $product_name, "product_id" => $product_id);
}

// Encoding array in JSON format
echo json_encode($return_arr);