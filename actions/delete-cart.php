<?php

require_once '../Controllers/CartController.php';

$cartController = new CartController();

$cartController->delete($_GET['id']);

header("Location: ../Views/pages/cart.php");