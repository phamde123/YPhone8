<?php

require_once '../model/product.php';
class ProductAdminController extends Product
{
    public function index()
    {
        $listProduct = $this->listProduct();
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
                    $errors['variant_price'][$key] = 'Vui lòng nhập giá sản phẩm biến thể ' . ($key + 1);
                }
            }
            foreach ($_POST['variant_sale_price'] as $key => $variant_sale_price) {
                if (empty($variant_sale_price)) {
                    $errors['variant_sale_price'][$key] = 'Vui lòng nhập giá khuyến mãi sản phẩm biến thể ' . ($key + 1);
                }
            }
            foreach ($_POST['variant_quantity'] as $key => $variant_quantity) {
                if (empty($variant_quantity)) {
                    $errors['variant_quantity'][$key] = 'Vui lòng nhập số lượng sản phẩm biến thể ' . ($key + 1);
                }
            }

            $_SESSION['errors'] = $errors;
            if ($errors) {
                header('location:?act=product_create');
            }
            $file = $_FILES['product_image'];
            $product_image = uniqid() . '-' . preg_replace('/[^A-Za-z0-9\-_\.]/', '', basename($file['name']));
            if (move_uploaded_file($file['tmp_name'], './images/product/' . $product_image)) {
                $addProduct = $this->addProduct($_POST['name'], $product_image, $_POST['price'], $_POST['sale_price'], $_POST['slug'], $_POST['description'], $_POST['cate_id']);

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
            } else {
                $_SESSION['error'] = 'Thêm sản phẩm thất bại ';
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    public function edit()
    {
        $product = $this->getProductId($_GET['id']);
        $varients = $this->getProductVariantId($_GET['id']);
        $gallery = $this->getProductGalleryId();
        $listCategory = $this->getAllCategory();
        $listColor = $this->getAllColer();
        $listSize = $this->getAllSize();

        include '../view/admin/product/edit.php';
    }

    public function update()
    {
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

        foreach ($_POST['variant_price'] as $key => $variant_price) {
            if (empty($variant_price)) {
                $errors['variant_price'][$key] = 'Vui lòng nhập giá sản phẩm biến thể ' . ($key + 1);
            }
        }
        foreach ($_POST['variant_sale_price'] as $key => $variant_sale_price) {
            if (empty($variant_sale_price)) {
                $errors['variant_sale_price'][$key] = 'Vui lòng nhập giá khuyến mãi sản phẩm biến thể ' . ($key + 1);
            }
        }
        foreach ($_POST['variant_quantity'] as $key => $variant_quantity) {
            if (empty($variant_quantity)) {
                $errors['variant_quantity'][$key] = 'Vui lòng nhập số lượng sản phẩm biến thể ' . ($key + 1);
            }
        }

        $_SESSION['errors'] = $errors;
        if (count($errors) > 0) {
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_product'])) {


            $file = $_FILES['product_image'];
            $product_image = uniqid() . '-' . preg_replace('/[^A-Za-z0-9\-_\.]/', '', basename($file['name']));
            if ($file['size'] > 0) {
                if (move_uploaded_file($file['tmp_name'], './images/product/' . $product_image)) {
                    if (isset($_POST['old_image']) && file_exists('./images/product/' . $_POST['old_image'])) {
                        unlink('./images/product/' . $_POST['old_image']);
                    }
                }
            } else {
                $product_image = $_POST['pro_old_image'];
            }

            $updateProduct = $this->updateProduct($_POST['pro_id'], $_POST['name'], $product_image, $_POST['price'], $_POST['sale_price'], $_POST['slug'], $_POST['description'], $_POST['cate_id']);
            if ($updateProduct) {
                $product_id = $_POST['pro_id'];
                if (isset($_POST['variant_size']) && isset($_POST['variant_color'])) {
                    foreach ($_POST['variant_size'] as $key => $size) {
                        if (isset($_POST['variant_id'][$key]) && !empty($_POST['variant_id'][$key])) {
                            $this->updateProductVariant(
                                $_POST['variant_id'][$key],
                                $_POST['variant_price'][$key],
                                $_POST['variant_sale_price'][$key],
                                $_POST['variant_quantity'][$key],
                                $product_id,
                                $_POST['variant_color'][$key],
                                $size,
                            );
                        } else {
                            $addProductVariant = $this->addProductVariants(
                                $_POST['variant_price'][$key],
                                $_POST['variant_sale_price'][$key],
                                $_POST['variant_quantity'][$key],
                                $product_id,
                                $_POST['variant_color'][$key],
                                $_POST['variant_size'][$key]
                            );
                        }
                    }
                }

                if (!empty($_FILES['gallery_image']['name'][0])) {
                    $file = $_FILES['gallery_image'];
                    for ($i = 0; $i < count($file['name']); $i++) {
                        $fileName = basename($file['name'][$i]);
                        $imageArray = uniqid() . '-' . preg_replace('/[^A-Za-z0-9\-_\.]+/', '-', basename($fileName));
                        move_uploaded_file($file['tmp_name'][$i], 'images/gallery_product/' . $imageArray);
                        $this->addGallery($_GET['id'], $imageArray);
                    }
                } else {
                    $imageArray = $_POST['old_gallery_image'];
                }

                $_SESSION['success'] = 'Cập nhập sản phẩm thành công';
                header('location:?act=product');
                exit();
            } else {
                $_SESSION['error'] = 'Cập nhập sản phẩm thất bại';
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    public function deleteGallery()
    {
        try {
            $gallery = $this->getProductGalleryId();

            foreach ($gallery as $image) {
                if (file_exists('./images/gallery_product/' . $image['image'])) {
                    unlink('./images/gallery_product/' . $image['image']);
                }
            }
            $this->removeGallery($_GET['id']);
            $_SESSION['success'] = 'Xóa ảnh sản phẩm thành công';
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    public function deleteProductVariant()
    {
        try {
            $this->removeProductVariant($_GET['variant_id']);
            $_SESSION['success'] = 'Xóa biến thể sản phẩm thành công';
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    public function deleteProduct() {
        try {
            $product = $this->getProductId($_GET['id']);
            $galleries = $this->getProductGalleryId();
            foreach ($galleries as $gallery) {
                if (file_exists('./images/gallery_product/' . $gallery['image'])) {
                    unlink('./images/gallery_product/' . $gallery['image']);
                }
            }
            $this->removeProduct();
            unlink('./images/product/' . $product['pro_image']);
            $_SESSION['success'] = "Xóa sản phẩm thành công";
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit();
        } catch (\Throwable $th) {
            $_SESSION['error'] = "Xóa phẩm thất bại.";
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
        
