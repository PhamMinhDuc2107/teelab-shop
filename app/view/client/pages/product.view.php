<!-- main -->
<section class="page__product">
	<div class="container">
		<div class="page__product--container">
			<?php require_once("./app/view/client/blocks/category_bar.view.php") ?>
			<!-- product -->
			<section class="mt-0 section__product">
				<div class="container">
					<h3 class="product__title"><a href="#"><?php echo $data['heading'] ?></a></h3>
					<div class="product__list">
						<?php if(isset($data['products'])): ?>
							<?php foreach($data['products'] as $item): ?>
								<div class="product__item">
									<div class="product__item--img">
										<img
										src="<?php echo ASSET."uploads/product/".$item->img ?>"
										alt=""
										/>
										<div class="product__item--sale">-<?php echo $item->discount?>%</div>
										<?php if($item-> quantity > 0) :?>
										<form class="overplay__hover" method="post" action="<?php echo ROOT."giohang/add_cart" ?>">
											<input type="text" hidden name="id" value="<?php echo $item->id  ?>">
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
										src="<?php echo ASSET."uploads/product/".$item->img ?>"
										alt=""
										/>
									</div>
									<div class="product__info">
										<a href="<?php echo ROOT."sanpham/chitiet/".$item->id ?>" class="product__info--name">
											<span
											><?php echo $item->name ?></span
											>
										</a>
										<div class="product__price">
											<span class="product__price--new"><?php echo number_format($item->price - ($item->price * $item->discount / 100)) ?>đ</span>
											<span class="product__price--old"><?php echo number_format($item->price) ?>đ</span>
										</div>
									</div>
								</div>
							<?php endforeach ?>
						<?php endif ?>
					</div>
					
					<div class="pagination">
						<?php if(isset($data['per_page']) && $data['per_page'] > 1)  :?>
							<?php $per_page = ceil($data['per_page'])?>
							<?php for($i = 1; $i <= $per_page ;$i++):?>
								<?php $number = $i ?>
								<a href="?page=<?php echo $number ?>" class="pagination__item <?php echo isset($_GET['page']) && +$_GET['page'] === +$number  ? "pagination__active" :""?>"><?php echo $number ?></a>
							<?php endfor ?>
						<?php endif?>
						<style>
							.pagination__active {
								background-color: black;
								color: white;
							}
						</style>
					</div>
				</div>
			</section>
			<!-- /product -->
		</div>
	</div>
</section>
						<!-- main -->