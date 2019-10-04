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
    $('#userTable').DataTable({
      "autoWidth": false,
    });
  });
</script>
<div class="container-fluid">
  <table id="userTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th scope="col">User #</th>
        <th scope="col">Email</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
        <th scope="col">Status</th>
        <th scope="col">Title</th>
        <th scope="col">Firstname</th>
        <th scope="col">Surname</th>
        <th scope="col">Contact Address</th>
        <th scope="col">Telephone Number</th>
        <th scope="col">Buyer Status</th>
        <th scope="col">Bank Account Number</th>
        <th scope="col">Bank Sort Code</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) {
        ?>
        <tr>
          <td><?= $user->id ?? '' ?></td>
          <td><?= $user->email ?? '' ?></td>
          <td>
            <a href="/admin/edit/users?id=<?= $user->id ?>">Edit</a>
          </td>
          </td>
          <td>
            <form method="post" action="">
              <input type="hidden" name="id" value="<?= $user->id ?>" />
              <input type="submit" name="submit" value="Delete" />
            </form>
          </td>
          <td><?= $user->status ?? '' ?></td>
          <td><?= $user->title ?? '' ?></td>
          <td><?= $user->firstname ?? '' ?></td>
          <td><?= $user->surname ?? '' ?></td>
          <td><?= $user->contactAddress ?? '' ?></td>
          <td><?= $user->telephoneNumber ?? '' ?></td>
          <td><?= $user->buyerApprovedStatus ?? '' ?></td>
          <td><?= $user->bankAccountNumber ?? '' ?></td>
          <td><?= $user->bankSortCode ?? '' ?></td>
        </tr>
      <?php
    }
    ?>
    </tbody>
  </table>
</div>