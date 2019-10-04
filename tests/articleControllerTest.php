<?php
require 'cars/Controllers/ArticleController.php';

class articleControllerTest extends \PHPUnit\Framework\TestCase
{
    private $pdo;
    private $articleTable;
    private $controller;

    public function setUp()
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=cars;charset=utf8', 'student', 'student');
        $this->articleTable = new \CSY2028\DatabaseTable($this->pdo, 'articles', 'id', 'stdclass', []);
        $this->controller = new \fothebys\Controllers\ArticleController($this->articleTable, $_GET, $_POST);
    }

    public function testValidateArticle() {
        $validName = [
            'staff_id' => '1',
            'name' => '£1000 Off',
            'description' => '£1000 off any car over the value of £10000 this weekend only!'
        ];
        $errors = $this->controller->validateArticle($validName);
        $this->assertEquals(count($errors), 0);
    }

    public function testInvalidateArticle() {
        $invalidName = [
            'name' => '',
            'description' => ''
        ];
        $errors = $this->controller->validateArticle($invalidName);
        $this->assertEquals(count($errors), 2);
    }
}
