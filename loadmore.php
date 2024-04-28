<?php 
  require_once './config/config.php';
  if(isset($_POST['last_post_id'])) {
      //Lấy id cuối cùng của bài viết
      $id = $_POST['last_post_id'];
      // Lấy bài viết có ID lớn hơn id cuối cùng và giới hạn lấy 2 bài 
      $post = $conn->query("select * from posts where id > '$id' and status = 1 limit 2");
      $post->execute();
      $allPosts = $post->fetchAll(PDO::FETCH_ASSOC);
      // 2 bài viết có id là 21 và 22
      // 2 bài viết có id là 23 và 24 
      //Nếu kết quả truy vấn query lấy về danh sách > 0
      if(count($allPosts) > 0) {
           $output = '';
           foreach ($allPosts as $item) {
            //Lần đầu : $last_id = 23
            //Lần 2 : $last_id = 24;
             $last_id = $item["id"]; 
     
             $output .= '<div class="post-preview">
                           <a href="posts/post.php?id='.$item["id"].'"'.'>
                                 <h2 class="post-title">'.$item["title"].'</h2>
                                 <h3 class="post-subtitle">'. $item["subtitle"].'</h3>
                            </a>
                                    <p class="post-meta">
                                        Posted by ' . $item["user_name"] . '
                                        <a href="#!"></a>
                                        on '. date('m', strtotime($item['created_at'])). '-' . date('d', strtotime($item['created_at'])) . '-' . date('Y', strtotime($item['created_at'])) . '' . '
                                     </p>
                         </div>
                         <hr class="my-4" />';
             # code...
           }
     
           $output .= '<div class="mx-auto mb-5 d-flex justify-content-center" id="remove_row">
                             <button id="loadmore" class="btn btn-info text-center text-white" last-id='. $last_id .'>Load More</button>
                       </div>';
           echo $output;

       }
  }




?>