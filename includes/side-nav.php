<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">


<div class="well">
    <?php if(isset($_SESSION['user_role'])): ?>

        <h4>Welcome <?php echo $_SESSION['firstname']; ?></h4>

        <a href="admin/includes/logout.php" class="btn btn-danger">Logout</a>

    <?php else: ?>

        <!-- login -->
    <form action="./includes/login.php" method="post">
        
            <h4>Login</h4>
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter username">
            </div>
            <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Enter password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login">Login</button>
                </span>
            </div>
            <!-- /.input-group -->
        
    </form>

    <?php endif; ?>
    </div>
    



    <!-- Blog Search Well -->
    <form action="search.php" method="post">
        <div class="well">
            <h4>Blog Search</h4>
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
            <!-- /.input-group -->
        </div>
    </form>


    

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php

                    $query = " SELECT * FROM categories";
                    $sideBarCats = mysqli_query($db, $query);

                    while ($row = mysqli_fetch_assoc($sideBarCats)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li> <a href='./category.php?category=$cat_id'>{$cat_title}</a> </li>";
                    }

                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>