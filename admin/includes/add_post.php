<?php 

if(isset($_POST['addPost'])){

    $post_title = $_POST['title'];
    $post_category = $_POST['category'];
    $post_author = $_POST['author'];
    $post_status = $_POST['status'];
    $post_image = $_FILES['image']['name'];
    $post_image_tmp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['tags'];
    $post_content = $_POST['content'];
    $post_date = date('d-m-y');
    

    move_uploaded_file($post_image_tmp,"../images/$post_image");

    $post_content = mysqli_real_escape_string($db,$post_content);
  

    $query = "INSERT INTO `posts`(`post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`)";
    $query .=" VALUES ({$post_category},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

    $addPostQuery = mysqli_query($db,$query);

    if(!$addPostQuery){
        die("adding post failed" . mysqli_error($db));
    }
}


?>

<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Post title</label>
    <input type="text" class="form-control" id="title" name="title" >
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
    <input type="text" class="form-control" id="author" name="author" readonly value="<?php echo $_SESSION['username']; ?>" >
  </div>

  <div class="form-group">
        <label for="status">Post status</label><br>
        <select value="" name="status" id="">

            <option value="published">published</option>
            <option value="draft">draft</option>

        </select>
    </div>
  
  

  <div class="form-group">
    <label for="image">Post image</label>
    <input type="file" class="form-control" id="image" name="image" >
  </div>

  <div class="form-group">
    <label for="tags">Post tags</label>
    <input type="text" class="form-control" id="tags" name="tags" >
  </div>

  <div class="form-group">
    <label for="content">Post content</label>
    <input type="text" class="form-control" id="content" name="content" >
  </div>
  
  <button type="submit" class="btn btn-primary" name="addPost">Publish</button>
  
</form>