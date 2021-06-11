<?php
 
// Kết nối database, session, general info
require_once __DIR__ . "/library/core/constants.php";//Gọi file constant
require_once ROOT_PROJECT . "/library/core/init.php";//Gọi file init core
require_once ROOT_PROJECT . "/library/helper/form.php";//Gọi file validate form;
require_once  ROOT_PROJECT . "/controller/note.php";//Gọi note controller
 
// Nếu không tồn tại $user
if (!$user)
{
    header('Location: index.php'); // Di chuyển đến trang chủ
}
 
// Nếu tồn tại hành động nào đó gửi đến
if (isset($_POST['ac']))
{   
    $ac = $_POST['ac'];
    // Nếu hành động là create
    if ($ac == 'create')
    {
        // Nhận dữ liệu và gán vào các biến đồng thời xử lý chuỗi
        $title_create_note = trim(htmlentities(@$_POST['title_create_note']));
        $body_create_note = htmlentities(@$_POST['body_create_note']);
 
        // Các biến chứa code JS về thông báo
        $show_alert = "<script>$('#formCreateNote .alert').removeClass('hidden');</script>";
        $hide_alert = "<script>$('#formCreateNote .alert').addClass('hidden');</script>";
        $success_alert = "<script>$('#formCreateNote .alert').attr('class', 'alert alert-success');</script>";
    
        NoteController::getInstance()->create($data_user['id'], $title_create_note, $body_create_note, $date_current);

        // Hiển thị thông báo và di chuyển đến trang edit của note vừa tạo
        echo $show_alert.$success_alert." Tạo note thành công
            <script>
                location.href = 'index.php?ac=edit_note&&id=". NoteController::getInstance()->insert_id()."';
            </script>
        ";
    }
    // Nếu hành động là edit
    else if ($ac == 'edit')
    {
        // Nhận dữ liệu và gán vào các biến đồng thời xử lý chuỗi
        $title_edit_note = trim(htmlentities(@$_POST['title_edit_note']));
        $body_edit_note = htmlentities(@$_POST['body_edit_note']);
        $id_edit_note = trim(htmlentities(@$_POST['id_edit_note']));
     
        // Các biến chứa code JS về thông báo
        $show_alert = "<script>$('#formEditNote .alert').removeClass('hidden');</script>";
        $hide_alert = "<script>$('#formEditNote .alert').addClass('hidden');</script>";
        $success_alert = "<script>$('#formEditNote .alert').attr('class', 'alert alert-success');</script>";
     
        // Kiểm tra có tồn tại ID note
        if (NoteController::getInstance()->checkNote($data_user['id'], $id_edit_note))
        {
            // Chỉnh sửa note
            NoteController::getInstance()->update($body_edit_note, $title_edit_note, $data_user['id'], $id_edit_note);
     
            // Hiển thị thông báo và tải lại trang
            echo $show_alert.$success_alert." Đã chỉnh sửa note
                <script>
                    location.reload();
                </script>
            ";
        }
        // Ngược lại không 
        else
        {
            // Hiển thị thông báo lỗi
            echo $show_alert.'Bạn đã cố tình sửa chữa ID note, nhưng rất tiếc ID note này không tồn tại hoặc không thuộc quyền sở hữu của bạn.';
        }
    }
    // Nếu hành động là delete
    else if ($ac == 'delete')
    {
        // Nhận dữ liệu và gán vào các biến đồng thời xử lý chuỗi
        $id_edit_note = filter_request_form(@$_POST['id_edit_note']);
        $id_edit_note = trim(htmlentities($id_edit_note));
     
        // Các biến chứa code JS về thông báo
        $show_alert = "<script>$('#modalDeleteNote .alert').removeClass('hidden');</script>";
        $hide_alert = "<script>$('#modalDeleteNote .alert').addClass('hidden');</script>";
        $success_alert = "<script>$('#modalDeleteNote .alert').attr('class', 'alert alert-success');</script>";
             
        // Kiểm tra có tồn tại ID note và thuộc quyền sở hữu
        if (NoteController::getInstance()->checkNote($data_user['id'], $id_edit_note))
        {
            // Xoá note
            NoteController::getInstance()->delete($data_user[id_user], $id_edit_note);
     
            // Hiển thị thông báo và trở về trang chủ
            echo $show_alert.$success_alert." Xoá note thành công.
                <script>
                    location.href = 'index.php';
                </script>
            ";
        }
    }
    // Ngược lại không 
    else
    {
        // Hiển thị thông báo lỗi
        echo $show_alert.'Bạn đã cố tình sửa chữa ID note, nhưng rất tiếc ID note này không tồn tại hoặc không thuộc quyền sở hữu của bạn.';
    }
}
 
?>