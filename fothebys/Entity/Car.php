<?php
namespace fothebys\Entity;
class Car {
    public $manuTable;
    public $staffTable;
    public $id;
    public $name;
    public $price;
    public $manufacturerId;
    public $description;
    public $archived;
    public $newprice;
    public $mileage;
    public $engine_type;
    public $staff_id;
    public function __construct(\CSY2028\DatabaseTable $auction, \CSY2028\DatabaseTable $staffTable) {
        $this->manuTable = $manuTable;
        $this->staffTable = $staffTable;
    }
    public function getManufacturer() {
        return $this->manuTable->find('id', $this->manufacturerId)[0];
    }
    public function getStaff() {
        return $this->staffTable->find('id', $this->staff_id)[0];
    }
}