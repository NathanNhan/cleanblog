<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 

   



?>
<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Categories</h5>
             <a  href="create-category.php" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Hiển thị data -->
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



      
<?php require "../layouts/footer.php"; ?>