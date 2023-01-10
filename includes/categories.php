<div class="card mb-4">
    <div class="card-header">Categories</div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <?php
                $query = "SELECT * FROM categories LIMIT 3";
                $select_all_categories_query = mysqli_query($connection, $query); ?>

                <ul class="list-unstyled mb-0">

                    <?php while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                        $cat_title = $row['title']; ?>
                        <li><a href="#!"><?php echo $cat_title ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>