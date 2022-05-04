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

                    <small><?php echo $_SESSION['firstname'] ?></small>
                </h1>

            </div>
        </div>
        <!-- /.row -->



        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                                <?php

                                $query = "SELECT * FROM posts";
                                $allPosts = mysqli_query($db, $query);
                                $allpostsNum = mysqli_num_rows($allPosts);

                                echo "<div class='huge'>{$allpostsNum}</div>"

                                ?>

                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php

                                $query = "SELECT * FROM comments";
                                $allComments = mysqli_query($db, $query);
                                $allcommentsNum = mysqli_num_rows($allComments);

                                echo "<div class='huge'>{$allcommentsNum}</div>"

                                ?>

                                <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php

                                $query = "SELECT * FROM users";
                                $allUsers = mysqli_query($db, $query);
                                $allUsersNum = mysqli_num_rows($allUsers);

                                echo "<div class='huge'>{$allUsersNum}</div>"

                                ?>
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php

                                $query = "SELECT * FROM categories";
                                $allCategories = mysqli_query($db, $query);
                                $allCategoriesNum = mysqli_num_rows($allCategories);

                                echo "<div class='huge'>{$allCategoriesNum}</div>"

                                ?>
                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="categories.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <?php 
        
        $query = "SELECT * FROM posts WHERE post_status = 'draft'";
        $draftPosts = mysqli_query($db, $query);
        $draftPostsNum = mysqli_num_rows($draftPosts);

        $query = "SELECT * FROM posts WHERE post_status = 'published'";
        $activePosts = mysqli_query($db, $query);
        $activePostsNum = mysqli_num_rows($activePosts);

        $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
        $pendingComments = mysqli_query($db, $query);
        $pendingCommentsNum = mysqli_num_rows($pendingComments);

        $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
        $userRoleQuery = mysqli_query($db, $query);
        $subscribersNum = mysqli_num_rows($userRoleQuery);

        
        
        
        ?>

        <div class="row">
            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['bar']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['data', 'count'],
                        <?php 
                        
                        $elementsNames = ['Active posts','Draft posts','Comments','Pending comments','Users','Subscribers','Categories'];
                        $elementsCount = [$activePostsNum,$draftPostsNum,$allcommentsNum,$pendingCommentsNum,$allUsersNum,$subscribersNum,$allCategoriesNum];

                        for($i= 0; $i < 7; $i++){

                            echo "['{$elementsNames[$i]}', {$elementsCount[$i]}],";

                        }
                        
                        
                        ?>
                        // ['posts', 1000],
                    ]);

                    var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>
            <div id="columnchart_material" style="width: 100%; height: 500px;"></div>

        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include "includes/footer.php" ?>