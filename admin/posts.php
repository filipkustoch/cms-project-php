<!DOCTYPE html>
<html lang="en">

<?php include "includes/admin_head.php" ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php include "includes/admin_navbar.php" ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include "includes/admin_sidebar.php" ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Posts
                        </h1>
                        <?php
                        if (isset($_GET['source'])) {
                            $source = $_GET['source'];
                        } else {
                            $source = '';
                        }

                        switch ($source) {
                            case 'add_post':
                                include "includes/add_post.php";
                                break;

                            case 'edit_post':
                                include "includes/edit_post.php";
                                break;

                            default:
                                include "includes/view_all_posts.php";
                                break;
                        }


                        ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <script src="js/scripts.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/summernote.js"></script>

    
</body>

</html>