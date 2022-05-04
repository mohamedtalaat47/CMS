<?php

//clear inputs before inserting to db
function escape($string){

    global $db;
    return mysqli_real_escape_string($db,trim(strip_tags($string)));

}


//add category

function addCategory(){


    global $db;
if (isset($_POST['submit'])) {

    $cat_title = $_POST['cat_title'];

    $query = "INSERT INTO categories(cat_title) VALUE ('$cat_title')";

    $addCatQuery = mysqli_query($db, $query);

    if (!$addCatQuery) {
        echo "adding category failed";
    }
}}


//display categories

function displayCategories(){

    
    global $db;
    $query = " SELECT * FROM categories";
    $displayCats = mysqli_query($db, $query);

    while ($row = mysqli_fetch_assoc($displayCats)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}' >Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}' >Edit</a></td>";
        echo "</tr>";
    }
}

//delete category

function deleteCategory(){

     global $db;

     if (isset($_GET['delete'])) {

        $getCatId = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$getCatId}";
        $deleteQuery = mysqli_query($db, $query);
        header("Location: categories.php");
    }

}


































?>