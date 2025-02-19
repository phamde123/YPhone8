<?php
session_start();

require_once '../controller/admin/CategoryAdminController.php';
require_once '../controller/admin/ProductAdminController.php';
require_once '../controller/admin/CouponAdminController.php';
require_once '../controller/admin/OrderAdminController.php';


require_once '../controller/client/HomeController.php';
require_once '../controller/client/AuthController.php';
require_once  '../controller/client/ProfileController.php';
require_once '../controller/client/CartController.php';
require_once '../controller/client/OrdertController.php';


$action = isset($_GET['act']) ? $_GET['act'] : 'index';
$categoryAdmin = new CategoryAdminController();
$productAdmin = new ProductAdminController();
$couponAdmin = new CouponAdminController();
$orderAdmin = new OrderAdminController();

$home = new HomeController();
$client = new AuthController();
$profile = new ProfileController();
$cart = new CartController();
$order = new OrdertController();

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
    case 'orders-list':
        $orderAdmin->list();
        break;
    case 'orders-edit':
        $orderAdmin->edit();
        break;
    case 'order-update':
        $orderAdmin->update();
        break;
    case 'orders-delete':
        $orderAdmin->delete();
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

    case 'coupon':
        $couponAdmin->index();
        break;
    case 'coupon-create':
        $couponAdmin->create();
        break;
    case 'coupon-edit':
        $couponAdmin->edit();
        break;
    case 'coupon-update':
        $couponAdmin->update();
        break;
    case 'coupon-delete':
        $couponAdmin->delete();
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

    case 'checkout':
        $order->index();
        break;
    case 'order':
        $order->order();
        break;
}
