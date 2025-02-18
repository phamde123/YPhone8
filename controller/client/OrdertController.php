<?php

require_once '../model/cart.php';
require_once '../model/Ship.php';
require_once '../model/User.php';
require_once '../model/Order.php';

class OrdertController
{
    protected $cart;
    protected $ship;
    protected $user;
    protected $order;

    public function __construct()
    {
        $this->cart = new Cart();
        $this->ship = new Ship();
        $this->user = new User();
        $this->order = new Order();
    }
    public function index()
    {
        $user = $this->user->getUserById($_SESSION['user']['user_id']);
        $ships = $this->ship->getAllShip();
        $carts = $this->cart->getAllCart();

        include "../view/client/checkout/checkout.php";
    }

    public function order()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order'])) {
            $carts = $this->cart->getAllCart();
            // echo '<pre>';
            // print_r($carts);
            // die;
            $orderDetail = $this->order->addOrderDetail(
                $_POST['name'],
                $_POST['email'],
                $_POST['phone'],
                $_POST['address'],
                $_POST['amount'],
                $_POST['note'],
                $_POST['shipping'],
                $_POST['cou_id'],
                $_POST['payment']
            );
            
            if ($orderDetail) {

                $orderDetailId = $this->order->getLastInsertId();

                foreach ($carts as $cart) {
                    $this->order->addOrder($cart['pro_id'], $cart['var_id'], $orderDetailId, $cart['cart_quantity']);
                    $this->cart->deleteCart($cart['cart_id']);
                }
                unset($_SESSION['total']);
                unset($_SESSION['coupon']);
                unset($_SESSION['totalCoupon']);

                header('Location: ?act=index');
                $_SESSION['success'] = 'Đặt hàng thành công';
                exit();
            } else {
                header('Location: ?act=checkout');
                $_SESSION['error'] = 'Đặt hàng không thành công';
                exit();
            }
        }
    }
}
