<?php include "includes/header.php" ?>

<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php include "includes/navigation.php" ?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to admin page
                    <small>Author</small>
                </h1>
                <div class="col-xs-6">


                    <?php addCategory() ?>

                    <form action="" method="POST" class="form-group">
                        <label for="addCat">Add category</label>
                        <br>
                        <input class="col-lg-6 " type="text" name="cat_title" id="addCat">
                        <br> <br>
                        <input type="submit" name="submit" class="btn btn-primary" value="Add category">



                    </form>

                    <?php if (isset($_GET['edit'])) {
                        include "includes/edit_categories.php";
                    } ?>

                </div>
                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Category id</th>
                                <th>Category title</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            displayCategories();
                            deleteCategory();
                            ?>



                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

<!-- /#page-wrapper -->
<?php include "includes/footer.php" ?>