<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Customer.php');

$database = new Database();
$db = $database->connect();

$customer = new Customer($db);

$result = $customer->read();

$num = $result->rowCount();


if ($num > 0) {
    $customer_arr = array();
    $customer_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $customer_item = array(
            'id' => $id,
            'name' => $name,
            'created_at' => $created_at,
        );

        array_push($customer_arr['data'], $customer_item);
    }

    echo json_encode($customer_arr);
} else {
    echo json_encode(
        array("message" => "No customer found")
    );
}

