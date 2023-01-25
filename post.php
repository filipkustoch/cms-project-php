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
                }

                $query = "SELECT * FROM posts WHERE id = $post_id";
                $select_post = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_array($select_post)) {
                    $post_title = $row['title'];
                    $post_date = $row['date'];
                    $post_author = $row['author'];
                    $post_image = $row['image'];
                    $post_content = $row['content'];
                }



                ?>



                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1"><?php echo $post_title ?></h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted on <?php echo $post_date ?> by <?php echo $post_author ?></div>
                        <!-- Post categories-->
                        <?php
                        $query = "SELECT tags FROM posts WHERE id = $post_id";
                        $select_tags = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_array($select_tags)) {
                            $post_tag = $row['tags'];
                            $str_arr = preg_split("/[,]/", $post_tag);
                        }
                        $length_str_arr = count($str_arr);
                        for ($i = 0; $i < $length_str_arr; $i++) {
                            echo "<a class='badge bg-secondary text-decoration-none link-light'>$str_arr[$i]</a>";
                        }
                        ?>


                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" src="./images/<?php echo $post_image ?>" alt="..." /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4"><?php echo $post_content ?></p>
                    </section>
                </article>
                <!-- Comments section-->
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            
                        
                        
                        
                        <?php
                        if(isset($_POST['create_comment'])){
                           $comment_author = $_POST['comment_author'];
                           echo $comment_email = $_POST['comment_email'];
                        }
                        
                        ?>
                        
                        
                        
                        <!-- Comment form-->
                            <form action="" method="post" class="mb-4">
                                <div class="form-group">
                                    <input type="text" name="comment_author" class="form-control"
                                    placeholder="Author">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="comment_email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
                                </div>
                                <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                            </form>
                            <!-- Comment with nested comments-->
                            <div class="d-flex mb-4">
                                <!-- Parent comment-->
                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                <div class="ms-3">
                                    <div class="fw-bold">Commenter Name</div>
                                    If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                    <!-- Child comment 1-->
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">Commenter Name</div>
                                            And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                        </div>
                                    </div>
                                    <!-- Child comment 2-->
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">Commenter Name</div>
                                            When you put money directly to a problem, it makes a good headline.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single comment-->
                            <div class="d-flex">
                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                <div class="ms-3">
                                    <div class="fw-bold">Commenter Name</div>
                                    When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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