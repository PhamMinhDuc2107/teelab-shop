<?php 
$admin = isset($data['data']) ? $data['data'] : "";
?>

<form method="post" action="<?php echo ROOT.$data['action'] ?>">
	<div class="mb-3 col-6">
		<label for="exampleInputEmail1" class="form-label">username</label>
		<input type="text" name="username" class="form-control" id="exampleInputEmail1" value="<?php echo isset($admin[0]) ? $admin[0]->username : '' ?>">
	</div>
	<div class="mb-3 col-6">
		<label for="exampleInputPassword1" class="form-label">Password</label>
		<input type="password" class="form-control" id="exampleInputPassword1" name="password"
		>
	</div>
	<div class="mb-3 col-6">
		<label for="exampleInputPassword2" class="form-label">Email</label>
		<input type="text" class="form-control" id="exampleInputPassword2" name="email"
		value="<?php echo isset($admin[0]) ? $admin[0]->email : "" ?>" 
		>
	</div>
	<div class="mb-3 col-6">
		<button type="submit" class="btn btn-primary" name="submit_category">Submit</button>
	</div>
</form>