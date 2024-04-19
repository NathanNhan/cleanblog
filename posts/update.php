<?php 
require_once '../includes/header.php';
//Nhúng PDO config vào
require_once '../config/config.php';
//Lấy một bài viết theo ID
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            // Viết câu truy vấn query thông qua PDO 
            $post = $conn->query("SELECT * FROM posts where id = '$id'");
            //Chạy câu truy vấn 
            $post->execute();
            //Convert sang đối tượng thông phương thức fetch()
            $row = $post->fetch(PDO::FETCH_OBJ);
        }
//cập nhật bài viết theo ID
if(isset($_POST['submit'])) {
  if($_POST['title'] == '' or $_POST['subtitle'] == '' or $_POST['body'] = '') {
    echo 'One or more field empty';
  } else {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $body = $_REQUEST['body'];
    
    
    $image = $_FILES['img']['name'];
    //Nếu tồn tại 1 hình ảnh mới thì ta xóa ảnh cũ đi
    if(isset($image)) {
        unlink("images/".$row->image."");
    }
    // print_r($_FILES['img']);
    //Khai báo đường dẫn lưu hình vào
    $dir = 'images/' . basename($image);
    
    //Update xuống database
    $update = $conn->prepare("UPDATE posts SET title = :title, subtitle = :subtitle, image = :image, body=:body where id = '$id'");
    $update->execute([
        ':title' => $title,
        ':subtitle' => $subtitle,
        ':image' => $image,
        ':body' => $body, 
    ]);
    //Move đường dẫn cái hình từ máy tính local của mình vào trong cái thư mục images của dự án
    if(move_uploaded_file($_FILES['img']['tmp_name'], $dir)) {
        //Chuyển sang trang chủ khi tạo bài viết và di chuyển file hình vào dự án thành công
        header('location: ../index.php');
    }
  }
}
?>
       
        <div class="container px-4 px-lg-5">

            <form method="POST" action="update.php?id=<?php echo $row->id  ?>" enctype="multipart/form-data" id="form2Example1">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" value="<?php echo $row->title; ?>" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" value="<?php echo $row->title ?>"  />
            </div>

              <div class="form-outline mb-4">
                <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8"><?php echo $row->body ?></textarea>
            </div>

              
             <div class="form-outline mb-4">
                <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
            </div>

             <div class="form-outline mb-4">
                <img src="images/<?php echo $row->image ?>" width="350" height="350">
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

          
            </form>


           
        </div>
    <!-- Footer-->
<?php 
require_once '../includes/footer.php';



?>
