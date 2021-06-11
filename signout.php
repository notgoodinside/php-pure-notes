<?php
 
// Include database, session, general info
require_once 'library/core/init.php';
// Xoá session
$session->destroy();
// Trở về trang chủ
header('Location: index.php');
 
?>