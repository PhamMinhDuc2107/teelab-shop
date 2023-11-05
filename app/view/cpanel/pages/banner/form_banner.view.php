
<?php $banner = isset($data['data']) ? $data['data'] :"" ?>
<form method="post" action="<?php echo ROOT.$data['action'] ?>" enctype="multipart/form-data">
	<div class="mb-3 col-6">
		<label for="exampleInputEmail1" class="form-label">Title</label>
		<input type="text" name="title" class="form-control" id="exampleInputEmail1" value="<?php echo isset($banner[0]) ? $banner[0]->title : '' ?>">
	</div>
	<div class="mb-3 col-6">
		<label for="file" class="form-label">Image</label>
		<label for="file" class="d-flex flex-column ">
			<input type="file" class="" id="file" name="image" 
			hidden> 
			<div class="border border-solid border-gray d-flex align-items-center justify-content-center rounded" style="height: 200px;font-size: 30px;position: relative;">
				<i class="fa-solid fa-arrow-up-from-bracket"></i>
				<img id="preview-img" alt="" style="position: absolute;top:0;height: 0;left: 0;right: 0;width: 100%;height: 200px;object-fit: cover; display: inline-block;
				">
			</div>
		</label>
	</div>
	<div class="mb-3 col-6 d-flex align-items-center">
		<label for="checkbox" class="mb-0 mr-3">Status: </label>
		<input type="checkbox" class="" id="checkbox" name="status"
		<?php echo isset($banner[0]) && $banner[0]->status ==1 ? "checked" : "" ?>
		>
	</div>
	<div class="mb-3 col-6">
		<button type="submit" class="btn btn-primary" name="submit_category">Submit</button>
	</div>
</form>
<script>
    // Sử dụng FileReader để đọc dữ liệu tạm trước khi upload lên Server
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#preview-img').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#file").change(function(){
		readURL(this);
	}); 
</script>