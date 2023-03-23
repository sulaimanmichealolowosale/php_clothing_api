<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/Order.php');

$database = new Database();
$db = $database->connect();

$order = new Order($db);

$data = json_decode(file_get_contents("php://input"));

$order->customer_id = $data->customer_id;
$order->product_id = $data->product_id;

if ($order->create()) {
    echo json_encode(array(
        'Message' => 'Order has been added'
    ));
} else {
    echo json_encode(array(
        'Message' => 'order was not added'
    ));
}
