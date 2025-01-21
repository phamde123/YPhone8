<?php
session_start();

require_once '../controller/admin/CategoryAdminController.php';
require_once '../controller/admin/ProductAdminController.php';
require_once '../controller/client/AuthController.php';

$action = isset($_GET['act']) ? $_GET['act'] : 'index';
$categoryAdmin = new CategoryAdminController();
$productAdmin = new ProductAdminController();
$client = new AuthController();

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
        $productAdmin->edit();
        break;
    case 'product_update':
        $productAdmin->update();
        break;
        // ==================================================================================================//

    case 'category':
        $categoryAdmin->index();
        break;
    case 'category_create':
        $categoryAdmin->addCategory();
        break;
    case 'category_edit':
        $categoryAdmin->updateCategory();
        break;
    case 'category_delete':
        $categoryAdmin->deleteCategory();
        break;

        // ==================================================================================================//

    case 'index';
        include '../view/client/index.php';
        break;
    case 'login';
        $client->sigin();
        break;
    case 'register';
        $client->registers();
        break;
}
