<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/productmodel.php';
require_once __DIR__ . '/../models/categorymodel.php';

class ProductController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function index()
    {
        $products = $this->productModel->getProducts();
        require_once __DIR__ . '/../views/product/index.php';
    }

    public function show($id) {
        $product = $this->productModel->getProductById($id);
    
        if (!$product) {
            die("❌ Không tìm thấy sản phẩm ID: " . htmlspecialchars($id));
        }
    
        require_once __DIR__ . '/../views/product/show.php';
    }
    
    public function add()
    {
        $categories = (new CategoryModel($this->db))->getCategories();
        require_once __DIR__ . '/../views/product/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            $image = $_POST['image'] ?? '';

            if (empty($name) || empty($price) || empty($image)) {
                $_SESSION['error'] = "❌ Vui lòng điền đầy đủ thông tin bắt buộc";
                header('Location: /webbanhang/index.php?controller=product&action=add');
                exit;
            }

            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);

            if (is_array($result)) {
                $_SESSION['error'] = implode("<br>", $result);
                header('Location: /webbanhang/index.php?controller=product&action=add');
                exit;
            }

            if ($result) {
                $_SESSION['success'] = "✅ Thêm sản phẩm thành công!";
                header('Location: /webbanhang/index.php?controller=product&action=index');
                exit;
            } else {
                $_SESSION['error'] = isset($_SESSION['error']) ? $_SESSION['error'] : "❌ Đã xảy ra lỗi khi thêm sản phẩm.";
                header('Location: /webbanhang/index.php?controller=product&action=add');
                exit;
            }
        }
    }
            
    public function edit($id)
    {
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();
    
        if ($product) {
            require_once __DIR__ . '/../views/product/edit.php';
        } else {
            $_SESSION['error'] = "❌ Không tìm thấy sản phẩm.";
            header('Location: /webbanhang/index.php?controller=product&action=index');
            exit;
        }
    }
    
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $image = $_POST['image'] ?? $_POST['old_image'] ?? '';

            if (empty($name) || empty($price)) {
                $_SESSION['error'] = "❌ Vui lòng điền đầy đủ thông tin bắt buộc";
                header('Location: /webbanhang/index.php?controller=product&action=edit&id=' . $id);
                exit;
            }

            $edit = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);

            if ($edit) {
                $_SESSION['success'] = "✅ Cập nhật sản phẩm thành công!";
                header('Location: /webbanhang/index.php?controller=product&action=index');
                exit;
            } else {
                $_SESSION['error'] = "❌ Đã xảy ra lỗi khi cập nhật sản phẩm.";
                header('Location: /webbanhang/index.php?controller=product&action=edit&id=' . $id);
                exit;
            }
        }
    }

    public function delete($id)
    {
        if ($this->productModel->deleteProduct($id)) {
            $_SESSION['success'] = "✅ Xóa sản phẩm thành công!";
            header('Location: /webbanhang/index.php?controller=product&action=index');
            exit;
        } else {
            $_SESSION['error'] = "❌ Đã xảy ra lỗi khi xóa sản phẩm.";
            header('Location: /webbanhang/index.php?controller=product&action=index');
            exit;
        }
    }
}
