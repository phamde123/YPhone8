<?php
require_once '../model/User.php';
class ProfileController extends User
{
    public function updateProfile(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update-profile'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }


            if (!isset($_SESSION['user']['user_id'])) {
                $_SESSION['error'] = 'Bạn cần đăng nhập để cập nhật thông tin.';
                header('Location: login.php');
                exit();
            }
            $userId = $_SESSION['user']['user_id'];

            $errors = [];
            if (empty($_POST['name'])) {
                $errors['name'] = 'Vui lòng nhập tên';
            }
            if (empty($_POST['email'])) {
                $errors['email'] = 'Vui lòng nhập email';
            }
            if (empty($_POST['phone'])) {
                $errors['phone'] = 'Vui lòng nhập số điện thoại';
            }
            if (empty($_POST['address'])) {
                $errors['address'] = 'Vui lòng nhập địa chỉ';
            }
            if (empty($_POST['gender'])) {
                $errors['gender'] = 'Vui lòng nhập giới tính';
            }

            $_SESSION['errors'] = $errors;
            if (count($errors) > 0) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            $user = $this->updateUser($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['gender']);

            if ($user) {
                $_SESSION['user'] = $this->getUserById($userId);
                $_SESSION['success'] = 'Cập nhật thông tin thành công!';
            } else {
                $_SESSION['error'] = 'Cập nhật thất bại, vui lòng thử lại.';
            }

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
