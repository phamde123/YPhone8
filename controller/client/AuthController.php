<?php
require_once '../model/User.php';

class AuthController extends User
{
    public function registers(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
            $errors = [];
            if (empty($_POST['name'])) {
                $errors['name'] = 'Vui lòng nhập tên danh mục';
            }
            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Vui lòng nhập email hợp lệ';
            }
            if (empty($_POST['password']) || strlen($_POST['password']) < 6) {
                $errors['password'] = 'Vui lòng nhập password có ít nhất 6 ký tự';
            }

            $_SESSION['errors'] = $errors; 
            if (count($errors) > 0) {
                header('Location: ?act=register');  
                exit();
            }

            $register = $this->register($_POST['name'], $_POST['email'], $_POST['password']);
            if ($register) {
                $_SESSION['success'] = 'Tạo mới tài khoản thành công! Vui lòng đăng nhập';
                header('Location: ?act=login');
                exit();
            } else {
                $_SESSION['error'] = 'Tạo mới tài khoản không thành công! Vui lòng thử lại';
                $referer = $_SERVER['HTTP_REFERER'] ?? '/'; // Kiểm tra HTTP_REFERER, nếu không có, dùng giá trị mặc định
                header('Location: ' . $referer);
                exit();
            }
        }
        include '../view/client/auth/register.php';
    }
    public function logout(){
        unset($_SESSION['user']);
        include '../view/client/auth/login.php';
    }

    public function sigin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
            $errors = [];
            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Vui lòng nhập email hợp lệ';
            }
            if (empty($_POST['password']) || strlen($_POST['password']) < 6) {
                $errors['password'] = 'Vui lòng nhập password có ít nhất 6 ký tự';
            }

            $_SESSION['errors'] = $errors;
            if (count($errors) > 0) {
                $referer = $_SERVER['HTTP_REFERER'] ?? '/'; // Kiểm tra HTTP_REFERER, nếu không có, dùng giá trị mặc định
                header('Location: ' . $referer);
                exit();
            }

            $login = $this->login($_POST['email'], $_POST['password']);
            if ($login) {
                $_SESSION['user'] = $login; //lưu thông tin người dùng đăng nhập và session
                $_SESSION['success'] = 'Đăng nhập thành công!';
                header('Location: ?act=index');
                exit();
            } else {
                $_SESSION['error'] = 'Đăng nhập thất bại! Vui lòng kiểm tra lại';
                $referer = $_SERVER['HTTP_REFERER'] ?? '/'; // Kiểm tra HTTP_REFERER, nếu không có, dùng giá trị mặc định
                header('Location: ' . $referer);
                exit();
            }
        }
        include '../view/client/auth/login.php';
    }
}
