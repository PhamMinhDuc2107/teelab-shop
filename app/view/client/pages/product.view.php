<!-- main -->
<section class="page__product">
	<div class="container">
		<div class="page__product--container">
			<?php require_once("./app/view/client/blocks/category_bar.view.php") ?>
			<!-- product -->
			<section class="section__product mt-0">
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
										<div class="overplay__hover">
											<img
											src="<?php echo ASSET?>client/images/shopping-cart-fast-moving-svgrepo-com.svg"
											alt=""
											/>
										</div>
									</div>
									<div class="product__img--detail">
										<img
										src="<?php echo ASSET."uploads/product/".$item->img ?>"
										alt=""
										/>
									</div>
									<div class="product__info">
										<a href="./productDetail.html" class="product__info--name">
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
							<?php for($i = 0; $i < $per_page ;$i++):?>
								<?php $number = $i + 1 ?>
								<a href="?page=<?php echo $number ?>" class="pagination__item <?php echo isset($_GET['page']) && +$_GET['page'] === +$number ? "pagination__active" :""?>"><?php echo $number ?></a>
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