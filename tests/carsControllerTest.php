<?php
require 'cars/Controllers/CarController.php';

class carControllerTest extends \PHPUnit\Framework\TestCase
{
    private $pdo;
    private $carsTable;
    private $manufacturersTable;
    private $staffTable;
    private $controller;




    public function setUp()
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=cars;charset=utf8', 'student', 'student');
        $this->manufacturersTable = new \CSY2028\DatabaseTable($this->pdo, 'manufacturers', 'id', 'stdclass', []);
        $this->staffTable = new \CSY2028\DatabaseTable($this->pdo, 'staff', 'id', 'stdclass', []);
        $this->carsTable = new \CSY2028\DatabaseTable($this->pdo, 'cars', 'id', '\fothebys\Entity\Car', [$this->manufacturersTable, $this->staffTable]);
        $this->controller = new \fothebys\Controllers\CarController($this->carsTable, $this->manufacturersTable, $_GET, $_POST);
    }

    public function testValidateCar() {
        $validName = [
            'name' => 'F-Type',
            'price' => '140000',
            'manufacturerId' => '2',
            'mileage' => '10000',
            'engine_type' => 'Petrol',
            'description' => 'A good very good running and driving car that works great!',
        ];
        $errors = $this->controller->validateCar($validName);
        $this->assertEquals(count($errors), 0);
    }

    public function testInvalidateCar() {
        $invalidName = [
            'name' => '',
            'price' => '',
            'mileage' => '',
            'engine_type' => '',
            'description' => '',
        ];
        $errors = $this->controller->validateCar($invalidName);
        $this->assertEquals(count($errors), 7);
    }
}