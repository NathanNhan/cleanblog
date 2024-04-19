<?php
 require_once './includes/header.php';
 require_once './config/config.php'; 
//  Bước 1: Các bạn viết câu truy vấn query
 $posts = $conn->query("select * from posts");
 // Bước 2: Chạy câu truy vấn query
 $posts->execute();
 //Bước 3: Lấy về kết quả theo kiểu mảng
 $rows = $posts->fetchAll(PDO::FETCH_ASSOC);
//  print_r($rows);
?>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <?php
                       foreach ($rows as $row) {
                        ?>
                           <div class="post-preview">
                               <a href="posts/post.html?id=<?php echo $row["id"]; ?>">
                                   <h2 class="post-title"><?php echo $row['title']; ?></h2>
                                   <h3 class="post-subtitle"><?php echo $row['subtitle']; ?></h3>
                               </a>
                               <p class="post-meta">
                                   Posted by
                                   <a href="#!"><?php echo $row['user_name']; ?></a>
                                   on <?php echo date('m', strtotime($row['created_at'])) . date('d', strtotime($row['created_at'])) . date('Y', strtotime($row['created_at']));?>
                               </p>
                           </div>
                           <!-- Divider-->
                           <hr class="my-4" />
                           
                        <?php
                       }
                    
                    ?>
                    

                    
                </div>
            </div>
        </div>
        <!-- Footer-->
<?php
 require_once './includes/footer.php';

?>
