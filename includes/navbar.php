<?php session_start(); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Blog Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <?php
                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $cat_title = $row['title'];

                    echo "<li class='nav-item'><a class='nav-link' href='#'>{$cat_title}</a></li>";
                }

                if (isset($_SESSION['role'])) {
                    if (isset($_GET['p_id'])) {
                        $post_id = $_GET['p_id'];
                        echo "<li class='nav-item'><a class='nav-link' href='admin/posts.php?source=edit_post&p_id=$post_id'>Edit</a></li>";
                    }
                }
                ?>
                <li class='nav-item'><a class='nav-link' href='./admin/'>Admin</a></li>
            </ul>
        </div>
    </div>
</nav>