<div class="container mt-3">
    <div id="itemCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#itemCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#itemCarousel" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <?php
            $i = 1;
            $directory = '/srv/http/default/public/images/items/' . $item->auctionItemsTable->id . '/';
            $filecount = 0;
            $files = glob($directory . "*");
            if ($files) {
                $filecount = count($files);
            }
            foreach (glob("images/items/" . $item->auctionItemsTable->id . "/*.*") as $filename) {
                if ($i === 1) {
                    $i++;
                    echo '<div class="carousel-item active">
                                    <img class="card-img-top" style="height: 300px; object-fit: fill;" src="' . $filename . '" alt="First slide">
                                    </div>';
                } else {
                    echo '<div class="carousel-item">
                                <img class="card-img-top" style="height: 300px; object-fit: fill;" src="' . $filename . '" alt="First slide">
                                </div>';
                }
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#itemCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#itemCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <ul class="list-group mb-3">
        <li class="list-group-item">Auction Title: <?= $item->auctionTitle ?? '' ?></li>
        <li class="list-group-item">Location: <?= $item->locationsTable->name ?? '' ?></li>
        <li class="list-group-item">Lot Number: <?= $item->id ?? '' ?> </li>
        <li class="list-group-item">Period/Date of Production: <?= $item->yearProduced ?? '' ?></li>
        <li class="list-group-item">Piece Title: <?= $item->auctionItemsTable->title ?? '' ?></li>
        <li class="list-group-item">Artist: <?= $item->artist ?? '' ?></li>
        <li class="list-group-item">Estimate Price: £<?= number_format($item->estimatedPrice) ?? '' ?></li>
        <li class="list-group-item">Category: <?= $item->categoriesTable->name ?? '' ?></li>
        <li class="list-group-item">Subject Classification: <?= $item->subjectClassification ?? '' ?></li>
        <?php
        if ($item->auctionDate !== '0000-00-00') {
            echo '<li class="list-group-item">Auction Date: ' .  date('d/m/Y', strtotime($item->auctionDate)) . '</li>';
        } else {
            echo '<li class="list-group-item">Auction Date: Sorry, this item hasn\'t been placed in an auction yet.</li>';
        }
        if ($item->auctionSlot !== '0') {
            echo '<li class="list-group-item">Auction Slot: ' . $item->auctionSlot . '</li>';
        } else {
            echo '<li class="list-group-item">Auction Slot: Sorry, this item hasn\'t been given a slot in an auction yet.</li>';
        }
        if ($item->auctionItemsTable->medium !== '' && $item->auctionItemsTable->medium !== null) {
            echo '<li class="list-group-item">Medium: ' . $item->auctionItemsTable->medium . '</li>';
        }
        if ($item->auctionItemsTable->framed !== '' && $item->auctionItemsTable->framed !== null) {
            echo '<li class="list-group-item">Frame: ' . $item->auctionItemsTable->framed . '</li>';
        }
        if ($item->auctionItemsTable->height !== '' && $item->auctionItemsTable->height !== null) {
            echo '<li class="list-group-item">Height: ' . $item->auctionItemsTable->height . '</li>';
        }
        if ($item->auctionItemsTable->length !== '' && $item->auctionItemsTable->length !== null) {
            echo '<li class="list-group-item">Length: ' . $item->auctionItemsTable->length . '</li>';
        }
        if ($item->auctionItemsTable->width !== '' && $item->auctionItemsTable->width !== null) {
            echo '<li class="list-group-item">Width: ' . $item->auctionItemsTable->width . '</li>';
        }
        if ($item->auctionItemsTable->type !== '' && $item->auctionItemsTable->type !== null) {
            echo '<li class="list-group-item">Type: ' . $item->auctionItemsTable->type . '</li>';
        }
        if ($item->auctionItemsTable->material !== '' && $item->auctionItemsTable->material !== null) {
            echo '<li class="list-group-item">Material: ' . $item->auctionItemsTable->material . '</li>';
        }
        if ($item->auctionItemsTable->weight !== '' && $item->auctionItemsTable->weight !== null) {
            echo '<li class="list-group-item">Weight: ' . $item->auctionItemsTable->weight . '</li>';
        }
        ?>
    </ul>
    <?php
    if (isset($_SESSION['approvedBuyer'])) {
        if ($_SESSION['approvedBuyer'] === 'YES') {
            echo '<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#bidModal">
                Place Commission Bid
            </button>';
        }
    }
    ?>
    <div class="modal fade" id="bidModal" tabindex="-1" role="dialog" aria-labelledby="bidModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bidModal">Commission Bid</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="lotID" value="<?= $item->id ?>" />
                        <input type="hidden" name="userID" value="<?= $_SESSION['userID'] ?>" />
                        <div class="form-group">
                            <label for="startingBid">Starting Bid</label>
                            <input type="number" class="form-control" required name="startingBid" id="startingBid" placeholder="100000">
                        </div>
                        <div class="form-group">
                            <label for="maxBid">Max Bid</label>
                            <input type="number" class="form-control" required name="maxBid" id="maxBid" placeholder="400000">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Place Bid</button>
                </div>
            </div>
        </div>
    </div>

</div>