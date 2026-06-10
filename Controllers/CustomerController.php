<?php

require_once "Models/Customer.php";

class CustomerController
{
    public function index()
    {
        $customerModel = new Customer();

        if (isset($_POST['keyword']) && !empty(trim($_POST['keyword']))) {
            $customers = $customerModel->search($_POST['keyword']);
        } else {
            $customers = $customerModel->getAll();
        }

        require "Views/customers/index.php";
    }

    public function delete()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];

            $customerModel = new Customer();
            $customerModel->delete($id);
        }

       
        header("Location: index.php?pages=ho-so"); 
        exit; 
    }
}