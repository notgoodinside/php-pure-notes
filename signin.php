<?php

// Include database, session, general info
require_once __DIR__ . "/library/core/constants.php";//Gọi file constant
require_once ROOT_PROJECT . "/library/core/init.php";//Gọi file init core
require_once ROOT_PROJECT . "/library/helper/form.php";//Gọi file validate form;

 
// Nếu tồn tại $user
if (isset($user) && $user)
{
    header('Location: index.php'); // Di chuyển đến trang chủ
}
 
// Nhận dữ liệu và gán vào các biến đồng thời xử lý chuỗi
$user_signin = filter_request_form(@$_POST['user_signin']);
$pass_signin = @md5(filter_request_form($_POST['pass_signin']));
 
// Các biến chứa code JS về thông báo
$show_alert = "<script>$('#formSignin .alert').removeClass('hidden');</script>";
$hide_alert = "<script>$('#formSignin .alert').addClass('hidden');</script>";
$success_alert = "<script>$('#formSignin .alert').attr('class', 'alert alert-success');</script>";

// Nếu tồn tại username

if (UserController::getInstance()->selectByUsername($user_signin))
{
    // Nếu đúng
    if (UserController::getInstance()->checkLogin($user_signin, $pass_signin))
    {
        // Gửi dữ liệu để lưu session
        $session->setUser($user_signin);
 
        // Hiển thị thông báo và tải lại trang
        echo $show_alert.$success_alert." Đăng nhập thành công.
            <script>
                location.reload();
            </script>
        ";
    }
    // Ngược lại nếu sai
    else
    {
        echo $show_alert.'Mật khẩu không chính xác, đảm bảo đã tắt caps lock.';
    }
}
// Ngược lại không tồn tại username
else
{
    echo $show_alert.'Tên đăng nhập không thuộc bất cứ tài khoản nào.';
}
 
?>