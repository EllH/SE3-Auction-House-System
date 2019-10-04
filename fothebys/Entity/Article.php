<?php
namespace fothebys\Entity;
class Article {
    public $articleTable;
    public $staffTable;
    public $id;
    public $name;
    public $staff_id;
    public $description;
    public function __construct(\CSY2028\DatabaseTable $staffTable) {
        $this->staffTable = $staffTable;
    }

    public function getStaff() {
        return $this->staffTable->find('id', $this->staff_id)[0];
    }
}