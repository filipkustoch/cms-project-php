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
                            Profile of <?php echo $_SESSION['username']; ?>
                        </h1>
                        <?php
                        $user_id_query = $_SESSION['id'];
                        $query = "SELECT * FROM users WHERE id = $user_id_query";
                        $select_user_by_id = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_assoc($select_user_by_id)) {
                            $username = $row['username'];
                            $password = $row['password'];
                            $user_firstname = $row['firstname'];
                            $user_lastname = $row['lastname'];
                            $user_email = $row['email'];
                            $user_role = $row['role']; ?>

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="user_role">Role</label><br>
                                    <select name="user_role" id="user_role">
                                        <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>

                                        <?php
                                        if ($user_role == 'admin') {
                                            echo '<option value="user">User</option>';
                                        } else if ($user_role == 'user') {
                                            echo '<option value="admin">Admin</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" value="<?php echo $password ?>">
                                </div>
                                <div class="form-group">
                                    <label for="user_firstname">First Name</label>
                                    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
                                </div>
                                <div class="form-group">
                                    <label for="user_lastname">Last Name</label>
                                    <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
                                </div>
                                <div class="form-group">
                                    <label for="user_email">Email</label>
                                    <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Add User" class="btn btn-primary" name="edit_user">
                                </div>
                            </form>

                        <?php
                        }
                        ?>

                        <?php
                        if (isset($_POST['edit_user'])) {
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $user_firstname = $_POST['user_firstname'];
                            $user_lastname = $_POST['user_lastname'];
                            $user_email = $_POST['user_email'];
                            $user_role = $_POST['user_role'];

                            $query = "UPDATE users SET `username` = '{$username}', `password` = '{$password}', `firstname` = '{$user_firstname}', `lastname` = '{$user_lastname}', `email` = '{$user_email}', `role` = '{$user_role}' WHERE id = $user_id_query";

                            mysqli_query($connection, $query);
                            header("Location: users.php");
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
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>