<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Post</th>
            <th>Author</th>
            <th>Email</th>
            <th>Content</th>
            <th>Status</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Disapprove</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php draw_table_comments(); ?>
    </tbody>
</table>

<?php

if(isset($_GET['delete'])){
    $comment_delete_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE id = $comment_delete_id";
    mysqli_query($connection, $query);
    header("Location: comments.php");
}

?>