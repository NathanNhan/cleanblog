<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 
    
    $select = $conn->query("SELECT posts.id, posts.title, category.name, posts.user_name from posts inner join category on posts.category_id = category.id");
    $select->execute();
    $row = $select->fetchAll(PDO::FETCH_ASSOC);

   

?>
<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Posts</h5>
            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">category</th>
                    <th scope="col">user</th>
                    <th scope="col">status</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                   <?php foreach($row as $post) : ?>
                    <tr>
                      <th scope="row"><?php echo $post['id'] ?></th>
                      <td><?php echo $post['title'] ?></td>
                      <td><?php echo $post['name'] ?></td>
                      <td><?php echo $post['user_name'] ?></td>
                      <th>1</th>
                      <th><a href="" class="btn btn-danger text-center">Delete</a></th>
                    </tr>
                   <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
</div>


<?php require "../layouts/footer.php"; ?>
