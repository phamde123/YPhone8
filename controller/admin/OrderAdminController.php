<?php

require_once '../model/Order.php';

class OrderAdminController extends Order
{

    public function list()
    {
        $listOrder = $this->getAllOrderDetail();

        include '../view/admin/order/list.php';
    }

    public function edit()
    {

        $getOrderDetail = $this->getOrderDetailById();
        $getOrder = $this->getOrderById();
        $coupon = $this->getCouponById();
        $ship = $this->getShipById();
        $handleCoupon = $this->handleCoupon($coupon, $getOrderDetail['amount']);

        include '../view/admin/order/edit.php';
    }

    public function handleCoupon($coupon, $total)
    {
        if ($coupon['type'] == 'Fixed Amount') {
            $totalCoupon = $coupon['coupon_value'];
        } else {
            $totalCoupon = $total * ($coupon['coupon_value'] / 100);
        }
        return $totalCoupon ?? 0;
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateOrder'])) {
            $updateOrder = $this->updateOrder($_POST['status']);

            if ($updateOrder) {
                $_SESSION['success'] = 'Cập nhập đơn hàng thành công';
                header('Location: ?act=orders-list');
                exit();
            } else {
                $_SESSION['error'] = 'Cập nhập đơn hàng thất bại';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    public function delete()
    {
        try {
            $getOrderDetail = $this->getOrderDetailById();
            if ($getOrderDetail['status'] != 'Canceled') {
                $_SESSION['error'] = 'Bạn không thể xóa đơn hàng này.';
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            $this->deleteOrder();
            $_SESSION['success'] = 'Xoá đơn hàng thành công';
            header('location:?act=orders-list');
            exit();
        } catch (\Throwable $th) {
            $_SESSION['error'] = 'Xoá đơn hàng thất bại.';
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
