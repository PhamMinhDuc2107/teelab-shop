<!-- menu -->
<section class="menu">
   <div class="menu__icon--close">
      <div class="menu__circle">
         <i class="fa-solid fa-xmark"></i>
      </div>
   </div>
   <ul class="menu__list">
      <h3 class="menu__title">Menu</h3>

      <li class="menu__item">
         <a href="<?php echo ROOT ?>" class="menu__item--link"> Trang chủ </a>
      </li>
      <li class="menu__item">
         <a href="<?php echo ROOT ?>sanpham/all" class="menu__item--link"
            >Tất cả sản phẩm
         </a>
         <ul class="menu2">
            <?php if(isset($data['categories_actives'])) :?>
               <?php foreach($data['categories_actives'] as $item) :?>
                  <li><a href="<?php echo ROOT."sanpham/".$item->slug ?>"><?php echo $item->title ?></a></li>
               <?php endforeach ?>
            <?php endif; ?>
         </ul>
      </li>
      <li class="menu__item">
         <a href="<?php echo ROOT."chinhsach" ?>" class="menu__item--link">
            Chính sách đổi trả
         </a>
      </li>
      <li class="menu__item">
         <a href="<?php echo ROOT."bangsize" ?>" class="menu__item--link"> Bảng size </a>
      </li>
      <li class="menu__item">
         <a href="<?php echo ROOT."kiemtradonhang" ?>" class="menu__item--link"> Kiểm tra đơn hàng </a>
      </li>
      <li class="menu__item">
         <a href="<?php echo ROOT."hethongcuahang" ?>" class="menu__item--link"> Hệ thống cửa hàng </a>
      </li>
   </ul>
</section>
      <!-- menu -->