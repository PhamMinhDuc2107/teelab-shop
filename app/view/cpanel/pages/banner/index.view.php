<?php 
if(!empty($_GET['msg']))
{
	$msg = unserialize(urldecode($_GET['msg']));
	foreach($msg as $key => $value) 
	{
		echo "<span style='color:blue;font-wright: bold; font-size: 15px;margin-bottom: 10px;display: inline-block'>$value</span>";
	}
} 
?>
<table class="table table-bordered">
	<thead class="table-primary text-white">
		<tr>
			<th class="col-1">id</th>
			<th class="col-5">Image</th>
			<th class="col-2">Title</th>
			<th class="col-2">Status</th>
			<th class="col-2">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($data['data'])) :?>
			<?php foreach($data["data"] as $item) : ?>
				<tr>
					<th class="col-1"><?php echo $item->id ?></th>
					<td class="col-5"><img src="<?php echo ROOT."assets/uploads/banner/".$item->img ?>" alt="<?php echo $item->title ?>" style="width: 400px;display: inline-block;"></td>
					<td class="col-2"><?php echo $item->title ?></td>
					<td class="col-2 text-center">
						<?php if($item->status == 1) 
						{
							echo "<span class='btn btn-success w-75'>Active</span>";
						} else if($item->status == 0)
						{
							echo "<span class='btn btn-warning w-75'>UnActive</span>";
						}
						?>
					</td>
					<td class="col-2">
						<div class="d-flex justify-content-center align-items-center">
							<a href="<?php echo ROOT.'banner/edit_banner/'.$item->id ?>"  class="d-block text-primary ">
								<i class="fa-regular fa-pen-to-square inline-block px-2"></i>
							</a>
							<a href="<?php echo ROOT.'banner/delete_banner/'.$item->id ?>" class="d-block text-danger " onClick="alert('Delete Category!')">
								<i class="fa-solid fa-trash inline-block px-2"></i>
							</a>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>