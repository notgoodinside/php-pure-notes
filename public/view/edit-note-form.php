<?php
 
// Lấy dữ liệu note theo ID
$data_note = NoteController::getInstance()->selectById($get_id, $data_user['id']);

$date_created = $data_note['date_created'];
    $day_created = substr($date_created, 8, 2); // Ngày tạo
    $month_created = substr($date_created, 5, 2); // Tháng tạo
    $year_created = substr($date_created, 0, 4); // Năm tạo
    $hour_created = substr($date_created, 11, 2); // Giờ tạo
    $min_created = substr($date_created, 14, 2); // Phút tạo
 
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-primary">Chỉnh sửa note</h3>
            <div class="alert alert-info">Đã tạo vào ngày
            <?php
                // Hiển thị ngày tháng tạo
                echo $day_created.' tháng
                     '.$month_created.' năm
                     '.$year_created.' lúc
                     '.$hour_created.':'.$min_created;
            ?>
            </div>
            <form method="POST" onsubmit="return false;" id="formEditNote">
                <div class="form-group">
                    <label for="user_signin">Tiêu đề</label>
                    <input type="text" class="form-control" id="title_edit_note" value="<?php echo $data_note['title'];  ?>">
                </div>
                <div class="form-group">
                    <label for="pass_signin">Nội dung</label>
                    <textarea class="form-control" id="body_edit_note" rows="5"><?php echo $data_note['body'];  ?></textarea>
                </div>
                <input type="hidden" value="<?php echo $data_note['id']; ?>" id="id_edit_note">
                <a href="index.php" class="btn btn-default">
                    <span class="glyphicon glyphicon-arrow-left"></span> Trở về
                </a>
                <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#modalDeleteNote">
                    <span class="glyphicon glyphicon-trash"></span> Xoá
                </button>
                <button class="btn btn-primary" id="submit_edit_note">
                    <span class="glyphicon glyphicon-ok"></span> Lưu
                </button>
                <br><br>
                <div class="alert alert-danger hidden"></div>
            </form>
        </div>
    </div>
</div>