<?php include "includes/db.php"; ?>
<?php include "includes/head.php"; ?>
<?php

if (isset($_POST['submit'])) {


    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($username) && !empty($email) && !empty($password)) {
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);

        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];

        $password = crypt($password,  $salt);

        $query = "INSERT INTO users (username, email, password, role) ";
        $query .= "VALUES ('$username', '$email', '{$password}', 'user')";
        $register_user_query = mysqli_query($connection, $query);

        $message = "Your registration has been successfully submitted";
    } else {
        $message = "Fields can't be empty!";
    }
}


?>

<!-- Navigation -->

<?php include "includes/navbar.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container mt-5 mb-5">
            <div class="row justify-content-md-center">
                <div class="col-lg-6  col-sm-offset-3">
                    <div class="form-wrap">
                        <h1 class="text-center mb-4">Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h6 class="text-center">
                                <?php if (isset($message)) {
                                    echo $message;
                                } ?>
                            </h6>
                            <div class="form-group mb-3">
                                <label for="username" class="visually-hidden">username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Enter Username">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="visually-hidden">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="visually-hidden">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                    placeholder="Password">
                            </div>
                            <div class="text-center d-grid"><input type="submit" name="submit" id="btn-login"
                                    class="btn btn-primary" value="Register">

                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
</div>

<?php include "includes/footer.php"; ?>