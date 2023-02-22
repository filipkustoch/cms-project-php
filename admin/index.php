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
                            Welcome to dashboard
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php echo widget_counter("posts"); ?>
                                        </div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php echo widget_counter("comments"); ?>
                                        </div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php echo widget_counter("users"); ?>
                                        </div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php echo widget_counter("categories"); ?>
                                        </div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <?php

                $query = "SELECT * FROM posts WHERE status = 'published'";
                $select_published_posts = mysqli_query($connection, $query);
                $count_published_posts = mysqli_num_rows($select_published_posts);

                $query = "SELECT * FROM posts WHERE status = 'draft'";
                $select_draft_posts = mysqli_query($connection, $query);
                $count_draft_posts = mysqli_num_rows($select_draft_posts);

                $query = "SELECT * FROM comments WHERE status = 'Unapproved'";
                $select_unapproved_comments = mysqli_query($connection, $query);
                $count_unapproved_comments = mysqli_num_rows($select_unapproved_comments);

                $query = "SELECT * FROM users WHERE role = 'user'";
                $select_user_role = mysqli_query($connection, $query);
                $count_user_role = mysqli_num_rows($select_user_role);

                ?>


                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['bar']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Type', 'Count'],
                                <?php
                                $text_element = ['Published Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'All Users', 'Normal Users', 'Categories'];
                                $count_element = [$count_published_posts, $count_draft_posts, widget_counter("comments"), $count_unapproved_comments, widget_counter("users"), $count_user_role, widget_counter("categories")];

                                for ($i = 0; $i < count($text_element); $i++) {
                                    echo "['{$text_element[$i]}'" . "," . "{$count_element[$i]}],";
                                }
                                ?>
                            ]);

                            var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>