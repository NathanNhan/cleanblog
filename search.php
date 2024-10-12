<?php 
require_once './includes/header.php';
require_once './config/config.php';
?>

<?php 
   if(isset($_POST['search'])) {
    if(empty($_POST['search'])) {
        echo "<div class='alert alert-danger text-center'>Please Enter the title for posts to search!</div>";
    } else {
        $search= $_POST['search'];

        $data = $conn->query("SELECT * from posts where title LIKE '%$search%'");

        $data->execute();

        $rows = $data->fetchAll(PDO::FETCH_OBJ);
        
        if($data->rowCount() == 0) {
            echo "<div class='alert alert-danger text-center'>No posts found!</div>";
        }

    
    }


   }

?>



<div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
<?php

foreach ($rows as $row) {
    ?>
                           <div class="post-preview">
                               <a href="posts/post.php?id=<?php echo $row->id; ?>">
                                   <h2 class="post-title"><?php echo $row->title ?></h2>
                                   <h3 class="post-subtitle"><?php echo $row->subtitle; ?></h3>
                               </a>
                               <p class="post-meta">
                                   Posted by
                                   <a href="#!"><?php echo $row->user_name; ?></a>
                                   on <?php echo date('m', strtotime($row->created_at)) . '-' . date('d', strtotime($row->created_at)) . '-' . date('Y', strtotime($row->created_at)); ?>
                               </p>
                           </div>
                           <!-- Divider-->
                           <hr class="my-4" />

                        <?php
}

?>
</div>
</div>


<?php require_once './includes/footer.php'; ?>
