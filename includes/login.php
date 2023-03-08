<?php include "db.php"; ?>
<?php session_start(); ?>

<?php
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($select_user_query)) {
        $user_username = $row['username'];
        $user_password = $row['password'];
        $user_role = $row['role'];
        $user_firstname = $row['firstname'];
        $user_lastname = $row['lastname'];
        $user_id = $row['id'];
    }

$password = crypt($password, $user_password);

    if ($username === $user_username && $password === $user_password) {

        $_SESSION['username'] = $user_username;
        $_SESSION['role'] = $user_role;
        $_SESSION['firstname'] = $user_firstname;
        $_SESSION['lastname'] = $user_lastname;
        $_SESSION['id'] = $user_id;

        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }
}
?>