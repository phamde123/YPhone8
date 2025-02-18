<?php include '../view/admin/layout/header.php'; ?>

<div class="page-content">

    <!-- Start Container Fluid -->
    <div class="container-xxl">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Danh sách mã giảm giá</h4>
                        </div>
                        <div class="dropdown">
                            <a href="index.php?act=coupon-create" class="btn btn-primary">Create Coupon</a>
                            <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light rounded" data-bs-toggle="dropdown" aria-expanded="false">
                                This Month
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Download</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Export</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Import</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1"></label>
                                            </div>
                                        </th>
                                        <th>Tên mã giảm giá</th>
                                        <th>Giá Giảm</th>
                                        <th>Mã giảm giá</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($coupons as $coupon) : ?>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td><?= $coupon['name'] ?></td>
                                            <?php if ($coupon['type'] == 'Percentage') : ?>
                                                <td><?= $coupon['coupon_value'] ?>%</td>
                                            <?php elseif ($coupon['type'] == 'Fixed Amount') : ?>
                                                <td>$<?= $coupon['coupon_value'] ?></td>
                                            <?php endif; ?>
                                            <td><?= $coupon['coupon_code'] ?></td>
                                            <td><?= $coupon['star_date'] ?></td>
                                            <td><?= $coupon['end_date'] ?></td>
                                            <?php if ($coupon['status'] == 'Active') : ?>
                                                <td>
                                                    <span class="badge text-success bg-success-subtle fs-12"><i class="bx bx-check-double"></i><?= $coupon['status'] ?></span>
                                                </td>
                                            <?php elseif ($coupon['status'] == 'Hidden') : ?>
                                                <td>
                                                    <span class="badge text-warning bg-success-subtle fs-12"><i class="bx bx-x"></i><?= $coupon['status'] ?></span>
                                                </td>
                                            <?php elseif ($coupon['status'] == 'FuturePplan') : ?>
                                                <td>
                                                    <span class="badge text-dark bg-success-subtle fs-12"><i class="bx"></i><?= $coupon['status'] ?></span>
                                                </td>
                                            <?php endif; ?>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="#!" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                                    <a href="index.php?act=coupon-edit&cou_id=<?= $coupon['cou_id'] ?>" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                    <a onclick="return confirm('Xóa à?')" href="index.php?act=coupon-delete&cou_id=<?= $coupon['cou_id'] ?>" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

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