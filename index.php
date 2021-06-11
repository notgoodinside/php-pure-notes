<?php
	require_once __DIR__ . "/library/core/constants.php";//Gọi file constant
	require_once ROOT_PROJECT . "/library/core/init.php";//Gọi file init core
	require_once ROOT_PROJECT . "/public/view/templates/header.php";//Gọi file header;
	require_once ROOT_PROJECT . "/library/helper/form.php";//Gọi file validate form;
	require_once  ROOT_PROJECT . "/controller/note.php";//Gọi note controller

	/*Main*/
	// Nếu tồn tại $user
	if (isset($user) && $user)
	{
	    // Kiểm tra hành động
	    if(isset($_GET['ac']))
		{
			$ac = filter_request_form($_GET['ac']);

			switch ($ac) {
				case 'create_note':
					require_once "public/view/create-note-form.php";
					break;
				case 'edit_note':
					// Nếu có ID truyền vào
			        if (isset($_GET['id']))
			        {
			            $get_id = filter_request_form($_GET['id']);
			            if ($get_id != '')
			            {
			                // Kiểm tra sự tồn tại và quyền sở hữu note 
			                if (NoteController::getInstance()->checkNote($data_user['id'], $get_id))
			                {
			                    // Include template chỉnh sửa note
			                    require_once 'public/view/edit-note-form.php';
			                }
			                // Ngược lại không tồn tại và không thuộc quyền sở hữu 
			                else
			                {   
			                    // Hiển thị thông báo lỗi
			                    echo '
			                        <div class="container">
			                            <div class="alert alert-danger">
			                                Note này không tồn tại hoặc không thuộc quyền sở hữu của bạn.
			                            </div>
			                        </div>
			                    ';
			                }                   
			            }
			            // Ngược lại không có ID truyền vào
			            else
			            {
			                header('Location: index.php'); // Di chuyển về trang chủ
			            }               
			        }
			        else
			        {
			            header('Location: index.php'); // Di chuyển về trang chủ
			        }
					break;
				case 'change_password':
	        		require_once 'public/view/change-pass-form.php';
					break;
				default:
					header('Location: index.php');
					break;
			}
		}
		else
		{
			// Include template danh sách ghi chú
	    	require_once 'public/view/list.php';
		}
	}
	// Ngược lại không tồn tại $user
	else
	{   
	    // Include template form đăng nhập, đăng ký
	    require_once 'public/view/sign-up-form.php';
	}
	/*Main*/

	require_once "public/view/templates/footer.php";//Gọi file footer;