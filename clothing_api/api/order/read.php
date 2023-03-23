<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Order.php');

$database = new Database();
$db = $database->connect();

$order = new Order($db);

$result = $order->read();

$num = $result->rowCount();


if ($num > 0) {
    $order_arr = array();
    $order_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $order_item = array(
            'id' => $id,
            'customer_id' => $customer_id,
            'product_id' => $product_id,
            'created_at' => $created_at,
        );

        array_push($order_arr['data'], $order_item);
    }

    echo json_encode($order_arr);
} else {
    echo json_encode(
        array("message" => "No order found")
    );
}
