<?php include '../view/admin/layout/header.php'; ?>
<div class="page-content">

    <!-- Start Container Fluid -->
    <div class="container-xxl">
        <form action="?act=product_store" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-12 col-lg-8 ">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Thêm ảnh sản phẩm</h4>
                        </div>
                        <div class="card-body">
                            <input type="file" name="gallery_image[]" id="" class="form-control" multiple>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Thông tin sản phẩm </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="product_name" class="form-label">Tên sản phẩm</label>
                                        <input type="text" id="product_name" class="form-control" name="name" onkeyup="ChangeToSlug();"
                                            placeholder="Nhập tên sản phẩm">
                                    </div>
                                    <?php if (isset($_SESSION['errors']['name'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['name'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-6">
                                    <label for="product-categories" class="form-label">Danh mục</label>
                                    <select class="form-control" id="product-categories" data-choices data-choices-groups
                                        data-placeholder="Chọn danh mục" name="cate_id">
                                        <?php foreach ($listCategory as $cate) { ?>
                                            <option value="<?= $cate['cate_id'] ?>"><?= $cate['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                    <label class="form-label">Ảnh sản phẩm</label>
                                        <input type="file" name="product_image" id="" class="form-control">
                                    </div>
                                    <?php if (isset($_SESSION['errors']['product_image'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['product_image'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                    <label class="form-label">Đường dẫn</label>
                                        <input type="text" name="slug" id="slug" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="product-name" class="form-label">Giá sản phẩm</label>
                                        <input type="text" id="product-name" class="form-control" name="price"
                                            placeholder="Nhập giá sản phẩm">
                                    </div>
                                    <?php if (isset($_SESSION['errors']['price'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['price'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="product-name" class="form-label">Giá khuyến mãi</label>
                                        <input type="text" id="product-name" class="form-control" name="sale_price"
                                            placeholder="Nhập giá khuyến mãi sản phẩm">
                                    </div>
                                    <?php if (isset($_SESSION['errors']['sale_price'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['sale_price'] ?></p>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- Biến thể sản phẩm -->
                            <div id="variants">
                                <div class="row mb-4 border rounded px-3">
                                    <div class="col-lg-4">
                                        <div class="mt-3">
                                            <h5 class="text-dark fw-medium">Kích thước :</h5>
                                            <div class="d-flex flex-wrap gap-2" role="group"
                                                aria-label="Basic checkbox toggle button group">
                                                <?php foreach ($listSize as $size) { ?>
                                                    <input type="checkbox" class="btn-check" id="size-xs1-<?= $size['var_size_id'] ?>" name="variant_size[]" value="<?= $size['var_size_id'] ?>">
                                                    <label
                                                        class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" style="width: 50px;"
                                                        for="size-xs1-<?= $size['var_size_id'] ?>"><?= $size['name'] ?></label>
                                                <?php } ?>
                                            </div>
                                            <?php if (isset($_SESSION['errors']['variant_size'])) { ?>
                                                <p class="text-danger"><?= $_SESSION['errors']['variant_size'] ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="mt-3">
                                            <h5 class="text-dark fw-medium">Màu sắc :</h5>
                                            <div class="d-flex flex-wrap gap-2" role="group"
                                                aria-label="Basic checkbox toggle button group">
                                                <?php foreach ($listColor as $color) { ?>
                                                    <input type="checkbox" class="btn-check" id="color-<?= $color['var_color_id'] ?>" name="variant_color[]" value="<?= $color['var_color_id'] ?>">
                                                    <label
                                                        class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                        for="color-<?= $color['var_color_id'] ?>"> <i class="bx bxs-circle fs-18" style="color: <?= $color['code'] ?>;"></i></label>
                                                <?php } ?>
                                            </div>
                                            <?php if (isset($_SESSION['errors']['variant_coller'])) { ?>
                                                <p class="text-danger"><?= $_SESSION['errors']['variant_coller'] ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mt-3 mb-3">
                                            <label for="variant_sale_price" class="form-label">Giá biến thể</label>
                                            <input type="text" id="variant_price" class="form-control" name="variant_price[]"
                                                placeholder="Nhập giá sản phẩm">
                                        </div>
                                        <?php if (isset($_SESSION['errors']['variant_price'])) { ?>
                                            <?php foreach ($_SESSION['errors']['variant_price'] as $variant_price) { ?>
                                                <p class="text-danger"><?= $variant_price ?></p>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mt-3  mb-3">
                                            <label for="variant_sale_price" class="form-label">Giá khuyến mãi biến thể</label>
                                            <input type="text" id="variant_sale_price" class="form-control" name="variant_sale_price[]"
                                                placeholder="Nhập giá khuyến mãi sản phẩm">
                                        </div>
                                        <?php if (isset($_SESSION['errors']['variant_sale_price'])) { ?>
                                            <?php foreach ($_SESSION['errors']['variant_sale_price'] as $variant_sale_price) { ?>
                                                <p class="text-danger"><?= $variant_sale_price ?></p>
                                            <?php } ?>
                                        <?php } ?>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mt-3  mb-3">
                                            <label for="variant_quantity" class="form-label">Số lượng</label>
                                            <input type="text" id="variant_quantity" class="form-control" name="variant_quantity[]"
                                                placeholder="Nhập giá khuyến mãi sản phẩm">
                                        </div>
                                        <?php if (isset($_SESSION['errors']['variant_quantity'])) { ?>
                                            <?php foreach ($_SESSION['errors']['variant_quantity'] as $variant_quantity) { ?>
                                                <p class="text-danger"><?= $variant_quantity ?></p>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                            <div class="rounded">
                                <div class="row justify-content-end g-2">
                                    <div class="col-lg-2">
                                        <button type="button" id="add-variant" class="btn btn-primary w-100">Thêm biến thể</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea class="form-control bg-light-subtle" id="description" rows="7" name="description" placeholder="Nhập mô tả của sản phẩm"></textarea>
                                    </div>
                                    <?php if (isset($_SESSION['errors']['description'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['description'] ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-end g-2">
                            <div class="col-lg-2">
                                <button type="submit" name="add_products" class="btn btn-outline-secondary w-100">Thêm mới sản phẩm</button>
                            </div>
                            <div class="col-lg-2">
                                <a href="?act=product" class="btn btn-primary w-100">Quay lại</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <!-- End Container Fluid -->
</div>
<script>
    document.getElementById('add-variant').addEventListener('click', function() {
        const container = document.getElementById('variants');
        const newVariant = document.createElement('div'); //tạo thẻ div mới
        newVariant.innerHTML = `
            <div class="row mb-4 border rounded px-3">
                                <div class="col-lg-4">
                                    <div class="mt-3">
                                            <h5 class="text-dark fw-medium">Kích thước :</h5>
                                            <div class="d-flex flex-wrap gap-2" role="group"
                                                aria-label="Basic checkbox toggle button group">
                                                <?php foreach ($listSize as $size) { ?>
                                                    <input type="checkbox" class="btn-check" id="size-<?= $size['var_size_id'] ?>-${container.children.length}" name="variant_size[]" value="<?= $size['var_size_id'] ?>">
                                                    <label
                                                        class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center" style="width: 50px;"
                                                        for="size-<?= $size['var_size_id'] ?>-${container.children.length}"><?= $size['name'] ?></label>
                                                <?php } ?>
                                            </div>
                                            <?php if (isset($_SESSION['errors']['variant_size'])) { ?>
                                                <p class="text-danger"><?= $_SESSION['errors']['variant_size'] ?></p>
                                            <?php } ?>
                                        </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="mt-3">
                                        <h5 class="text-dark fw-medium">Màu sắc :</h5>
                                        <div class="d-flex flex-wrap gap-2" role="group"
                                            aria-label="Basic checkbox toggle button group">
                                             <?php foreach ($listColor as $color) { ?>
                                            <input type="checkbox" class="btn-check" id="color-<?= $color['var_color_id'] ?>-${container.children.length}" value="<?= $color['var_color_id'] ?>" name="variant_color[]">
                                            <label
                                                class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                for="color-<?= $color['var_color_id'] ?>-${container.children.length}"> <i class="bx bxs-circle fs-18"  style="color: <?= $color['code'] ?>;"></i></label>
                                                <?php } ?>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mt-3 mb-3">
                                        <label for="variant_price" class="form-label">Giá biến thể</label>
                                        <input type="text" id="variant_price" class="form-control" name="variant_price[]"
                                            placeholder="Nhập giá sản phẩm">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mt-3  mb-3">
                                        <label for="variant_sale_price" class="form-label">Giá khuyến mãi biến thể</label>
                                        <input type="text" id="variant_sale_price" class="form-control" name="variant_sale_price[]"
                                            placeholder="Nhập giá khuyến mãi sản phẩm">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mt-3  mb-3">
                                        <label for="variant_quantity" class="form-label">Số lượng</label>
                                        <input type="text" id="variant_quantity" class="form-control" name="variant_quantity[]"
                                            placeholder="Nhập giá khuyến mãi sản phẩm">
                                    </div>
                                </div>

                            </div>
        `;
        container.appendChild(newVariant); //thêm biến thể vào container
    })
</script>
<?php
unset($_SESSION['errors']);
include '../view/admin/layout/footer.php'; ?>