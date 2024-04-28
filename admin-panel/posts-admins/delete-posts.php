<?php require "../../config/config.php"; ?>


<?php 

   //Chặn không cho user xóa trực tiếp thông qua đường dẫn khi chưa đăng nhập
  if(!isset($_SESSION['adminname'])) {
    header ('location: http://cleanblog.test/admin-panel/admins/login-admins.php');
   }
  
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $post_delete = $conn->prepare("DELETE FROM posts where id = :id");
    $post_delete->execute([
        ':id' => $id
    ]);
    header('location: show-posts.php?page=1');
  } else {
    header('location: http://cleanblog.test/404.php');
  }

?>