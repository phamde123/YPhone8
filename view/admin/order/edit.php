<?php include '../view/admin/layout/header.php'; ?>

<div class="page-content">

    <!-- Start Container -->
    <div class="container-xxl">

        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                    <h4 class="fw-medium text-dark d-flex align-items-center gap-2">#<?= $getOrderDetail['detail_id'] ?> <span class="badge bg-success-subtle text-success  px-2 py-1 fs-13"><?= $getOrderDetail['status'] ?></span></h4>
                                    <p class="mb-0">Order / Order Details / #<?= $getOrderDetail['detail_id'] ?> - <?= date('F d, Y \a\t g:i a', strtotime($getOrderDetail['created_at'])) ?></p>
                                </div>
                                <form action="?act=order-update&detail_id=<?= $getOrderDetail['detail_id'] ?>" method="post">
                                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3 mt-3">
                                        <select name="status" id="" class="form-select order-edit">
                                            <option value="Pending" <?= $getOrderDetail['status'] == 'Pending' ? 'selected' : '' ?>>Chờ xác nhận</option>
                                            <option value="Confirmend" <?= $getOrderDetail['status'] == 'Confirmend' ? 'selected' : '' ?>>Đã xác nhận</option>
                                            <option value="Shipped" <?= $getOrderDetail['status'] == 'Shipped' ? 'selected' : '' ?>>Đang vận chuyển</option>
                                            <option value="Delivered" <?= $getOrderDetail['status'] == 'Delivered' ? 'selected' : '' ?>>Đã giao hàng</option>
                                            <option value="Canceled" <?= $getOrderDetail['status'] == 'Canceled' ? 'selected' : '' ?>>Hủy đơn</option>
                                        </select>
                                        <button type="submit" name="updateOrder" class="btn btn-primary">Cập nhập</b>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thông tin khách hàng</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0 table-hover table-centered">
                                        <thead class="bg-light-subtle border-bottom">
                                            <tr>
                                                <th>Họ và Tên</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Địa chỉ</th>
                                                <th>Ghi chú</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div>
                                                            <a href="#!" class="text-dark fw-medium fs-15"><?= $getOrderDetail['name'] ?></a>
                                                        </div>
                                                    </div>

                                                </td>

                                                <!-- <td>
                                                        <span class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Ready</span>
                                                    </td> -->
                                                <td> <?= $getOrderDetail['email'] ?></td>
                                                <td><?= $getOrderDetail['phone'] ?></td>
                                                <td><?= $getOrderDetail['address'] ?></td>
                                                <td>    <?= $getOrderDetail['note'] ?></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Sản phẩm</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0 table-hover table-centered">
                                        <thead class="bg-light-subtle border-bottom">
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>số lượng</th>
                                                <th>Giá</th>
                                                <th>Tổng tiền</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($getOrder as $order) { ?>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                <img src="./images/product/<?= $order['pro_image'] ?>" alt="" class="avatar-md">
                                                            </div>
                                                            <div>
                                                                <a href="#!" class="text-dark fw-medium fs-15"><?= $order['pro_name'] ?></a>
                                                                <p class="text-muted mb-0 mt-1 fs-13"><span><?= $order['variant_size_name'] ?></span></p>
                                                                <p class="text-muted mb-0 mt-1 fs-13"><span><?= $order['variant_color_name'] ?></span></p>
                                                            </div>
                                                        </div>

                                                    </td>

                                                    <!-- <td>
                                                        <span class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Ready</span>
                                                    </td> -->
                                                    <td> <?= $order['quantity'] ?></td>
                                                    <td>$<?= $order['var_sale_price'] ?></td>
                                                    <td>$<?= $order['var_sale_price'] * $order['quantity'] ?></td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tóm tắt đơn hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon icon="solar:clipboard-text-broken"></iconify-icon>Tổng tiền : </p>
                                        </td>
                                        <td class="text-end text-dark fw-medium px-0">$<?= $getOrderDetail['amount'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon icon="solar:ticket-broken" class="align-middle"></iconify-icon> Giảm giá : </p>
                                        </td>
                                        <td class="text-end text-dark fw-medium px-0">- $<?= $handleCoupon ?></td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon icon="solar:kick-scooter-broken" class="align-middle"></iconify-icon>Phí giao hàng : </p>
                                        </td>
                                        <td class="text-end text-dark fw-medium px-0">$<?= $ship['price'] ?></td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between bg-light-subtle">
                        <div>
                            <p class="fw-medium text-dark mb-0">Thành tiền</p>
                        </div>
                        <div>
                            <p class="fw-medium text-dark mb-0">$<?= $getOrderDetail['amount'] - $handleCoupon + $ship['price'] ?></p>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

</div>

<?php include '../view/admin/layout/footer.php'; ?>