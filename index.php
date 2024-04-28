<?php
 require_once './includes/header.php';
 require_once './config/config.php'; 
//  Bước 1: Các bạn viết câu truy vấn query
 $posts = $conn->query("select * from posts where status = 1 limit 2");
 // Bước 2: Chạy câu truy vấn query
 $posts->execute();
 //Bước 3: Lấy về kết quả theo kiểu mảng
 $rows = $posts->fetchAll(PDO::FETCH_ASSOC);
//  print_r($rows);


//  Bước 1: Các bạn viết câu truy vấn query
$categories = $conn->query("select * from category");
 // Bước 2: Chạy câu truy vấn query
 $categories->execute();
 //Bước 3: Lấy về kết quả theo kiểu mảng
 $rows_category = $categories->fetchAll(PDO::FETCH_ASSOC);



?>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7" id="load_data_container">
                    <!-- Post preview-->
                    <?php
                       foreach ($rows as $row) {
                        ?>
                           <div class="post-preview">
                               <a href="posts/post.php?id=<?php echo $row["id"]; ?>">
                                   <h2 class="post-title"><?php echo $row['title']; ?></h2>
                                   <h3 class="post-subtitle"><?php echo $row['subtitle']; ?></h3>
                               </a>
                               <p class="post-meta">
                                   Posted by
                                   <a href="#!"><?php echo $row['user_name']; ?></a>
                                   on <?php echo date('m', strtotime($row['created_at'])) . '-' . date('d', strtotime($row['created_at'])) . '-' . date('Y', strtotime($row['created_at']));?>
                               </p>
                           </div>
                           <!-- Divider-->
                           <hr class="my-4" />
                           
                        <?php
                       }
                    
                    ?>
                    <div class="mx-auto mb-5 d-flex justify-content-center" id="remove_row">
                        <button id="loadmore" class="btn btn-info text-center text-white" last-id=<?php echo $row['id'] ?>>Load More</button>

                    </div>
                    

                    
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                <?php foreach ($rows_category as $category) {   
                    ?>
                        <a href="./category/category.php?cat_id=<?php echo $category['id'] ?>" class="btn btn-secondary text-white">
                            <?php echo $category["name"] ?>
                        </a>
                        <?php
                } ?>
               
                </div>
            </div>    
        </div>
        <!-- Footer-->
        <!-- //Nhúng jquery vào  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function(){
                $(document).on("click","#loadmore",function(){
                    var last_post_id = $(this).attr("last-id");
                    console.log(last_post_id); 
                    //Lần đầu: last post id = 20
                    //Lần 2: last post id = 22
                    //Lần cuối: last post id = 24  
                    $("#loadmore").html("loading");
                    $.ajax({
                        url: "loadmore.php",
                        method : "POST",
                        data : {last_post_id: last_post_id},
                        dataType : 'text',
                        success: (data) => {
                            if(data != '') {
                                $("#remove_row").remove();
                                $('#load_data_container').append(data);
                            } else {
                                $('#loadmore').hide();
                            }
                        }  
                    })
                })
            });
        </script>
<?php
 require_once './includes/footer.php';

?>
