<div class=" d-flex items-center justify-between bg-primary py-2 px-2 mb-2 rounded-lg gap-2 col-12">
	<div class="d-flex items-center col-6">
		<select class="sortBar-select">
			<option>Sắp xếp</option>
			<option <?php echo isset($_GET['order']) && $_GET['order'] === "asc" ? "selected" :"" ?> value="asc">Sắp xếp tăng dần</option>
			<option <?php echo isset($_GET['order']) && $_GET['order'] === "desc" ? "selected" :"" ?>  value="desc">Sắp xếp giảm dần</option>
		</select>
		<select class="sortBar-col ml-3">
			<option value="">Column</option>
			<?php if($data['col']): ?>
				<?php foreach($data['col'] as $item) :?>
					<option <?php echo isset($_GET['col']) && $_GET['col'] === $item ? "selected" :"" ?>  value='<?php  echo $item ?>'><?php echo $item ?></option>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
	</div>
	<form action="" class="col-6 ml-auto search d-flex justify-content-end items-center">
		<input type="text" name="q" class="w-50">
		<button class="ml-3 ">Search</button>
	</form>
</div>
<style>
	.sortBar-select,.sortBar-col,.search input,.search button {
		padding: 5px 10px;
		border-radius: 8px;
		border: none;
		outline: none;
		font-size: 16px;
		display: inline-block;
	}
</style>