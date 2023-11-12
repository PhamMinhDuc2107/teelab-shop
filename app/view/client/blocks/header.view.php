<!-- topbar -->
<section class="topbar">
   <div class="container">
      <div class="topbar__container">
         <div class="topbar__menu--icon">
            <i class="fa-solid fa-bars"></i>
         </div>
         <a href="<?php echo ROOT ?>" class="topbar__logo">
            <img src="<?php echo ROOT ?>assets/client/images/logo.webp" alt="" />
         </a>
         <form class="topbar__search" action="<?php echo ROOT."search"?>" method="get">
            <input
            type="text"
            name="search"
            placeholder="Tìm kiếm sản phẩm..."
            />
            <button type="submit" class="topbar__search--btn">
               <i class="fa fa-search"></i>
            </button>
         </form>
         <div class="topbar__right">
            <div class="topbar__search--icon">
               <i class="fa fa-search"></i>
            </div>
            <a href="<?php echo ROOT."giohang" ?>" class="topbar__cart">
               <div class="topbar__cart--icon">
                  <img src="<?php echo ROOT ?>assets/client/images/shopping.webp" alt="" />
               </div>
               <div class="topbar__cart--number">
                  <span><?php echo cartTotal() ?></span>
               </div>
               <!-- cart--mini -->
               <?php $carts = getSession("carts") ?>
               <div class="cart__mini">
                  <div class="cart__mini--list">
                     <?php if(!empty($carts) && is_array($carts)) :?>
                     <?php foreach($carts as $cart) :?>
                        <div class="cart__mini--item">
                           <a href="#" class="cart__mini--img">
                              <img
                              src="<?php echo ASSET."uploads/product/".$cart['img'] ?>"
                              alt=""
                              />
                           </a>
                           <div class="cart__mini--content">
                              <div class="cart__mini--name">
                                 <a href="#"
                                 ><?php echo $cart['name'] ?></a
                                 >
                                 <span>Kem / M</span>
                              </div>
                              <div class="cart__mini--grid">
                                 <div class="grid__item">
                                    <span class="grid__item--name"
                                    >Số lượng</span
                                    >
                                    <div class="grid__item--quantity">
                                       <input type="text" value="<?php echo $cart['quantity']?>" class="cart__quantity--input" name="<?php echo $cart['id']?>" >
                                    </div>
                                 </div>
                                 <div class="grid__item">
                                    <span class="grid__item--price"
                                    ><?php echo number_format($cart['price'] - ($cart['price'] * $cart['discount'] / 100)) ?>đ</span
                                    >
                                    <a href="<?php echo ROOT."giohang/remove_cart/".$cart["id"]?>" class="grid__item--remove">
                                       Xoá
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php endforeach; ?>
                     <?php else :?>
                        <?php echo "<div style='padding: 20px 10px; display:flex;align-items:center;justify-content:space-between; flex-direction:column'>
                        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' style='display:inline-block; width: 100px; height: 100px'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z' />
                        </svg>
                        <p style='font-size:14px; text-align:center; margin: 20px 0'>Không có sản phẩm nào trong giỏ hàng của bạn</p> 
                     </div>"?>
                     <?php endif; ?>
               </div>
               <div class="cart__mini--bot">
                  <div class="cart__mini--total">
                     <span class="text">Tổng tiền:</span>
                     <span class="number total-price"><?php echo number_format(cartTotalPrice()) ?>đ</span>
                  </div>
                  <a href="<?php echo ROOT.'checkout'?>" class="cart__mini--btn">
                     <button>Thanh toán</button>
                  </a>
               </div>
            </div>
            <!-- /cart--mini -->
         </a>
      </div>
      <form method="get" action="<?php echo ROOT.'search'?>" class="form-search">
         <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." />
         <button type="submit"><i class="fa fa-search"></i></button>
      </form>
   </div>
</div>
</section>
<!-- /topbar -->
<!-- header -->
<section class="header">
   <div class="container">
      <div class="header__container">
         <!-- nav -->
         <ul class="nav">
            <li class="nav__item">
               <a href="<?php echo ROOT ?>" class="nav__item--link">
                  Trang chủ
               </a>
            </li>
            <li class="nav__item">
               <a href="<?php echo ROOT.'chinhsach' ?>" class="nav__item--link"
                  >Chính sách đổi trả
               </a>
            </li>
            <li class="nav__item">
               <a href="<?php echo ROOT ?>" class="nav__item--link">
                  <img src="<?php echo ROOT ?>assets/client/images/logo.webp" alt="" />
               </a>
            </li>
            <li class="nav__item">
               <a href="<?php echo ROOT.'bangsize' ?>" class="nav__item--link">
                  Bảng size
               </a>
            </li>
            <li class="nav__item">
               <a href="<?php echo ROOT."hethongcuahang" ?>" class="nav__item--link">
                  Hệ thống cửa hàng
               </a>
            </li>
         </ul>
         <!-- nav -->
         <!--header__menu -->
         <ul class="header__menu">
            <?php $categories = isset($data['dataCategories']) ? $data['dataCategories'] : "" ?>
            <?php if(!empty($categories) && is_array($categories)) :?>
               <?php foreach ($categories as $item) :?>
                  <li class="header__menu--item">
                     <a href="<?php echo ROOT."sanpham/".$item->slug ?>" class="header__menu--link"
                        ><?php  echo $item->title  ?></a
                        >
                     </li>
                  <?php endforeach; ?>
               <?php endif;?>
            </ul>
            <!--header__menu -->
         </div>
      </div>
   </section>
         <!-- /header -->