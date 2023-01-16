<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Update Title</label>

        <?php
        if (isset($_GET['edit'])) {
            $cat_edit_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE id = $cat_edit_id";
            $edit_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($edit_query)) {
                $cat_edit_id = $row['id'];
                $cat_title = $row['title']; ?>

                <input value="<?php if (isset($cat_title)) {
                                    echo $cat_title;
                                }  ?>" type="text" class="form-control" name="cat_title">


        <?php
            }
        }

        ?>

        <?php

        if (isset($_POST['update'])) {
            $cat_edit_title = $_POST['cat_title'];
            $query = "UPDATE categories SET title = '$cat_edit_title' WHERE id = $cat_edit_id";
            mysqli_query($connection, $query);
            header("Location: categories.php");
        }

        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Update Category" name="update">
    </div>
</form>