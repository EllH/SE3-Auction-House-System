<div class="container">
    <div class="row justify-content-between">
        <?php
        foreach ($data as $item) {
            if($item->estimatedPrice > 999999){
                echo '<div class="card mt-3" style="width: 100%; ">';
            } else {
                echo '<div class="card mt-3" style="width: 18rem">';
            }
            ?>
                <div id="carouselControls<?= $item->id ?>" class="carousel slide" data-ride="carousel">
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
                    <a class="carousel-control-prev" href="#carouselControls<?= $item->id ?>" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselControls<?= $item->id ?>" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <?php
                        echo 'Lot Number: ' . $item->id  . '<br>';
                        echo 'Artist: ' . $item->artist . '<br>';
                        echo 'Year Produced: ' . $item->yearProduced . '<br>';
                        echo 'Subject Classification: ' . $item->subjectClassification . '<br>';
                        echo 'Description: ' . $item->textualDescription . '<br>';
                        if($item->auctionDate !== '0000-00-00') {
                        echo 'Auction Date: ' .  date('d/m/Y', strtotime($item->auctionDate)) . '<br>';
                        } else {
                            echo 'Auction Date: This item hasn\'t been placed in an auction yet. <br>';
                        }
                        if ($item->auctionSlot !== '0') {
                            echo 'Auction Slot: ' . $item->auctionSlot . '<br>';
                        } else {
                            echo 'Auction Slot: Sorry, this item hasn\'t been given a slot in an auction yet.<br>';
                        }
                        echo 'Estimated Price: £' . $item->estimatedPrice . '<br>';

                        echo (!$item->auctionItemsTable->medium) ? null : 'Medium: ' . $item->auctionItemsTable->medium . '<br>';
                        echo (!$item->auctionItemsTable->framed) ? null : 'Framed: ' . $item->auctionItemsTable->framed . '<br>';
                        echo (!$item->auctionItemsTable->height) ? null : 'Height: ' . $item->auctionItemsTable->height . 'cm <br>';
                        echo (!$item->auctionItemsTable->length) ? null : 'Length: ' . $item->auctionItemsTable->length . 'cm <br>';
                        echo (!$item->auctionItemsTable->type) ? null : 'Type: ' . $item->auctionItemsTable->type . '<br>';
                        echo (!$item->auctionItemsTable->material) ? null : 'Material: ' . $item->auctionItemsTable->material . '<br>';
                        echo (!$item->auctionItemsTable->width) ? null : 'Width: ' . $item->auctionItemsTable->width . 'cm <br>';
                        echo (!$item->auctionItemsTable->weight) ? null : 'Framed: ' . $item->auctionItemsTable->weight . 'kg <br>';
                        echo 'Category: ' . $item->categoriesTable->name . '<br><br>';
                        ?>
                        <a href="?id=<?=$item->id?>" class="btn btn-info active" role="button" aria-pressed="true">View Item</a>
                    </p>
                </div>
            </div>

        <?php
    }
    ?>
    </div>
</div>