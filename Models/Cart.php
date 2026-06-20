<?php

class Cart {

    public function add($product) {

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][] = $product;
    }

    public function getAll() {
        return $_SESSION['cart'] ?? [];
    }

    public function remove($id) {

        if (!isset($_SESSION['cart'])) return;

        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $id) {
                unset($_SESSION['cart'][$key]);
            }
        }

        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    public function increase($id) {

        if (!isset($_SESSION['cart'])) return;

        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) {
                $item['qty']++;
            }
        }
    }

    public function decrease($id) {

        if (!isset($_SESSION['cart'])) return;

        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) {

                $item['qty']--;

                if ($item['qty'] <= 0) {
                    $item['qty'] = 1;
                }
            }
        }
    }
}