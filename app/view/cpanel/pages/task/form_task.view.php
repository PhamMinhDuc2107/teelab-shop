
<?php
   $admins = isset($data["admins"]) ? $data["admins"] :"";
   $tasks  = isset($data["tasks"]) ? $data["tasks"] :"";
	$task = isset($data["task"]) ? $data["task"][0] :"";
?>

<form method="post" action="<?php echo ROOT.$data['action'] ?>" enctype="multipart/form-data">
   <div class="mb-3 col-12 text-center text-danger">
      <?php echo isset($data['errors']) ? $data['errors'] : ""?>
   </div>
	<div class="mb-3 col-6">
		<label for="exampleInputEmail1" class="form-label">Title</label>
		<input type="text" name="title" class="form-control" id="exampleInputEmail1" value="<?php echo isset($task)&& is_object($task)  ? $task->title : '' ?>">
	</div>
   <div class="mb-3 col-6">
		<label for="exampleInputEmail1" class="form-label">Description</label>
		<textarea type="text" name="description" class="form-control" id="description"style="height: 150px">
		<?php echo isset($task)&& is_object($task)  ? ($task->description) : '' ?>
		</textarea>
		<style>
			.ck.ck-editor__main>.ck-editor__editable {
				height: 200px;
			}
		</style>
		<script>
			ClassicEditor
			.create( document.querySelector( '#description' ) )
			.catch( error => {
				console.error( error );
			} );
		</script>
	</div>
	<div class="mb-3 col-6">
		<label for="exampleInputEmail1" class="form-label">Assigned To</label>
		<select class="form-select w-100 py-2 px-1 border border-solid border-gray rounded"  aria-label="Default select example" name="assigned_to">
			<option selected>Open this select menu</option>
			<?php if(isset($admins)) :?>
				<?php foreach($admins as $item): ?>
					<option 
					value="<?php echo $item->id ?>" 
					<?php echo isset($task)&& is_object($task)  && $task->assigned_to === $item->id ?"selected" :"" ?>>
						<?php echo $item->username ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div>
      <div class="mb-3 col-6">
		<label for="exampleInputEmail1" class="form-label">Due Date</label>
		<input type="datetime-local" name="due_date" class="form-control" id="exampleInputEmail1" value="<?php echo isset($task)&& is_object($task)  ? $task->due_date : '' ?>" />
	   </div>
		<div class="mb-3 col-6">
			<button type="submit" class="btn btn-primary" name="submit_category">Submit</button>
		</div>
	</form>