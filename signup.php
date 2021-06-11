<?php
	// Include database, session, general info
	require_once __DIR__ . "/library/core/constants.php";//Gọi file constant
	require_once ROOT_PROJECT . "/library/core/init.php";//Gọi file init core
	require_once ROOT_PROJECT . "/library/helper/form.php";//Gọi file validate form;

	if (isset($user) && $user)
	{ 
		header('Location: index.php');
	}

	$user_signup = filter_request_form(@$_POST['user_signup']);
	$pass_signup = filter_request_form(@$_POST['pass_signup']);
	$repass_signup = filter_request_form(@$_POST['repass_signup']);

	//Các biến thông báo
	$show_alert = "<script>$('#formSignup .alert').removeClass('hidden');</script>";
	$hide_alert = "<script>$('#formSignup .alert').addClass('hidden');</script>";
	$success_alert = "<script>$('#formSignup .alert').attr('class', 'alert alert-success');</script>";

	//Kiểm tra độ dài tên đăng nhập không thuộc khoảng 6 - 24
	if(strlen($user_signup) < 6 || strlen($user_signup) > 24)
	{
		echo $show_alert.'Tên đăng nhập phải nằm trong khoảng 6-24 ký tự.';
	}
	else if (preg_match('/\W/', $user_signup))//Kiểm tra khoảng trắng và ký tự đặc biệt
	{
	    echo $show_alert.'Tên đăng nhập không được chứa ký tự đặc biệt và khoảng trắng.';
	}
	// Ngược lại nếu tồn tại tên đăng nhập
	else if (UserController::getInstance()->selectByUsername($user_signup))
	{
	    echo $show_alert.'Tên đăng nhập đã tồn tại, vui lòng sử dụng tên khác.';
	}
	// Ngược lại nếu độ dài mật khẩu nhỏ hơn 6
	else if (strlen($pass_signup) < 6)
	{
	    echo $show_alert.'Mật khẩu quá ngắn, hãy thử với mật khẩu khác an toàn hơn.';
	}
	// Ngược lại nếu mật khẩu nhập lại không khớp
	else if ($pass_signup != $repass_signup)
	{
	    echo $show_alert.'Mật khẩu nhập lại không khớp, đảm bảo đã tắt caps lock.';
	}
	else
	{
	    $pass_signup = md5($pass_signup); // Mã hoá mật khẩu sang MD5

	    // Thực thi truy vấn
	 	UserController::getInstance()->insert($user_signup, $pass_signup, $date_current);
	 	
	    // Gửi dữ liệu để lưu session
	    $session->setUser($user_signup);
	     
	    // Hiển thị thông báo và tải lại trang
	    echo $show_alert.$success_alert." Đăng ký tài khoản thành công.
	        <script>
	            location.reload();
	        </script>
	    ";
	}
