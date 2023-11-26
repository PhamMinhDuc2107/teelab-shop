
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
                        <td>
                            <?php
                                if(isset($data["admins"]) && is_array($data['admins']))
                                {
                                    foreach($data['admins'] as $key => $item)
                                    {
                                        if($item->id === $data['task'][0]->assigned_to)
                                        {
                                            echo $item->username;
                                        }
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Hạn</td>
                        <td><?php echo isset($data['task']) ? $data['task'][0]->due_date : ""?></td>
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
        <?php if(!empty($data['detail'])):?>
        <div class="panel panel-primary">
            <div class="panel-body">
                <h4>Báo cáo</h4>
                <table class="table">
                    <tr>
                        <td>Ngày nộp :</td>
                        <td>
                            <?php echo isset($data['detail']) ? $data['detail'][0]->submitted_date : ""?>
                        </td>
                    </tr>
                    <tr>
                        <td>Mô tả:</td>
                        <td><?php echo isset($data['detail']) ? $data['detail'][0]->description : ""?></td>
                    </tr>
                    <tr>
                        <td>File báo cáo :</td>
                        <td>
                            <form action="<?php echo ROOT."task/download"?>" method="post">
                                <input type="hidden" name="file_path" value="<?php echo isset($data['detail']) ? $data['detail'][0]->file_name : "" ?>">
                                <button type="submit" class="btn btn-primary">Download File</button>
                            </form>
                        </td>
                    </tr>
                    
                </table>
            </div>
        </div>
        <?php endif;?>
        <div style="margin-bottom:20px;">        
          <a href="<?php echo ROOT."task" ?>" class="btn btn-danger">Quay lại</a> 
      </div>
    </div>
</div>