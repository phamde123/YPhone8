<?php
require_once '../connect/connect.php';
class User extends connect{
    public function register($name, $email, $password): bool {
        $hash_password = password_hash($password, PASSWORD_DEFAULT); // Mã hóa mật khẩu
        $sql = 'INSERT INTO user(name, email, pass, role_id) VALUES (?, ?, ?, 1)'; // Sửa 'password' thành 'pass'
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$name, $email, $hash_password]);
    }
    

    public function login($email, $password): mixed {
        $sql = 'SELECT * FROM user WHERE email = ?'; // Không cần sửa vì đây là cột 'email'
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();
    
        // Kiểm tra mật khẩu bằng cột 'pass'
        if ($user && password_verify($password, $user['pass'])) {
            return $user;
        }
        return false;
    }
    
}
?>