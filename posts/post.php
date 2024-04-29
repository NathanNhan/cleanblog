     <!-- Navigation-->
        <?php 
        require_once '../includes/navbar.php';
        //Nhúng PDO vào 
        require_once '../config/config.php';
        
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            // Viết câu truy vấn query thông qua PDO 
            $post = $conn->query("SELECT * FROM posts where id = '$id'");
            //Chạy câu truy vấn 
            $post->execute();
            //Convert sang đối tượng thông phương thức fetch()
            $row = $post->fetch(PDO::FETCH_OBJ);
        } else {
            header('location: ../404.php');
        }

        //Xử lý insert comment vào cơ sở dữ liệu
        if(isset($_POST['submit']) AND isset($_GET['id'])) {
            // id bài viết mà chúng ta bình luận
            $id = $_GET['id']; 
            // Tên người bình luận
            $author_name = $_SESSION['username'];
            //Nội dung comment 
            $comment = $_POST['comment'];
            //Viết câu truy vấn insert to databse 
            $insert = $conn->prepare("INSERT INTO comments (id_post, author, comments) VALUES (:id_post, :author, :comments)");
            $insert->execute([
                ':id_post' => $id, 
                ':author' => $author_name,
                ':comments' => $comment
            ]);
            //Sau khi mà tạo mới bình luận cho bài viết thành công thì chúng ta sẽ cho quay lại trang chi tiết bài viết
            header('location: post.php?id='.$id.'');

        }
        
        
        ?>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('images/<?php echo $row->image ?>')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1><?php echo $row->title; ?></h1>
                            <h2 class="subheading"><?php echo $row->subtitle ?></h2>
                            <span class="meta">
                                Posted by
                                <a href="#!"><?php echo $row->user_name ?></a>
                                on on <?php echo date('m', strtotime($row->created_at)) . '-' . date('d', strtotime($row->created_at)) . '-' . date('Y', strtotime($row->created_at));?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                          <?php echo $row->body; ?><br>
                          <?php if(isset($_SESSION['userid']) and $_SESSION['userid'] == $row->user_id) : ?>
                          <a href="delete.php?id=<?php echo $row->id ?>" class="btn btn-danger text-center float-end">Delete</a>
                          <a href="update.php?id=<?php echo $row->id ?>" class="btn btn-warning text-center">Update</a>
                          <?php endif; ?>
                          </div>
                </div>
            </div>
        </article>


    <section>
          <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
              <div class="col-md-12 col-lg-10 col-xl-8">
               
                <h3 class="mb-5">Comments</h3>          
                    <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-start align-items-center">
                            <div>
                                <h6 class="fw-bold text-primary">
                                    Trọng Nhân
                                    <h8 class="p-3 text-black">02/01/2024</h8>
                                </h6>
                                
                            </div>
                            </div>
                            <p class="mt-3 mb-4 pb-2">
                              This is comments
                            </p>
                            <hr class="my-4" />
                    </div>
                   
                 
                  <form method="POST" action="post.php?id=<?php echo $row->id;?>">

                        <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">

                            <div class="d-flex flex-start w-100">
                            
                                <div class="form-outline w-100">
                                    <textarea class="form-control" id="" placeholder="write message" rows="4"
                                     name="comment"></textarea>
                                
                                </div>
                            </div>
                            <div class="float-end mt-2 pt-1">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm mb-3">Post comment</button>
                            </div>
                        </div>
                    </form>
                      
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Footer-->
       <?php require_once '../includes/footer.php' ?>
