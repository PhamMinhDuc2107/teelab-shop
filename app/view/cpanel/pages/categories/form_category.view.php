<form method="post" action="<?php echo ROOT.$data['action'] ?>">
	<div class="mb-3 col-6">
		<label for="exampleInputEmail1" class="form-label">Name</label>
		<?php 
		$category = isset($data['category']) ? $data['category'] : "";
		?>
		<input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?php echo isset($category[0]) ? $category[0]->name : '' ?>">
	</div>
	<div class="mb-3 col-6">
		<label for="exampleInputPassword1" class="form-label">Slug</label>
		<input type="text" class="form-control" id="exampleInputPassword1" name="slug"
		value="<?php echo isset($category[0]) ? $category[0]->slug : "" ?>" 
		>
	</div>
	<div class="mb-3 col-6 d-flex align-items-center">
		<label for="checkbox" class="mb-0 mr-3">Status: </label>
		<input type="checkbox" class="" id="checkbox" name="status" <?php echo isset($category[0]) && $category[0]->status ==1 ? "checked" : "" ?>>
	</div>
	<div class="mb-3 col-6">
		<button type="submit" class="btn btn-primary" name="submit_category">Submit</button>
	</div>
</form>