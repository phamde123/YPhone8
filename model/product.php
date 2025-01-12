<?php

require_once '../connect/connect.php';
class Product extends connect{
    public function getAllColer(){
        $sql = 'SELECT * FROM `variant_color`';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllSize(){
        $sql = 'SELECT * FROM `variant_size`';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllCategory(){
        $sql = "SELECT * FROM `categories`";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function addProduct($name,$image,$price,$sale_price,$slug,$description,$cate_id){
        $sql = 'insert into products (name,image,price,sale_price,slug,description,cate_id) value (?,?,?,?,?,?,?)';
        $stmt= $this->connect()->prepare($sql);
        return $stmt->execute([$name,$image,$price,$sale_price,$slug,$description,$cate_id]);
    }
    public function addGallery($pro_id, $image)
    {
        $sql = 'insert into product_galleries(pro_id ,image) value(?,?)';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$pro_id, $image]);
    }
    public function addProductVariants($price, $sale_price, $var_quantity, $pro_id, $var_color_id, $var_size_id)
    {
        $sql = 'insert into product_variants(price,sale_price,var_quantity,pro_id,var_color_id,var_size_id,created_at,updated_at) value(?,?,?,?,?,?,now(),now())'; //noW()->lấy thời gian hiện tại
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$price, $sale_price, $var_quantity, $pro_id, $var_color_id, $var_size_id]);
    }

    public function getLastInsertId()
    {
        //Lấy id sản phẩm vừa thêm
        return $this->connect()->lastInsertId();
    }

}