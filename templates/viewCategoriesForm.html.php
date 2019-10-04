<?php
require 'admin.nav.html.php';
?>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"> </script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"> </script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"> </script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"> </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css" />
<script type="text/javascript">
    $(document).ready(function() {
        $('#categoryTable').DataTable({
            "autoWidth": false,
        });
    });
</script>
<div class="container-fluid">
    <table id="categoryTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">Category #</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Enable/Disable</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) {
                ?>
                <tr>
                    <td><?= $category->id ?? '' ?></td>
                    <td><?= $category->name ?? '' ?></td>
                    <td><?= $category->status ?? '' ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="category[id]" value="<?= $category->id ?>" />
                            <?php
                            if ($category->status == "ENABLED") {
                                echo '<input type="hidden" name="category[status]" value="DISABLED" />
                                <input type="submit" name="submit" value="Disable" />';
                            } else {
                                echo '<input type="hidden" name="category[status]" value="ENABLED" />
                                <input type="submit" name="submit" value="Enable" />';
                            }
                            ?>
                        </form>
                    </td>
                </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>