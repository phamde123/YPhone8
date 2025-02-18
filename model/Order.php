<?php

require_once '../connect/connect.php';
class Order extends connect{

    public function addOrder($pro_id,$var_id,$detail_id,$quantity){
        $sql = 'insert into orders (user_id,pro_id,var_id,detail_id,quantity,created_at,updated_at) values (?,?,?,?,?,now(),now())';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$_SESSION['user']['user_id'],$pro_id,$var_id,$detail_id,$quantity]);
    }

    public function addOrderDetail($name,$email,$phone,$address,$amount,$note,$ship_id,$cou_id,$payment){
        $sql = 'insert into order_details (name,email,phone,address,amount,note,user_id,ship_id,cou_id,payment,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?,now(),now())';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$name,$email,$phone,$address,$amount,$note,$_SESSION['user']['user_id'],$ship_id,$cou_id,$payment]);
    }

    public function getLastInsertId() {
        return $this->connect()->lastInsertId();
    }
    

}