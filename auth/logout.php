<?php 
//Bắt đầu session
 session_start();
 //Xóa các biến trong session => username
 session_unset();
 //Xóa luôn cái session chứa các biến
 session_destroy();

 //Chuyển lại về trang chủ 
 header('Location: ../index.php')


?>