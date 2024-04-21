<?php 
require_once '../includes/header.php';
//Nhúng PDO config vào
require_once '../config/config.php';

//Lấy một bài viết theo ID
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            // Viết câu truy vấn query thông qua PDO 
            $user = $conn->query("SELECT * FROM users where id = '$id'");
            //Chạy câu truy vấn 
            $user->execute();
            //Convert sang đối tượng thông phương thức fetch()
            $row = $user->fetch(PDO::FETCH_OBJ);

        }
//cập nhật bài viết theo ID
if(isset($_POST['submit'])) {
  if($_POST['email'] == '' or $_POST['username'] == '') {
    echo 'One or more field empty';
  } else {
    $email = $_POST['email'];
    $username = $_POST['username'];
    
    
    //Update xuống database
    $update = $conn->prepare("UPDATE users SET email = :email, username = :username where id = '$id'");
    $update->execute([
        ':email' => $email,
        ':username' => $username,

    ]);
   
    header('location: profile.php?id='.$_SESSION['userid'].'');
  }
}
?>
       
        <div class="container px-4 px-lg-5">

            <form method="POST" action="profile.php?id=<?php echo $row->id  ?>" id="form2Example1">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="email" id="form2Example1" class="form-control" placeholder="email" value="<?php echo $row->email; ?>" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="username" id="form2Example1" class="form-control" placeholder="username" value="<?php echo $row->username ?>"  />
              </div>
              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

          
            </form>


           
        </div>
    <!-- Footer-->
<?php 
require_once '../includes/footer.php';



?>
