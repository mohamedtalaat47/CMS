<?php include "includes/header.php" ?>

<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php include "includes/navigation.php" ?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-6">
                <h1 class="page-header">
                    Welcome to admin page
                    <small>Author</small>
                </h1>

                <?php 
                
                if(isset($_GET['source'])){

                   $source = $_GET['source'];
                }else{
                    $source = "";
                }


                switch($source){

                    case 'add_post';
                    include "includes/add_post.php";
                    break;

                    case 'edit_post';
                    include "includes/edit_post.php";
                    break;

                    default: include "includes/show_all_posts.php";


                }
                
                
                
                
                
                
                
                ?>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

<!-- /#page-wrapper -->
<?php include "includes/footer.php" ?>