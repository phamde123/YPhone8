<?php

class connect{
    public function connect(){
        $serverName='localhost';
        $userName='root';
        $passWord='';
        $dbName='duanmot';

        try {
        $conn = new PDO("mysql:host=$serverName;dbname=$dbName",$userName,$passWord);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $conn;
        } catch (\Throwable $th) {
            echo "Kết nối thất bại".$th->getMessage();
            return null;
        }
    }
}