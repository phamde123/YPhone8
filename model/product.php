<?php

require_once '../connect/connect.php';
class Product extends connect
{
    public function getAllColer()
    {
        $sql = 'SELECT * FROM `variant_color`';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllSize()
    {
        $sql = 'SELECT * FROM `variant_size`';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllCategory()
    {
        $sql = "SELECT * FROM `categories`";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProduct($name, $image, $price, $sale_price, $slug, $description, $cate_id)
    {
        $sql = 'insert into products (name,image,price,sale_price,slug,description,cate_id) value (?,?,?,?,?,?,?)';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$name, $image, $price, $sale_price, $slug, $description, $cate_id]);
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

    public function listProduct()
    {
        $sql = "select 
        products.pro_id as pro_id,
        products.name as pro_name,
        products.price as pro_price,
        products.sale_price as pro_sale_price,
        products.image as pro_image,
        categories.cate_id as cate_id,
        categories.name as cate_name,
        product_variants.var_id as var_id,
        variant_color.name as  var_color_name,
        variant_size.name as  var_size_name

        from products

        left join categories on products.cate_id = categories.cate_id
        left join product_variants on products.pro_id = product_variants.pro_id
        left join variant_color on product_variants.var_color_id = variant_color.var_color_id
        left join variant_size on product_variants.var_size_id = variant_size.var_size_id
        ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $listProduct = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $groupedProduct = [];
        foreach ($listProduct as $product) {
            if (!isset($groupedProduct[$product['pro_id']])) {
                $groupedProduct[$product['pro_id']] = $product;
                $groupedProduct[$product['pro_id']]['variant'] = [];
            }
            $groupedProduct[$product['pro_id']]['variant'][] = [
                'pro_id' => $product['pro_id'],
                'var_color' => $product['var_color_name'],
                'var_size' => $product['var_size_name']
            ];
        }
        return $groupedProduct;
    }

    public function getProductId($pro_id)
    {
        $sql = 'select 
        products.pro_id as pro_id,
        products.name as pro_name,
        products.price as pro_price,
        products.sale_price as pro_sale_price,
        products.image as pro_image,
        products.description as pro_description,
        products.slug as pro_slug,
        categories.cate_id as cate_id

        from products 

        left join categories on products.cate_id = categories.cate_id
        where products.pro_id = ?
        ';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$pro_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductVariantId($pro_id)
    {
        $sql = 'select
        product_variants.var_id as var_id,
        product_variants.price as var_price,
        product_variants.sale_price as var_sale_price,
        product_variants.var_quantity as var_quantity,
        variant_color.var_color_id  as  var_color_id,
        variant_color.name as  var_color_name,
        variant_size.var_size_id  as  var_size_id,
         variant_size.name as  var_size_name

        from  product_variants
        left join variant_color on product_variants.var_color_id = variant_color.var_color_id
        left join variant_size on product_variants.var_size_id = variant_size.var_size_id
        where product_variants.pro_id = ?
        ';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$pro_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductGalleryId()
    {
        $sql = "select * from product_galleries where pro_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateProduct($pro_id, $name, $image, $price, $sale_price, $slug, $description, $cate_id)
    {
        $sql = "update products set name=?, image=?,price=?,sale_price=?,slug=?,description=?,cate_id=?  where pro_id=?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$name, $image, $price, $sale_price, $slug, $description, $cate_id, $pro_id]);
    }

    public function updateProductVariant($var_id, $price, $sale_price, $var_quantity, $pro_id, $var_color_id, $var_size_id)
    {
        $sql = "update product_variants set price=?,sale_price=?,var_quantity=?,pro_id=?,var_color_id=?,var_size_id=? where var_id=?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$price, $sale_price, $var_quantity, $pro_id, $var_color_id, $var_size_id, $var_id]);
    }

    public function removeGallery(){
        $sql = 'delete from product_galleries where pro_id = ?';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$_GET['id']]);
    } 

    public function removeProductVariant(){
        $sql = 'delete from product_variants where var_id = ?';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$_GET['variant_id']]);
    }

    public function removeProduct(){
        $sql = 'delete from products where pro_id = ?';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$_GET['id']]);
    }
    

}
