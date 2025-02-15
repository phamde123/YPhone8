<?php
session_start();

require_once '../controller/admin/CategoryAdminController.php';
require_once '../controller/admin/ProductAdminController.php';
require_once '../controller/client/HomeController.php';
require_once '../controller/client/AuthController.php';

require_once  '../controller/client/ProfileController.php';

require_once '../controller/client/CartController.php';


$action = isset($_GET['act']) ? $_GET['act'] : 'index';
$categoryAdmin = new CategoryAdminController();
$productAdmin = new ProductAdminController();

$home = new HomeController();
$client = new AuthController();

$profile = new ProfileController();

$cart = new CartController();


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
    case 'delete_gallery':
        $productAdmin->deleteGallery();
        break;
    case 'delete_product_variant':
        $productAdmin->deleteProductVariant();
        break;
    case 'product_delete':
        $productAdmin->deleteProduct();
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
        $home->index();
        break;
    case 'product_detail';
        $home->getProductDetail();
        break;
    case 'login';
        $client->sigin();
        break;
    case 'register';
        $client->registers();
        break;
    case 'logout';
        $client->logout();
        break;
    case 'profile':
        include "../view/client/profile/profile.php";
        break;
    case 'update-profile':
        $profile->updateProfile();

    case 'cart';
        $cart->index();
        break;
    case 'addToCartByNow';
        $cart->addToCartByNow();
        break;
    case 'update-cart';
        $cart->update();
        break;
    case 'delete-cart';
        $cart->delete();

        break;
}
