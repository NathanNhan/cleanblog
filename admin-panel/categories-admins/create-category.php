<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php  
if(!isset($_SESSION['adminname'])) {
  header ('location: http://cleanblog.test/admin-panel/admins/login-admins.php');
}
    //Xử lý tạo mới chuyên mục bài viết 
if(isset($_POST['submit'])) {
  if($_POST['name'] == '') {
    echo "<div class='alert alert-danger text-center' role='alert'>
               Please fill one or more fields
          </div>";
  } else {
    $category_name = $_POST['name'];
    //Insert xuống database
    $insert = $conn->prepare("INSERT INTO category (name) VALUES (:name)");
    $insert->execute([
        ':name' => $category_name,
    ]);
    //Move đường dẫn cái hình từ máy tính local của mình vào trong cái thư mục images của dự án
    header('location: show-categories.php');
  }
}
?>

<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Categories</h5>
          <form method="POST" action="create-category.php">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php require "../layouts/footer.php"; ?>
