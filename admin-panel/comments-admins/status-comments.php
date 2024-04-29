<?php require "../../config/config.php"; ?>


<?php 

   //Chặn (interceptors) không cho user cập nhật trực tiếp thông qua đường dẫn khi chưa đăng nhập
    if(!isset($_SESSION['adminname'])) {
      header ('location: http://cleanblog.test/admin-panel/admins/login-admins.php');
    }

    if(isset($_GET['id']) && isset($_GET['status'])) {
        $id = $_GET['id'];
        $status = $_GET['status'];

        if($status == 0) {
            $update = $conn->prepare("UPDATE comments set status_comment = :status where id = '$id'");
            $update->execute([
                ':status' => 1
            ]);
            header('location: http://cleanblog.test/admin-panel/comments-admins/show-comments.php');
        } else {
            $update = $conn->prepare("UPDATE comments set status_comment = :status where id = '$id'");
            $update->execute([
                ':status' => 0
            ]);
            header('location: http://cleanblog.test/admin-panel/comments-admins/show-comments.php');
        }
            
            
    } else {
        header('location: http://cleanblog.test/404.php');
    }






?>