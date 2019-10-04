<?php
namespace fothebys\Controllers;

class ProductController
{
    private $auctionItemsTable;
    private $auctionLotsTable;
    private $categoriesTable;
    private $locationsTable;
    private $usersTable;
    private $get;
    private $post;

    public function __construct($auctionLotsTable, $auctionItemsTable, $categoriesTable, $locationsTable, $usersTable, array $get, array $post)
    {
        $this->auctionItemsTable = $auctionItemsTable;
        $this->auctionLotsTable = $auctionLotsTable;
        $this->categoriesTable = $categoriesTable;
        $this->locationsTable = $locationsTable;
        $this->usersTable = $usersTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function saveItem()
    {
        $this->auctionItemsTable->save($this->post['item']);
        if ($this->post['lot']['itemID'] !== '') {
            $folderName = $this->post['lot']['itemID'];
        } else {
            $folderName = $this->auctionItemsTable->getLastInsertId();
            $this->post['lot']['itemID'] = $folderName;
        }
        $this->auctionLotsTable->save($this->post['lot']);
        $folder = '/srv/http/default/public/images/items/' . $folderName . '/';
        extract($this->post);
        $error = array();
        $extension = array("jpg", "png");
        $i = 1;
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES["images"]["name"][$key];
            $file_tmp = $_FILES["images"]["tmp_name"][$key];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            if (in_array($ext, $extension)) {
                if (!file_exists("/srv/http/default/public/images/items/" . $folderName . "/" . $file_name)) {
                    $file_name = $i . '.' . $ext;
                    move_uploaded_file($file_tmp = $_FILES["images"]["tmp_name"][$key], "/srv/http/default/public/images/items/" . $folderName . "/" . $file_name);
                    $i++;
                } else {
                    $filename = basename($file_name, $ext);
                    $newFileName = $filename . time() . "." . $ext;
                    move_uploaded_file($file_tmp = $_FILES['images']['tmp_name'][$key], "/srv/http/default/public/images/items/" . $folderName . "/" . $newFileName);
                }
            } else {
                array_push($error, "$file_name, ");
            }
            header('location: /admin/view/items');
        }
    }



    public function deleteDir($dirPath)
    {
        if (!is_dir($dirPath)) {
            if (file_exists($dirPath) !== false) {
                unlink($dirPath);
            }
            return;
        }

        if ($dirPath[strlen($dirPath) - 1] != '/') {
            $dirPath .= '/';
        }

        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    public function editItem($errors = [])
    {
        if (isset($_GET['id'])) {
            $auctionLot = $this->auctionLotsTable->find('id', $this->get['id'])[0];
        } else {
            $auctionLot = false;
        }
        $sellers = $this->usersTable->find('status', 'SELLER');
        $joint = $this->usersTable->find('status', 'JOINT');
        $users = $result = array_merge($sellers, $joint);
        return [
            'template' => 'createItemForm.html.php',
            'variables' => [
                'item' => $auctionLot,
                'categories' => $this->categoriesTable->findAll(),
                'locations' => $this->locationsTable->findAll(),
                'users' => $users,
                'errors' => $errors,
            ],
            'title' => "Fotheby's Auction House - View Products"
        ];
    }

    public function viewItems()
    {
        $items = $this->auctionLotsTable->findAll();
        return [
            'template' => 'viewItemsForm.html.php',
            'variables' => [
                'items' => $items,
            ],
            'title' => "Fotheby's Auction House - Create Products"
        ];
    }

    public function deleteItem()
    {
        // Deletes Items
        $this->auctionLotsTable->delete($this->post['item']['id']);
        $this->auctionItemsTable->delete($this->post['item']['itemID']);
        $dir =  '/srv/http/default/public/images/items/' . $this->post['item']['itemID'];
        //Deletes Images
        $this->deleteDir($dir);
        header('location: /admin/view/items');
    }
}
