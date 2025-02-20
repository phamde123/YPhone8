<?php
require_once '../connect/connect.php';

class User extends connect
{
    public function register($name, $email, $password): bool
    {
        $hash_password = password_hash($password, PASSWORD_DEFAULT); // Mã hóa mật khẩu
        $sql = 'INSERT INTO user(name, email, pass, role_id) VALUES (?, ?, ?, 1)'; // Sửa 'password' thành 'pass'
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$name, $email, $hash_password]);
    }

    public function login($email, $password): mixed
    {
        $sql = 'SELECT * FROM user WHERE email = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['pass'])) {
            return $user;
        }
        return false;
    }

    public function updateUser($name, $email, $phone, $address, $gender): bool
    {
        $sql = 'UPDATE user SET name=?, email=?, phone=?, address=?, gender=? WHERE user_id=?';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$name, $email, $phone, $address, $gender, $_SESSION['user']['user_id']]);
    }

    public function getUserById($id): mixed
    {
        $sql = 'SELECT * FROM user WHERE user_id = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($newPassword): bool
    {
        $hash_password = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = 'UPDATE user SET pass=? WHERE user_id=?'; // Sửa 'password' thành 'pass' (nếu đúng tên cột)
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$hash_password, $_SESSION['user']['user_id']]);
    }

    public function getPassword(): mixed
    {
        $sql = 'select pass from user where user_id = ?';
        $stmt = $this->connect()->prepare(query: $sql);
        $stmt->execute(params: [$_SESSION['user']['user_id']]);
        return $stmt->fetchColumn();
    }
}
