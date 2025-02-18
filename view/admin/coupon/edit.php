<?php include '../view/admin/layout/header.php'; ?>

<div class="page-content">

    <!-- Start Container Fluid -->
    <div class="container-xxl">
        <form action="?act=coupon-update&cou_id=<?= $coupon['cou_id'] ?>" method="post">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Trạng thái mã giảm giá</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="Hidden" <?= $coupon['status'] == 'Hidden' ? 'checked' : '' ?> id="flexRadioDefault9" checked="">
                                            <label class="form-check-label" for="flexRadioDefault9">
                                                Đã Hết Hạn
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="Active" <?= $coupon['status'] == 'Active' ? 'checked' : '' ?> id="flexRadioDefault10">
                                        <label class="form-check-label" for="flexRadioDefault10">
                                            Đang Hoạt Động
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="FuturePplan" <?= $coupon['status'] == 'FuturePplan' ? 'checked' : '' ?> id="flexRadioDefault11">
                                        <label class="form-check-label" for="flexRadioDefault11">
                                            Kế hoạch tương lai
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($_SESSION['errors']['status'])) { ?>
                                <p class="text-danger"><?= $_SESSION['errors']['status'] ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Lịch Trình</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="start-date" class="form-label text-dark">Ngày bắt đầu</label>
                                <input type="date" id="start-date" class="form-control flatpickr-input active" name="star_date" value="<?= $coupon['star_date'] ?>" placeholder="dd-mm-yyyy">
                            </div>
                            <?php if (isset($_SESSION['errors']['star_date'])) { ?>
                                <p class="text-danger"><?= $_SESSION['errors']['star_date'] ?></p>
                            <?php } ?>
                            <div class="mb-3">
                                <label for="end-date" class="form-label text-dark">Ngày kết thúc</label>
                                <input type="date" id="end-date" class="form-control flatpickr-input active" name="end_date" value="<?= $coupon['end_date'] ?>" placeholder="dd-mm-yyyy">
                            </div>
                            <?php if (isset($_SESSION['errors']['end_date'])) { ?>
                                <p class="text-danger"><?= $_SESSION['errors']['end_date'] ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Thông tin mã giảm giá</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="coupons-code" class="form-label">Tên mã giảm giá</label>
                                        <input type="text" id="coupons-code" name="name" class="form-control" value="<?= $coupon['name'] ?>" placeholder="Tên mã giảm giá">
                                    </div>
                                    <?php if (isset($_SESSION['errors']['name'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['name'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="coupons-limits" class="form-label">Mã giảm</label>
                                        <input type="text" id="coupons-limits" name="coupon_code" class="form-control" value="<?= $coupon['coupon_code'] ?>" placeholder="Mã giảm">
                                    </div>
                                    <?php if (isset($_SESSION['errors']['coupon_code'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['coupon_code'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="coupons-limits" class="form-label">Số lượng</label>
                                        <input type="number" id="coupons-limits" name="quantity" class="form-control" value="<?= $coupon['quantity'] ?>" placeholder="Số lượng">
                                    </div>
                                    <?php if (isset($_SESSION['errors']['quantity'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['quantity'] ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                            <h4 class="card-title mb-3 mt-2">Các loại phiếu giảm giá</h4>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" value="Percentage" <?= $coupon['type'] == 'Percentage' ? 'checked' : '' ?> id="flexRadioDefault13">
                                        <label class="form-check-label" for="flexRadioDefault13">
                                            Giảm phần trăm
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" value="Fixed Amount" <?= $coupon['type'] == 'Fixed Amount' ? 'checked' : '' ?>  id="flexRadioDefault14">
                                        <label class="form-check-label" for="flexRadioDefault14">
                                            Số tiền cố định
                                        </label>
                                    </div>
                                </div>
                                <?php if (isset($_SESSION['errors']['type'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['errors']['type'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <label for="discount-value" class="form-label">Giá trị giảm</label>
                                        <input type="text" id="discount-value" name="coupon_value" class="form-control" value="<?= $coupon['coupon_value'] ?>" placeholder="Nhập giá trị giảm">
                                    </div>
                                    <?php if (isset($_SESSION['errors']['coupon_value'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['coupon_value'] ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-top">
                            <button type="submit" name="coupon-update" class="btn btn-primary">Update Coupon</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Vendor Javascript (Require in all Page) -->
<!--   -->

<?php 
unset($_SESSION['errors']);
include '../view/admin/layout/footer.php'; ?>