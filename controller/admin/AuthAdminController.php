<?php
require_once "../model/User.php";
class AuthAdminController extends User
{
    public function isAdmin(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1;
    }

    public function middleware(): bool
    {
        if (!$this->isAdmin()) {
            $_SESSION['error'] = "Bạn không có quyền đăng nhập. Vui lòng đăng nhập";
            header('Location: ?act=auth');
            exit();
        } else {
            return true;
        }
    }

    public function singin(): void
    {
        if (
            $_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['auth'])
        ) {
            $errors = [];
            if (empty($_POST['email'])) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($_POST['password'])) {
                $errors['password'] = 'password không được để trống';
            }


            $_SESSION['errors'] = $errors;

            if (count(value: $errors) > 0) {
                header('Location: ?act=auth');
                exit();
            }

            $auth = $this->auth(email: $_POST['email'], password: $_POST['password']);
            if ($auth) {
                $_SESSION['user'] = $auth;
                $_SESSION['success'] = "Đăng nhập thành công";
                header('Location: ?act=admin');
                exit();
            } else {
                $_SESSION['error'] = 'Bạn không có quyền truy cập !';
                header('Location: ?act=index');
                exit();
            }
        }
        include '../view/admin/auth/login.php';
    }
}
