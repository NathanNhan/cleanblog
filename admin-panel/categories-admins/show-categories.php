<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 

   $select = $conn->query("select * from category");
   $select->execute();
   $categories = $select->fetchAll(PDO::FETCH_ASSOC);



?>
<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Categories</h5>
             <a  href="create-category.php" class="btn btn-outline-primary mb-4 text-center float-right">Create Category</a>
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
                  <?php foreach ($categories as $category) : ?>
                    <tr>
                      <th><?php echo $category['id'] ?></th>
                      <td><?php echo $category['name'] ?></td>
                      <td><a href="update-category.php?id=<?php echo $category['id'] ?>" class="btn btn-outline-warning text-center">Update</a></td>
                      <td><a href="delete-category.php?id=<?php echo $category['id'] ?>" class="btn btn-outline-danger text-center">Delete</a></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



      
<?php require "../layouts/footer.php"; ?>