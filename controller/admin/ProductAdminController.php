<?php

require_once '../modle/product.php';
class ProductAdminController extends Product
{
    public function index()
    {
        include '../view/admin/product/list.php';
    }

    public function create()
    {
        $listColor = $this->getAllColer();
        $listSize = $this->getAllSize();
        $listCategory = $this->getAllCategory();
        include '../view/admin/product/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_products'])) {
            $errors = [];
            if (empty($_POST['name'])) {
                $errors['name'] = 'Vui lòng nhập tên sản phẩm';
            }
            if (empty($_POST['price'])) {
                $errors['price'] = 'Vui lòng nhập giá sản phẩm';
            }
            if (empty($_POST['sale_price'])) {
                $errors['sale_price'] = 'Vui lòng nhập giá khuyến mãi';
            }
            if (empty($_POST['variant_size'])) {
                $errors['variant_size'] = 'Vui lòng chọn kích thước';
            }
            if (empty($_POST['variant_color'])) {
                $errors['variant_coller'] = 'Vui lòng chọn màu';
            }
            if (empty($_POST['variant_price'])) {
                $errors['variant_price'] = 'Vui lòng nhập giá sản phẩm biến thể';
            }
            if (empty($_POST['description'])) {
                $errors['description'] = 'Vui lòng nhập mô tả về sản phẩm';
            }
            if (!isset($_FILES['product_image']) || $_FILES['product_image']['error'] !== UPLOAD_ERR_OK) {
                $errors['product_image'] = 'Vui lòng chọn file ảnh';
            }

            foreach ($_POST['variant_price'] as $key => $variant_price) {
                if (empty($variant_price)) {
                    $errors['variant_price'][$key] = 'Vui lòng nhập giá sản phẩm biến thể '.($key + 1);
                }
            }
            foreach ($_POST['variant_sale_price'] as $key => $variant_sale_price) {
                if (empty($variant_sale_price)) {
                    $errors['variant_sale_price'][$key] = 'Vui lòng nhập giá khuyến mãi sản phẩm biến thể '.($key + 1);
                }
            }
            foreach ($_POST['variant_quantity'] as $key => $variant_quantity) {
                if (empty($variant_quantity)) {
                    $errors['variant_quantity'][$key] = 'Vui lòng nhập số lượng sản phẩm biến thể '.($key + 1);
                }
            }          

            $_SESSION['errors'] = $errors;
            if ($errors) {
                header('location:?act=product_create');
            }
            $file = $_FILES['product_image'];
            $product_image = uniqid().'-'.preg_replace('/[^A-Za-z0-9\-_\.]/','',basename($file['name']));
            if (move_uploaded_file($file['tmp_name'],'./images/product/'. $product_image)) {
                $addProduct = $this->addProduct($_POST['name'],$product_image,$_POST['price'],$_POST['sale_price'],$_POST['slug'],$_POST['description'],$_POST['cate_id']);

                if ($addProduct) {
                    $product_id = $this->getLastInsertId();
                    if (isset($_POST['variant_size']) && isset($_POST['variant_color'])) {
                        foreach ($_POST['variant_size'] as $key => $size) {
                            $addProductVariant = $this->addProductVariants(
                                $_POST['variant_price'][$key],
                                $_POST['variant_sale_price'][$key],
                                $_POST['variant_quantity'][$key],
                                $product_id,
                                $_POST['variant_color'][$key],
                                $size
                            );
                        }
                    }
                    if (!empty($_FILES['gallery_image']['name'][0])) {
                        $file = $_FILES['gallery_image'];
                        for ($i = 0; $i < count($file['name']); $i++) {
                            $fileName = basename($file['name'][$i]);
                            $imageArray = uniqid() . '-' . preg_replace('/[^A-Za-z0-9\-_\.]+/', '-', basename($fileName));
                            move_uploaded_file($file['tmp_name'][$i], 'images/gallery_product/' . $imageArray);
                            $this->addGallery($product_id, $imageArray);
                        }
                    }
                }
                $_SESSION['success'] = 'Thêm sản phẩm thành công';
                header('location:index.php?act=product');
                exit();
            }else{
                $_SESSION['error'] = 'Thêm sản phẩm thất bại ';
                header('location:'.$_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }
}
