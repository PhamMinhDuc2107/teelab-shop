
<?php

?>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h4><?php echo isset($data['task']) ? $data['task'][0]->title : ""?></h4>
                <table class="table">
                    <tr>
                        <td style="width:200px;">Người tạo</td>
                        <td><?php echo isset($data['task']) ? $data['task'][0]->description : ""?></td>
                    </tr>
                    <tr>
                        <td>Hạn</td>
                        <td><?php echo isset($data['task']) ? $data['task'][0]->due_date¸ : ""?></td>
                    </tr>
                    <tr>
                        <td>Mô tả</td>
                        <td><?php echo isset($data['task']) ? $data['task'][0]->description : ""?></td>
                    </tr>
                    <tr>
                        <td>Trạng thái</td>
                        <td>
                           <?php if(isset($data['task']) && $data['task'][0]->status === 1):?>
                                <span style="color:rgb(30, 198, 83);">Hoàn thành</span>
                            <?php else:?>
                                <span style="color:rgb(19, 183, 233)">Chưa hoàn thành</span>
                            <?php endif;?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel panel-primary">
            <span>Oke</span>
        </div>
        <div style="margin-bottom:20px;">        
          <a href="<?php echo ROOT.'order'?>" class="btn btn-danger">Quay lại</a> 
      </div>
    </div>
</div>