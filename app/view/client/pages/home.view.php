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
<section class="section__product mt-0">
	<div class="container">
		<h3 class="product__title"><a href="#">Áo thun</a></h3>
		<div class="product__list">
			<div class="product__item">
				<div class="product__item--img">
					<img
					src="<?php echo ROOT ?>assets/client/images/ao thun den size to.webp"
					alt=""
					/>
					<div class="product__item--sale">-40%</div>
					<div class="overplay__hover">
						<img
						src="<?php echo ROOT ?>assets/client/images/shopping-cart-fast-moving-svgrepo-com.svg"
						alt=""
						/>
					</div>
				</div>
				<div class="product__img--detail">
					<img
					src="<?php echo ROOT ?>assets/client/images/ao thun den size to.webp"
					alt=""
					/>
				</div>
				<div class="product__info">
					<a
					href="./productDetail.html"
					class="product__info--name"
					>
					<span
					>Áo Thun Teelab Local Brand Unisex The Eyes
					T-Shirt TS206 Lorem ipsum dolor sit, amet
					consectetur adipisicing elit. Facilis, neque a.
					Impedit sed architecto veniam necessitatibus
					earum, nisi libero, autem dolore excepturi fugit
					dicta? Veritatis obcaecati maiores ex recusandae
					qui!</span
					>
				</a>
				<div class="product__price">
					<span class="product__price--new">150.000đ</span>
					<span class="product__price--old">250.000đ</span>
				</div>
			</div>
		</div>
		<div class="product__item">
			<div class="product__item--img">
				<img src="<?php echo ROOT ?>assets/client/images/Áo gấu to.webp" alt="" />
				<div class="product__item--sale">-40%</div>
				<div class="overplay__hover">
					<img
					src="<?php echo ROOT ?>assets/client/images/shopping-cart-fast-moving-svgrepo-com.svg"
					alt=""
					/>
				</div>
			</div>
			<div class="product__img--detail">
				<img
				src="<?php echo ROOT ?>assets/client/images/ao thun den size to.webp"
				alt=""
				/>
			</div>
			<div class="product__info">
				<a
				href="./productDetail.html"
				class="product__info--name"
				><span
				>Áo Thun Teelab Local Brand Unisex The Eyes
				T-Shirt TS206</span
				></a
				>
				<div class="product__price">
					<span class="product__price--new">150.000đ</span>
					<span class="product__price--old">250.000đ</span>
				</div>
			</div>
		</div>
		<div class="product__item">
			<div class="product__item--img">
				<img src="<?php echo ROOT ?>assets/client/images/Áo mèo to.webp" alt="" />
				<div class="product__item--sale">-40%</div>
				<div class="overplay__hover">
					<img
					src="<?php echo ROOT ?>assets/client/images/shopping-cart-fast-moving-svgrepo-com.svg"
					alt=""
					/>
				</div>
			</div>
			<div class="product__img--detail">
				<img
				src="<?php echo ROOT ?>assets/client/images/ao thun den size to.webp"
				alt=""
				/>
			</div>
			<div class="product__info">
				<a
				href="./productDetail.html"
				class="product__info--name"
				><span
				>Áo Thun Teelab Local Brand Unisex The Eyes
				T-Shirt TS206</span
				></a
				>
				<div class="product__price">
					<span class="product__price--new">150.000đ</span>
					<span class="product__price--old">250.000đ</span>
				</div>
			</div>
		</div>
		<div class="product__item">
			<div class="product__item--img">
				<img
				src="<?php echo ROOT ?>assets/client/images/Áo thun trắng size to.webp"
				alt=""
				/>
				<div class="product__item--sale">-40%</div>
				<div class="overplay__hover">
					<img
					src="<?php echo ROOT ?>assets/client/images/shopping-cart-fast-moving-svgrepo-com.svg"
					alt=""
					/>
				</div>
			</div>
			<div class="product__img--detail">
				<img
				src="<?php echo ROOT ?>assets/client/images/ao thun den size to.webp"
				alt=""
				/>
			</div>
			<div class="product__info">
				<a
				href="./productDetail.html"
				class="product__info--name"
				><span
				>Áo Thun Teelab Local Brand Unisex The Eyes
				T-Shirt TS206</span
				></a
				>
				<div class="product__price">
					<span class="product__price--new">150.000đ</span>
					<span class="product__price--old">250.000đ</span>
				</div>
			</div>
		</div>
		<div class="product__item">
			<div class="product__item--img">
				<img src="<?php echo ROOT ?>assets/client/images/Áo kẻ viền to.webp" alt="" />
				<div class="product__item--sale">-40%</div>
				<div class="overplay__hover">
					<img
					src="<?php echo ROOT ?>assets/client/images/shopping-cart-fast-moving-svgrepo-com.svg"
					alt=""
					/>
				</div>
			</div>
			<div class="product__img--detail">
				<img
				src="<?php echo ROOT ?>assets/client/images/ao thun den size to.webp"
				alt=""
				/>
			</div>
			<div class="product__info">
				<a
				href="./productDetail.html"
				class="product__info--name"
				><span
				>Áo Thun Teelab Local Brand Unisex The Eyes
				T-Shirt TS206</span
				></a
				>
				<div class="product__price">
					<span class="product__price--new">150.000đ</span>
					<span class="product__price--old">250.000đ</span>
				</div>
			</div>
		</div>
		<div class="product__item">
			<div class="product__item--img">
				<img src="<?php echo ROOT ?>assets/client/images/áo trắng  to.webp" alt="" />
				<div class="product__item--sale">-40%</div>
				<div class="overplay__hover">
					<img
					src="<?php echo ROOT ?>assets/client/images/shopping-cart-fast-moving-svgrepo-com.svg"
					alt=""
					/>
				</div>
			</div>
			<div class="product__img--detail">
				<img
				src="<?php echo ROOT ?>assets/client/images/ao thun den size to.webp"
				alt=""
				/>
			</div>
			<div class="product__info">
				<a
				href="./productDetail.html"
				class="product__info--name"
				><span
				>Áo Thun Teelab Local Brand Unisex The Eyes
				T-Shirt TS206</span
				></a
				>
				<div class="product__price">
					<span class="product__price--new">150.000đ</span>
					<span class="product__price--old">250.000đ</span>
				</div>
			</div>
		</div>
		<div class="product__item">
			<div class="product__item--img">
				<img
				src="<?php echo ROOT ?>assets/client/images/Áo Xmas trắng to.webp"
				alt=""
				/>
				<div class="product__item--sale">-40%</div>
				<div class="overplay__hover">
					<img
					src="<?php echo ROOT ?>assets/client/images/shopping-cart-fast-moving-svgrepo-com.svg"
					alt=""
					/>
				</div>
			</div>
			<div class="product__img--detail">
				<img
				src="<?php echo ROOT ?>assets/client/images/ao thun den size to.webp"
				alt=""
				/>
			</div>
			<div class="product__info">
				<a
				href="./productDetail.html"
				class="product__info--name"
				><span
				>Áo Thun Teelab Local Brand Unisex The Eyes
				T-Shirt TS206</span
				></a
				>
				<div class="product__price">
					<span class="product__price--new">150.000đ</span>
					<span class="product__price--old">250.000đ</span>
				</div>
			</div>
		</div>
		<div class="product__item more">
			<a class="product__item--more"> Xem thêm </a>
		</div>
	</div>
	<a class="product__more">Xem thêm</a>
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