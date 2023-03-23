<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/Customer.php');

$database = new Database();
$db = $database->connect();

$customer = new Customer($db);

$data = json_decode(file_get_contents("php://input"));

$customer->name = $data->name;

if ($customer->create()) {
    echo json_encode(array(
        'Message' => 'customer has been added'
    ));
} else {
    echo json_encode(array(
        'Message' => 'customer was not added'
    ));
}
