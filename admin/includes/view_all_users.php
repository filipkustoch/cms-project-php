<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Password</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php draw_table_users(); ?>
    </tbody>
</table>

<?php
approve_comment();
disapprove_comment();
delete_comment();
?>