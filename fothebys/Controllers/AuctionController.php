<?php
namespace fothebys\Controllers;

class AuctionController
{
    private $AuctionLotTable;
    private $usersTable;
    private $bidsTable;
    private $get;
    private $post;

    public function __construct($AuctionLotTable, $usersTable, $bidsTable, array $get, array $post)
    {
        $this->AuctionLotTable = $AuctionLotTable;
        $this->usersTable = $usersTable;
        $this->bidsTable = $bidsTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function home()
    {
        if (isset($this->get['id']))
            $data = $this->AuctionLotTable->find();

        return [
            'template' => 'home.html.php',
            'variables' => [
                'main' => 'home',
                'data' => $data
            ],
            'title' => "Fotheby's Auction House - Home"
        ];
    }

    public function details()
    {
        $items = $this->AuctionLotTable->find('auctionDate', date('Y-m-d'));
        $bids = $this->bidsTable->findAll();
        return [
            'template' => 'auctionDetails.html.php',
            'variables' => [
                'items' => $items,
                'bids' => $bids,
            ],
            'title' => "Fotheby's Auction House - Auction Details"
        ];
    }

    public function placeBid()
    {
        if ($_SESSION['approvedBuyer'] === 'YES') {
            $this->bidsTable->save($this->post);
            header("location:/catalogue?id=". $this->post['lotID']);
        } else {
            header("location:/login");
        }
    }

    public function soldItem()
    {
        $this->post['lot']['commissionDue'] = $this->post['lot']['soldPrice'] * 0.15;
        $this->AuctionLotTable->save($this->post['lot']);
        return $this->details();
    }
}
