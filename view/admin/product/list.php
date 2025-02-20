<?php include '../view/admin/layout/header.php'; ?>
<div class="page-content">

    <!-- Start Container Fluid -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">Danh sách sản phẩm</h4>

                        <a href="index.php?act=product_create" class="btn btn-sm btn-primary">
                            Thêm mới
                        </a>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check ms-1">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1"></label>
                                            </div>
                                        </th>
                                        <th>Tên sản phẩm và biến thể</th>
                                        <th>Giá sản phẩm</th>
                                        <th>Giá khuyến mãi</th>
                                        <th>Danh mục</th>
                                        <th>Hành dộng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listProduct as $product) { ?>

                                        <tr>
                                            <td>
                                                <div class="form-check ms-1">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                        <img src="./images/product/<?= $product['pro_image'] ?>" alt="" class="avatar-md">
                                                    </div>
                                                    <div>
                                                        <a href="#!" class="text-dark fw-medium fs-15"><?= $product['pro_name'] ?></a>
                                                        <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span>
                                                            <?php foreach ($product['variant'] as $size) { ?>
                                                                <span><?= $size['var_size'] ?></span>
                                                            <?php } ?>
                                                        </p>
                                                        <p class="text-muted mb-0 mt-1 fs-13"><span>Color : </span>
                                                            <?php foreach ($product['variant'] as $color) { ?>
                                                                <span><?= $color['var_color'] ?></span>
                                                            <?php } ?>
                                                        </p>
                                                    </div>
                                                </div>

                                            </td>
                                            <td><?= number_format($product['pro_price'] * 1000,0,',','.') ?> đ</td>
                                            <td><?= number_format($product['pro_sale_price'] * 1000,0,',','.') ?> đ</td>

                                            <td><?= $product['cate_name'] ?></td>
                                            
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="?act=product_edit&id=<?= $product['pro_id'] ?>" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                    <a href="?act=product_delete&id=<?= $product['pro_id'] ?>" onclick="return confirm('Bạn có muốn xóa sản phẩm không?')" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php    } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                    <div class="card-footer border-top">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- End Container Fluid -->

    <!-- ========== Footer Start ========== -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> &copy; Larkon. Crafted by <iconify-icon icon="iconamoon:heart-duotone" class="fs-18 align-middle text-danger"></iconify-icon> <a
                        href="https://1.envato.market/techzaa" class="fw-bold footer-text" target="_blank">Techzaa</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- ========== Footer End ========== -->

</div>
<?php include '../view/admin/layout/footer.php'; ?>