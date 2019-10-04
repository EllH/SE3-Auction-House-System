<?php
require 'cars/Controllers/EnquiryController.php';

class enquiryControllerTest extends \PHPUnit\Framework\TestCase
{
    private $pdo;
    private $staffTable;
    private $enquiriesTable;
    private $controller;

    public function setUp()
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=cars;charset=utf8', 'student', 'student');
        $this->staffTable = new \CSY2028\DatabaseTable($this->pdo, 'staff', 'id', 'stdclass', []);
        $this->enquiriesTable = new \CSY2028\DatabaseTable($this->pdo, 'enquiries', 'id', '\fothebys\Entity\Enquiry', [$this->staffTable]);
        $this->controller = new \fothebys\Controllers\EnquiryController($this->enquiriesTable, $_GET, $_POST);
    }

    public function testValidateArticle() {
        $validName = [
            'name' => 'Bobby',
            'email' => 'bobby@gmail.com',
            'telephone_number' => '',
            'content' => 'Hey, i was wondering if i could book a date to test drive the e-type'
        ];
        $errors = $this->controller->validateEnquiry($validName);
        $this->assertEquals(count($errors), 0);
    }

    public function testInvalidateArticle() {
        $invalidName = [
            'name' => '',
            'email' => '',
            'telephone_number' => '',
            'content' => ''
        ];
        $errors = $this->controller->validateEnquiry($invalidName);
        $this->assertEquals(count($errors), 3);
    }
}
