<?php
require 'cars/Controllers/AdminController.php';
require 'CSY2028/DatabaseTable.php';

class adminControllerTest extends \PHPUnit\Framework\TestCase
{
    private $pdo;
    private $staffTable;
    private $manufacturersTable;
    private $controller;

    public function setUp()
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=cars;charset=utf8', 'student', 'student');
        $this->manufacturersTable = new \CSY2028\DatabaseTable($this->pdo, 'manufacturers', 'id', 'stdclass', []);
        $this->staffTable = new \CSY2028\DatabaseTable($this->pdo, 'staff', 'id', 'stdclass', []);
        $this->controller = new \fothebys\Controllers\AdminController($this->staffTable, $this->manufacturersTable, $_GET, $_POST);
    }

    public function testValidManufacturer() {
        $validName = [
            'name' => 'Ferrari',
        ];
        $errors = $this->controller->validateManufacturer($validName);
        $this->assertEquals(count($errors), 0);
    }

    public function testInvalidManufacturerName() {
        $invalidName = [
            'name' => '',
        ];
        $errors = $this->controller->validateManufacturer($invalidName);
        $this->assertEquals(count($errors), 1);
    }

    public function testInvalidStaff() {
        $invalidStaff = [
            'name' => '',
            'password' => ''
        ];
        $errors = $this->controller->validateStaff($invalidStaff);
        $this->assertEquals(count($errors), 2);
    }
    public function testValidStaff() {
        $validStaff = [
            'name' => 'test',
            'password' => 'testpassword'
        ];
        $errors = $this->controller->validateStaff($validStaff);
        $this->assertEquals(count($errors), 0);
    }

    public function testInvalidStaffPasswordForm() {
        $invalid = [
            'password' => ''
        ];
        $errors = $this->controller->validateStaffPasswordForm($invalid);
        $this->assertEquals(count($errors), 1);
    }
    public function testValidStaffPasswordForm() {
        $valid = [
            'password' => 'testpassword'
        ];
        $errors = $this->controller->validateStaffPasswordForm($valid);
        $this->assertEquals(count($errors), 0);
    }



}
