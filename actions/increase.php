<?php

require_once '../Controllers/CartController.php';

$cartController = new CartController();

$cartController->increase($_GET['id']);

header("Location: ../Views/pages/cart.php");