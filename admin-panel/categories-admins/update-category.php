<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>


<?php 
     //Chặn (interceptors) không cho user cập nhật trực tiếp thông qua đường dẫn khi chưa đăng nhập
    if(!isset($_SESSION['adminname'])) {
      header ('location: http://cleanblog.test/admin-panel/admins/login-admins.php');
    }

     if(isset($_GET['id'])) {
            $id = $_GET['id'];
            // Viết câu truy vấn query thông qua PDO 
            $category = $conn->query("SELECT * FROM category where id = '$id'");
            //Chạy câu truy vấn 
            $category->execute();
            //Convert sang đối tượng thông phương thức fetch()
            $row = $category->fetch(PDO::FETCH_OBJ);
            if(isset($_POST['submit'])) {
              if($_POST['name'] == '') {
                echo "<div class='alert alert-danger text-center' role='alert'>
                           Please fill one or more fields
                      </div>";
              } else {
                $name = $_POST['name'];
                //Update xuống database
                $update = $conn->prepare("UPDATE category SET name = :name where id = '$id'");
                $update->execute([
                    ':name' => $name,
                ]);
                header('location: show-categories.php');
              }
            }
        } else {
            header('location: http://cleanblog.test/404.php');
        }




?>
<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Update Categories</h5>
          <form method="POST" action="">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text"  name="name" id="form2Example1" class="form-control" placeholder="name" value="<?php echo $row->name; ?>" />
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

          
              </form>

            </div>
          </div>
        </div>
</div>
<?php require "../layouts/footer.php"; ?>
