<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php  
    //If session username có tồn tại thì chuyển sang trang chủ 
  if(!isset($_SESSION['adminname'])) {
    header('Location: login-admins.php');
  }
  if(isset($_POST['submit'])) {
    // $_GET['name'] -> lấy các giá trị của các input form thông qua phương thức GET 
    // $_POST['name'] -> lấy ra các giá trị input nhập vào của form thông qua phương thức POST 
    if($_POST['email'] == '' or $_POST['adminname'] == '' or $_POST['password'] == '') {
       echo "<div class='alert alert-danger text-center' role='alert'>
               Please fill one or more fields
            </div>";
    } else {
      $email = $_POST['email'];
      $adminname = $_POST['adminname'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      // Insert dữ liệu vào trong database
      $insert = $conn->prepare("INSERT INTO admin(email, adminname, password) VALUES (:email, :adminname, :password)");
      $insert->execute([
        ':email' => $email, 
        ':adminname' => $adminname, 
        ':password' => $password
      ]);
      
      header('Location: admins.php');

    }
  }


?>
<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
                <form method="POST" action="create-admins.php">
                    <!-- Email input -->
                    <div class="form-outline mb-4 mt-4">
                      <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                    
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="username" />
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                    </div>
                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>

          
              </form>

            </div>
          </div>
        </div>
</div>

<?php require "../layouts/footer.php"; ?>
