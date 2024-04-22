<?php require "layouts/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 
// Nếu như mà biến admin name của session không tồn tại => quay về trăng đăng nhập
   if(!isset($_SESSION['adminname'])) {
    header('Location: ./admins/login-admins.php');
   }


?>


            
<div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Posts</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of posts: 20</p>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              
              <p class="card-text">number of categories: 25</p>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: 50</p>
              
            </div>
          </div>
        </div>
</div>
  
<?php require "layouts/footer.php"; ?>
        