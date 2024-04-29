<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 
   $select = $conn->query("select comments.status_comment, comments.id, posts.title, comments.author, comments.comments from comments inner join posts on comments.id_post = posts.id");
   $select->execute();

   $comments = $select->fetchAll(PDO::FETCH_ASSOC);

   

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
                    <th scope="col">Title Post</th>
                    <th scope="col">Author comment</th>
                    <th scope="col">Comment</th>
                    <th scope="col">status</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                   <?php foreach($comments as $comment) : ?>
                    <tr>
                      <th scope="row"><?php echo $comment['id'] ?></th>
                      <td><?php echo $comment['title'] ?></td>
                      <td><?php echo $comment['author'] ?></td>
                      <td><?php echo $comment['comments'] ?></td>
                      <?php if($comment['status_comment'] == 0) : ?>
                      <td><a href="status-comments.php?id=<?php echo $comment['id']; ?>&status=<?php echo $comment['status_comment'] ?>" class="btn btn-danger text-center">UnApprove</a></td>
                      <?php else:  ?>
                      <td><a href="status-comments.php?id=<?php echo $comment['id']; ?>&status=<?php echo $comment['status_comment'] ?>" class="btn btn-primary text-center">Approve</a></td>
                      <?php endif; ?>
                         
                      
                      <td><a href="delete-comment.php?id=<?php echo $comment['id']; ?>" class="btn btn-danger text-center">Delete</a></td>
                     
                    </tr>
                   <?php endforeach; ?>

                   </tbody>
                   </table> 
                   <!-- Pagination -->
                   

            </div>
          </div>
        </div>
</div>

<?php require "../layouts/footer.php"; ?>
