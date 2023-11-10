<form method="post" action="<?php echo ROOT.$data['action'] ?>">
	<div class="mb-3 col-6">
		<label for="exampleInputEmail1" class="form-label">Code</label>
		<?php 
		$coupon = isset($data['coupon']) ? $data['coupon'] : "";
		?>
		<input type="text" name="code" class="form-control" id="exampleInputEmail1" value="<?php echo isset($coupon[0]) ? $coupon[0]->code : '' ?>">
	</div>
	<div class="mb-3 col-6">
		<label for="exampleInputPassword1" class="form-label">Discount Amount</label>
		<input type="text" class="form-control" id="exampleInputPassword1" name="discount_amount"
		value="<?php echo isset($coupon[0]) ? $coupon[0]->discount_amount : "" ?>" 
		>
	</div>
   <div class="mb-3 col-6">
		<label for="exampleInputPassword1" class="form-label">Quantity</label>
		<input type="text" class="form-control" id="exampleInputPassword1" name="quantity"
		value="<?php echo isset($coupon[0]) ? $coupon[0]->quantity : "" ?>" 
		>
	</div>
	<div class="mb-3 col-6 d-flex align-items-center">
		<label for="date_start" class="mb-0 mr-3">Date Start: </label>
		<input type="datetime-local" id="date_start" name="date_start" value="<?php echo isset($coupon[0]) ? $coupon[0]->start : "" ?>">
	</div>
   <div class="mb-3 col-6 d-flex align-items-center">
		<label for="date_end" class="mb-0 mr-3">Date End: </label>
		<input type="datetime-local" id="date_end" name="date_end" value="<?php echo isset($coupon[0]) ? $coupon[0]->end : "" ?>">
	</div>
	<div class="mb-3 col-6">
		<button type="submit" class="btn btn-primary" name="submit_category">Submit</button>
	</div>
</form>