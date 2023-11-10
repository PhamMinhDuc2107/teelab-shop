<?php $result = isset($data['result']) ? $data['result']:"";
   ?>
<div class="search">
      <div class="search__container">
         <?php if(!empty($result) && is_array($data)): ?>
            <div class="search__result">
               <div class="container">
                  <h2 class="search__title">Tìm thấy <?php echo isset($data['count']) ? $data['count'] : ''?> kết quả phù hợp</h2>
               </div>
               <!-- product -->
               <section class="mt-0 section__product">
                        <div class="container">
                        <div class="product__container">
                           <div class="product__list" style=" flex-wrap: wrap; 
     overflow-x: unset;">
                              <?php foreach($result as $product): ?>
                                    <div class="product__item">
                                       <div class="product__item--img">
                                          <img src="<?php echo  ASSET."/uploads/product/".$product->img  ?>" alt="" />
                                          <div class="product__item--sale">-<?php echo  $product->discount ?>%</div>
                                          <form class="overplay__hover" method="post" action="<?php echo ROOT."giohang/add_cart" ?>">
                                             <input type="text" hidden name="id" value="<?php echo $product->id  ?>">
                                             <button type="submit" name="add_cart">
                                                <img
                                                src="<?php echo ROOT ?>assets/client/images/shopping-cart-fast-moving-svgrepo-com.svg"
                                                alt=""
                                                />
                                             </button>
                                          </form>
                                       </div>
                                       <div class="product__img--detail">
                                          <img
                                          src="<?php echo isset($product) ? ASSET."uploads/product/".$product->img: "" ?>"
                                          alt=""
                                          />
                                       </div>
                                       <div class="product__info">
                                          <a
                                          href="<?php echo ROOT."sanpham/chitiet/"."$product->id" ?>"
                                          class="product__info--name"
                                          ><span
                                          ><?php echo isset($product) ? $product->name : "" ?></span
                                          ></a
                                          >
                                          <div class="product__price">
                                             <span class="product__price--new">
                                                <?php $price_item = isset($product) ? $product->price - ($product->price * $product->discount / 100) : "" ;
                                                ?>
                                                <?php echo isset($product) ? number_format($price_item)."đ" : "" ?>
                                             </span>
                                             <span class="product__price--old"><?php echo isset($product) ? number_format($product->price)."đ" : ""?></span>
                                          </div>
                                       </div>
                                    </div>
                                 <?php endforeach ?>
                           </div>
                        </div>
                  </div>
                        </div>
                        <div class="pagination">
                  <?php $pagination = isset($data['pagination']) ? $data['pagination'] : ""?>
                  <?php if($pagination > 1):?>
                     <?php for($i = 1 ; $i <= $pagination ;$i++):?>
                     <a href="<?php echo ROOT."search?search=".$data['search']?>&page=<?php echo $i?>" class="pagination__item <?php
                        echo isset($_GET['page']) && $_GET['page'] == $i ? "pagination__active" : "" 
                        ?>"><?php echo $i?></a>
                  <?php endfor;?>
                  <?php endif;?>
               </div>
               </section>
               <!-- /product -->
             
         <?php else:?>
            <div class="container">
               <div class="search__empty">
               <h2 class="search__title">Không tìm thấy bất kỳ kết quả nào với từ khóa trên.</h2>
            <p class="search__desc">Vui lòng nhập từ khóa tìm kiếm khác</p>
            <form method="get" action="<?php echo ROOT."search"?>" class="search__form">
               <input type="text" name="search" class="search__input" placeholder="Bạn cần tìm gì?">
               <button type="submit" class="search__btn">Tìm kiếm</button>
            </form>
               </div>
            </div>
         <?php endif?>
      </div>
   </div>
</div>
