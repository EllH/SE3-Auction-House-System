<?php
namespace fothebys\Controllers;

class CatalogueController
{
    private $AuctionLotTable;
    private $AuctionItemTable;
    private $CategoriesTable;
    private $get;
    private $post;

    public function __construct($AuctionLotTable, $AuctionItemTable, $CategoriesTable, array $get, array $post)
    {
        $this->AuctionLotTable = $AuctionLotTable;
        $this->AuctionItemTable = $AuctionItemTable;
        $this->CategoriesTable = $CategoriesTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function home()
    {

        return [
            'template' => 'home.html.php',
            'variables' => [
            ],
            'title' => "Fotheby's Auction House - Home"
        ];
    }

    public function view()
    {
        if (isset($this->get['id'])) {
            $item = $this->AuctionLotTable->find('id', $this->get['id'])[0];
            return [
                'template' => 'viewItem.html.php',
                'variables' => [
                    'item' => $item
                ],
                'title' => "Fotheby's Auction House - Home"
            ];
        }
        if (isset($this->get)) {
            $this->get['date1'] = "0000-00-00";//date('Y-m-d');
            $this->get['date2'] = "9999-12-31";
            $data = $this->AuctionLotTable->findAllSearch($this->get);
            $categories = $this->CategoriesTable->findAll();
        } else { 

        }
        return [
            'template' => 'catalogue.html.php',
            'variables' => [
                'categories' => $categories,
                'data' => $data
            ],
            'title' => "Fotheby's Auction House - Home"
        ];
    }
}
