$("#submit_signup").on("click", function(){
	$user_signup = $("#user_signup").val();
	$pass_signup = $("#pass_signup").val();
	$repass_signup = $("#repass_signup").val();

	if($user_signup == '' || $pass_signup == '' || $repass_signup == '') //Check rỗng
	{
		$('#formSignup .alert').removeClass('hidden');
        $('#formSignup .alert').html('Vui lòng điền đầy đủ thông tin bên trên.');
	}
	else
    {
        // Thực thi gửi dữ liệu bằng Ajax
        $.ajax({
            url : 'signup.php', // Đường dẫn file nhận dữ liệu
            type : 'POST', // Phương thức gửi dữ liệu
            // Các dữ liệu
            data : {
                user_signup : $user_signup,
                pass_signup : $pass_signup,
                repass_signup : $repass_signup
            // Thực thi khi gửi dữ liệu thành công
            }, success : function(data) {
                $('#formSignup .alert').html(data);
            }
        });
    }
});