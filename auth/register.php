
<?php
  require_once '../includes/header.php';
  //Nhúng PDO vào để thao tác truy vấn xuống database
  require_once '../config/config.php';
  //If session username có tồn tại thì chuyển sang trang chủ 
  if(isset($_SESSION['username'])) {
    header('Location: ../index.php');
   }
  if(isset($_POST['submit'])) {
    // $_GET['name'] -> lấy các giá trị của các input form thông qua phương thức GET 
    // $_POST['name'] -> lấy ra các giá trị input nhập vào của form thông qua phương thức POST 
    if($_POST['email'] == '' or $_POST['username'] == '' or $_POST['password'] == '') {
       echo "<div class='alert alert-danger text-center' role='alert'>
               Please fill one or more fields
            </div>";
    } else {
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      // Insert dữ liệu vào trong database
      $insert = $conn->prepare("INSERT INTO users(email, username, password) VALUES (:email, :username, :password)");
      $insert->execute([
        ':email' => $email, 
        ':username' => $username, 
        ':password' => $password
      ]);
      
      header('Location: login.php');

    }
  }
?>
                <!-- Main Content-->
        <div class="container px-4 px-lg-5">

            <form method="POST" action="register.php">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="" name="username" id="form2Example1" class="form-control" placeholder="Username" />
               
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                
              </div>



              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Register</button>

              <!-- Register buttons -->
              <div class="text-center">
                <p>Aleardy a member? <a href="login.php">Login</a></p>
                

               
              </div>
            </form>


           
        </div>
    <!-- Footer-->

<?php
  require_once '../includes/footer.php'
?>