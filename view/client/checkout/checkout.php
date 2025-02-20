<?php include '../view/client/layout/header.php'; ?>
<main>

    <!-- breadcrumb area start -->
    <section class="breadcrumb__area include-bg pt-95 pb-50" data-bg-color="#EFF1F5">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content p-relative z-index-1">
                        <h3 class="breadcrumb__title">Checkout</h3>
                        <div class="breadcrumb__list">
                            <span><a href="#">Home</a></span>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- checkout area start -->
    <section class="tp-checkout-area pb-120" data-bg-color="#EFF1F5">
        <form action="?act=order" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="tp-checkout-bill-area">
                            <h3 class="tp-checkout-bill-title">Billing Details</h3>

                            <div class="tp-checkout-bill-form">
                                <form action="#">
                                    <div class="tp-checkout-bill-inner">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Họ và Tên <span>*</span></label>
                                                    <input type="text" name="name" value="<?= $user['name'] ?>" placeholder="Name">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Địa chỉ</label>
                                                    <input type="text" name="address" value="<?= $user['address'] ?>" placeholder="Đại chỉ">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Số điện thoại </label>
                                                    <input type="text" name="phone" value="<?= $user['phone'] ?>" placeholder="Số điện thoại">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Email</label>
                                                    <input type="email" placeholder="Email" name="email" value="<?= $user['email'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tp-checkout-input">
                                                    <label>Ghi chú</label>
                                                    <textarea name="note" id="" placeholder="Ghi chú"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- checkout place order -->
                        <div class="tp-checkout-place white-bg">
                            <h3 class="tp-checkout-place-title">Your Order</h3>

                            <div class="tp-order-info-list">
                                <ul>

                                    <!-- header -->
                                    <li class="tp-order-info-list-header">
                                        <h4>Product</h4>
                                        <h4>Total</h4>
                                    </li>

                                    <!-- item list -->
                                    <?php foreach ($carts as $cart) { ?>
                                        <li class="tp-order-info-list-desc">
                                            <p><?= $cart['pro_name'] ?> <span>x <?= $cart['cart_quantity'] ?></span></p>
                                            <span>$<?= $cart['var_sale_price'] ?></span>
                                        </li>
                                    <?php } ?>
                                    <?php if (!empty($_SESSION['coupon'])) { ?>
                                        <li class="tp-order-info-list-subtotal">
                                            <span>Coupon</span>
                                            <span>- $<?= $_SESSION['totalCoupon'] ?></span>
                                            <input type="hidden" name="cou_id" id="" value="<?= $_SESSION['coupon']['cou_id']?>">
                                        </li>
                                    <?php } ?>


                                    <!-- shipping -->
                                    <li class="tp-order-info-list-shipping">
                                        <span>Shipping</span>
                                        <div class="tp-order-info-list-shipping-item d-flex flex-column align-items-end">
                                            <?php foreach ($ships as    $key => $ship) { ?>
                                                <span>
                                                    <input id="flat_rate_<?= $key + 1 ?>" type="radio" name="shipping" value="<?= $ship['ship_id'] ?>">
                                                    <label for="flat_rate_<?= $key + 1 ?>"><?= $ship['name'] ?> <span>$<?= $ship['price'] ?></span></label>
                                                </span>
                                            <?php } ?>


                                        </div>
                                    </li>
                                    <li class="tp-order-info-list-subtotal">
                                        <span>Total</span>
                                        <span>$<?= $_SESSION['total'] ?></span>
                                        <input type="hidden" name="amount" value="<?= $_SESSION['total'] ?>">
                                    </li>

                                </ul>
                            </div>
                            <div class="tp-checkout-payment">
                                <div class="tp-checkout-payment-item">
                                    <input type="radio" id="back_transfer" name="payment">
                                    <label for="back_transfer" data-bs-toggle="direct-bank-transfer">VNPAY</label>

                                </div>
                                <!-- <div class="tp-checkout-payment-item">
                                    <input type="radio" id="cheque_payment" name="payment">
                                    <label for="cheque_payment">Cheque Payment</label>
                                    <div class="tp-checkout-payment-desc cheque-payment">
                                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div> -->
                                <div class="tp-checkout-payment-item">
                                    <input type="radio" id="cod" name="payment" value="cod">
                                    <label for="cod">COD</label>

                                </div>
                                <!-- <div class="tp-checkout-payment-item paypal-payment">
                                    <input type="radio" id="paypal" name="payment">
                                    <label for="paypal">PayPal <img src="assets/img/icon/payment-option.png" alt=""> <a href="#">What is PayPal?</a></label>
                                </div> -->
                            </div>

                            <div class="tp-checkout-btn-wrapper">
                                <button type="submit" name="order" class="tp-checkout-btn w-100">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- checkout area end -->


</main>

<?php include '../view/client/layout/footer.php'; ?>