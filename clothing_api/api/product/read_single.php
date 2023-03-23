<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Product.php');

$database = new Database();
$db = $database->connect();

$product = new Product($db);
$product->id = isset($_GET['id']) ? $_GET['id'] : die();

$product->read_single();

if ($product->name == null) {
    echo json_encode(array("message" => " A product with id: " . $product->id . " does not exist"));
} else {
    $product_arr = array(
        'id' => $product->id,
        'name' => $product->name,
        'description' => $product->description,
        'created_at' => $product->created_at,
    );
    print_r(json_encode($product_arr));
}
