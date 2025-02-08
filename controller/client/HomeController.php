<?php

require_once '../model/Category.php';
require_once '../model/Product.php';

class HomeCotroller
{
    protected $category;
    protected $product;

    public function __construct()
    {
        $this->category = new Category();
        $this->product = new Product();
    }

    public function index()
    {
        $category = $this->category->listCategory();
        $product = $this->product->listProduct();
        include '../view/client/index.php';
    }
    
    public function getProductDetail()
    {
        $productDetail = $this->product->getProductBySlug($_GET['slug']);
        $productDetail = reset($productDetail);
        // echo '<pre>';
        // print_r($productDetail);
        // echo '</pre>';
        include '../view/client/product/productDetail.php';
    }
}