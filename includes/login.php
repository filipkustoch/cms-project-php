<?php include "db.php"; ?>
<?php session_start(); ?>

<?php
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
    $select_user_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($select_user_query)) {
        $user_username = $row['username'];
        $user_password = $row['password'];
        $user_role = $row['role'];
        $user_firstname = $row['firstname'];
        $user_lastname = $row['lastname'];
    }
    if ($username !== $user_username && $password !== $user_password) {
        header("Location: ../index.php");
    } else if ($username === $user_username && $password === $user_password){

        $_SESSION['username'] = $user_username;
        $_SESSION['role'] = $user_role;
        $_SESSION['firstname'] = $user_firstname;
        $_SESSION['lastname'] = $user_lastname;

        header("Location: ../admin");
    }
}
?>