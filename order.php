<?php
require_once 'src/config.php';
require_once 'src/class.db.php';
require_once 'src/functions.php';
require_once 'src/class.burger.php';

$burger = new Burger();


$addressField = ['phone', 'street', 'home', 'part', 'appt', 'floor'];
$address = '';
foreach ($_POST as $field => $value){
    if($value && in_array($field, $addressField)){
        $address .= $value . ',';
    }
}
$email = $_POST['email'];
$name = $_POST['name'];
$data = ['address'=>$address];
$user = $burger->getUserByEmail($email);

if ($user){
    $userId = $user['id'];
    $burger->incOrders($userId);
    $orderNumber = $user['count'] + 1;
} else {
    $orderNumber = 1;
    $userId = $burger->createUser($email, $name);
}

$orderId = $burger->orders($userId, $data);

echo "Спасибо, ваш заказ будет доставлен по адресу: $address <br>
Номер вашего заказа: #$orderId <br>
Это ваш $orderNumber-й заказ!";