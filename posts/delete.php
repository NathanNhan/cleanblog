<?php
session_start();
require_once '../config/config.php';

if(isset($_GET['id']) ) {
    $id = $_GET['id'];
    //Lấy bài viết cần xóa theo id 
    $single = $conn->query("SELECT * FROM posts where id = '$id'");
    $single->execute(); 
    $post = $single->fetch(PDO::FETCH_OBJ);
    if(isset($_SESSION['userid']) and $_SESSION['userid'] == $post->user_id ) {
        //Xóa hình ảnh thuộc bài viết chi tiết
        unlink('images/'.$post->image.'');
        
        //Xóa bài viết chi tiết ở database
        $post_delete = $conn->prepare("DELETE FROM posts where id = :id");
        $post_delete->execute([
            ':id' => $id
        ]);   
    }  
    header('location: ../index.php');
}



?>