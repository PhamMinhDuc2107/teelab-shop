<?php $rule = isset($data['data']) ? $data['data'] : "" ?>
<form method="post" action="<?php echo ROOT.$data['action'] ?>">
	<div class="mb-3 col-6">
		<label for="exampleInputEmail1" class="form-label">Name</label>
		
		<input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?php echo isset($rule[0]) ? $rule[0]->name : '' ?>">
	</div>
	<div class="mb-3 col-6">
		<label for="url" class="form-label">Url</label>
		<input type="text" name="url" class="form-control" id="url" value="<?php echo isset($rule[0]) ? $rule[0]->url : '' ?>">
	</div>
	<div class="mb-3 col-6">
		<button type="submit" class="btn btn-primary" name="submit_category">Submit</button>
	</div>
</form>