<?php

class HomeController
{
    public function index()
    {
        $pageTitle = "Trang Chủ - Thời Trang Nữ";

        if (file_exists('views/home.php')) {
            include 'views/home.php';
        } else {
            echo "Chào mừng bạn đến với Website Thời Trang Nữ!";
        }
    }
}