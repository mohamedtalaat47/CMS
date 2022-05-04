<?php include "db.php"; session_start() ?>

<?php 


if(isset($_POST['login'])){

    $username= $_POST['username'];
    $password= $_POST['password'];

    $username = mysqli_real_escape_string($db,$username);
    $password = mysqli_real_escape_string($db,$password);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_username_query = mysqli_query($db,$query);

    if(!$select_username_query){
        die ("failed ".mysqli_error($db));
    }

    while($row = mysqli_fetch_assoc($select_username_query)){
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];

        $password = crypt($password,$db_user_password);

        
    }

    if($username === $db_username && $password === $db_user_password){
         
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        header("location: ../admin/index.php");
    
    }else{
        header("location: ../index.php");
    }
}



?>