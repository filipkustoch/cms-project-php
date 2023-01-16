<?php
function insert_category()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(title) VALUE('$cat_title')";
            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function draw_table()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $select_all_categories_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
        $cat_title = $row['title'];
        $cat_id = $row['id'];

        echo "<tr><td>$cat_id</td><td>$cat_title</td><td><a href='categories.php?delete={$cat_id}'>Delete</a></td><td><a href='categories.php?edit={$cat_id}'>Edit</a></td></tr>";
    }
}

function delete_category()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $cat_delete_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE id= {$cat_delete_id}";
        mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}
