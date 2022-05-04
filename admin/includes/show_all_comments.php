<table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>In response to</th>
                            <th>Date</th>
                            <th>Approve</th>
                            <th>Decline</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        $query = " SELECT * FROM comments";
                        $displaycomments = mysqli_query($db, $query);
                    
                        while ($row = mysqli_fetch_assoc($displaycomments)) {
                            $comment_id = $row['comment_id'];
                            $comment_author = $row['comment_author'];
                            $comment_content = $row['comment_content'];
                            $comment_email = $row['comment_email'];
                            $comment_status = $row['comment_status'];
                            $comment_post_id = $row['comment_post_id'];
                            $comment_date = $row['comment_date'];
                          
                            echo "<tr>";
                            echo "<td>{$comment_id}</td>";
                            echo "<td>{$comment_author}</td>";
                            echo "<td>{$comment_content}</td>";
                            echo "<td>{$comment_email}</td>";
                            echo "<td>{$comment_status}</td>";
                            
                            $query = " SELECT * FROM posts WHERE post_id = {$comment_post_id} ";
                            $comment_post_title = mysqli_query($db, $query);
                
                            while ($row = mysqli_fetch_assoc($comment_post_title)) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                
                               echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                
                            }

                            echo "<td>{$comment_date}</td>";
                            echo "<td><a href='comments.php?approve={$comment_id}' >Approve</a></td>";
                            echo "<td><a href='comments.php?decline={$comment_id}' >Decline</a></td>";
                            echo "<td><a onClick= \" javascript: return confirm('Are you sure you want to delete this comment?'); \" href='comments.php?delete={$comment_id}' style= 'color: red;' >Delete</a></td>";
                            echo "</tr>";
                        }
                        
                        if(isset($_GET['approve'])){

                            $approve_comment_id = $_GET['approve'];
 
                            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approve_comment_id";
                            $approve_comment_query = mysqli_query($db,$query);
                            header("Location: comments.php");
 
                         }


                        if(isset($_GET['decline'])){

                            $decline_comment_id = $_GET['decline'];
 
                            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $decline_comment_id";
                            $decline_comment_query = mysqli_query($db,$query);
                            header("Location: comments.php");
 
                         }



                        if(isset($_GET['delete'])){

                           $delete_comment_id = $_GET['delete'];

                           $query = "DELETE FROM comments WHERE comment_id = {$delete_comment_id}";
                           $delete_comment_query = mysqli_query($db,$query);
                           header("Location: comments.php");

                        }



                        ?>
                    </tbody>
                </table>