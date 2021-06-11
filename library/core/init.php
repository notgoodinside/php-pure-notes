<?php
	//Get Session Library
	require_once "library/classes/session.php";
	require_once "controller/user.php";

	//Set time default
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$date_current = "";
	$date_current = date("Y-m-d H:i:s");

	$session = new Session();//Khởi tạo object session
	$session->start();//Khởi động session
	//$session->destroy();//Khởi động session
	$user = $session->getUser();//Lấy dữ liệu session

	if(isset($user) && $user)
	{
		$data_user = UserController::getInstance()->selectByUsername($user);
	}