<?php require "layouts/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 
// Nếu như mà biến admin name của session không tồn tại => quay về trăng đăng nhập
   if(!isset($_SESSION['adminname'])) {
    header('Location: ./admins/login-admins.php');
   }

   //Tổng số bài viết 
   $select = $conn->query("SELECT COUNT(*) as total_post from posts;");

   $select->execute(); 

   $totalPosts = $select->fetch(PDO::FETCH_OBJ);

  //  print_r($totalPosts);


   //Tổng số chuyên mục bài viết 
   $select = $conn->query("SELECT COUNT(*) as total_category from category;");

   $select->execute(); 

   $totalCategories = $select->fetch(PDO::FETCH_OBJ);


   //Tổng số tài khoản admin 
   $select = $conn->query("SELECT COUNT(*) as total_admin from admin;");

   $select->execute(); 

   $totalAdmin = $select->fetch(PDO::FETCH_OBJ);


?>


            
<div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Posts</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of posts: <?php echo $totalPosts->total_post; ?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              
              <p class="card-text">number of categories: <?php echo $totalCategories->total_category; ?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: <?php echo $totalAdmin->total_admin; ?></p>
              
            </div>
          </div>
        </div>
</div>
  
<?php require "layouts/footer.php"; ?>
        