<?php 

class Session
{
	//Khởi tạo session
	public function start()
	{
		session_start();
	}

	public function setUser($user)
	{
		$_SESSION['user'] = $user;
	}

	//Hàm lấy dữ liệu
	public function getUser()
	{
		if(isset($_SESSION['user']))
		{
			$user = $_SESSION['user'];
		}
		else
		{
			$user = "";
		}

		return $user;
	}

	//Kết thúc session
	public function destroy()
	{
		session_destroy();
	}
}