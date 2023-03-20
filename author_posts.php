<!DOCTYPE html>
<html lang="en">
<?php include "includes/db.php";
include "includes/head.php"; ?>

<body>
    <!-- Responsive navbar-->
    <?php include "includes/navbar.php" ?>
    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <?php
                if (isset($_GET['p_id'])) {
                    $post_id = $_GET['p_id'];
                    $post_author = $_GET['author'];
                } ?>
                <h2>All posts by
                    <?php echo $post_author ?>
                </h2>
                <?php
                $query = "SELECT * FROM posts WHERE author = '{$post_author}'";
                $select_post = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_post)) {
                    $post_id = $row['id'];
                    $post_title = $row['title'];
                    $post_date = $row['date'];
                    $post_content = substr($row['content'], 0, 200);
                    $post_content .= "... Czytaj dalej!";
                    $post_author = $row['author'];
                    $post_image = $row['image']; ?>

                    <div class='card mb-4'>
                        <a href='post.php?p_id=<?php echo $post_id ?>'><img class='card-img-top post-image'
                                src='images/<?php echo $post_image ?>' alt='...' /></a>
                        <div class='card-body'>
                            <div class='small text-muted'>
                                <?php echo $post_date ?>
                            </div>
                            <h2 class='card-title h4'>
                                <?php echo $post_title ?>
                            </h2>
                            <p class='card-text'>
                                <?php echo $post_content ?>
                            </p>
                            <a class='btn btn-primary' href='post.php?p_id=<?php echo $post_id ?>'>Read more →</a>
                            <p class='lead'><a
                                    href='author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>'
                                    style='text-decoration: none;'>@<?php echo $post_author ?></a></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <?php include "includes/search.php" ?>
                <!-- Categories widget-->
                <?php include "includes/categories.php" ?>
                <!-- Side widget-->
                <?php include "includes/side_widget.php" ?>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php" ?>
</body>

</html>