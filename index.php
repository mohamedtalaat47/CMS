<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<!-- Page Content -->
<div class="container">

    <div class="row">
    

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->


            <?php

            $post_count_query = " SELECT * FROM posts WHERE post_status = 'published'";
            $countPostsQuery = mysqli_query($db, $post_count_query);
            $posts_count = mysqli_num_rows($countPostsQuery);

            $per_page = 5;
            $posts_count = ceil($posts_count / $per_page);

            if(isset($_GET['page'])){
               $page = $_GET['page'];
            }else{
                $page = "";
            }

            if($page == "" || $page == 1){
                $page_1 = 0;
            }else{
                $page_1 = ($page * $per_page) - $per_page;
            }

            $query = " SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1,$per_page";
            $showAllPosts = mysqli_query($db, $query);

            while ($row = mysqli_fetch_assoc($showAllPosts)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 100);
                $post_status = $row['post_status'];

                
            ?>


                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>



            <?php } ?>




        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/side-nav.php'; ?>

    </div>
    <!-- /.row -->

    
    <hr>

                <ul class="pager">

                <?php 

                    for($i=1;$i<=$posts_count;$i++){

                        if($i == $page){
                            echo "<li ><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";

                        }else{
                            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";

                        }

                    }
                
                ?>

                </ul>


    <?php include 'includes/footer.php'; ?>