<form action="" method="POST" class="form-group">
                        <label for="addCat">Edit category</label>
                        <br>
                        <?php //display edit category input
                        if (isset($_GET['edit'])) {

                            $getCatId = $_GET['edit'];
                            $query = "SELECT * FROM categories WHERE cat_id = {$getCatId}";
                            $showEditQuery = mysqli_query($db, $query);
                            while ($row = mysqli_fetch_assoc($showEditQuery)) {
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                            }
                            echo "<input class='col-lg-6 ' type='text' name='cat_title' id='addCat' value='$cat_title'>";
                        }

                        if (isset($_POST['edit'])) {

                            $cat_title = $_POST['cat_title'];
    
                            $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = '{$cat_id}'";
    
                            $editCatQuery = mysqli_query($db, $query);
    
                            if (!$editCatQuery) {
                                die("Updating category failed" . mysqli_error($db));
                            }
                        }

                        ?>

                        <br> <br>
                        <input type="submit" name="edit" class="btn btn-primary" value="Update category">



                    </form>