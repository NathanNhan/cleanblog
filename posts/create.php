<?php require_once '../includes/header.php';
//Nhúng PDO config vào
require_once '../config/config.php';
if(isset($_POST['submit'])) {
  if($_POST['title'] == '' or $_POST['subtitle'] == '' or $_POST['body'] = '') {
    echo 'One or more field empty';
  } else {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $body = $_POST['body'];
    //Lấy tên hình
    $image = $_FILES['img']['name'];
    // print_r($_FILES['img']);
    //Khai báo đường dẫn lưu hình vào
    $dir = 'images/' . basename($image);
    
    //Insert xuống database
    $insert = $conn->prepare("INSERT INTO posts (title,subtitle,body,image,user_id,user_name) VALUES (:title, :subtitle,:body,:image,:user_id,:user_name)");
    $insert->execute([
        ':title' => $title,
        ':subtitle' => $subtitle,
        ':body' => $body, 
        ':image' => $image,
        ':user_id' => $_SESSION['userid'],
        ':user_name' => $_SESSION['username']
    ]);
    //Move đường dẫn cái hình từ máy tính local của mình vào trong cái thư mục images của dự án
    if(move_uploaded_file($_FILES['img']['tmp_name'], $dir)) {
        //Chuyển sang trang chủ khi tạo bài viết và di chuyển file hình vào dự án thành công
        header('location: ../index.php');
    }
  }
}

?>

                <!-- Main Content-->
        <div class="container px-4 px-lg-5">

            <form method="POST" action="create.php" enctype="multipart/form-data">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" />
            </div>

              <div class="form-outline mb-4">
                <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8"></textarea>
            </div>

              
             <div class="form-outline mb-4">
                <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
            </form>


           
        </div>
    <!-- Footer-->
<?php require_once '../includes/footer.php' ?>
