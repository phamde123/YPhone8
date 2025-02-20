<?php

require_once '../model/cart.php';

class CartController extends Cart
{
    public function index(){
        $carts = $this->getAllCart();
        $sum = 0;
        foreach ($carts as $cart) {
            $sum += $cart['var_sale_price'] * $cart['cart_quantity'];
        }
        $_SESSION['total'] = $sum;
        include '../view/client/cart/cart.php';
    }
    public function addToCartByNow()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-to-cart'])) {
            if (empty($_POST['variant_id'])) {
                $_SESSION['error'] = 'Vui lọng chọn màu sắc, kích thước, số lượng sản phẩm';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            if (empty($_SESSION['user'])) {
                $_SESSION['error'] = 'Bạn chưa đăng nhập. Vui lòng đăng nhập';
                header('Location: index.php?act=login');
                exit();
            }
            $checkCart = $this->checkCart();
            if ($checkCart) {
                $quantity = $checkCart['quantity'] + $_POST['quantity'];
                $updateCart = $this->updateCart($_SESSION['user']['user_id'], $_POST['pro_id'], $_POST['variant_id'], $quantity);
                $_SESSION['success'] = 'Cập nhập giỏ hàng thành công';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            } 
            else{
                $addToCart = $this->addToCart($_SESSION['user']['user_id'], $_POST['pro_id'], $_POST['variant_id'], $_POST['quantity']);
                $_SESSION['success'] = 'Thêm vào giỏ hàng thành công';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buy-now'])) {
            if (empty($_POST['variant_id'])) {
                $_SESSION['error'] = 'Vui lọng chọn màu sắc, kích thước, số lượng sản phẩm';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            if (empty($_SESSION['user'])) {
                $_SESSION['error'] = 'Bạn chưa đăng nhập. Vui lòng đăng nhập';
                header('Location: index.php?act=login');
                exit();
            }
            $checkCart = $this->checkCart();
            if ($checkCart) {
                $quantity = $checkCart['quantity'] + $_POST['quantity'];
                
                $updateCart = $this->updateCart($_SESSION['user']['user_id'], $_POST['pro_id'], $_POST['variant_id'], $quantity);
                header('Location: ?act=cart');
                exit();
            } 
            else{
                $addToCart = $this->addToCart($_SESSION['user']['user_id'], $_POST['pro_id'], $_POST['variant_id'], $_POST['quantity']);
                header('Location: ?act=cart');
                exit();
            }
        }
    }

    public function update(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_cart'])) {
            if (isset($_POST['cart_quantity'])) {
               foreach ($_POST['cart_quantity'] as $cart_id => $quantity) {
                $this->updateCartById($cart_id,$quantity);
               }
               header('Location: '.$_SERVER['HTTP_REFERER']);
               $_SESSION['success'] = 'Cập nhập giỏ hàng thành công';
               exit();
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apply'])) {
            $coupon_code = $this->getCouponByCode($_POST['coupon_code']);
            if(!$coupon_code){
                $_SESSION['error'] = 'Mã giảm giá không tồn tại';
                header('Location: '.$_SERVER['HTTP_REFERER']);
                exit();
            }
            if($coupon_code){
                $_SESSION['coupon'] = $coupon_code;
                $totalCoupon = $this->handleCoupon($coupon_code,$_SESSION['total']);
                $_SESSION['totalCoupon'] = $totalCoupon;
                // echo '<pre>';
                // print_r($totalCoupon);
                // echo '</pre>';
                $_SESSION['success'] = 'Áp dụng mã giảm giá thành công';
                header('Location: '.$_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    public function delete(){
        try {
            $this->deleteCart($_GET['cart_id']);
            $_SESSION['success'] = 'Xoá sản phẩm khỏi giỏ hàng thành công';
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Xoá sản phẩm khỏi giỏ hàng thất bại ';
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    public function handleCoupon($coupon,$total){
        if($coupon['type'] == 'Fixed Amount'){ 
            $totalCoupon = $coupon['coupon_value'];
        }else{
            $totalCoupon = $total * ($coupon['coupon_value'] / 100);
        }
        return $totalCoupon;
    }
}
