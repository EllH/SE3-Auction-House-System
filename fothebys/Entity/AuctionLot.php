<?php
namespace fothebys\Entity;
class AuctionLot {
    public $auctionItemsTable;
    public $categoriesTable;
    public $locationsTable;
    public $usersTable;
    public $id;
    public $auctionTitle;
    public $artist;
    public $yearProduced;
    public $subjectClassification;
    public $textualDescription;
    public $auctionDate;
    public $estimatedPrice;
    public $locationID;
    public $itemID;
    public $categoryID;

    public function __construct(\CSY2028\DatabaseTable $auctionItemsTable, \CSY2028\DatabaseTable $categoriesTable, \CSY2028\DatabaseTable $locationsTable, \CSY2028\DatabaseTable $usersTable) {
        $this->auctionItemsTable = $auctionItemsTable->find('id', $this->itemID)[0];
        $this->categoriesTable = $categoriesTable->find('id', $this->categoryID)[0];
        $this->locationsTable = $locationsTable->find('id', $this->locationID)[0];
        $this->usersTable = $usersTable->find('id', $this->userID)[0];
    }
}