<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 
    //Mặc định lần đầu tiên hiển thị thì page = 1 
    $start_from = 0;
    //Giới hạn số bài viết hiển thị cho 1 trang 
    $posts_per_page = 2;
    $page = 1; 
    if(isset($_GET['page'])) {
      $page = intval($_GET['page']);
      //Tính vị trí bắt đầu lấy dữ liệu
      $start_from = ( $page - 1 ) * $posts_per_page;
    } 
    

        
      $select = $conn->query("SELECT posts.id, posts.title, category.name, posts.user_name from posts inner join category on posts.category_id = category.id LIMIT $start_from , $posts_per_page");
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
                   <!-- Pagination -->
                   
                   <nav aria-label="...">
                      <ul class="pagination pagination-lg">
                        <?php
                           $totalPost = $conn->query("SELECT count(*) as total from posts;");
                           $totalPost->execute();
                           $total_posts = $totalPost->fetch(PDO::FETCH_OBJ);
                           
                           

                           $pagination_number = ceil((intval($total_posts->total) / $posts_per_page));
                          
                           //Vòng Lặp để in ra số phân trang
                           for ($i=1; $i <= $pagination_number ; $i++) { 
                            ?>
                             <li class="page-item"><a class="page-link" href="show-posts.php?page=<?php echo $i ?>"><?php echo $i; ?></a></li>
                            
                            <?php 
                           }
                        
                        ?>
                      </ul>
                  </nav>
            </div>
          </div>
        </div>
</div>

<?php require "../layouts/footer.php"; ?>
