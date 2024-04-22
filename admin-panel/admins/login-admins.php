<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php 

    //Lập trình tính năng login
   // Nếu session user có tồn tại -> tức là đã đăng nhập -> redirect về trang chủ 
   if(isset($_SESSION['adminname'])) {
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

      $login = $conn->query("SELECT * from admin where email = '$email'");

      $login->execute();
      // stdObject -> Array => count (Array) > 0 -> Verify password == success -> login
      $row = $login->FETCH(PDO::FETCH_ASSOC);

      // array (
      //   array("email" => 'abc@gmail.com'),
      //   array("password" => 'abbkscv.asdlkja')
      // )
      if($login->rowCount() > 0) {
        if(password_verify($password, $row["password"])) {
          $_SESSION["adminname"] = $row["adminname"];
          $_SESSION["adminid"] = $row['id'];
          header('Location: ../index.php');
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
<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-5">Login</h5>
              <form method="POST" class="p-auto" action="login-admins.php">
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

                 
                </form>

            </div>
       </div>
     </div>
</div>
<?php require "../layouts/footer.php"; ?>
