<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th colspan="2">Change to</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php draw_table_users(); ?>
    </tbody>
</table>

<?php
change_role_to_admin();
change_role_to_user();
delete_user();
?>