<?php
// display post by id
if (isset($_GET['p_id'])) {


    $get_post_id = $_GET['p_id'];

    $query = " SELECT * FROM posts WHERE post_id = {$get_post_id}";
    $displayPostsById = mysqli_query($db, $query);

    while ($row = mysqli_fetch_assoc($displayPostsById)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
    }
}

//edit post query
if (isset($_POST['updatePost'])) {

    $post_title = $_POST['title'];
    $post_category = $_POST['category'];
    $post_author = $_POST['author'];
    $post_status = $_POST['status'];
    $post_image = $_FILES['image']['name'];
    $post_image_tmp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['tags'];
    $post_content = $_POST['content'];
    $post_date = date('d-m-y');
    $post_comments_count = 4;

    move_uploaded_file($post_image_tmp, "../images/$post_image");

    $post_content = mysqli_real_escape_string($db,$post_content);

    if(empty($post_image)){

        $query= "SELECT * FROM posts WHERE post_id = {$get_post_id}";
        $sameImage = mysqli_query($db, $query);

        while($row = mysqli_fetch_assoc($sameImage)){
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET post_category_id={$post_category},post_title='{$post_title}',post_author='{$post_author}',";
    $query .= "post_date= now() ,post_image='{$post_image}', post_content ='{$post_content}',";
    $query .= "post_tags='{$post_tags}',post_comment_count='{$post_comments_count}',post_status='{$post_status}' WHERE post_id = {$get_post_id}";

    $updatePostQuery = mysqli_query($db, $query);

    if (!$updatePostQuery) {
        die("adding post failed" . mysqli_error($db));
    }
}


?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $post_title; ?>">
    </div>

    <div class="form-group">
        <label for="category">Post category</label><br>
        <select value="" name="category" id="">

            <?php $query = " SELECT * FROM categories";
            $displayCats = mysqli_query($db, $query);

            while ($row = mysqli_fetch_assoc($displayCats)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option name='category' value= '$cat_id'>$cat_title</option>";

            } ?>



        </select>
    </div>

    <div class="form-group">
        <label for="author">Post author</label>
        <input type="text" class="form-control" id="author" name="author" value="<?php echo $post_author; ?>">
    </div>

    <div class="form-group">
        <label for="status">Post status</label><br>
        <select value="" name="status" id="">
            
            <option value="published">published</option>
            <option value="draft">draft</option>

        </select>
    </div>
   

    <div class="form-group">
        <label for="image">Post image</label> <br>
        <img width="100" src="../images/<?php echo $post_image;  ?>"><br><br>
        <input type="file" class="form-control" id="image" name="image" >
    </div>

    <div class="form-group">
        <label for="tags">Post tags</label>
        <input type="text" class="form-control" id="tags" name="tags" value="<?php echo $post_tags; ?>">
    </div>

    <div class="form-group">
        <label for="content">Post content</label>
        <TEXTarea style="width: 550px;height: 300px;" name="content"><?php echo $post_content; ?></TEXTarea>
        
    </div>

    <button type="submit" class="btn btn-primary" name="updatePost">Edit</button>

</form>