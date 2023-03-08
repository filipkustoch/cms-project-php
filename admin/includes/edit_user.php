<?php
$user_id_query = $_GET['user_id'];
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

    $query = "SELECT randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection,$query);
    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randSalt'];
    $hashed_password = crypt($password, $salt);


    $query = "UPDATE users SET `username` = '{$username}', `password` = '{$hashed_password}', `firstname` = '{$user_firstname}', `lastname` = '{$user_lastname}', `email` = '{$user_email}', `role` = '{$user_role}' WHERE id = $user_id_query";

    mysqli_query($connection, $query);
    header("Location: users.php");
}
?>