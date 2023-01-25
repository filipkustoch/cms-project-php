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

function draw_table_categories()
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

function draw_table_posts()
{
    global $connection;
    $query = "SELECT * FROM posts";
    $select_all_posts_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
        $post_id = $row['id'];
        $post_category_id = $row['category_id'];
        $post_title = $row['title'];
        $post_author = $row['author'];
        $post_date = $row['date'];
        $post_image = $row['image'];
        $post_content = $row['content'];
        $post_category = $row['tags'];
        $post_comments = $row['comment_count'];
        $post_status = $row['status'];

        $query = "SELECT * FROM categories WHERE id = $post_category_id";
        $edit_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($edit_query)) {
            $cat_title = $row['title'];
        }

        echo "<tr><td>$post_id</td><td>$cat_title</td><td>$post_title</td><td>$post_author</td><td>$post_date</td><td><img class='img-responsive' src='../images/$post_image'></td><td>$post_content</td><td>$post_category</td><td>$post_comments</td><td>$post_status</td><td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td><td><a href='posts.php?delete=$post_id'>Delete</a></td></tr>";
    }
}

function draw_table_comments()
{
    global $connection;
    $query = "SELECT * FROM comments";
    $select_all_comments_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_comments_query)) {
        $comment_id = $row['id'];
        $comment_post_id = $row['post_id'];
        $comment_author = $row['author'];
        $comment_email = $row['email'];
        $comment_content = $row['content'];
        $comment_status = $row['status'];
        $comment_date = $row['date'];

        $query_post_title = "SELECT title FROM posts WHERE id = $comment_post_id";
        $post_title_query = mysqli_query($connection, $query_post_title);
        while ($row = mysqli_fetch_assoc($post_title_query)) {
            $post_title = $row['title'];
        }

        echo "<tr><td>$comment_id</td><td><a href='../post.php?p_id=$comment_post_id'>$post_title</a></td><td>$comment_author</td><td>$comment_email</td><td>$comment_content</td><td>$comment_status</td><td>$comment_date</td><td><a href=''>Approve</a></td><td><a href=''>Disapprove</a></td><td><a href=''>Edit</a></td><td><a href='?delete=$comment_id'>Delete</a></td></tr>";
    }
}


function delete_category()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $comment_delete_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE id= {$comment_delete_id}";
        mysqli_query($connection, $query);
        header("Location: comments.php");
    }
}

function delete_comment()
{
    global $connection;
    if(isset($_GET['delete'])){
        $comment_delete_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE id = $comment_delete_id";
        mysqli_query($connection, $query);
        header("Location: comments.php");
    }
}
