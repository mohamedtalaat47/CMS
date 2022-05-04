<?php

if (isset($_GET['edit_user'])) {

    $get_user_id = $_GET['edit_user'];

    $query = " SELECT * FROM users WHERE user_id = {$get_user_id}";
    $displayuserById = mysqli_query($db, $query);

    while ($row = mysqli_fetch_assoc($displayuserById)) {
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
    $user_role = $_POST['user_role'];
    //$post_date = date('d-m-y');
    // move_uploaded_file($post_image_tmp, "../images/$post_image");



    $randsaltQuery = "SELECT randSalt FROM users";
    $randsalt = mysqli_query($db, $randsaltQuery);

    $row = mysqli_fetch_assoc($randsalt);
    $salt = $row['randSalt'];

    $hash_password = crypt($user_password, $salt);


    $query = "UPDATE `users` SET `username`='$username',`user_password`='$hash_password',`user_firstname`='$user_firstname',";
    $query .= "`user_lastname`='$user_lastname',`user_email`='$user_email',`user_role`='$user_role' WHERE user_id = $get_user_id ";

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
        <input type="password" class="form-control" id="title" name="user_password" value="<?php echo $user_password; ?>">
    </div>


    <div class="form-group">
        <label for="category">User role</label><br>
        <select value="" name="user_role" id="" value="<?php echo $user_id; ?>">

            <option name="user_role" value="<?php echo $user_role; ?>" selected="selected"><?php echo $user_role; ?></option>

            <?php if ($user_role == 'admin') {

                echo '<option name="user_role" value="subscriber">subscriber</option>';
            } else {

                echo '<option name="user_role" value="admin">admin</option>';
            }
            ?>

        </select>
        <br><br>





        <!-- <div class="form-group">
    <label for="image">Post image</label>
    <input type="file" class="form-control" id="image" name="image" >
  </div> -->


        <button type="submit" class="btn btn-primary" name="updateUser">Update user</button>

</form>