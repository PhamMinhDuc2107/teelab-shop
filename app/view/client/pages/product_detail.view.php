<!-- productDetail -->
<?php 
$related_products = isset($data['related_product']) ? $data['related_product'] : "" ;
$product = isset($data['product']) ? $data['product'] : "";
$detail_img = isset($data['detail_img']) ? $data['detail_img'] :"";
?>
<section class="productDetail">
	<div class="container">
		<div class="productDetail__container">
			<div class="productDetail__left">
				<div class="productDetail__imgs swiper">
					<div class="swiper-wrapper">
						<?php foreach($detail_img as $img) :?>
							<div class="swiper-slide">
								<img
								src="<?php echo ASSET."uploads/product/".$img->img ?>"
								alt=""
								/>
							</div>
						<?php endforeach ?>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
			<div class="productDetail__right">
				<h4 class="productDetail__name">
					<?php echo $product[0]->name ?>
				</h4>
				<div class="productDetail__price">
					<span class="productDetail__price--new"><?php echo number_format($product[0]->price - ($product[0]->price * $product[0]->discount / 100)) ?>đ</span>
					<span class="productDetail__price--old"><?php echo number_format($product[0]->price) ?>đ</span>
				</div>
				<div class="productDetail__info">
					<p>Thông tin sản phẩm:</p>
					<p>- Chất liệu: Cotton</p>
					<p>- Form: Baby Tee</p>
					<p>- Màu sắc: Đen</p>
					<p>- Thiết kế: In lụa</p>
					<p>- Kiểu áo: Áo Nữ</p>
				</div>
				<div class="productDetail__color">
					<div class="productDetail__color--text">
						Màu sắc: <span>Đen</span>
					</div>
					<div class="productDetail__color--list">
						<div class="productDetail__color--item">
							<img
							src="<?php echo ASSET."uploads/product/".$product[0]->img ?>"
							alt=""
							/>
						</div>
					</div>
				</div>
				<div class="productDetail__size">
					<div class="productDetail__size--text">
						Kích thước: <span>M</span>
					</div>
					<div class="productDetail__size--list">
						<div class="productDetail__size--item">M</div>
						<div class="productDetail__size--item">L</div>
					</div>
					<a href="<?php echo ROOT.'bangsize' ?>">Hướng dẫn chọn size</a>
				</div>
				<div action="<?php echo $product[0]->quantity > 0 ? ROOT."giohang/add_cart" : ""?>" method="post">
					<?php if($product[0]->quantity > 0) :?>
						<form method="post" action="<?php echo ROOT."giohang/add_cart"?>" class="productDetail__quantity">
							<div class="productDetail__quantity--text">
								Số lượng
							</div>
							<div class="productDetail__quantity--number">
								<i class="fa fa-minus product__minus"></i>
								<input type="number" data-id="<?php echo $product[0]->id ?>" name="quantity" value=1 style="border: none;outline: none; width: auto; height: 100%;text-align: center;" class="productDetail__input--quantity input__quantity">
								<i class="fa fa-plus product__plus"></i>
							</div>
							<input type="text" hidden value="<?php echo $product[0]->id?>" name="id">
							<span class="quantity__error"></span>
							<div class="btn-buy">
							<button type="<?php echo $product[0]->quantity > 0 ? "submit" : "button"?>" <?php echo $product[0]->quantity > 0 ? "" : "disabled"?>>
								<?php echo $product[0]->quantity > 0 ? "THÊM VÀO GIỎ" : "HẾT HÀNG"?></button>
							</div>
					</div>
						</form>
					<?php endif; ?>
					
				</div>
			</div>
		</div>
	</section>
	<!-- /productDetail -->
	<!-- tab -->
	<section class="tabs">
		<div class="container">
			<div class="tabs__container">
				<h3 class="tabs__title">Mô tả sản phẩm</h3>
				<div class="tabs__content">
					<style>
						.tabs__content img {
							max-height: 900px;
							display: inline-block;
						}
						@media screen and (max-width: 900px){
							.tabs__content img  {
								height: 600px;
							}
						}
						@media screen and (max-width: 500px){
							.tabs__content img  {
								height: 500px;
							}
						}
					</style>
					<?php echo json_decode($product[0]->subtext) ?>
					Về TEELAB:<br />
					<br />
					You will never be younger than you are at this very moment “Enjoy Your Youth!”<br />
					<br />
					Không chỉ là thời trang, TEELAB còn là “phòng thí nghiệm” của tuổi trẻ - nơi nghiên cứu và cho ra đời nguồn năng lượng mang tên “Youth”. Chúng mình luôn muốn tạo nên những trải nghiệm vui vẻ, năng động và trẻ trung.<br />
					Lấy cảm hứng từ giới trẻ, sáng tạo liên tục, bắt kịp xu hướng và phát triển đa dạng các dòng sản phẩm là cách mà chúng mình hoạt động để tạo nên phong cách sống hằng ngày của bạn. Mục tiêu của TEELAB là cung cấp các sản phẩm thời trang chất lượng cao với giá thành hợp lý.<br />
					Chẳng còn thời gian để loay hoay nữa đâu youngers ơi! Hãy nhanh chân bắt lấy những những khoảnh khắc tuyệt vời của tuổi trẻ. TEELAB đã sẵn sàng trải nghiệm cùng bạn!<br />
					<br />
					“Enjoy Your Youth”, now!<br />
					<br />
				</div>
			</div>
		</div>
	</section>
	<!-- tab -->
	<!-- recentview -->
	<?php $recent_views = getSession("recent_view")?>
	<?php if(isset($recent_views)) :?>
		<section class="mt-0 section__product section-recentview-product">
			<div class="container">
				<h3 class="product__title"><a href="#">Sản phẩm đã xem</a></h3>
				<div class="swiper product__swiper">
					<div class="product__list swiper-wrapper">
						<!-- product__item -->
						<?php foreach($recent_views as $recent_view) :?>
							<div class="product__item swiper-slide">
								<div class="product__item--img">
									<img
									src="<?php echo ASSET."uploads/product/".$recent_view["img"] ?>"
									alt=""
									/>
									<div class="product__item--sale">- <?php echo $recent_view["discount"] ?>%</div>
									<div class="overplay__hover">
										<img
										src="<?php echo ASSET."client/" ?>images/shopping-cart-fast-moving-svgrepo-com.svg"
										alt=""
										/>
									</div>
								</div>
								<div class="product__img--detail">
									<img
									src="<?php echo ASSET."uploads/product/".$recent_view['img'] ?>"
									alt=""
									/>
								</div>
								<div class="product__info">
									<a href="<?php echo ROOT."sanpham/chitiet/".$recent_view['id'] ?>" class="product__info--name">
										<span
										><?php echo $recent_view["name"] ?></span
										>
									</a>
									<div class="product__price">
										<span class="product__price--new"><?php echo number_format($recent_view['price'] - ($recent_view['price'] * $recent_view['discount'] / 100)) ?>đ</span>
										<span class="product__price--old"><?php echo number_format($recent_view['price']) ?>đ</span>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
						<!-- product__item -->
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
		</section>
	<?php endif?>
	<!-- /recentview -->
	<!-- related -->
	<section class="mt-0 section__product section-related-product">
		<div class="container">
			<h3 class="product__title"><a href="#">Sản phẩm tương tự</a></h3>
			<div class="swiper product__swiper">
				<div class="product__list swiper-wrapper">
					<?php if(isset($related_products)): ?>
						<?php foreach($related_products as $related_product) :?>
							<div class="product__item swiper-slide">
								<div class="product__item--img">
									<img
									src="<?php echo ASSET."uploads/product/".$related_product->img?>"
									alt=""
									/>
									<div class="product__item--sale">- <?php echo $related_product->discount ?>%</div>
									<div class="overplay__hover">
										<img
										src="<?php echo ASSET ?>client/images/shopping-cart-fast-moving-svgrepo-com.svg"
										alt=""
										/>
									</div>
								</div>
								<div class="product__img--detail">
									<img
									src="<?php echo ASSET."uploads/product/".$related_product->img?>"
									alt=""
									/>
								</div>
								<div class="product__info">
									<a href="<?php echo ROOT."sanpham/chitiet/".$related_product->id ?>" class="product__info--name">
										<span
										><?php echo $related_product->name ?></span
										>
									</a>
									<div class="product__price">
										<span class="product__price--new"><?php echo number_format($related_product->price - ($related_product->price * $related_product->discount / 100)) ?>đ</span>
										<span class="product__price--old"><?php echo number_format($related_product->price) ?>đ</span>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif ?>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</div>
	</section>
	<!-- /related -->
	<script>
		document.addEventListener("DOMContentLoaded", function () {

			var swiperImg = new Swiper(".productDetail__imgs", {
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
				},
				rewind: true,
			});
			var swiperViewCurrent = new Swiper(".product__swiper", {
				slidesPerView: 4,
				slidesPerColumn: 1,
				slidesPerRow: 1,
				spaceBetween: 5,
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
				},
				rewind: true,
				breakpoints: {
					990: {
						slidesPerView: 4,
						slidesPerRow: 1,
					},
					640: {
						slidesPerView: 3,
						slidesPerRow: 1,
					},
					300: {
						slidesPerView: 2,
						slidesPerRow: 1,
					},

				}
			});
		})
	</script>
	<script src="<?php echo ASSET."client/js/productDetail.js" ?>"></script>