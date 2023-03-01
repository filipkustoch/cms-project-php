<?php
if (isset($_POST['create_post'])) {
    $post_category_id = $_POST['post_category'];
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_date = date('d-m-y');
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO `posts` (`category_id`, `title`, `author`, `date`, `image`, `content`, `tags`, `status`) ";
    $query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '$post_image', '{$post_content}', '{$post_tags}', '{$post_status}')";

    mysqli_query($connection, $query);

    $post_id_query = mysqli_insert_id($connection);

    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$post_id_query}'>View post </a> or <a href='posts.php'> Edit More Posts</a>";
}
?>



<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category ID</label><br>
        <select name="post_category" id="post_category">

            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['id'];
                $cat_title = $row['title']; ?>

                <option value="<?php echo $cat_id ?>"><?php echo $cat_title ?></option>
            <?php
            }
            ?>

        </select>

    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label><br>
            <select name="post_status" id="post_status">
                <option value="draft">Select Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Publish Post" class="btn btn-primary" name="create_post">
    </div>
</form>

