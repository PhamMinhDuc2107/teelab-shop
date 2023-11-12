<?php $shipping = isset($data['shipping']) ? $data['shipping'] : ""?>
<?php $order = isset($data['order']) ? $data['order'] : ""?>
<?php $order_details = isset($data['order_detail']) ? $data['order_detail'] : ""?>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td style="width:200px;">Tên khách hàng</td>
                        <td><?php echo $shipping->name?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $shipping->email?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?php echo $shipping->phone?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $shipping->address?></td> 
                    </tr>
                    <tr>
                        <td>Notes</td>
                        <td><?php echo $shipping->note?></td>
                    </tr>
                    <tr>
                        <td>Ngày đặt hàng</td>
                        <td><?php echo $order->date?></td>      
                    </tr>
                    <tr>
                        <td>Tổng giá</td>
                        <td><?php echo number_format($order->total)?>đ</td>      
                    </tr>
                    <tr>
                        <td>Trạng thái giao hàng</td>
                        <td>
                           <?php if($shipping->method === 2):?>
                                <span style="color:rgb(30, 198, 83);">Đã giao hàng</span>
                            <?php elseif($shipping->method === 1):?>
                                <span style="color:rgb(19, 183, 233)">Đang giao hàng</span>
                           <?php elseif($shipping->method === 0) :?>
                                <span style="color:red">Chưa giao hàng</span>
                            <?php endif;?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel panel-primary">
            <h3 class="panel-heading">Chi tiết đơn hàng</h3>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <tr class="table-primary">
                        <th style="width:100px;">Photo</th>
                        <th>Name</th>
                        <th style="width:100px;">Price</th>
                        <th style="width:80px;">Discount</th>
                        <th style="width:80px;">Quantity</th>
                    </tr>
                            <?php foreach ($order_details as $order_detail) :?>
                            <tr>
                                <td>
                                    <img src="<?php echo ASSET."uploads/product/".$order_detail->img?>" style="width:100px;">
                                </td>
                                <td><?php echo $order_detail->name?></td>
                                <td><?php echo number_format( $order_detail->price)?>đ</td>
                                <td style="text-align:center;"><?php echo $order_detail->discount?>%</td>
                                <td style="text-align:center;"><?php echo $order_detail->quantity ?></td>
                            </tr>
                            <?php endforeach ?>
                </table>
            </div>
        </div>
        <div style="margin-bottom:20px;">        
          <a href="<?php echo ROOT.'order'?>" class="btn btn-danger">Quay lại</a> 
          <?php if ($shipping->method === 0):?>
          <a href="<?php echo ROOT."order/update_order/".$order->id?>" class="btn btn-primary">Thực hiện giao hàng</a>  
          <?php endif?>
          <?php if ($shipping->method === 1) :?>
          <a href="<?php echo ROOT."order/update_order/".$order->id?>" class="btn btn-success ml-4">Hoàn thành giao hàng</a>      
         <?php endif;?>
      </div>
    </div>
</div>