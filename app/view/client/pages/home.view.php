<!-- slider -->
<section class="home__slider swiper">
	<ul class="home__slider--list swiper-wrapper">
		<?php $banner = isset($data['dataBanner']) ? $data['dataBanner'] : "" ?>
		<?php if(isset($banner)): ?>
			<?php foreach($banner as $item) :?>
				<li class="home__slider--item swiper-slide">
					<img src="<?php echo ROOT ?>assets/uploads/banner/<?php echo $item->img ?>" alt="<?php echo $item->title ?>" />
				</li>
			<?php endforeach ?>
		<?php endif ?>
	</ul>
	<div class="swiper-pagination"></div>
</section>
<!-- slider -->
<!-- hero -->
<section class="about__heading">
	<div class="container">
		<div class="about__heading--container">
			<h2 class="title">Enjoy Your Youth!</h2>
			<span class="text"
			>Không chỉ là thời trang, TEELAB còn là “phòng thí nghiệm”
			của tuổi trẻ - nơi nghiên cứu và cho ra đời nguồn năng
			lượng mang tên “Youth”. Chúng mình luôn muốn tạo nên những
			trải nghiệm vui vẻ, năng động và trẻ trung.</span
			>
		</div>
	</div>
</section>
<!-- hero -->
<!-- product -->
<section class="mt-0 section__product">
	<div class="container">
		<?php $data_total = isset($data['data']) ? $data['data'] : "";?>
		<?php foreach($data_total as $item): ?>
			<div class="product__container">

				<h3 class="product__title">
					<a href="
					<?php echo isset($item['category']) ?  ROOT."sanpham/".$item['category']->slug  : ''?>"><?php echo isset($item['category']) ? $item['category']->title  : ""?></a>
				</h3>
				<div class="product__list">
					<?php if(isset($item['products'])) :?>
						<?php foreach($item['products'] as $product ) :?>
							<div class="product__item">
								<div class="product__item--img">
									<img src="<?php echo isset($product) ? ASSET."/uploads/product/".$product->img : "" ?>" alt="" />
									<div class="product__item--sale">-<?php echo isset($product) ? $product->discount :"" ?>%</div>
									<?php if($product-> 	quantity > 0) :?>
										<form class="overplay__hover" method="post" action="<?php echo ROOT."giohang/add_cart" ?>">
											<input type="text" hidden name="id" value="<?php echo $product->id  ?>">
											<button type="submit" name="add_cart">
												<img
												src="<?php echo ROOT ?>assets/client/images/shopping-cart-fast-moving-svgrepo-com.svg"
												alt=""
												/>
											</button>
										</form>
									<?php else : ?>
										<div class="sold"><span>SOLD OUT</span></div>
									<?php endif;?>
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
					<?php endif; ?>
					<div class="product__item more">
						<a href="<?php echo isset($item['category']) ? ROOT."sanpham/".$item['category']->slug : "" ?>" class="product__item--more"> Xem thêm </a>
					</div>
				</div>
				<a href="<?php echo ROOT."sanpham/".$item['category']->slug ?>" class="product__more">Xem thêm</a>
			</div>
		<?php endforeach; ?>
	</div>
</section>
<!-- /product -->
<!-- feedback -->
<section class="feedback">
	<div class="container">
		<div class="feedback__container">
			<h2 class="feedback__title">Find out TEELAB more</h2>
			<div class="swiper feedback__swiper">
				<ul class="feedback__list swiper-wrapper">
					<li class="feedback__item swiper-slide">
						<img
						src="<?php echo ROOT ?>assets/client/images/feedback_1.webp"
						alt=""
						class="feedback__item--img"
						/>
					</li>
					<li class="feedback__item swiper-slide">
						<img
						src="<?php echo ROOT ?>assets/client/images/feedback_2.webp"
						alt=""
						class="feedback__item--img"
						/>
					</li>
					<li class="feedback__item swiper-slide">
						<img
						src="<?php echo ROOT ?>assets/client/images/feedback_3.webp"
						alt=""
						class="feedback__item--img"
						/>
					</li>
					<li class="feedback__item swiper-slide">
						<img
						src="<?php echo ROOT ?>assets/client/images/feedback_4.webp"
						alt=""
						class="feedback__item--img"
						/>
					</li>
					<li class="feedback__item swiper-slide">
						<img
						src="<?php echo ROOT ?>assets/client/images/feedback_6.webp"
						alt=""
						class="feedback__item--img"
						/>
					</li>
					<li class="feedback__item swiper-slide">
						<img
						src="<?php echo ROOT ?>assets/client/images/feedback_6.webp"
						alt=""
						class="feedback__item--img"
						/>
					</li>
					<li class="feedback__item swiper-slide">
						<img
						src="<?php echo ROOT ?>assets/client/images/feedback_7.webp"
						alt=""
						class="feedback__item--img"
						/>
					</li>
					<li class="feedback__item swiper-slide">
						<img
						src="<?php echo ROOT ?>assets/client/images/feedback_8.webp"
						alt=""
						class="feedback__item--img"
						/>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!-- /feedback -->
<script>
	document.addEventListener("DOMContentLoaded", function () {
		const sliderSwiper = new Swiper(".home__slider", {
            // direction: "vertical",
			loop: true,
			pagination: {
				el: ".swiper-pagination",
			},
			rewind: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			},
		});
	});
	var swiper = new Swiper(".feedback__swiper", {
		slidesPerView: 4,
		slidesPerColumn: 2,
		slidesPerRow: 1,
		spaceBetween: 10,
		rewind: true,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		breakpoints: {
			990: {
				slidesPerView: 4,
				slidesPerRow: 1,
				slidesPerColumn: 1,
				spaceBetween: 10,
			},
			765: {
				slidesPerView: 3,
				slidesPerRow: 1,
				slidesPerColumn: 1,
				spaceBetween: 10,
			},
			300: {
				slidesPerView: 2,
				slidesPerRow: 1,
				slidesPerColumn: 1,
				spaceBetween: 10,
			},
		},
	});
</script>