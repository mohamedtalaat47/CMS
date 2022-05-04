<?php include "includes/header.php" ?>

<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php include "includes/navigation.php" ?>

<div id="page-wrapper">

  <?php

  if (isset($_SESSION['username'])) {

    $select_user = $_SESSION['username'];

    $query = " SELECT * FROM users WHERE username = '{$select_user}'";
    $displayuserBySession = mysqli_query($db, $query);

    while ($row = mysqli_fetch_assoc($displayuserBySession)) {

      $user_id = $row['user_id'];
      $username = $row['username'];
      $user_password = $row['user_password'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];
      $user_img = $row['user_img'];
      $user_role = $row['user_role'];
    }
  }

  if (isset($_POST['updateUser'])) {


    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    // $post_image = $_FILES['image']['name'];
    // $post_image_tmp = $_FILES['image']['tmp_name'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    //$post_date = date('d-m-y');
    // move_uploaded_file($post_image_tmp, "../images/$post_image");




    $query = "UPDATE `users` SET `username`='$username',`user_password`='$user_password',`user_firstname`='$user_firstname',";
    $query .= "`user_lastname`='$user_lastname',`user_email`='$user_email' WHERE username = '{$username}' ";

    $editUserQuery = mysqli_query($db, $query);

    if (!$editUserQuery) {
      die("updating user failed" . mysqli_error($db));
    }
  }


  ?>

  <form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
      <label for="title">Firstname</label>
      <input type="text" class="form-control" id="title" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>

    <div class="form-group">
      <label for="title">Lastname</label>
      <input type="text" class="form-control" id="title" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>

    <div class="form-group">
      <label for="title">Username</label>
      <input type="text" class="form-control" id="title" name="username" value="<?php echo $username; ?>">
    </div>

    <div class="form-group">
      <label for="title">Email</label>
      <input type="text" class="form-control" id="title" name="user_email" value="<?php echo $user_email; ?>">
    </div>

    <div class="form-group">
      <label for="title">Password</label>
      <input type="text" class="form-control" id="title" name="user_password" value="<?php echo $user_password; ?>">
    </div>


    
      <br>





      <!-- <div class="form-group">
    <label for="image">Post image</label>
    <input type="file" class="form-control" id="image" name="image" >
  </div> -->


      <button type="submit" class="btn btn-primary" name="updateUser">Update profile</button>

  </form>
</div>
<!-- /#page-wrapper -->
<?php include "includes/footer.php" ?>