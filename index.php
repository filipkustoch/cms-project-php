<!DOCTYPE html>
<html lang="en">

<?php include "includes/db.php";
include "includes/head.php"; ?>


<body>
    <!-- Responsive navbar-->
    <?php include "includes/navbar.php" ?>
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-md-8">
                <?php
                $query = "SELECT * FROM posts";
                $select_all_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_title = $row['title'];
                    $post_date = $row['date'];
                    $post_content = $row['content'];
                    $post_author = $row['author'];
                    $post_image = $row['image']; ?>

                    <div class='card mb-4'>
                        <a href='#!'><img class='card-img-top' src='images/<?php echo $post_image ?>' alt='...' /></a>
                        <div class='card-body'>
                            <div class='small text-muted'><?php echo $post_date ?></div>
                            <h2 class='card-title h4'><?php echo $post_title ?></h2>
                            <p class='card-text'><?php echo $post_content ?></p>
                            <a class='btn btn-primary' href='#!'>Read more →</a>
                            <p class='card-text'>@<?php echo $post_author ?></p>
                        </div>
                    </div>
                <?php }
                ?>
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