<?php

if (isset($_POST['addUser'])) {


  $username = escape($_POST['username']);
  $user_password = escape( $_POST['user_password']);
  $user_firstname = $_POST['user_firstname'];
  // $post_image = $_FILES['image']['name'];
  // $post_image_tmp = $_FILES['image']['tmp_name'];
  $user_lastname = $_POST['user_lastname'];
  $user_email = $_POST['user_email'];
  $user_role = $_POST['user_role'];
  //$post_date = date('d-m-y');


  // move_uploaded_file($post_image_tmp, "../images/$post_image");




  $query = "INSERT INTO `users`(`username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`,`user_role`)";
  $query .= "VALUES ('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}')";

  $addUserQuery = mysqli_query($db, $query);

  if (!$addUserQuery) {
    die("adding user failed" . mysqli_error($db));
  }

  echo "User was created succesfully!" . " : <a href='users.php'>Veiw all users</a>";
}
?>


<form action="" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Firstname</label>
    <input type="text" class="form-control" id="title" name="user_firstname">
  </div>

  <div class="form-group">
    <label for="title">Lastname</label>
    <input type="text" class="form-control" id="title" name="user_lastname">
  </div>

  <div class="form-group">
    <label for="title">Username</label>
    <input type="text" class="form-control" id="title" name="username">
  </div>

  <div class="form-group">
    <label for="title">Email</label>
    <input type="text" class="form-control" id="title" name="user_email">
  </div>

  <div class="form-group">
    <label for="title">Password</label>
    <input type="text" class="form-control" id="title" name="user_password">
  </div>


  <div class="form-group">
    <label for="category">User role</label><br>
    <select value="" name="user_role" id="">

      <option name="user_role" value="subscriber" selected="selected">Select role</option>
      <option name="user_role" value="subscriber">subscriber</option>
      <option name="user_role" value="admin">admin</option>

    </select>
    <br><br>


    <!-- <div class="form-group">
        <label for="category">User role</label><br>
        <select value="" name="category" id="">

            <?php $query = " SELECT * FROM users";
            $get_user_role = mysqli_query($db, $query);

            while ($row = mysqli_fetch_assoc($get_user_role)) {
              $user_id = $row['user_id'];
              $user_role = $row['user_role'];

              echo "<option name='category' value= '$user_id'>$user_role</option>";
            } ?>

        </select>
    </div> -->


    <!-- <div class="form-group">
    <label for="image">Post image</label>
    <input type="file" class="form-control" id="image" name="image" >
  </div> -->


    <button type="submit" class="btn btn-primary" name="addUser">Add user</button>

</form>