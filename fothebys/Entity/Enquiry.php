<?php
namespace fothebys\Entity;
class Enquiry {
    public $enquiriesTable;
    public $staffTable;
    public $id;
    public $name;
    public $email;
    public $telephone_number;
    public $content;
    public $completed;
    public $staff_id;
    public function __construct(\CSY2028\DatabaseTable $staffTable) {
        $this->staffTable = $staffTable;
    }

    public function getStaff() {
        return $this->staffTable->find('id', $this->staff_id)[0];
    }
}