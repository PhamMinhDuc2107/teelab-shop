<?php echo isset($data['error']) ? $data['error'] : ""?>
<form method="post" action="<?php echo ROOT.$data['action'] ?>" enctype="multipart/form-data">
	<div class="mb-3 col-6">
		<label for="description" class="form-label">Description</label>
		<input type="text" name="description" class="form-control" id="description" >
	</div>
	<div class="mb-3 col-6">
		<label for="file" class="form-label">File báo cáo:</label>
		<input type="file" class="form-control d-none" id="file" name="file">
      <label for="file" class="d-flex align-items-center justify-content-center border rounded-md" style="height: 100px">
         Tải file lên
      </label>
	</div>
	<div class="mb-3 col-6">
		<button type="submit" class="btn btn-primary" name="submit_category">Submit</button>
	</div>
</form>