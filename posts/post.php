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

                          <a href="delete.php?id=<?php echo $row->id ?>" class="btn btn-danger text-center float-end">Delete</a>
                          <a href="" class="btn btn-warning text-center">Update</a>
                          </div>
                </div>
            </div>
        </article>
        <!-- Footer-->
       <?php require_once '../includes/footer.php' ?>
