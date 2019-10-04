<?php
namespace fothebys\Controllers;

class LocationController
{
    private $LocationsTable;
    private $get;
    private $post;

    public function __construct($LocationsTable, array $get, array $post)
    {
        $this->LocationsTable = $LocationsTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function editLocation() {
        if (isset($_GET['id'])) {
            $location = $this->LocationsTable->find('id', $this->get['id'])[0];
        } else {
            $location = false;
        }
        return [
            'template' => 'createLocationForm.html.php',
            'variables' => [
                'category' => $location,
            ],
            'title' => "Fotheby's Auction House - Create Location"
        ];
    }

    public function saveLocation() {
        $this->LocationsTable->save($this->post);
        header('location: /admin/view/locations');
    }

    public function viewLocations() {
        $locations = $this->LocationsTable->findAll();
        return [
            'template' => 'viewLocationsForm.html.php',
            'variables' => [
                'locations' => $locations,
            ],
            'title' => "Fotheby's Auction House - View Locations"
        ];
    }

    public function disableLocation() {
        $this->LocationsTable->save($this->post['location']);
        header('location: /admin/view/locations');
    }




}
