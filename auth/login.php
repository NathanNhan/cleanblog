
<?php
   require_once '../includes/header.php';
   require_once '../config/config.php';
   //Nếu session user có tồn tại -> tức là đã đăng nhập -> redirect về trang chủ 
   if(isset($_SESSION['username'])) {
    header('Location: ../index.php');
   }
   if(isset($_POST['submit'])) {
     if($_POST['email'] == '' or $_POST['password'] == '') {
      echo "<div class='alert alert-danger text-center' role='alert'>
                Please fill one or more field
            </div>";
     } else {
      $email = $_POST['email'];
      $password = $_POST['password']; 

      $login = $conn->query("SELECT * from users where email = '$email'");

      $login->execute();
      // stdObject -> Array => count (Array) > 0 -> Verify password == success -> login
      $row = $login->FETCH(PDO::FETCH_ASSOC);

      // array (
      //   array("email" => 'abc@gmail.com'),
      //   array("password" => 'abbkscv.asdlkja')
      // )
      if($login->rowCount() > 0) {
        if(password_verify($password, $row["password"])) {
          $_SESSION["username"] = $row["username"];
          $_SESSION["userid"] = $row['id'];
          header('Location: http://cleanblog.test/');
        } else {
          echo "<div class='alert alert-danger text-center' role='alert'>
                Password Wrong
                </div>";
        }
      } else {
        echo "<div class='alert alert-danger text-center' role='alert'>
                Can not found user with email
            </div>";
      }

     }
   }

?>
                <!-- Main Content-->
        <div class="container px-4 px-lg-5">

               <form method="POST" action="login.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                  <!-- Register buttons -->
                  <div class="text-center">
                    <p>a new member? Create an acount<a href="register.php"> Register</a></p>
                    

                   
                  </div>
                </form>

           
        </div>
    <!-- Footer-->
<?php
   require_once '../includes/footer.php';

?>
