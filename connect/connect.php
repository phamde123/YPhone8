<?php

class connect
{
    private $conn;
    public function connect()
    {
        if ($this->conn === null) {
            $serverName = 'localhost';
            $userName = 'root';
            $password = '';
            $myDB = 'duanmot';
            try {
                // Tạo kết nối PDO và lưu vào thuộc tính
                $this->conn = new PDO("mysql:host=$serverName;dbname=$myDB", $userName, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\Throwable $th) {
                // Xử lý lỗi và đưa ra thông báo cụ thể
                echo 'Kết nối thất bại: ' . $th->getMessage();
                return null;
            }
        }
        return $this->conn;
    }
}
