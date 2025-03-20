<?php
// Require SessionHelper and other necessary files
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/CategoryModel.php';

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    public function list()
    {
        $categories = $this->categoryModel->getCategories();
        require_once __DIR__ . '/../views/category/list.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($name)) {
                $_SESSION['error'] = "❌ Vui lòng điền tên danh mục";
                header('Location: /webbanhang/index.php?controller=category&action=add');
                exit();
            }

            $this->categoryModel->addCategory($name, $description);
            header('Location: /webbanhang/index.php?controller=category&action=list');
            exit();
        }

        require_once __DIR__ . '/../views/category/add.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($name)) {
                $_SESSION['error'] = "❌ Vui lòng điền tên danh mục";
                header("Location: /webbanhang/index.php?controller=category&action=edit&id=$id");
                exit();
            }

            $this->categoryModel->updateCategory($id, $name, $description);
            header('Location: /webbanhang/index.php?controller=category&action=list');
            exit();
        }

        $category = $this->categoryModel->getCategoryById($id);
        require_once __DIR__ . '/../views/category/edit.php';
    }

    public function delete($id)
    {
        $this->categoryModel->deleteCategory($id);
        header('Location: /webbanhang/index.php?controller=category&action=list');
        exit();
    }
}
?>
