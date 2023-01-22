<table class="table table-bordered table-hover">
    <thead>
        <tr>
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

<?php

if(isset($_GET['delete'])){
    $post_delete_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE id = $post_delete_id";
    mysqli_query($connection, $query);
    header("Location: posts.php");
}

?>