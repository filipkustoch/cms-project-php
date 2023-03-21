<?php

if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $postId) {
        $bulkOptions = $_POST['bulkOptions'];

        #switch $bulkOptions
        switch ($bulkOptions) {
            case 'published':
                $query = "UPDATE posts SET status = 'published' WHERE id = '$postId'";
                $publishedPost = mysqli_query($connection, $query);
                break;
            case 'draft':
                $query = "UPDATE posts SET status = 'draft' WHERE id = '$postId'";
                $draftPost = mysqli_query($connection, $query);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE id = '$postId'";
                $deletePost = mysqli_query($connection, $query);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE id = '$postId'";
                $clonePost = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($clonePost)) {
                    $post_title = $row['title'];
                    $post_category_id = $row['category_id'];
                    $post_date = $row['date'];
                    $post_author = $row['author'];
                    $post_status = $row['status'];
                    $post_image = $row['image'];
                    $post_tags = $row['tags'];
                    $post_content = $row['content'];
                }
                $query = "INSERT INTO posts (title, category_id, date, author, status, image, tags, content) ";
                $query .= "VALUES ('{$post_title}','{$post_category_id}','{$post_date}','{$post_author}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}')";
                $copy_query = mysqli_query($connection, $query);
                break;
            default:
                break;
        }
    }
}
?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-3">
            <select class="form-control" name="bulkOptions" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>

        </div>
        <div class="col-xs-4">
            <input type="submit" value="Apply" class="btn btn-success" name="submit">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>
        <thead>
            <tr>
                <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Category</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Image</th>
                <th>Content</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Status</th>
                <th>View Post</th>
            </tr>
        </thead>
        <tbody>
            <?php draw_table_posts(); ?>
        </tbody>
    </table>
</form>

<?php

if (isset($_GET['delete'])) {
    $post_delete_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE id = $post_delete_id";
    mysqli_query($connection, $query);
    header("Location: posts.php");
}

?>