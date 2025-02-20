<?php
require_once '../model/coupon.php';
class CouponAdminController extends Coupon
{
    public function index()
    {
        $coupons = $this->listCoupon();
        include '../view/admin/coupon/list.php';
    }

    public function create()
    {
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['coupon-create'])) {

            $errors = [];
            if (empty($_POST['name'])) {
                $errors['name'] = 'Tên mã giảm giá không được để trống';
            }
            if (empty($_POST['coupon_code'])) {
                $errors['coupon_code'] = 'Mã giảm giá không được để trống';
            }
            if (empty($_POST['type'])) {
                $errors['type'] = 'Loại mã giảm giá không được để trống';
            }
            if (empty($_POST['star_date']) && $_POST['star_date'] < date('Y-m-d')) {
                $errors['star_date'] = 'Ngày bắt đầu không được để trống và phải lớn hơn ngày hiện tại';
            }
            if (empty($_POST['end_date']) && !empty($_POST['star_date']) && $_POST['end_date'] < $_POST['star_date']) {
                $errors['end_date'] = 'Ngày kết thúc không được để trống và phải lớn hơn ngày bắt đầu';
            }
            if (empty($_POST['quantity'])) {
                $errors['quantity'] = 'Số lượng không được để trống';
            }
            if (empty($_POST['status'])) {
                $errors['status'] = 'Trạng thái không được để trống';
            }
            if (empty($_POST['coupon_value'])) {
                $errors['coupon_value'] = 'Giá trị mã giảm giá không được để trống';
            }

            $_SESSION['errors'] = $errors;
            if (count($errors) > 0) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }


            $coupons = $this->addCoupon(
                $_POST['name'],
                $_POST['coupon_code'],
                $_POST['type'],
                $_POST['star_date'],
                $_POST['end_date'],
                $_POST['quantity'],
                $_POST['status'],
                $_POST['coupon_value']
            );
            if ($coupons) {
                $_SESSION['success'] = 'Thêm mã giảm giá thành công';
                header('Location: ?act=coupon');
                exit();
            } else {
                $_SESSION['error'] = 'Thêm mã giảm giá thất bại';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        include '../view/admin/coupon/add.php';
    }

    public function edit()
    {
        $coupon = $this->editCoupon();
        // echo '<pre>';
        // print_r($coupon);
        // echo '</pre>';
        include '../view/admin/coupon/edit.php';
    }
    public function update()
    {
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['coupon-update'])) {

            $errors = [];
            if (empty($_POST['name'])) {
                $errors['name'] = 'Tên mã giảm giá không được để trống';
            }
            if (empty($_POST['coupon_code'])) {
                $errors['coupon_code'] = 'Mã giảm giá không được để trống';
            }
            if (empty($_POST['type'])) {
                $errors['type'] = 'Loại mã giảm giá không được để trống';
            }
            if (empty($_POST['star_date']) && $_POST['star_date'] < date('Y-m-d')) {
                $errors['star_date'] = 'Ngày bắt đầu không được để trống và phải lớn hơn ngày hiện tại';
            }
            if (empty($_POST['end_date']) && !empty($_POST['star_date']) && $_POST['end_date'] < $_POST['star_date']) {
                $errors['end_date'] = 'Ngày kết thúc không được để trống và phải lớn hơn ngày bắt đầu';
            }
            if (empty($_POST['quantity'])) {
                $errors['quantity'] = 'Số lượng không được để trống';
            }
            if (empty($_POST['status'])) {
                $errors['status'] = 'Trạng thái không được để trống';
            }
            if (empty($_POST['coupon_value'])) {
                $errors['coupon_value'] = 'Giá trị mã giảm giá không được để trống';
            }

            $_SESSION['errors'] = $errors;
            if (count($errors) > 0) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            $coupons = $this->updateCoupon(
                $_POST['name'],
                $_POST['coupon_code'],
                $_POST['type'],
                $_POST['star_date'],
                $_POST['end_date'],
                $_POST['quantity'],
                $_POST['status'],
                $_POST['coupon_value']
            );
            if ($coupons) {
                $_SESSION['success'] = 'Cập nhật mã giảm giá thành công';
                header('Location: ?act=coupon');
                exit();
            } else {
                $_SESSION['error'] = 'Cập nhật mã giảm giá thất bại';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function delete()
    {
        $coupons = $this->deleteCoupon();
        if ($coupons) {
            $_SESSION['success'] = 'Xóa mã giảm giá thành công';
            header('Location: ?act=coupon');
            exit();
        } else {
            $_SESSION['error'] = 'Xóa mã giảm giá thất bại';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
