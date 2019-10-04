<?php
namespace fothebys\Controllers;

class CategoryController
{
    private $CategoriesTable;
    private $get;
    private $post;

    public function __construct($CategoriesTable, array $get, array $post)
    {
        $this->CategoriesTable = $CategoriesTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function editCategory() {
        if (isset($_GET['id'])) {
            $category = $this->CategoriesTable->find('id', $this->get['id'])[0];
        } else {
            $category = false;
        }
        return [
            'template' => 'createCategoryForm.html.php',
            'variables' => [
                'category' => $category,
            ],
            'title' => "Fotheby's Auction House - Create Categories"
        ];
    }

    public function saveCategory() {
        $this->CategoriesTable->save($this->post);
        header('location: /admin/view/categories');
    }

    public function viewCategories() {
        $categories = $this->CategoriesTable->findAll();
        return [
            'template' => 'viewCategoriesForm.html.php',
            'variables' => [
                'categories' => $categories,
            ],
            'title' => "Fotheby's Auction House - View Categories"
        ];
    }

    public function disableCategory() {
        $this->CategoriesTable->save($this->post['category']);
        header('location: /admin/view/categories');
    }




}
