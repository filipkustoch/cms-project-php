<?php

$post_id_query = $_GET['p_id'];
$query = "SELECT * FROM posts WHERE id = $post_id_query";
$select_post_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_post_by_id)) {
    $post_cat_id = $row['category_id'];
    $post_title = $row['title'];
    $post_author = $row['author'];
    $post_date = $row['date'];
    $post_image = $row['image'];
    $post_content = $row['content'];
    $post_category = $row['tags'];
    $post_comments = $row['comment_count'];
    $post_status = $row['status']; ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="post_title">Post Title</label>
            <input type="text" class="form-control" name="post_title" value="<?php echo $post_title ?>">
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
            <input type="text" class="form-control" name="post_author" value="<?php echo $post_author ?>">
        </div>
        <div class="form-group">
            <label for="post_status">Post Status</label><br>
            <select name="post_status" id="post_status">
                <?php
                if ($post_status == 'published') {
                    echo "<option value='published'>Published</option>
                <option value='draft'>Draft</option>";
                } else {
                    echo "<option value='draft'>Draft</option>
                <option value='published'>Published</option>";
                }


                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="post_image">Post Image (View of current image)</label>
            <img class='img-responsive' src='../images/<?php echo $post_image ?>'>
            <input type="file" class="form-control" name="post_image">
        </div>
        <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input type="text" class="form-control" name="post_tags" value="<?php echo $post_category ?>">
        </div>
        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea class="form-control" name="post_content" cols="30" rows="10"><?php echo $post_content ?></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Publish Post" class="btn btn-primary" name="update_post">
        </div>
    </form>
<?php
}
?>

<?php
if (isset($_POST['update_post'])) {
    $cat_edit_id = $_GET['p_id'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 4;
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE id = $cat_edit_id";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['image'];
        }
    }

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "UPDATE posts SET `title` = '{$post_title}', `category_id` = '{$post_category_id}', `author` = '{$post_author}', `status` = '{$post_status}', `tags` = '{$post_tags}',`content` = '{$post_content}', `date` = now(), `comment_count` = '{$post_comment_count}', `image` = '{$post_image}' WHERE id = $cat_edit_id";

    mysqli_query($connection, $query);
    header("Location: posts.php");
}
?>