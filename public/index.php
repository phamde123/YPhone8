<?php
session_start();
require_once '../controller/admin/ProductAdminController.php';
$action = isset($_GET['act']) ? $_GET['act'] : 'index';
$productAdmin = new ProductAdminController();
switch ($action) {
    case 'admin':
        include '../view/admin/index.php';
        break;
    case 'product':
        $productAdmin->index();
        break;
    case 'product_store':
        $productAdmin->store();
        break;
    case 'product_create':
        $productAdmin->create();
        break;
    case 'product_edit':
        include '../view/admin/product/edit.php';
        break;
    case 'category':
        include '../view/admin/category/list.php';
        break;
    case 'category_create':
        include '../view/admin/category/create.php';
        break;
    case 'category_edit':
        include '../view/admin/category/edit.php';
        break;

        // ==================================================================================================//

    case 'index';
        include '../view/client/index.php';
        break;
    case 'login';
        include '../view/client/auth/login.php';
        break;
    case 'register';
        include '../view/client/auth/register.php';
        break;
}
