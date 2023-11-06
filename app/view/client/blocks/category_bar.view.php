<div class="cate">
	<div class="cate__title">
		<i class="fa fa-bars"></i>
		<h3>Danh mục</h3>
	</div>
	<ul class="cate__list">
		<?php if(isset($data['dataCategories'])): ?>
			<?php $categories  = $data['dataCategories'] ?>
			<?php foreach($categories as $item) :?>
				<li class="cate__item"><a href="<?php echo $item->slug ?>" class="cate__item--link"><?php echo $item->title ?></a></li>
			<?php endforeach ?>
		<?php endif; ?>
	</ul>
</div>