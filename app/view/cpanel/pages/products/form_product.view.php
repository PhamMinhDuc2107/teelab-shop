<form method="post" action="<?php echo ROOT.$data['action'] ?>" enctype="multipart/form-data">
	<div class="mb-3 col-6">
		<label for="exampleInputEmail1" class="form-label">Name</label>
		<input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?php echo isset($category[0]) ? $category[0]->name : '' ?>">
	</div>
	<div class="mb-3 col-6">
		<label for="exampleInputEmail1" class="form-label">Category</label>
		<select class="form-select w-100 py-2 px-1 border border-solid border-gray rounded"  aria-label="Default select example" name="category">
			<option selected>Open this select menu</option>
			<?php $categories = isset($data['dataCategories']) ? $data['dataCategories'] : "" ?>
			<?php if(isset($categories)) :?>
				<?php foreach($categories as $item): ?>
					<option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
	</div>
	<div class="mb-3 col-6">
		<label for="exampleInputPassword1" class="form-label">Price</label>
		<input type="text" class="form-control" id="exampleInputPassword1" name="price"
		value="<?php echo isset($category[0]) ? $category[0]->slug : "" ?>" 
		>
	</div>
	<div class="mb-3 col-6">
		<label for="exampleInputPassword1" class="form-label">Discount</label>
		<input type="text" class="form-control" id="exampleInputPassword1" name="discount"
		value="<?php echo isset($category[0]) ? $category[0]->slug : "" ?>" 
		>
	</div>
	<div class="mb-3 col-6">
		<label for="quantity" class="form-label">Quantity</label>
		<input type="text" class="form-control" id="quantity" name="quantity"
		value="<?php echo isset($category[0]) ? $category[0]->slug : "" ?>" 
		>
	</div>
	<div class="mb-3 col-6">
		<label for="image" class="form-label">Image</label>
		
		<input type="file" class="form-control" id="image" name="image" multiple 
		> 
	</div>
	<div class="mb-3 col-6">
		<label for="image-details" class="form-label">Image Detail</label>
		
		<input type="file" class="form-control" id="image-details" name="image-details[]" multiple 
		> 
	</div>

	<div class="mb-3 col-6">
		<label for="editor" class="form-label">Subtext</label>
		<textarea name="subtext" id="editor">
		</textarea>
	</div>
	<style>
		.ck.ck-editor__main>.ck-editor__editable {
			height: 200px;
		}
	</style>
	<script>
		ClassicEditor
		.create( document.querySelector( '#editor' ) )
		.catch( error => {
			console.error( error );
		} );
	</script>

	<div class="mb-3 col-6">
		<button type="submit" class="btn btn-primary" name="submit_category">Submit</button>
	</div>
</form>