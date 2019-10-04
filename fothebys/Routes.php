<?php
namespace fothebys;

class Routes implements \CSY2028\Routes
{
    public function getRoutes()
    {
        require '../database.php';

        $usersTable = new \CSY2028\DatabaseTable($pdo, 'users', 'id', 'stdclass', []);
        $bidsTable = new \CSY2028\DatabaseTable($pdo, 'bids', 'id', 'stdclass', []);
        $locationsTable = new \CSY2028\DatabaseTable($pdo, 'locations', 'id', 'stdclass', []);
        $auctionItemsTable = new \CSY2028\DatabaseTable($pdo, 'auctionItems', 'id', 'stdclass', []);
        $categoriesTable = new \CSY2028\DatabaseTable($pdo, 'categories', 'id', 'stdclass', []);
        $locationsTable = new \CSY2028\DatabaseTable($pdo, 'locations', 'id', 'stdclass', []);
        $auctionLotsTable = new \CSY2028\DatabaseTable($pdo, 'auctionLots', 'id', '\fothebys\Entity\AuctionLot', [$auctionItemsTable, $categoriesTable, $locationsTable, $usersTable]);

        $CatalogueController = new \fothebys\Controllers\CatalogueController($auctionLotsTable, $auctionItemsTable, $categoriesTable, $_GET, $_POST);
        $CategoryController = new \fothebys\Controllers\CategoryController($categoriesTable, $_GET, $_POST);
        $UserController = new \fothebys\Controllers\UserController($usersTable, $_GET, $_POST);
        $ProductController = new \fothebys\Controllers\ProductController($auctionLotsTable, $auctionItemsTable, $categoriesTable, $locationsTable, $usersTable, $_GET, $_POST);
        $AuctionController = new \fothebys\Controllers\AuctionController($auctionLotsTable, $usersTable, $bidsTable, $_GET, $_POST);
        $LocationController = new \fothebys\Controllers\LocationController($locationsTable, $_GET, $_POST);

        $routes = [
            '' => [
                'GET' => [
                    'controller' => $CatalogueController,
                    'function' => 'home'
                ]
            ],
            'catalogue' => [
                'GET' => [
                    'controller' => $CatalogueController,
                    'function' => 'view'
                ],
                'POST' => [
                    'controller' => $AuctionController,
                    'function' => 'placeBid'
                ],
            ],
            'item' => [
                'GET' => [
                    'controller' => $AuctionController,
                    'function' => 'home'
                ]
            ],
            'login' => [
                'GET' => [
                    'controller' => $UserController,
                    'function' => 'loginForm'
                ],
                'POST' => [
                    'controller' => $UserController,
                    'function' => 'loginSubmit'
                ],
            ],
            'logout' => [
                'GET' => [
                    'controller' => $UserController,
                    'function' => 'logout'
                ],
                'login' => true
            ],
            'home' => [
                'GET' => [
                    'controller' => $UserController,
                    'function' => 'home',
                ],
            ],
            'admin/edit/item' => [
                'GET' => [
                    'controller' => $ProductController,
                    'function' => 'editItem'
                ],
                'admin' => true,
                'POST' => [
                    'controller' => $ProductController,
                    'function' => 'saveItem'
                ],
                'admin' => true
            ],
            'admin/view/items' => [
                'GET' => [
                    'controller' => $ProductController,
                    'function' => 'viewItems'
                ],
                'admin' => true,
                'POST' => [
                    'controller' => $ProductController,
                    'function' => 'deleteItem'
                ],
                'admin' => true,
            ],
            'admin/edit/users' => [
                'GET' => [
                    'controller' => $UserController,
                    'function' => 'editUser'
                ],
                'admin' => true,
                'POST' => [
                    'controller' => $UserController,
                    'function' => 'saveUser'
                ],
                'admin' => true
            ],
            'admin/view/users' => [
                'GET' => [
                    'controller' => $UserController,
                    'function' => 'viewUsers'
                ],
                'admin' => true,
                'POST' => [
                    'controller' => $UserController,
                    'function' => 'deleteUser'
                ],
                'admin' => true,
            ],
            'admin/edit/category' => [
                'GET' => [
                    'controller' => $CategoryController,
                    'function' => 'editCategory'
                ],
                'POST' => [
                    'controller' => $CategoryController,
                    'function' => 'saveCategory'
                ],
                'admin' => true,
            ],
            'admin/view/categories' => [
                'GET' => [
                    'controller' => $CategoryController,
                    'function' => 'viewCategories'
                ],
                'admin' => true,
                'POST' => [
                    'controller' => $CategoryController,
                    'function' => 'disableCategory'
                ],
                'admin' => true,
            ],
            'admin/edit/location' => [
                'GET' => [
                    'controller' => $LocationController,
                    'function' => 'editLocation'
                ],
                'POST' => [
                    'controller' => $LocationController,
                    'function' => 'saveLocation'
                ],
                'admin' => true,
            ],
            'admin/view/locations' => [
                'GET' => [
                    'controller' => $LocationController,
                    'function' => 'viewLocations'
                ],
                'admin' => true,
                'POST' => [
                    'controller' => $LocationController,
                    'function' => 'disableLocation'
                ],
                'admin' => true,
            ],
            'admin/auction/details' => [
                'GET' => [
                    'controller' => $AuctionController,
                    'function' => 'details'
                ],
                'admin' => true,
                'POST' => [
                    'controller' => $AuctionController,
                    'function' => 'soldItem'
                ],
                'admin' => true,
            ],
        ];
        return $routes;
    }
    public function checkLogin()
    {
        if ($_SESSION['usertype'] !== 'BUYER' && $_SESSION['usertype'] !== 'SELLER' && $_SESSION['usertype'] !== 'JOINT') {
            header('location: /login');
        }
    }

    public function checkAdmin()
    {
        if ($_SESSION['usertype'] !== 'ADMIN') {
            header('location: /login');
        }
    }
}
