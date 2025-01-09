<?php
$action = isset($_GET['act']) ? $_GET['act'] : 'index';

switch ($action) {
    case 'admin':
        include '../view/admin/index.php';
        break;
    case 'product':
        include '../view/admin/product/list.php';
        break;
    case 'product_create':
        include '../view/admin/product/create.php';
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
