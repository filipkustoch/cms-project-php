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

        echo "<tr><td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='$post_id'></td><td>$post_id</td><td>$cat_title</td><td>$post_title</td><td>$post_author</td><td>$post_date</td><td><img class='img-responsive' src='../images/$post_image'></td><td>$post_content</td><td>$post_category</td><td>$post_comments</td><td>$post_status</td><td><a href='../post.php?p_id=$post_id'>Post Link</a></td><td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td><td><a href='posts.php?delete=$post_id'>Delete</a></td></tr>";
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

        echo "<tr><td>$comment_id</td><td><a href='../post.php?p_id=$comment_post_id'>$post_title</a></td><td>$comment_author</td><td>$comment_email</td><td>$comment_content</td><td>$comment_status</td><td>$comment_date</td><td><a href='?approve=$comment_id'>Approve</a></td><td><a href='?disapprove=$comment_id'>Disapprove</a></td><td><a href=''>Edit</a></td><td><a href='?delete=$comment_id'>Delete</a></td></tr>";
    }
}

function draw_table_users()
{
    global $connection;
    $query = "SELECT * FROM users";
    $select_all_comments_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_comments_query)) {
        $user_id = $row['id'];
        $user_username = $row['username'];
        $user_firstname = $row['firstname'];
        $user_lastname = $row['lastname'];
        $user_email = $row['email'];
        $user_role = $row['role'];

        echo "<tr><td>$user_id</td><td>$user_username</td><td>$user_firstname</td><td>$user_lastname</td><td>$user_email</td><td>$user_role</td><td><a href='?changeToUser=$user_id'>User</a></td><td><a href='?changeToAdmin=$user_id'>Admin</a></td><td><a href='?delete=$user_id'>Delete</a></td><td><a href='users.php?source=edit_user&user_id=$user_id'>Edit</a></td></tr>";
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
    if (isset($_GET['delete'])) {
        $comment_delete_id = $_GET['delete'];
        $query = "SELECT post_id FROM comments WHERE id = $comment_delete_id";
        $select_post_id = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($select_post_id)) {
            $post_id = $row['post_id'];
            $query = "UPDATE `posts` SET comment_count = comment_count - 1 WHERE id = $post_id";
            mysqli_query($connection, $query);
        }

        $query = "DELETE FROM comments WHERE id = $comment_delete_id";
        mysqli_query($connection, $query);
        header("Location: comments.php");
    }
}

function approve_comment()
{
    global $connection;
    if (isset($_GET['approve'])) {
        $comment_approve_id = $_GET['approve'];
        $query = "UPDATE comments SET `status` = 'approved' WHERE id = $comment_approve_id";
        mysqli_query($connection, $query);
        header("Location: comments.php");
    }
}

function disapprove_comment()
{
    global $connection;
    if (isset($_GET['disapprove'])) {
        $comment_disapprove_id = $_GET['disapprove'];
        $query = "UPDATE comments SET `status` = 'disapproved' WHERE id = $comment_disapprove_id";
        mysqli_query($connection, $query);
        header("Location: comments.php");
    }
}

function delete_user()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $user_delete_id = $_GET['delete'];

        $query = "DELETE FROM users WHERE id = $user_delete_id";
        mysqli_query($connection, $query);
        header("Location: users.php");
    }
}

function change_role_to_admin()
{
    global $connection;
    if (isset($_GET['changeToAdmin'])) {
        $change_user_id = $_GET['changeToAdmin'];
        $query = "UPDATE users SET `role` = 'admin' WHERE id = $change_user_id";
        mysqli_query($connection, $query);
        header("Location: users.php");
    }
}

function change_role_to_user()
{
    global $connection;
    if (isset($_GET['changeToUser'])) {
        $change_user_id = $_GET['changeToUser'];
        $query = "UPDATE users SET `role` = 'user' WHERE id = $change_user_id";
        mysqli_query($connection, $query);
        header("Location: users.php");
    }
}

function widget_counter($table)
{
    global $connection;
    $query = "SELECT * FROM $table";
    $select_all_posts = mysqli_query($connection, $query);
    return mysqli_num_rows($select_all_posts);
}
