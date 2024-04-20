<?php require_once '../includes/header.php';
//Nhúng PDO config vào
require_once '../config/config.php';
//Lấy tất cả chuyên mục bài viết từ cơ sở dữ liệu 
//  Bước 1: Các bạn viết câu truy vấn query
$categories = $conn->query("select * from category");
 // Bước 2: Chạy câu truy vấn query
 $categories->execute();
 //Bước 3: Lấy về kết quả theo kiểu mảng
 $rows_category = $categories->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['submit'])) {
  if($_POST['title'] == '' or $_POST['subtitle'] == '' or $_POST['body'] == '' or $_POST['category_id'] == '') {
    echo 'One or more field empty';
  } else {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $body = $_REQUEST['body'];
    $category_id = $_POST['category_id'];
    
    
    $image = $_FILES['img']['name'];
    // print_r($_FILES['img']);
    //Khai báo đường dẫn lưu hình vào
    $dir = 'images/' . basename($image);
    
    //Insert xuống database
    $insert = $conn->prepare("INSERT INTO posts (title,subtitle,image,body,category_id,user_id,user_name) VALUES (:title, :subtitle,:image,:body,:category_id,:user_id,:user_name)");
    $insert->execute([
        ':title' => $title,
        ':subtitle' => $subtitle,
        ':image' => $image,
        ':body' => $body, 
        ':user_id' => $_SESSION['userid'],
        ':user_name' => $_SESSION['username'], 
        ':category_id' => $category_id
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

            <form method="POST" action="create.php" enctype="multipart/form-data" id="form2Example1">
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
              <select name="category_id" class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <?php foreach ($rows_category as $cat) : ?> 
                <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>
                <?php endforeach; ?>
              </select>
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
