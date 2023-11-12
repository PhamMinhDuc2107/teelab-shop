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
  <thead class="text-white table-primary">
    <tr>
      <th class="col-2">Mã đơn hàng</th>
      <th class="col-2">Name</th>
      <th class="col-1">Quantity</th>
      <th class="col-1">Coupon</th>
      <th class="col-2">Total</th>
      <th class="col-1">Date</th>
      <th class="col-2">Status</th>
      <th class="col-2"></th>
    </tr>
  </thead>
  <tbody>
    <?php if($data['data']) :?>
      <?php foreach($data["data"] as $item) : ?>
        <tr>
          <th class="col-2"><?php echo $item->madonhang ?></th>
          <td class="col-2"><?php echo $item->name ?></td>
          <td class="col-1"><?php echo $item->quantity ?></td>
          <td class="col-1"><?php echo $item->code ?></td>
          <td class="col-2"><?php echo number_format($item->total) ?>đ</td>
          <td class="col-1"><?php echo $item->date ?></td>
          <td class="col-2 text-center"><?php echo $item->order_status == 1? "<div class='btn btn-success'>Hoàn thành</div>" : "<div class='btn btn-danger'>Chưa hoàn thành</div>" ?></td>
          <td class="col-1 text-center"><a href="<?php echo ROOT.'order/order_detail/'.$item->id ?>">Chi tiết</a></td>
        </tr>
      <?php endforeach;  ?>
    <?php endif; ?>
  </tbody>
</table>