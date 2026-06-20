<?php

class ProductController {

    private $products;

    public function __construct(){

        $this->products = $products;
    }

    public function index(){

        return $this->products;
    }

    public function find($id){

        foreach($this->products as $product){

            if($product['id'] == $id){

                return $product;
            }
        }

        return null;
    }

}
?>