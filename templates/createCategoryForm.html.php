<?php
require 'admin.nav.html.php';
?>

<div class="container">
    <form action="" method="post">
        <input type="hidden" name="name" value='<?= $category->id ?? '' ?>' />
        <div class="form-group mt-5">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Category Name" value="<?= $category->name ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="name">Status</label>
            <select class="form-control" id="status" name="status">
                <?php
                $status = ['ENABLED', 'DISABLED'];
                foreach ($status as $row) {
                    if ($category->status == $row) {
                        echo '<option value="' . $row . '" selected="selected">' . $row . '</option>';
                    } else {
                        echo '<option option value="' . $row . '">' . $row . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Create Category</button>
    </form>
</div>