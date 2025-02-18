<?php
require_once '../connect/connect.php';
class Coupon extends connect
{
    public function listCoupon()
    {
        $sql = "SELECT * FROM coupons";
        $stmt = $this->connect()->query($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCoupon($name, $coupon_code, $type, $star_date, $end_date, $quantity, $status, $coupon_value)
    {
        $sql = "INSERT INTO coupons(name,coupon_code,type,star_date,end_date,quantity,status,coupon_value,created_at,updated_at)
                             VALUES(?,?,?,?,?,?,?,?,now(),now())";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$name, $coupon_code, $type, $star_date, $end_date, $quantity, $status, $coupon_value]);
    }

    public function editCoupon()
    {
        $sql = "SELECT * FROM coupons WHERE cou_id  = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['cou_id']]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCoupon($name, $coupon_code, $type, $star_date, $end_date, $quantity, $status, $coupon_value)
    {
        $sql = "UPDATE coupons SET name = ?,coupon_code = ?,type = ?,star_date = ?,end_date = ?,quantity = ?,status = ?,coupon_value = ?,updated_at = now() WHERE cou_id = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$name, $coupon_code, $type, $star_date, $end_date, $quantity, $status, $coupon_value, $_GET['cou_id']]);
    }

    public function deleteCoupon()
    {
        $sql = "DELETE FROM coupons WHERE cou_id = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$_GET['cou_id']]);
    }
}
