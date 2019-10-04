<?php
require 'admin.nav.html.php';
?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="lot[id]" value='<?= $item->id ?? '' ?>' />
        <input type="hidden" name="lot[itemID]" value='<?= $item->auctionItemsTable->id ?? '' ?>' />
        <div class="form-group">
            <h2>Create Item</h2>
            <label for="auctionTitle">Auction Title</label>
            <input type="text" class="form-control" name="lot[auctionTitle]" id="auctionTitle" required placeholder="e.g. 21st Century English Paintings" value="<?= $item->auctionTitle ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="userID">Seller Name</label>
            <select class="form-control" id="userID" name="lot[userID]">
                <?php
                foreach ($users as $row) {
                    if ($item->userID == $row->id) {
                        echo '<option value="' . $row->id . '" selected="selected">' . $row->firstname . ' ' . $row->surname .  '</option>';
                    } else {
                        echo '<option value="' . $row->id . '">' . $row->firstname . ' ' . $row->surname .  '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="artist">Artist Name</label>
            <input type="text" class="form-control" name='lot[artist]' id="artist" required placeholder="e.g. Charles Bellender" value="<?= $item->artist ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="locationID">Location</label>
            <select class="form-control" id="locationID" name="lot[locationID]">
                <?php
                foreach ($locations as $row) {
                    if ($row->status !== 'DISABLED') {
                        if ($item->locationID == $row->id) {
                            echo '<option selected="selected" value="' . $row->id . '">' . $row->name . '</option>';
                        } else {
                            echo '<option value="' . $row->id . '">' . $row->name . '</option>';
                        }
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="artist">Year Produced</label>
            <input type="text" class="form-control" name='lot[yearProduced]' id="yearProduced" required placeholder="e.g. 2019" value="<?= $item->yearProduced ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="subjectClassification">Subject Classification</label>
            <input type="text" class="form-control" name="lot[subjectClassification]" id="subjectClassification" required placeholder="e.g. Landscape" value="<?= $item->subjectClassification ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="textualDescription">Lot Description</label>
            <input type="text" class="form-control" name="lot[textualDescription]" id="textualDescription" required placeholder="e.g. An exceptionally fine contemporary painting capturing the lust for wealth" value="<?= $item->textualDescription ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="reservePrice">Reserve Price (Not Required)</label>
            <input type="text" class="form-control" name="lot[reservePrice]" id="reservePrice" placeholder="e.g. 1000000" value="<?= $item->reservePrice ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="estimatedPrice">Estimated Price</label>
            <input type="text" class="form-control" name="lot[estimatedPrice]" id="estimatedPrice" required placeholder="e.g. 1000000" value="<?= $item->estimatedPrice ?? '' ?>" />
        </div>
        <div class="form-group">
            <label>Auction Date (Not Required)</label>
            <input type="date" name="lot[auctionDate]" id="auctionDate" min="<?= date("Y-m-d"); ?>" max="3000-12-31" class="form-control" value="<?= $item->auctionDate ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="auctionSlot">Auction Slot</label>
            <select class="form-control" id="auctionSlot" name="lot[auctionSlot]">
                <?php
                $slots = ['No Date Yet', 'Morning', 'Afternoon', 'Evening'];
                foreach ($slots as $row) {
                    if ($item->auctionSlot == $row) {
                        echo '<option selected="selected">' . $row . '</option>';
                    } else {
                        echo '<option>' . $row . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="lot[categoryID]">
                <?php
                foreach ($categories as $row) {
                    if ($row->status !== 'DISABLED') {
                        if ($item->categoryID == $row->id) {
                            echo '<option selected="selected" value="' . $row->id . '">' . $row->name . '</option>';
                        } else {
                            echo '<option value="' . $row->id . '">' . $row->name . '</option>';
                        }
                    }
                }
                ?>
            </select>
        </div>


        <div class="form-group">
            <label for="medium">Piece Title</label>
            <input type="text" class="form-control" name='item[title]' id="title" placeholder="e.g. Emergent Wealth" value="<?= $item->auctionItemsTable->medium ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="medium">Medium (Not Required)</label>
            <input type="text" class="form-control" name='item[medium]' id="medium" placeholder="e.g. Pencil" value="<?= $item->auctionItemsTable->medium ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="framed">Framed</label>
            <input type="text" class="form-control" name='item[framed]' id="framed" placeholder="e.g. Minimalist Black Metallic Frame" value="<?= $item->auctionItemsTable->framed ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="height">Height (Not Required)</label>
            <input type="text" class="form-control" name='item[height]' id="height" placeholder="e.g 170" value="<?= $item->auctionItemsTable->height ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="length">Length (Not Required)</label>
            <input type="text" class="form-control" name='item[length]' id="length" placeholder="e.g. 220" value="<?= $item->auctionItemsTable->length ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="width">Width (Not Required)</label>
            <input type="text" class="form-control" name='item[width]' id="width" placeholder="e.g. 150" value="<?= $item->auctionItemsTable->width ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="type">Type (Not Required)</label>
            <input type="text" class="form-control" name='item[type]' id="type" placeholder="e.g. Black and White" value="<?= $item->auctionItemsTable->type ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="material">Material (Not Required)</label>
            <input type="text" class="form-control" name='item[material]' id="material" placeholder="e.g. Bronze" value="<?= $item->auctionItemsTable->material ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="weight">Weight (Not Required)</label>
            <input type="text" class="form-control" name='item[weight]' id="weight" placeholder="e.g. 5" value="<?= $item->auctionItemsTable->weight ?? '' ?>" />
        </div>
        <div class="form-group">
            <label for="images">Product Images</label>
        </div>
        <div class="form-group">
            <input id="images" type="file" name='images[]' multiple />
        </div>
        <button type="submit" class="btn btn-primary mb-3">Create Item</button>
    </form>
</div>