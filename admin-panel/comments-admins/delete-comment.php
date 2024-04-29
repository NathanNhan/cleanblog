<?php require "../../config/config.php"; ?>


<?php 

   //Chặn không cho user xóa trực tiếp thông qua đường dẫn khi chưa đăng nhập
  if(!isset($_SESSION['adminname'])) {
    header ('location: http://cleanblog.test/admin-panel/admins/login-admins.php');
   }
  
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $comment_delete = $conn->prepare("DELETE FROM comments where id = :id");
    $comment_delete->execute([
        ':id' => $id
    ]);
    header('location: show-comments.php');
  } else {
    header('location: http://cleanblog.test/404.php');
  }

?>