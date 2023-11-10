<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $data['title'] ? $data['title'] : "Home Page"?></title>
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
	href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,700&display=swap"
	rel="stylesheet"
	/>
	<!-- font awesome -->
	<link
	rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
	/>
	<!-- swiper -->
	<link
	rel="stylesheet"
	href="https://unpkg.com/swiper/swiper-bundle.min.css"
	/>
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<!-- css -->
	<link rel="stylesheet" href="<?php echo ROOT  ?>assets/client/css/app.css" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   
</head>
<body>
<?php $carts = getSession("carts")?>
<div class="wrapper">
   <div class="container">
      <h3 class="main-logo-header main-logo">
         <img src="<?php echo ASSET?>client/images/logo.webp" alt="">
      </h3>
   <form  class="form-order" method="post"  action="<?php echo ROOT."checkout/checkout_post"?>">
      <div class="main">
         <a href="<?php echo ROOT?>" class="main-logo">
            <img src="<?php echo ASSET?>client/images/logo.webp" alt="">
         </a>
         <div style=""  class="main-container">
         <div class="main-left">
            <div action="" class="main-form">
               <h4 class="main-form-title">Thông tin nhận hàng</h4>
               <div class="main-form-input">
               <input type="text" name="email" value=""class="form-input input-email" placeholder="Email">
               </div>
               <div class="main-form-input">
               <input type="text" name="name" value="" class="form-input input-name" placeholder="Họ và tên">
               </div>
               <div class="main-form-input">
               <input type="number" name="phone" class="form-input input-phone"  placeholder="Số điện thoại">
               </div>
               <div class="main-form-input">
               <input type="text" class="form-input input-address" placeholder="Địa chỉ" name="address">
               </div>
               <div class="main-form-tarea">
               <textarea type="text" placeholder="Ghi chú..." class="input-note" name="note"></textarea>
               </div>
            </div>
         </div>
         <div class="main-right">
            <h4 class="main-form-title">Vận chuyển</h4>
            <div class="right-wrapper">
               <div class="input-group">
               <input type="radio" id="box">
               <label for="box">Giao hàng tận nơi</label>
               </div>
               <input type="text" disabled class="price-feeship" name="feeship" value="">
            </div>
            <h4 class="main-form-title">Thanh toán</h4>
            <div class="right-wrapper">
               <div class="input-group">
               <input type="radio" id="box1" name="paymentMethod" value="cash" class="input-ship" >
               <label for="box1">Thanh toán khi nhận hàng(COD)</label>
               </div>
               <i class="fa-solid fa-money-bill"></i>
            </div>
            <div class="right-wrapper">
               <div class="input-group">
               <input type="radio" id="momo" name="paymentMethod" value="momo" class="input-ship" >
               <label for="momo">Thanh toán Momo</label>
               </div>
               <img src="https://developers.momo.vn/v3/vi/assets/images/icon-52bd5808cecdb1970e1aeec3c31a3ee1.png" alt="" style="display: inline-block; width: 25px">
            </div>
            <div class="right-wrapper">
               <div class="input-group">
               <input type="radio" id="vnpay" name="paymentMethod" value="vnpay" class="input-ship" >
               <label for="vnpay">Thanh toán VnPay</label>
               </div>
               <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Icon-VNPAY-QR.png" alt="" style="display: inline-block; width: 20px">
            </div>
         </div>
         <div class="aside_btn checkout-lg">
               <a href="<?php echo ROOT."giohang"?>" >
               <i class="fa fa-angle-left"></i>
               Quay về giỏ hàng
               </a>
               <button type="submit" class="aside_btn-submit">Đặt hàng</button>
            </div>
         </div>
      </div>
      <div class="aside">
         <h4 class="aside-form-title">Đơn hàng(<?php echo cartTotal()?> sản phẩm)</h4>
         <div class="aside_content">
         <div class="aside_list">
            <?php if(!empty($carts) && is_array($carts)) :?>
               <?php foreach($carts as $cart) :?>
                  <div class="aside_item">
                     <div class="aside_item-content">
                        <div class="aside_item-img">
                           <img src="<?php echo ASSET."uploads/product/".$cart['img']?>" alt="">
                           <span><?php echo $cart['quantity']?></span>
                        </div>
                        <div class="aside_item-name"><?php echo $cart['name']?>
                        </div>
                     </div>
                     <div class="aside_item-price"><?php echo number_format($cart['price'] - ($cart['price'] * $cart['discount'] / 100)) ?>đ</div>
                  </div>
               <?php endforeach;?>
            <?php endif;?>
         </div>
         <div style="display: flex; flex-direction:column;border-bottom: 1px solid #eee">
            <div class="aside_coupons">
               <div class="main-form-input">
                  <input type="text" name="coupon" class="input-coupon" placeholder="Mã giảm giá" >
               </div>
               <input value="Áp dụng" class="coupons-btn">
            </div>
            <span class="coupon-alert">
                  <span class="coupon-success"></span>
                  <span class="coupon-errors"></span>
            </span>
         </div>
         
         <div class="aside_price">
            <div class="aside_price-item">
               <span>Tạm tính</span>
               <span class="price"><?php echo number_format(cartTotalPrice())?>đ</span>
            </div>
            <div class="aside_price-item">
               <span>Phí vận chuyển</span>
               <input disabled class="price-feeship price-fee" value="0đ">
            </div>
            <div class="aside_price-item">
               <span>Discount</span>
               <span class="aside_price-coupon">0đ</span>
            </div>
         </div>
         <div class="aside_price-total">
            <span>Tổng cộng</span>
            <p class="price-total"><?php echo number_format(cartTotalPrice())?>đ</p>
         </div>
         <div class="aside_btn">
            <a href="<?php echo ROOT."giohang"?>" >
               <i class="fa fa-angle-left"></i>
               Quay về giỏ hàng
            </a>
            <button type="submit" class="aside_btn-submit">Đặt hàng</button>
         </div>
         </div>
      </div>
   </form>
</div>
</body>
</html>
<script>
   function formatCurrency(number) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number).replace('.', ',');	
	}	
   $('.coupons-btn').click(function(e) {
          let coupon = $(".input-coupon").val();
          $('.coupon-success').empty();
          $('.coupon-errors').empty();
          $.ajax({
            url:"<?php echo ROOT."checkout/check_coupon_ajax"?>",
            method:"post",
            data: {code: coupon},
            success: function(result) {
               const data = JSON.parse(result);
             if(Object.keys(data).length !== 0){
               const discountAmount = data.discount_amount;
               const total = data.total;
               const end = new Date(data.end).getTime();
               const now = new Date().getTime();
               const time = end - now;
               if(data.quantity <= 0 ) {
               $(".coupon-errors").text(`Số lượng mã coupon đã hết`)
               }else if(time <= 0)
               {
                  $(".coupon-errors").text(`Mã coupon đã hết hạn sử dụng`)
               }else
               {
                  $(".coupon-success").text(`Áp dụng ${data.code} thành công`)
                  $(".aside_price-coupon").text(formatCurrency(discountAmount));
                  $(".price-total").text(formatCurrency(total - discountAmount - feeship))
               }
             }else {
               $(".coupon-errors").text(`Áp dụng mã coupon thất bại`)
             }
            },
            error: function(xhr, status, error) {
              console.error(error);
            }
          })
        })
        function ajaxFeeShip() {
          $(".price-feeship").val("30,000đ")
          
        }
        $(".price-feeship").on("click",ajaxFeeShip)
</script>