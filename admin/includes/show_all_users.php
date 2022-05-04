<?php include "delete_modale.php"; ?>
<table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Change to admin</th>
                            <th>Change to subscriber</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                        $query = " SELECT * FROM users";
                        $displayusers = mysqli_query($db, $query);
                    
                        while ($row = mysqli_fetch_assoc($displayusers)) {
                            $user_id = $row['user_id'];
                            $username = $row['username'];
                            $user_password = $row['user_password'];
                            $user_firstname = $row['user_firstname'];
                            $user_lastname = $row['user_lastname'];
                            $user_email = $row['user_email'];
                            $user_img = $row['user_img'];
                            $user_role = $row['user_role'];
                          
                            echo "<tr>";
                            echo "<td>{$user_id}</td>";
                            echo "<td>{$username}</td>";
                            echo "<td>{$user_firstname}</td>";
                            echo "<td>{$user_lastname}</td>";
                            echo "<td>{$user_email}</td>";
                            echo "<td>{$user_role}</td>";

                            
                            // $query = " SELECT * FROM posts WHERE post_id = {$comment_post_id} ";
                            // $comment_post_title = mysqli_query($db, $query);
                
                            // while ($row = mysqli_fetch_assoc($comment_post_title)) {
                            //     $post_id = $row['post_id'];
                            //     $post_title = $row['post_title'];
                
                            //    echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                
                            // }

                            
                            echo "<td><a href='users.php?make_admin={$user_id}' >Change to admin</a></td>";
                            echo "<td><a href='users.php?make_sub={$user_id}' >Change to subscriber</a></td>";
                            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}' >Edit</a></td>";
                            echo "<td><a href='javascript:void(0)' rel='$user_id' class='delete_link' style='color:red;' >Delete</a></td>";
                            // echo "<td><a onClick= \" javascript: return confirm('Are you sure you want to delete this user?'); \" href='users.php?delete={$user_id}' style= 'color: red;' >Delete</a></td>";
                            echo "</tr>";
                        }
                        
                        if(isset($_GET['make_admin'])){

                            $make_admin_id = $_GET['make_admin'];
 
                            $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $make_admin_id";
                            $make_admin_query = mysqli_query($db,$query);
                            header("Location: users.php");
 
                         }


                         if(isset($_GET['make_sub'])){

                            $make_sub_id = $_GET['make_sub'];
 
                            $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $make_sub_id";
                            $make_admin_query = mysqli_query($db,$query);
                            header("Location: users.php");
 
                         }


                         if(isset($_SESSION['user_role'])){

                            if($_SESSION['user_role'] == 'admin'){

                                if(isset($_GET['delete'])){

                                    $delete_user_id = $_GET['delete'];
         
                                    $query = "DELETE FROM users WHERE user_id = {$delete_user_id}";
                                    $delete_user_query = mysqli_query($db,$query);
                                    header("Location: users.php");
         
                                 }

                            }
                         }

                        



                        ?>
                    </tbody>
                </table>


<script>

    $(document).ready(function(){

        $(".delete_link").on('click', function(){

            var id = $(this).attr("rel");

            var delete_url = "users.php?delete="+id+" ";

            $(".modal_delete_link").attr("href",delete_url);

            $("#myModal").modal('show');

        });
    });


</script>