<!-- danh sách bài viết theo phân loại -->
<?php

class ProductController {

    private $products;

    public function __construct($products){
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