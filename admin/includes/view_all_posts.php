<?php 

if(isset($_POST['checkBoxArray'])){

    echo "Data";

}

?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-3">
            <select class="form-control" name="" id="">
                <option value="">Select Options</option>
                <option value="">Publish</option>
                <option value="">Draft</option>
                <option value="">Delete</option>
            </select>

        </div>
        <div class="col-xs-4">
            <input type="submit" value="Apply" class="btn btn-success" name="submit">
            <a href="add_post.php" class="btn btn-primary">Add New</a>
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