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



            if (isset($_POST['submit'])) {

                $search = $_POST['search'];

                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR post_title LIKE '%$search%'";
                $search_query = mysqli_query($db, $query);

                if (!$search_query) {

                    die("failed" . mysqli_error($db));
                }

                if (mysqli_num_rows($search_query) == 0) {

                    echo "<h1>no results found</h1>";
                } else {

                    while ($row = mysqli_fetch_assoc($search_query)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

            ?>

                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>



            <?php }
                }
            } ?>

            




        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/side-nav.php'; ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include 'includes/footer.php'; ?>