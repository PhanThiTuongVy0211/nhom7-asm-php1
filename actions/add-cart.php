<?php

require_once '../Controllers/CartController.php';

$cartController = new CartController();

$product = [
    "id" => $_GET['id'],
    "name" => $_GET['name'],
    "price" => $_GET['price'],
    "image" => $_GET['image']
];

$cartController->add($product);

header("Location: ../Views/pages/cart.php");