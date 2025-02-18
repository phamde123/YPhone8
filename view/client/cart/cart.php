<?php include '../view/client/layout/header.php'; ?>
<main>

   <!-- breadcrumb area start -->
   <section class="breadcrumb__area include-bg pt-95 pb-50">
      <div class="container">
         <div class="row">
            <div class="col-xxl-12">
               <div class="breadcrumb__content p-relative z-index-1">
                  <h3 class="breadcrumb__title">Shopping Cart</h3>
                  <div class="breadcrumb__list">
                     <span><a href="?act=index">Home</a></span>
                     <span>Shopping Cart</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- breadcrumb area end -->

   <!-- cart area start -->
   <section class="tp-cart-area pb-120">
      <div class="container">
         <div class="row">
            <div class="col-xl-9 col-lg-8">
            <form action="?act=update-cart" method="post">
               <div class="tp-cart-list mb-25 mr-30">
                     <table class="table">
                        <thead>
                           <tr>
                              <th colspan="2" class="tp-cart-header-product">Tên sản phẩm</th>
                              <th class="tp-cart-header-price">Giá sản phẩm</th>
                              <th class="tp-cart-header-price">Màu</th>
                              <th class="tp-cart-header-price">Kích thước</th>
                              <th class="tp-cart-header-quantity">Số lượng</th>
                              <th class="tp-cart-header-price"></th>

                           </tr>
                        </thead>
                        <tbody>

                           <?php foreach ($carts as $cart) { ?>
                              <tr>
                                 <!-- img -->
                                 <td class="tp-cart-img"><a href="product-details.html"> <img src="./images/product/<?= $cart['pro_image'] ?>" alt="" width="80px" height="100px"> </a></td>
                                 <!-- title -->
                                 <td class="tp-cart-title"><?= $cart['pro_name'] ?></td>
                                 <!-- price -->
                                 <td class="tp-cart-price"><span>$<?= $cart['var_sale_price'] ?></span></td>
                                 <td><?= $cart['color_name'] ?></td>
                                 <td><?= $cart['size_name'] ?></td>
                                 <!-- quantity -->
                                 <td class="tp-cart-quantity">
                                    <div class="tp-product-quantity mt-10 mb-10">
                                       <span class="tp-cart-minus">
                                          <svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M1 1H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                          </svg>
                                       </span>
                                       <input class="tp-cart-input" type="text" name="cart_quantity[<?= $cart['cart_id'] ?>]" value="<?= $cart['cart_quantity'] ?>">
                                       <span class="tp-cart-plus">
                                          <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M5 1V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M1 5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                          </svg>
                                       </span>
                                    </div>
                                 </td>
                                 <!-- action -->
                                 <td class="tp-cart-action">
                                    <a href="?act=delete-cart&cart_id=<?= $cart['cart_id'] ?>" onclick="return confirm('Bạn có muốn xóa sản phẩm khỏi giỏ hàng không?')" class="tp-cart-action-btn">
                                       <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M9.53033 1.53033C9.82322 1.23744 9.82322 0.762563 9.53033 0.46967C9.23744 0.176777 8.76256 0.176777 8.46967 0.46967L5 3.93934L1.53033 0.46967C1.23744 0.176777 0.762563 0.176777 0.46967 0.46967C0.176777 0.762563 0.176777 1.23744 0.46967 1.53033L3.93934 5L0.46967 8.46967C0.176777 8.76256 0.176777 9.23744 0.46967 9.53033C0.762563 9.82322 1.23744 9.82322 1.53033 9.53033L5 6.06066L8.46967 9.53033C8.76256 9.82322 9.23744 9.82322 9.53033 9.53033C9.82322 9.23744 9.82322 8.76256 9.53033 8.46967L6.06066 5L9.53033 1.53033Z" fill="currentColor" />
                                       </svg>
                                       <span>Remove</span>
                                    </a>
                                 </td>
                              </tr>
                           <?php } ?>

                        </tbody>
                     </table>
               </div>
               <div class="tp-cart-bottom">
                  <div class="row align-items-end">
                     <div class="col-xl-6 col-md-8">
                        <div class="tp-cart-coupon">
                           <form action="#">
                              <div class="tp-cart-coupon-input-box">
                                 <label>Coupon Code:</label>
                                 <div class="tp-cart-coupon-input d-flex align-items-center">
                                    <input type="text" name="coupon_code" placeholder="Enter Coupon Code">
                                    <button type="submit" name="apply">Apply</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="col-xl-6 col-md-4">
                        <div class="tp-cart-update text-md-end">
                           <button type="submit" name="update_cart" class="tp-cart-update-btn">Update Cart</button>
                        </div>
                     </div>
                  </div>
               </div>
               </form>

            </div>
            <div class="col-xl-3 col-lg-4 col-md-6">
               <div class="tp-cart-checkout-wrapper">
                  <div class="tp-cart-checkout-top d-flex align-items-center justify-content-between">
                     <span class="tp-cart-checkout-top-title">Tổng tiền</span>
                     <span class="tp-cart-checkout-top-price">$<?= $sum ?></span>
                  </div>
                  <div class="tp-cart-checkout-top d-flex align-items-center justify-content-between">
                     <span class="tp-cart-checkout-top-title">Giá giảm</span>
                     <span class="tp-cart-checkout-top-price">$<?= $_SESSION['totalCoupon'] ?></span>
                  </div>
                  <!-- <div class="tp-cart-checkout-shipping">
                     <h4 class="tp-cart-checkout-shipping-title">Shipping</h4>

                     <div class="tp-cart-checkout-shipping-option-wrapper">
                        <div class="tp-cart-checkout-shipping-option">
                           <input id="flat_rate" type="radio" name="shipping">
                           <label for="flat_rate">Flat rate: <span>$20.00</span></label>
                        </div>
                        <div class="tp-cart-checkout-shipping-option">
                           <input id="local_pickup" type="radio" name="shipping">
                           <label for="local_pickup">Local pickup: <span> $25.00</span></label>
                        </div>
                        <div class="tp-cart-checkout-shipping-option">
                           <input id="free_shipping" type="radio" name="shipping">
                           <label for="free_shipping">Free shipping</label>
                        </div>
                     </div>
                  </div> -->
                  <div class="tp-cart-checkout-total d-flex align-items-center justify-content-between">
                     <span>Thành tiền</span>
                     <span>$<?= $sum - $_SESSION['totalCoupon'] ?></span>
                  </div>
                  <div class="tp-cart-checkout-proceed">
                     <a href="checkout.html" class="tp-cart-checkout-btn w-100">Proceed to Checkout</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- cart area end -->

</main>


<?php include '../view/client/layout/footer.php'; ?>