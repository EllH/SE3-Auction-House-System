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
    $('#itemTable').DataTable({
      "autoWidth": false,
    });
  });
</script>
<div class="container-fluid">
  <table id="itemTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th scope="col">Auction Lot #</th>
        <th scope="col">Auction Title</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
        <th scope="col">Reserve Price</th>
        <th scope="col">Sale Price</th>
        <th scope="col">Commission Due</th>
        <th scope="col">Comment</th>
        <th scope="col">Artist</th>
        <th scope="col">Year Produced</th>
        <th scope="col">Subject Classification</th>
        <th scope="col">Textual Description</th>
        <th scope="col">Auction Date</th>
        <th scope="col">Auction Slot</th>
        <th scope="col">Estimated Price</th>
        <th scope="col">Location</th>
        <th scope="col">Category</th>
        <th scope="col">Title</th>
        <th scope="col">Medium</th>
        <th scope="col">Framed</th>
        <th scope="col">Height</th>
        <th scope="col">Length</th>
        <th scope="col">Type</th>
        <th scope="col">Material</th>
        <th scope="col">Width</th>
        <th scope="col">Weight</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $item) {
        ?>
        <tr>
          <td><?= $item->id ?? '' ?></td>
          <td><?= $item->auctionTitle ?? '' ?></td>
          <td>
            <a href="/admin/edit/item?id=<?= $item->id ?>">Edit</a>
          </td>
          </td>
          <td>
            <form method="post" action="">
              <input type="hidden" name="item[id]" value="<?= $item->id ?>" />
              <input type="hidden" name="item[itemID]" value="<?= $item->auctionItemsTable->id ?>" />
              <input type="submit" name="submit" value="Delete" />
            </form>
          </td>
          <td><?= '£' . number_format($item->reservePrice) ?? '' ?></td>
          <td><?= '£' . number_format($item->soldPrice) ?? '' ?></td>
          <td><?= '£' . number_format($item->commissionDue) ?? '' ?></td>
          <td><?= $item->comment ?? '' ?></td>
          <td><?= $item->artist ?? '' ?></td>
          <td><?= $item->yearProduced ?? '' ?></td>
          <td><?= $item->subjectClassification ?? '' ?></td>
          <td><?= $item->textualDescription ?? '' ?></td>
          <td><?= $item->auctionDate ?? 'No Date' ?></td>
          <td><?= $item->auctionSlot === '0' ? 'No Slot' : $item->auctionSlot ?></td>
          <td>£<?= number_format($item->estimatedPrice) ?? '' ?></td>
          <td><?= $item->locationsTable->name ?? '' ?></td>
          <td><?= $item->categoriesTable->name ?? '' ?></td>
          <td><?= $item->auctionItemsTable->title ?? '' ?></td>
          <td><?= $item->auctionItemsTable->medium ?? '' ?></td>
          <td><?= $item->auctionItemsTable->framed ?? '' ?></td>
          <td><?= $item->auctionItemsTable->height ?? '' ?></td>
          <td><?= $item->auctionItemsTable->length ?? '' ?></td>
          <td><?= $item->auctionItemsTable->type ?? '' ?></td>
          <td><?= $item->auctionItemsTable->material ?? '' ?></td>
          <td><?= $item->auctionItemsTable->width ?? '' ?></td>
          <td><?= $item->auctionItemsTable->weight ?? '' ?></td>
        </tr>
      <?php
    }
    ?>
    </tbody>
  </table>
</div>