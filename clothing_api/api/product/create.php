<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/Product.php');

$database = new Database();
$db = $database->connect();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

$product->name=$data->name;
$product->description=$data->description;

if ($product->create()){
    echo json_encode(array(
        'Message' => 'Product has been added'
    ));
}else{
    echo json_encode(array(
        'Message' => 'Product was not added'
    ));
}